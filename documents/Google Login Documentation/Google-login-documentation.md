# Sign in with Google: HTML API Reference (chapter notes)

> Source: https://developers.google.com/identity/gsi/web/reference/html-reference
> Page last updated by Google: 2026-09-01. Content of the original page is licensed CC BY 4.0 (code samples Apache 2.0).
> This file is a reorganized, reworded study version. Check the original page for authoritative wording.

## Contents

1. [Overview](#1-overview)
2. [Element with ID `g_id_onload`](#2-element-with-id-g_id_onload)
3. [Element with class `g_id_signin`](#3-element-with-class-g_id_signin)
4. [Server-side integration](#4-server-side-integration)

---

## 1. Overview

The HTML data-attributes API lets you show the **Sign in with Google button** and/or the **One Tap prompt** on a page without writing JavaScript to initialize them.

Key points:

- Configuration lives in `data-*` attributes on a marker element (`g_id_onload`) and on button elements (`g_id_signin`).
- Google returns an **ID token** (a JWT). You receive it either through a JS callback (`data-callback`) or via a POST to your endpoint (`data-login_uri`).
- Your server must handle the POST, verify the token, and sign the user in.
- Use the token's **`sub`** claim as the permanent user identifier.

---

## 2. Element with ID `g_id_onload`

Put these attributes on any element (visible or hidden, e.g. `<div>` or `<span>`) whose `id` is `g_id_onload`. Use this ID on **only one** element per page.

### 2.1 Attribute summary

| Attribute | Purpose |
| --- | --- |
| `data-client_id` | Your app's OAuth client ID |
| `data-color_scheme` | Color scheme of the One Tap prompt |
| `data-auto_prompt` | Whether One Tap is shown |
| `data-auto_select` | Auto-return a token when only one approved Google session exists |
| `data-login_uri` | Your login endpoint URL |
| `data-callback` | Name of the JS function that receives the ID token |
| `data-native_login_uri` | Endpoint for password credentials from the browser credential manager |
| `data-native_callback` | JS function for password credentials |
| `data-native_id_param` | Param name used for `credential.id` |
| `data-native_password_param` | Param name used for `credential.password` |
| `data-cancel_on_tap_outside` | Cancel the prompt when the user clicks outside it |
| `data-prompt_parent_id` | DOM ID of the container for the One Tap prompt |
| `data-skip_prompt_cookie` | Hide One Tap if this cookie has a non-empty value |
| `data-nonce` | Random string embedded in the ID token (replay protection) |
| `data-essential_claims` | Extra claims to request in the ID token |
| `data-context` | Wording of the One Tap title/message |
| `data-moment_callback` | Listener for prompt UI status changes |
| `data-state_cookie_domain` | Parent domain for a shared state cookie across subdomains |
| `data-ux_mode` | Button flow: `popup` or `redirect` |
| `data-allowed_parent_origin` | Origins allowed to embed the intermediate iframe |
| `data-intermediate_iframe_close_callback` | Custom behavior when the user closes One Tap in iframe mode |
| `data-itp_support` | Upgraded One Tap UX on ITP browsers |
| `data-login_hint` | Skip account selection with a hint |
| `data-hd` | Restrict account selection by domain |
| `data-use_fedcm_for_prompt` | **Deprecated**, ignored |
| `data-use_fedcm_for_button` | Use the FedCM button flow on supported Chrome |
| `data-button_auto_select` | Auto sign-in for returning users in the FedCM button flow |

### 2.2 Attribute details

#### `data-client_id`
- Type: string. **Required.**
- The client ID you create in the Google Cloud console.
- Example: `data-client_id="CLIENT_ID.apps.googleusercontent.com"`

#### `data-color_scheme`
- Type: string. Optional (defaults to the user's system preference).
- Values: `default` (follow system), `light`, `dark`.

#### `data-auto_prompt`
- Type: boolean. Optional. Default `true`.
- Set `false` to stop One Tap from appearing.

#### `data-auto_select`
- Type: boolean. Optional. Default `false`.
- When `true`, a token is returned with no user interaction if exactly one Google session has already approved your app.

#### `data-login_uri`
- Type: URL. Optional; defaults to the current page.
- Must exactly match one of the authorized redirect URIs configured for the OAuth 2.0 client, and follow Google's redirect URI validation rules.
- Can be omitted if the current page is the login page (the credential is posted to it).
- The ID token is POSTed here when no callback is defined and the user clicks the button/One Tap, or auto sign-in happens.
- Ignored when `data-ux_mode="popup"` and `data-callback` is set.
- Your endpoint must accept a POST with a `credential` parameter (see [Section 4](#4-server-side-integration)).

#### `data-callback`
- Type: string (function name). Required if `data-login_uri` isn't set.
- Which one to use depends on mode:
  - Button in `redirect` mode: `data-login_uri` is **required**, `data-callback` is ignored.
  - One Tap and button in `popup` mode: set at least one. If both are set, `data-callback` wins.
- Must be a **global** function. Namespaced functions (like `mylib.callback`) are not supported; use something like `mylibCallback`.

#### `data-native_login_uri`
- Type: string. Optional.
- Endpoint for password credentials from the browser's built-in credential manager. Setting this (or `data-native_callback`) makes the library fall back to the credential manager when no Google session exists.
- You may **not** set both `data-native_login_uri` and `data-native_callback`.

#### `data-native_callback`
- Type: string (global function name). Optional.
- JS handler for the password credential. Same fallback behavior and same "not both" rule as above.

#### `data-native_id_param`
- Optional. Name of the field carrying `credential.id` when posting to the password handler. Default: `email`.

#### `data-native_password_param`
- Optional. Name of the field carrying `credential.password`. Default: `password`.

#### `data-cancel_on_tap_outside`
- Type: boolean. Optional. Default `true`.
- Set `false` to keep the prompt open when the user clicks elsewhere.

#### `data-prompt_parent_id`
- Type: string. Optional.
- DOM ID of a container for the prompt. Without it, One Tap appears in the top-right corner.

#### `data-skip_prompt_cookie`
- Type: string. Optional.
- Name of a cookie; if it holds a non-empty value, One Tap is not shown.

#### `data-nonce`
- Type: string. Optional.
- Random value placed in the ID token to defend against replay attacks. Length is limited by the max JWT size your environment and browsers/servers allow.

#### `data-essential_claims`
- Type: string. Optional.
- Comma-separated extra claims to include in the token, e.g. `"auth_time, amr"`. See Google's OpenID Connect docs for supported claims.

#### `data-context`
- Type: string. Optional. Default `signin`.
- Changes the title/message text of One Tap (no effect on ITP browsers).

| Value | Resulting wording |
| --- | --- |
| `signin` | "Sign in to" |
| `signup` | "Sign up to" |
| `use` | "Use" |

#### `data-moment_callback`
- Type: string (global function name). Optional.
- Receives prompt UI status notifications (see `PromptMomentNotification` in the JS API reference).

#### `data-state_cookie_domain`
- Type: string. Optional.
- Use when One Tap runs on a parent domain and its subdomains, so a single shared-state cookie is used. Example: `example.com`.

#### `data-ux_mode`
- Type: string. Optional. Default `popup`. Only affects the button, not One Tap.
- `popup`: sign-in happens in a pop-up window.
- `redirect`: sign-in happens via full-page redirect.

#### `data-allowed_parent_origin`
- Type: string or comma-separated list. Optional.
- Origins permitted to embed the intermediate iframe. **If present, One Tap runs in intermediate iframe mode.** An invalid value makes initialization fail and stop.
- Wildcards are supported, e.g. `https://*.example.com` matches the root and all subdomains at any depth.
- Wildcard rules:
  - A pattern can't be just a wildcard plus a TLD (such as `https://*.com`).
  - Wildcard origins must start with `https://` (so `*.example.com` alone is invalid).
  - To list several domains, separate with commas.

#### `data-intermediate_iframe_close_callback`
- Type: function name. Optional.
- Only in intermediate iframe mode. Overrides the default (removing the iframe from the DOM right away) when the user taps the "X" on One Tap. It affects the intermediate iframe, not the One Tap iframe itself, and runs after One Tap UI is removed.

#### `data-itp_support`
- Type: boolean. Optional. Default `false`.
- Enables the upgraded One Tap UX on ITP-enabled browsers.

#### `data-login_hint`
- Type: string (email or the `sub` from an ID token). Optional.
- If you already know who should sign in, this skips account selection.

#### `data-hd`
- Type: string (domain) or `*`. Optional.
- Limits the accounts shown to a Workspace domain. `*` shows only Workspace accounts and excludes consumer accounts such as `@gmail.com`.

#### `data-use_fedcm_for_prompt`
- **Deprecated and ignored.** See Google's "Migrate to FedCM" guide.

#### `data-use_fedcm_for_button`
- Type: boolean. Optional. Default `false`.
- Turns on the FedCM button experience on Chrome desktop (M125+) and Android (M128+).

#### `data-button_auto_select`
- Type: boolean. Optional. Default `false`.
- For the FedCM button flow: returning users with an active Google session are signed in automatically, skipping the account chooser. Must be explicitly enabled during the opt-in launch.

---

## 3. Element with class `g_id_signin`

Add `g_id_signin` to an element's `class` to render it as a Sign in with Google button. You can place **multiple buttons** on one page, each with its own visual settings.

### 3.1 Attribute summary

| Attribute | Purpose |
| --- | --- |
| `data-type` | `standard` or `icon` |
| `data-theme` | Look of the button (outline, filled_blue, etc.) |
| `data-size` | `large`, `medium`, `small` |
| `data-text` | Label wording |
| `data-shape` | Corner/outline shape |
| `data-logo_alignment` | Logo position (`left` or `center`) |
| `data-width` | Minimum width in pixels (max 400) |
| `data-locale` | Language of button text |
| `data-click_listener` | Function called on click |
| `data-state` | String returned alongside the ID token |

### 3.2 Attribute details

#### `data-type`
- Default `standard`. Listed as required by Google.
- `standard`: button with text or personalized info.
- `icon`: icon-only button.

#### `data-theme`
- Default `outline`. Optional.

| Theme | Description | Key specs |
| --- | --- | --- |
| `outline` | Standard light button | Fill `#FFFFFF`, 1px inside stroke `#747775`, text `#1F1F1F` |
| `filled_blue` | Blue-filled | Fill `#0B57D0`, white text |
| `filled_black` | Black-filled with contrasting logo | Fill `#202124`, white text |
| `outline_dark` | Dark variant | Fill `#131314`, 1px inside stroke `#8E918F`, white text |

#### `data-size`
- Default `large`. Options: `large`, `medium`, `small`.

#### `data-text`
- Default `signin_with`. Optional.
- Icon buttons look the same for every value; the text only matters for screen readers.

| Value | Label |
| --- | --- |
| `signin_with` | "Sign in with Google" |
| `signup_with` | "Sign up with Google" |
| `continue_with` | "Continue with Google" |
| `signin` | "Sign in" |

#### `data-shape`
- Default `rectangular`. Optional.

| Value | Notes |
| --- | --- |
| `rectangular` | Rectangle. For `icon` buttons, same as `square`. |
| `pill` | Pill shape. For `icon` buttons, same as `circle`. |
| `circle` | Circle. For `standard` buttons, same as `pill`. |
| `square` | Square. For `standard` buttons, same as `rectangular`. |

#### `data-logo_alignment`
- Default `left`. Applies only to `standard` buttons.
- Values: `left`, `center`.

#### `data-width`
- Minimum width in pixels; the maximum available is 400. Optional.

#### `data-locale`
- Optional. Forces the button text language (e.g. `zh_CN`).
- You also need to load the library with the `hl` query parameter: `.../gsi/client?hl=<iso-639-code>`.
- If unset, the browser locale or Google session preference is used, so different users may see different (and differently sized) buttons.

#### `data-click_listener`
- Name of a JS function called whenever the button is clicked.

Minimal example (my own, equivalent in spirit to the official one):

```html
<script>
  function onSignInClick() {
    console.log("Google button clicked");
  }
</script>

<div class="g_id_signin"
     data-size="large"
     data-theme="outline"
     data-click_listener="onSignInClick"></div>
```

#### `data-state`
- Optional. Because several buttons can coexist, give each a unique string; it comes back with the ID token so you can tell which button was used.

---

## 4. Server-side integration

Your endpoints must handle HTTP **POST** requests. Clients must ignore unrecognized response parameters.

### 4.1 ID token handler endpoint

Purpose: receive the ID token, then depending on the account's state, sign the user in, send them to sign-up, or send them to account linking.

Shape of the request (illustrative):

```http
POST /login HTTP/1.1
Content-Type: application/x-www-form-urlencoded
Cookie: g_csrf_token=<RANDOM_STRING>

credential=<JWT>&g_csrf_token=<RANDOM_STRING>
```

Request contents:

| Where | Name | Meaning |
| --- | --- | --- |
| Cookie | `g_csrf_token` | Random string, changes per request; must equal the body parameter |
| Body param | `g_csrf_token` | Same value as the cookie |
| Body param | `credential` | The JWT ID token issued by Google |
| Body param | `select_by` | How the user signed in |
| Body param | `state` | Only present if a button was clicked and had `data-state` |

#### `credential` (the ID token)

Header and payload claims you'll typically see:

| Claim | Meaning |
| --- | --- |
| `alg`, `kid`, `typ` (header) | Signing algorithm (RS256), key ID, token type |
| `iss` | Issuer (`https://accounts.google.com`) |
| `aud` | Your client ID |
| `azp` | Authorized party (client ID) |
| `sub` | Unique, never-reused ID of the Google Account |
| `hd` | Workspace host domain, if any |
| `email`, `email_verified` | Email and whether Google verified it |
| `name`, `given_name`, `family_name`, `picture` | Profile info (when present) |
| `auth_time`, `amr` | Authentication time/methods (if requested via `data-essential_claims`) |
| `nbf`, `iat`, `exp` | Not-before, issued-at, expiry timestamps |
| `jti` | Token ID |

Rules and cautions:

- Clients must ignore unrecognized claims.
- **Identify users only by `sub`.** Do not use email as an identifier: an account can have different addresses over time.
- **When Google is authoritative for an email** (the user is confirmed as the legitimate owner):
  - `email` ends in `@gmail.com`, or
  - `email_verified` is true **and** `hd` is set (Workspace account).
- Otherwise (non-Gmail address, no `hd`), Google is not authoritative; verifying with a password or another challenge is recommended, even if `email_verified` is true, since ownership of a third-party address may have changed.
- `exp` is one hour for tokens from Sign in with Google. You must **verify the token on your server before it expires**. Don't use `exp` for session management; an expired ID token doesn't mean the user is signed out. Session handling is your app's job.

#### `g_csrf_token`
- A CSRF defense created by the `gsi/client` library, sent both as a cookie and as a body parameter. If the two values don't match, treat the request as invalid.

#### `select_by`
Tells you how the user signed in. It is derived from the button type, session state and consent state.

| Value | Meaning |
| --- | --- |
| `auto` | Automatic sign-in of a user with an existing session who had already consented (non-FedCM browsers only) |
| `user` | User with existing session and prior consent tapped One Tap "Continue as" (non-FedCM only) |
| `fedcm` | User tapped One Tap "Continue as" via FedCM (FedCM-supported browsers) |
| `fedcm_auto` | Automatic sign-in via FedCM One Tap with prior consent |
| `user_1tap` | User with existing session tapped "Continue as" and granted consent (Chrome 75+) |
| `user_2tap` | User without a session tapped "Continue as", chose an account, then confirmed consent in a pop-up (non-Chromium browsers) |
| `itp` | Previously consented user tapped One Tap on an ITP browser |
| `itp_confirm` | User without prior consent tapped One Tap on an ITP browser and pressed "Continue" |
| `btn` | Previously consented user clicked the button and picked an account |
| `btn_confirm` | User without prior consent clicked the button and pressed "Continue" |

#### `state`
- Present only when a Sign in with Google button was clicked and it had `data-state`. Equals that attribute's value. Useful to identify which of several buttons was used.

### 4.2 Password credential handler endpoint

Handles password credentials retrieved by the browser's built-in credential manager (used with `data-native_login_uri`).

| Where | Name | Meaning |
| --- | --- | --- |
| Cookie | `g_csrf_token` | Random string; must match the body parameter (relates to the endpoint in `data-native_login_uri`) |
| Body param | `g_csrf_token` | Same value as the cookie |
| Body param | `email` | The credential's ID (default name; renamable via `data-native_id_param`) |
| Body param | `password` | The credential's password (default name; renamable via `data-native_password_param`) |

> Note: the original page's parameter descriptions for `email` and `password` in this table appear to be swapped/mislabeled (they read like the ID-token table). Treat them as the credential ID and password.

---

### Further reading (linked from the original page)

- Verify a Google ID token on your server
- Handle credential responses with JS functions
- Migrate to FedCM
- OpenID Connect `login_hint` / `hd` parameters
- JavaScript API reference for Sign in with Google