# MediRed on the landing

> **Status: approved by the owner on 2026-10-23**, from
> `resource-tmp-folder/medired/brief-medired-para-cismed.md`.

## 1. What and why

MediRed (`https://medired.mx`) is LKM Soft's online medical directory. Every CISMed plan includes it:
a doctor's public profile, online appointments that reach their CISMed agenda, reviews from verified
patients and Google's rating of their practice. The landing presents it as part of CISMed.

## 2. The rule

**The landing only presents MediRed and links to it.** Its sign-up, subscriptions, terms and privacy
notice belong to MediRed. The landing never copies its prices (the sponsored position is «opcional»,
without a price, by the owner's decision), never explains it for doctors who do not use CISMed, never
says every professional license is verified or that the listing is ordered by rating, and never shows
figures of doctors, appointments or patients.

## 3. Where it is shown

- **Features:** the module «MediRed» (`MODULES`, anchor `medired`), after «Agenda médica», with six
  points and the button «Conoce MediRed».
- **Home:** the section «Tus pacientes te encuentran en MediRed» after the agenda showcase, with the
  first three points of the module; the plans summary says every plan includes MediRed. The module is
  kept off the home modules grid (`'home' => false`).
- **Plans:** the row «Perfil y citas en línea en MediRed», included in every plan (`plans.md`).
- **FAQ:** the group «MediRed» with «¿Qué es MediRed?», «¿Cómo aparezco en MediRed?» and «¿Los
  pacientes pueden agendar conmigo en línea?».
- **Footer:** «MediRed, directorio médico».
- **Promo flyer:** the strip «Incluye MediRed».

Every link is built by `medired_link_attributes()` (`MEDIRED_URL`, new tab) and reported as
`medired_click` with its location (`analytics.md`).
