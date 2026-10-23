# Contact form

> **Status: recorded on 2026-10-23** from the decisions the owner took in September 2026.

## 1. What and why

Doctors who want to know more leave their data on `contact.php`; the request reaches `info@cismed.mx`
by email so LKM Soft can call or write back. Nothing is stored on the site.

## 2. Fields

All required:

| Field | Name | Rule |
|---|---|---|
| Nombre y apellidos | `full_name` | Name and at least one surname, letters only |
| Cédula profesional | `professional_license` | 5 to 8 digits; it replaced the CURP, which the landing never asks for |
| Especialidad | `specialty` | One of `MEDICAL_SPECIALTIES` (the owner's `specialties.txt`, 91 entries) |
| Celular | `mobile_phone` | 10 digits; a +52 or +521 prefix is accepted and removed |
| Correo electrónico | `email` | A valid address |
| Aviso de privacidad | `privacy_consent` | Must be accepted |

The same messages are checked in the browser (`assets/js/contact-form.js`) and on the server
(`includes/contact-form.php`).

## 3. Protection

A CSRF token rotated on every submission, the honeypot `website`, a minimum of 3 seconds to fill the
form, and 5 submissions per hour per IP (`CONTACT_RATE_LIMIT`, `CONTACT_RATE_WINDOW_SECONDS`). A spam
trap answers as a success so bots learn nothing.

## 4. Submission

`actions/send-contact.php` answers JSON to `fetch` and redirects back to `contact#contact-form`
without JavaScript. The email, sent with PHPMailer through IONOS SMTP, is titled «Nueva solicitud de
información: <name>» and replies to the visitor. Only the transport error is logged, never the
submitted data. A successful submission sends `generate_lead` to analytics, with no personal data.
