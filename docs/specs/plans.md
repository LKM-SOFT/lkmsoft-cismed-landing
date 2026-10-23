# Plans and prices

> **Status: recorded on 2026-10-23** from the decisions the owner took between September 2026 and
> 2026-10-23. Prices and features follow the owner's instructions exactly (constitution 6.1).

## 1. What and why

The plans page (`plans.php`) and the plans summary of the home page (`index.php`, `#plans`) show the
CISMed licenses a doctor or a clinic can buy, so a visitor can compare them and create an account.

## 2. The plans

| Plan | Price (MXN per month, VAT included) | Doctors | Nurses and assistants | Features included |
|---|---|---|---|---|
| Classic | $400 | 1 | 1 | 8 |
| Master | $1,000 | 2 | 2 | 9 |
| Premium | $2,100 | 3 | Ilimitado | 11 |
| Gold | $3,500 | 5 | Ilimitado | 11 |
| Platinum | $4,900 | 7 | Ilimitado | 11 |
| Black | $7,000 | 10 | Ilimitado | 11 |

Every plan can be paid monthly, quarterly, half-yearly or yearly («Mensual, Trimestral, Semestral o
Anual»), with different discounts by cycle. The discounts themselves are not published.

## 3. The features

`PLAN_FEATURES`, in this order. A plan's count marks the first features it includes; the rest show as
not included.

1. Agenda médica
2. Integración con Google Calendar
3. Perfil y citas en línea en MediRed
4. Consulta externa y hojas de consulta especializadas
5. Receta electrónica
6. Almacenamiento ilimitado en la nube
7. Estadísticas y reportes
8. Notificaciones y recordatorios vía correo electrónico
9. Notificaciones y recordatorios vía WhatsApp (from Master)
10. Facturación electrónica (from Premium)
11. Inventario (from Premium)

A feature every plan includes goes before the ones some plans lack, and inserting one moves every count.

## 4. The cards

- Each card shows the name, the price with «.00», «MXN al mes, IVA incluido», the doctors and the
  nurses and assistants, the features (included or not), and a «Crear cuenta» button to CISMed's
  sign-up (`account_link_attributes('plan_<name>')`).
- Under the cards, «¿Necesitas algo diferente?» leads to the contact page.

## 5. Decisions taken with the owner

| Date | Decision |
|---|---|
| September 2026 | Six plans, four billing cycles with different discounts, «¿Necesitas algo diferente?» |
| October 2026 | Google Calendar under «Agenda médica» in every plan |
| 2026-10-04 | Inventory from Premium; prices raised twice (final list in section 2) |
| 2026-10-09 | SMS removed from the product and from every plan |
| 2026-10-23 | MediRed as a row included in every plan, never with a price of its own |
