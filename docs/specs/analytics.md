# Analytics and cookie consent

> **Status: approved by the owner in September 2026**, with the GA4 measurement id `G-YZ7V24DNB5`.

## 1. When it loads

`analytics_enabled()` is true only when `GA_MEASUREMENT_ID` is set and the host is in
`ANALYTICS_HOSTS` (`cismed.mx`, `www.cismed.mx`). Local development never loads it.

## 2. Consent (Consent Mode v2)

- Every consent starts denied, with `wait_for_update: 500`; a visitor who accepted before
  (`localStorage` key `cismed_cookie_consent` = `granted`) is granted on load.
- The cookie banner stays until the visitor chooses; «Aceptar» grants `analytics_storage` only,
  «Rechazar» keeps it denied. «Preferencias de cookies» in the footer reopens it.
- The privacy notice explains the cookies (`privacy-notice#cookies`).

## 3. Events

| Event | When | Parameters |
|---|---|---|
| `generate_lead` | The contact form is sent | None personal |
| `whatsapp_click` | A WhatsApp link is clicked | `link_location` |
| `email_click` | A `mailto:` link is clicked | `link_location` (footer or page) |
| `create_account_click` | A «Crear cuenta» link is clicked | `link_location` |
| `medired_click` | A MediRed link is clicked | `link_location` |

No event carries personal data.
