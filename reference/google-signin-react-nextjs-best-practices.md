# Google Sign-In with React & Next.js — Best Practices

This builds on the general web guide. The short version: **for a plain React SPA**, wiring GIS directly (or via a thin wrapper) is fine. **For Next.js**, don't hand-roll the GIS integration — use a proper auth library, because Server/Client Component boundaries and edge middleware make raw token-handling error-prone. Details below.

---

## Part 1: Plain React (client-side SPA, no SSR)

### Use `@react-oauth/google` instead of raw GIS calls

It's a thin, well-maintained wrapper around Google Identity Services that plays nicely with React's render lifecycle (handles script loading, cleanup, and re-renders for you).

```bash
npm install @react-oauth/google
```

```jsx
// main.jsx / App root
import { GoogleOAuthProvider } from "@react-oauth/google";

<GoogleOAuthProvider clientId={import.meta.env.VITE_GOOGLE_CLIENT_ID}>
  <App />
</GoogleOAuthProvider>
```

```jsx
// LoginButton.jsx
import { GoogleLogin } from "@react-oauth/google";

function LoginButton() {
  return (
    <GoogleLogin
      onSuccess={async (credentialResponse) => {
        const res = await fetch("/api/auth/google", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ idToken: credentialResponse.credential }),
          credentials: "include", // needed if backend sets an httpOnly cookie
        });
        if (res.ok) window.location.href = "/dashboard";
      }}
      onError={() => console.error("Google sign-in failed")}
      useOneTap
    />
  );
}
```

### React-specific gotchas

- **Don't store the ID token (or your session token) in `localStorage`.** It's readable by any injected script — an XSS bug becomes an account-takeover bug. Have your backend set an `HttpOnly`, `Secure`, `SameSite=Lax` cookie instead, and never touch it from JS.
- **Verify server-side, always.** The React layer only *collects* the credential; a real backend (Node/Express, Django, whatever) must verify it as described in the previous guide before you trust it.
- **Guard against double-init.** If you roll your own GIS integration instead of the wrapper, initialize `google.accounts.id` once (e.g., in a top-level effect with an empty dependency array, or a module-level flag) — re-running `initialize()` on every re-render causes duplicate buttons or console warnings.
- **`credentials: "include"`** is required on your fetch calls if you're setting cross-origin cookies (frontend and API on different subdomains) — and your backend CORS config needs `Access-Control-Allow-Credentials: true` with an explicit origin (not `*`).

---

## Part 2: Next.js — the more important decision

### Don't hand-roll this. Pick an auth library.

In Next.js, especially App Router, "just call Google's JS SDK from a component" runs into real problems:
- GIS needs `window`/DOM, so any component touching it must be a Client Component (`"use client"`), but your session check for protecting routes needs to happen on the server (Server Components, Route Handlers, or middleware/proxy) — mixing these by hand is where most bugs come from.
- As of Next.js 16, `middleware.ts` was renamed to `proxy.ts` and requires a named `proxy` export (or default export) — most existing tutorials, including official docs for several auth libraries, still show the old pattern and will throw immediately on Next.js 16.
- **CVE-2025-29927** (disclosed March 2025) showed that middleware-only session protection is bypassable by spoofing the `x-middleware-subrequest` header. Practical takeaway: **never rely solely on middleware/proxy to gate access** — treat it as a UX-level redirect optimization, and always re-verify the session inside the actual Server Component, Route Handler, or Server Action that serves protected data.

### Which library, for which situation

