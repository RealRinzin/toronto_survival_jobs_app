# Sign in with Google — Complete Step-by-Step Web Implementation Guide

This covers Google's current system, **Google Identity Services (GIS)**, which replaced the old deprecated `gapi.auth2` library. If you see tutorials using `gapi.auth2.init()`, ignore them — that library is dead.

---

## Overview of the architecture

GIS separates two distinct moments:

| Moment | API | Returns | Purpose |
|---|---|---|---|
| **Authentication** | Sign in with Google | ID token (JWT) | Logs the user into *your* site |
| **Authorization** | Google Identity Services Authorization API | Access/code token | Lets you call Google APIs (Calendar, Drive, etc.) |

You almost always want just the **authentication** flow for "login with Google." You only need the authorization flow if you're also pulling data from a Google API on the user's behalf. This guide focuses on authentication (sign-in), with a note on authorization at the end.

---

## Step 1: Create a Google Cloud project

1. Go to [console.cloud.google.com](https://console.cloud.google.com).
2. Create a new project (or select an existing one) — top-left project dropdown → "New Project."
3. Give it a name that matches your app (this becomes visible to users on the consent screen).

## Step 2: Configure the OAuth consent screen

1. In the Cloud Console, go to **APIs & Services → OAuth consent screen**.
2. Choose **User Type**:
   - **External** — anyone with a Google account (what you want for a public website).
   - **Internal** — only available if you're on Google Workspace, restricts to your org.
3. Fill in the required branding fields:
   - App name
   - User support email
   - App logo (optional but recommended — builds trust)
   - App domain, homepage, privacy policy link, terms of service link
   - Developer contact email
4. Add scopes. For basic sign-in you only need:
   - `.../auth/userinfo.email`
   - `.../auth/userinfo.profile`
   - `openid`
5. Add test users while your app is in "Testing" mode (required before verification).
6. If you'll go to production with sensitive/restricted scopes, you'll eventually need to submit for **OAuth verification** — for basic profile/email scopes this usually isn't required, but check current Google policy for your case.

## Step 3: Create an OAuth Client ID

1. Go to **APIs & Services → Credentials → Create Credentials → OAuth client ID**.
2. Application type: **Web application**.
3. Name it (e.g., "Production Web Client").
4. Add **Authorized JavaScript origins** — the exact origin(s) your frontend runs on:
   ```
   https://www.yourapp.com
   http://localhost:3000   (for local dev)
   ```
5. Add **Authorized redirect URIs** only if you're using a redirect-based flow (not needed for the standard popup/One Tap/button flow, which uses a JS callback instead).
6. Save. You'll get a **Client ID** like:
   ```
   721724668570-abcxyz.apps.googleusercontent.com
   ```
   You do *not* get a client secret for pure sign-in (the secret is only relevant for server-side authorization code exchange).

⚠️ Common pitfall: origins must match **exactly**, including protocol and port. `http://localhost:3000` and `http://127.0.0.1:3000` are treated as different origins.

---

## Step 4: Add the GIS library to your page

Add this script tag (no npm package needed — it's loaded from Google's CDN):

```html
<script src="https://accounts.google.com/gsi/client" async defer></script>
```

## Step 5: Initialize Sign in with Google

You have two front-end presentation options that both feed the same callback: the **button** and **One Tap**. You can use either or both.

### Option A: The rendered button

```html
<div id="g_id_onload"
     data-client_id="YOUR_CLIENT_ID.apps.googleusercontent.com"
     data-context="signin"
     data-ux_mode="popup"
     data-callback="handleCredentialResponse"
     data-auto_prompt="false">
</div>

<div class="g_id_signin"
     data-type="standard"
     data-shape="rectangular"
     data-theme="outline"
     data-text="signin_with"
     data-size="large"
     data-logo_alignment="left">
</div>
```

Or do it in pure JS instead of HTML data-attributes:

```javascript
window.onload = function () {
  google.accounts.id.initialize({
    client_id: "YOUR_CLIENT_ID.apps.googleusercontent.com",
    callback: handleCredentialResponse,
    use_fedcm_for_prompt: true // important — see Step 8
  });

  google.accounts.id.renderButton(
    document.getElementById("g_id_signin_div"),
    { theme: "outline", size: "large", text: "signin_with" }
  );
};
```

### Option B: One Tap (auto-prompt for already-signed-in Google users)

```javascript
google.accounts.id.initialize({
  client_id: "YOUR_CLIENT_ID.apps.googleusercontent.com",
  callback: handleCredentialResponse,
  use_fedcm_for_prompt: true
});

google.accounts.id.prompt(); // triggers the One Tap UI
```

You can combine both — render the button as a fallback and also call `prompt()` for users who qualify for One Tap.

## Step 6: Handle the credential response (client side)

This callback fires once the user completes sign-in. It receives a JWT **ID token** — do not trust it yet, it must be verified server-side.

```javascript
function handleCredentialResponse(response) {
  const idToken = response.credential; // this is the JWT

  // Send it to your backend to verify and create a session
  fetch("/api/auth/google", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ idToken })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      window.location.href = "/dashboard";
    }
  });
}
```

---

## Step 7: Verify the ID token on your server

**This step is non-negotiable.** Never treat the raw JWT from the browser as trusted proof of identity without verifying its signature, issuer, audience, and expiry against Google's public keys.

### Node.js (using `google-auth-library`)

```bash
npm install google-auth-library
```

```javascript
const { OAuth2Client } = require("google-auth-library");
const client = new OAuth2Client(CLIENT_ID);

async function verify(idToken) {
  const ticket = await client.verifyIdToken({
    idToken,
    audience: CLIENT_ID, // must match your OAuth client ID
  });
  const payload = ticket.getPayload();
  // payload.sub      -> stable unique Google user ID (use this as your primary key)
  // payload.email
  // payload.email_verified
  // payload.name
  // payload.picture
  return payload;
}
```

### Python (using `google-auth`)

```bash
pip install google-auth
```

```python
from google.oauth2 import id_token
from google.auth.transport import requests

def verify(token):
    idinfo = id_token.verify_oauth2_token(
        token, requests.Request(), CLIENT_ID
    )
    # idinfo['sub'], idinfo['email'], idinfo['name'], idinfo['picture']
    return idinfo
```

### What to check regardless of language
- Signature is valid (handled automatically by the libraries above using Google's public JWKs)
- `aud` claim matches your client ID
- `iss` claim is `https://accounts.google.com` or `accounts.google.com`
- `exp` claim hasn't passed
- `email_verified` is `true` if you're using email as an identifier

## Step 8: Create your own session

Once verified, don't just keep re-using Google's token as your session mechanism. Instead:

1. Look up or create a user record in your database keyed on `payload.sub` (this ID is stable and unique — don't key on email, since email can theoretically change).
2. Issue your own session — either a signed cookie/session token or your own JWT.
3. Return that to the client and treat it as the source of truth for your app's auth going forward.

```javascript
// after verifying payload...
let user = await db.users.findOne({ googleId: payload.sub });
if (!user) {
  user = await db.users.create({
    googleId: payload.sub,
    email: payload.email,
    name: payload.name,
    avatar: payload.picture
  });
}
const sessionToken = createYourAppSessionToken(user);
res.cookie("session", sessionToken, { httpOnly: true, secure: true, sameSite: "lax" });
```

---

## Step 9: Enable FedCM (important, do this now)

Chrome is phasing out third-party cookies, and GIS has migrated to the **Federated Credential Management (FedCM)** API as the privacy-preserving replacement for the old iframe/cookie-based flow. For new integrations, always enable it explicitly:

```javascript
google.accounts.id.initialize({
  client_id: "YOUR_CLIENT_ID.apps.googleusercontent.com",
  callback: handleCredentialResponse,
  use_fedcm_for_prompt: true
});
```

If you built an integration before this became the default, check Google's FedCM migration guide — some older iframe-based intermediate flows need updating or they'll silently stop working in Chrome.

## Step 10: Sign-out and automatic sign-in

- `google.accounts.id.disableAutoSelect()` — call this when the user explicitly logs out of *your app*, so the browser doesn't immediately re-prompt them next visit.
- Your own session logout (clearing your cookie/session) is separate from this — do both.

```javascript
function logout() {
  google.accounts.id.disableAutoSelect();
  fetch("/api/auth/logout", { method: "POST" })
    .then(() => window.location.href = "/");
}
```

---

## If you also need Google API access (not just sign-in)

This is the separate **authorization** moment — use it only when your app actually needs to call a Google API (e.g., read the user's Calendar). Don't request this at sign-in time; ask when the feature is actually used (**incremental authorization**).

```javascript
const client = google.accounts.oauth2.initTokenClient({
  client_id: "YOUR_CLIENT_ID.apps.googleusercontent.com",
  scope: "https://www.googleapis.com/auth/calendar.readonly",
  callback: (tokenResponse) => {
    // tokenResponse.access_token — use this to call the Google API
  }
});

// Trigger it only when the user clicks "Connect Calendar" or similar:
document.getElementById("connect-calendar-btn").addEventListener("click", () => {
  client.requestAccessToken();
});
```

---

## Security & best-practice checklist

- [ ] Verify ID tokens server-side against Google's public keys — never trust the client-decoded JWT
- [ ] Check `aud`, `iss`, `exp`, and `email_verified` claims
- [ ] Use `sub` (not email) as your stable user identifier
- [ ] Serve everything over HTTPS; match authorized origins exactly
- [ ] Never expose a client secret in frontend code (you shouldn't need one for pure sign-in anyway)
- [ ] Enable FedCM (`use_fedcm_for_prompt: true`)
- [ ] Request only `profile`/`email` scopes at sign-in; use incremental authorization for anything else
- [ ] Call `disableAutoSelect()` on explicit logout
- [ ] Consider integrating **Cross-Account Protection** so you're notified if a user's Google account is suspended or they revoke access, so you can respond (force logout, flag account, etc.)
- [ ] Offer an alternative sign-in method (email/password or another provider) where feasible — if a user's Google account is suspended, they lose access to everything tied to it, so have a recovery path
- [ ] Test in Chrome, Safari, and Firefox — third-party identity handling differs meaningfully across browsers, especially post-FedCM

## Common pitfalls

- **"redirect_uri_mismatch" or origin errors** — almost always an exact-match issue (trailing slash, http vs https, missing port) between what's registered in Cloud Console and what the browser sends.
- **One Tap not appearing** — it won't show if the user recently dismissed it, is not signed into a Google account in that browser, or third-party cookies/FedCM aren't configured correctly.
- **Treating the ID token as a session** — it expires quickly and isn't meant to be your ongoing session mechanism; always exchange it for your own session token.
- **Forgetting `email_verified`** — an email can be present but unverified; don't treat it as a confirmed identifier without checking this claim.
