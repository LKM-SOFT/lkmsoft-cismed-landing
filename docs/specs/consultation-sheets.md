# Consultation sheets by specialty

> **Status: recorded on 2026-10-23.** Every sheet is described only from CISMed's code or its
> specification, or from the owner's own description (constitution 6.1).

## 1. What and why

CISMed has a general consultation sheet and specialized sheets. The landing lists them so a doctor
knows whether CISMed covers their specialty.

## 2. Where they are shown

A new sheet is added to all of these in the same change:

- `SPECIALTIES` in `includes/content.php`: a card on the specialties page and in the home grid
  (`slug`, `icon`, `title`, `summary`, `intro`, `points`);
- a point of the consultations module (`MODULES`, anchor `consultations`) on the features page;
- the FAQ answer «¿Qué especialidades tienen hoja de consulta?»;
- the lead and the meta description of `specialties.php`;
- the «Consultas» line of the promo flyer (`resource-tmp-folder/promo/make-promo.js`).

If the specialty was among `UPCOMING_SPECIALTIES`, it is removed from there.

## 3. The sheets on the site

| Specialty | Source | Added |
|---|---|---|
| Medicina general | CISMed | September 2026 |
| Ginecología (control prenatal, diagnóstico de climaterio) | CISMed | September 2026 |
| Pediatría | CISMed | September 2026 |
| Estomatología (odontograma) | CISMed | September 2026 |
| Oftalmología | CISMed | September 2026 |
| Nutrición | The owner's description | 2026-10-05 |
| Cardiología and Cardiología Intervencionista | `docs/specs/cardiology-sheet.md` in CISMed | 2026-10-23 |

The cardiology sheet was published while it was only on CISMed's `qa`, by the owner's decision.

## 4. Upcoming sheets

`UPCOMING_SPECIALTIES` (today Nefrología and Ortopedia) shows sheets being built, with the end of the
name blurred and a loading placeholder, never a date. The home grid shows only as many as it takes to
complete its last row of four, and none on phones. `CONSULTATION_SHEETS_NOTE` says more sheets are
coming.