| If you need... | Use |
|---|---|
| Full ownership of user data, self-hosted, no vendor lock-in | **Better Auth** — current recommended default for new projects |
| Fastest possible setup, don't mind a hosted vendor, <50K users | **Clerk** |
| Enterprise SSO (SAML/OIDC/SCIM) now or soon | **WorkOS AuthKit** |
| Maintaining an existing NextAuth/Auth.js v4/v5 app | **Auth.js v5** (it's in maintenance/security-patch mode now — its own maintainers point new projects to Better Auth) |

### Example: Better Auth + Google in Next.js 16 (App Router)

```bash
npm install better-auth
```

```bash
# .env.local
BETTER_AUTH_SECRET=<openssl rand -base64 32>
BETTER_AUTH_URL=http://localhost:3000
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
```

```typescript
// lib/auth.ts
import { betterAuth } from "better-auth";
import { prismaAdapter } from "better-auth/adapters/prisma";
import { nextCookies } from "better-auth/next-js";
import { prisma } from "@/lib/db";

export const auth = betterAuth({
  database: prismaAdapter(prisma, { provider: "postgresql" }),
  socialProviders: {
    google: {
      clientId: process.env.GOOGLE_CLIENT_ID!,
      clientSecret: process.env.GOOGLE_CLIENT_SECRET!,
    },
  },
  plugins: [nextCookies()], // required — without it, Server Actions silently fail to set cookies
});
```

```typescript
// app/api/auth/[...all]/route.ts
import { auth } from "@/lib/auth";
import { toNextJsHandler } from "better-auth/next-js";

export const { GET, POST } = toNextJsHandler(auth);
```

```typescript
// lib/auth-client.ts (client-side helper)
"use client";
import { createAuthClient } from "better-auth/react";
export const authClient = createAuthClient();
```

```tsx
// components/GoogleSignInButton.tsx
"use client";
import { authClient } from "@/lib/auth-client";

export function GoogleSignInButton() {
  return (
    <button onClick={() => authClient.signIn.social({ provider: "google", callbackURL: "/dashboard" })}>
      Sign in with Google
    </button>
  );
}
```

```typescript
// proxy.ts — Next.js 16 naming; UX-level redirect only, NOT the security boundary
import { getSessionCookie } from "better-auth/cookies";
import { NextRequest, NextResponse } from "next/server";

export async function proxy(request: NextRequest) {
  const sessionCookie = getSessionCookie(request); // existence check only, not full validation
  if (!sessionCookie && request.nextUrl.pathname.startsWith("/dashboard")) {
    return NextResponse.redirect(new URL("/sign-in", request.url));
  }
  return NextResponse.next();
}

export const config = { matcher: ["/dashboard/:path*"] };
```

```tsx
// app/dashboard/page.tsx — the REAL security boundary
import { auth } from "@/lib/auth";
import { headers } from "next/headers";
import { redirect } from "next/navigation";

export default async function DashboardPage() {
  const session = await auth.api.getSession({ headers: await headers() });
  if (!session) redirect("/sign-in"); // full DB-backed check happens here
  return <div>Welcome, {session.user.name}</div>;
}
```

Note the pattern: `proxy.ts` does a cheap cookie-existence check purely to bounce obviously-logged-out users early (good UX, avoids a flash of protected content). The actual authorization decision happens again inside the Server Component with a real database-backed session lookup — that's the part CVE-2025-29927 can't bypass, because it can only spoof what the edge middleware sees, not a check running inside the route itself.

### Next.js-specific best practices checklist

- [ ] Treat middleware/proxy as a UX convenience, never the sole security boundary (post-CVE-2025-29927 guidance)
- [ ] Re-check the session inside every Server Component / Route Handler / Server Action that touches protected data
- [ ] Keep provider secrets (`GOOGLE_CLIENT_SECRET`) server-only — never prefix them with `NEXT_PUBLIC_`
- [ ] Only the client ID (public by design) can safely be `NEXT_PUBLIC_GOOGLE_CLIENT_ID` if a client component needs it
- [ ] Any component touching `window`, the GIS script, or browser storage needs `"use client"` — keep it as small/leaf as possible and do the actual auth logic (verification, session creation) server-side
- [ ] On Next.js 16, use `proxy.ts` with a named `proxy` export — the old `middleware.ts` / `export { auth as middleware }` pattern throws immediately
- [ ] Decide your session storage model deliberately: JWT-in-cookie (fast, edge-compatible, but can't be revoked before expiry without extra work) vs. database-backed session (immediate revocation, but requires Node.js runtime — not edge)
- [ ] Don't pass class-instance user objects (e.g., some SDKs' `currentUser()`) directly from a Server Component to a Client Component — serialize to a plain object first or you'll hit a "only plain objects can be passed to Client Components" error
- [ ] Version-control your OAuth provider config where possible (code-based config, like Better Auth or Auth.js) rather than dashboard-only config (like Clerk) if you want changes to go through code review

---

## Quick decision summary

- **Plain React SPA + your own backend** → `@react-oauth/google` on the frontend, verify the ID token server-side, issue your own httpOnly session cookie.
- **Next.js, new project, want to own your data** → Better Auth with the Google social provider.
- **Next.js, want the fastest setup and don't mind a hosted vendor** → Clerk.
- **Next.js, need enterprise SSO** → WorkOS AuthKit.
- **Either way** → middleware/proxy is a UX nicety, not your security boundary — always re-verify server-side where the protected data actually lives.
