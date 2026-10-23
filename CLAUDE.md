# CLAUDE.md

Instructions for AI agents working on this repository.

## The constitution comes first

The project constitution is loaded below. Its rules apply to every change, and its boundaries
(Always / Ask first / Never) decide what may be done without asking. When a request, a plan or
existing code contradicts it, say so before acting instead of silently following either side.

@constitution.md

## Working with the owner

- Talk to the owner in **Spanish**. Everything written into the repository stays in English, as the
  constitution requires.
- Work spec-first:
  1. Agree on what to build and why before planning how.
  2. Agree on the plan and the texts before writing code (the owner approves every new copy).
  3. Split the work into small, reviewable steps (the landing was built in numbered phases, each one
     approved before the next).
- When information is missing (a feature, a text, a figure), ask; never fill the gap with invented
  content.
- When delivering, report:
  - what was verified, with the real results (status codes, warnings, counts, what was seen in the
    browser);
  - what was not verified;
  - the decisions taken on the owner's behalf.
- Commits, pushes and pull requests only when the owner asks. Each change goes in its own
  `feature/*` branch from `main`, with a pull request into `main` (constitution 8).
- WAMP serves the repository folder, so the owner's local checks see whatever branch is checked out.
  Say which branch it is when switching. The owner sometimes leaves local edits uncommitted (for
  example `APP_URL_LOCAL` in `includes/config.php`): leave them out of commits unless asked.

---

## 1. The project at a glance

| | |
|---|---|
| Product | **CISMed** — expediente clínico electrónico en la nube |
| Company | LKM Soft (also the maker of MediRed) |
| Domain | `https://cismed.mx` (canonical, without `www`) |
| Repository | `LKM-SOFT/lkmsoft-cismed-landing` (this folder: `D:\WORK\TOOLS\wamp64\www\cismed`) |
| Application | `https://app.cismed.mx` (sign-up at `/registration/doctor`); QA at `https://sandbox.cismed.mx` |
| Source of product facts | CISMed repository, `D:\WORK\PROJECTS\PERSONAL\LKMSOFT\CIS_VAADIN\WEBAPP` (`docs/specs/`) |
| Sister site | MediRed, `https://medired.mx` (`D:\WORK\TOOLS\wamp64\www\medired`), built on this landing |

### Pages

| Page | File | What it holds |
|---|---|---|
| Inicio | `index.php` | Hero, highlights, modules grid, agenda showcase, specialties, audiences, plans summary, FAQ, call to action |
| Funciones | `features.php` | One section per entry of `MODULES`, with a module navigation |
| Especialidades | `specialties.php` | One card per entry of `SPECIALTIES` |
| Planes | `plans.php` | Billing cycles, one card per plan with `PLAN_FEATURES`, «¿Necesitas algo diferente?» |
| Preguntas frecuentes | `faq.php` | `FAQ_GROUPS`, with `FAQPage` JSON-LD |
| Contacto | `contact.php` | Contact form (`actions/send-contact.php`), email and WhatsApp |
| Aviso de privacidad | `privacy-notice.php` | Approved by the owner; dated 01/09/2026 |
| 404 | `404.php` | `ErrorDocument 404` |

### Current state (2026-10-23)

- Consultation sheets on the site: general medicine, gynecology (prenatal control, climacteric),
  pediatrics, stomatology (odontogram), ophthalmology, nutrition and cardiology. Upcoming cards:
  Nefrología, Ortopedia (the home grid shows only the one that completes its last row).
- Plans: Classic $400, Master $1,000, Premium $2,100, Gold $3,500, Platinum $4,900, Black $7,000
  (MXN per month, VAT included), billed monthly, quarterly, half-yearly or yearly. Inventory from
  Premium up; WhatsApp notifications from Master up; SMS was removed from the product (2026-10-09).
- WhatsApp: 56 5407 3364 (`5215654073364`), message «Hola CISMED 👋 ¡Me gustaría recibir informes!».
- MediRed is presented since pull request #7: a features module, a home section, a row included in
  every plan, a FAQ group and a footer link, with `medired_link_attributes()` and the
  `medired_click` event. The cardiology sheet was only on CISMed's `qa` when it was published; the
  owner chose to publish it anyway.
- Promo flyer and Facebook cover (outside git, `resource-tmp-folder/promo`, `resource-tmp-folder/social`)
  are up to date with the content above.
- Specifications of every feature: `docs/specs/` (plans, consultation sheets, MediRed, contact form,
  analytics, privacy notice).
- No decision is open in the constitution (section 11).

---

## 2. How the landing is built

### 2.1 PHP pages

```php
<?php
$page = [
    'slug'        => 'plans',              // canonical path, nav highlight, body class
    'title'       => 'Planes',             // <title>: "Planes | CISMed"
    'heading'     => '...',                // h1 of the page header (defaults to title)
    'lead'        => '...',                // paragraph under the h1
    'description' => '...',                // meta description + Open Graph
    // optional: 'robots' => 'noindex', 'schema' => [ ...JSON-LD arrays ], 'scripts' => ['js/x.js']
];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/page-header.php';   // inner pages only
?>
        <!-- section name start -->
        <section class="... section-t-space section-b-space"> ... </section>
        <!-- section name end -->
<?php
require __DIR__ . '/includes/footer.php';
```

- `head.php` requires `config.php`, `navigation.php`, `content.php` and `whatsapp.php` once.
- Sections use the template's spacing classes (`section-t-space`, `section-b-space`); titles use
  `.theme-title` with `.subtitle` (icon + label) and an `<h2>` with a `<span>` for the colored part.
- Scroll animations: `data-aos="fade-up" data-aos-duration="..."` on blocks.
- Clean URLs: links are `url('plans')`, served by `plans.php` through `.htaccess`.

### 2.2 Content (`includes/content.php`)

- **`MODULES`**: `anchor`, `icon`, `title`, `summary` (home card), `heading`, `intro`, `points`,
  and `image` or `tags` (the features page shows the image, or an icon with the tags). `'home' =>
  false` keeps a module off the home grid (Inventario; MediRed, which has its own home section).
  `module('<anchor>')` returns one.
- **`SPECIALTIES`**: `slug`, `icon`, `title`, `summary`, `intro`, `points`. The home grid adds as
  many `UPCOMING_SPECIALTIES` cards (blurred name suffix plus a skeleton, hidden on phones) as it
  takes to complete the last row of four.
- **`PLAN_FEATURES`** and **`PLANS`**: `'included' => n` marks the first `n` features as included.
  Inserting a feature every plan has means adding 1 to every plan's count.
- **`FAQ_GROUPS`**: `id`, `icon`, `title`, `items` (`q`, `a`, optional `featured`). Answers are plain
  text (escaped), so a link inside an answer is not possible.
- **`CONSULTATION_SHEETS_NOTE`**: the sentence that more sheets are coming.
- When a specialty sheet is added, it goes in `SPECIALTIES`, a point of the consultations module, the
  FAQ answer «¿Qué especialidades tienen hoja de consulta?», the lead and description of
  `specialties.php`, its entry is removed from `UPCOMING_SPECIALTIES` if it was there, and the promo
  line «Consultas» is updated.

### 2.3 JavaScript

`assets/js/main.js`, one block per section:

1. **Icons** — `lucide.createIcons()` from the generated subset.
2. **Animations** — AOS; GSAP + SplitType for the hero and section titles (the template hides them
   until animated); everything skipped under `prefers-reduced-motion`.
3. **Sticky header** — class added after 300 px.
4. **Mobile menu** — toggles `body.menu-open`.
   4.1 **Segmented navigation pill (desktop ≥ 1200 px)** — the active link is highlighted by CSS on
   load; a click slides a pill from the current link to the new one with the Web Animations API
   (explicit keyframes, 400 ms) and navigates after 320 ms. The pill has `transition: none` because
   the template transitions every menu `li`. `pageshow` resets it after the back-forward cache.
5. **Back to top.**
6. **Footer accordion** on phones.
7. **Smooth scroll (Lenis)** — anchors with a `-100` px offset; a hash on load is scrolled to after load.
8. **WhatsApp links** — `data-whatsapp-link` anchors go to WhatsApp Web on desktop and the app on
   phones, with the message `encodeURIComponent`-ed.

`assets/js/contact-form.js`: live validation, digits-only professional license, `fetch` submit,
`generate_lead`. `assets/js/analytics.js` (production only): `window.trackEvent()`, the cookie banner
and the click events with `data-track-location`.

### 2.4 CSS (`assets/css/cismed.css`)

- Loaded last: Bootstrap → AOS → template `style.css` → `cismed.css`. Its index lists its numbered
  sections (brand tokens, accessibility, logo, header, shared components, one per home block, inner
  pages, WhatsApp, cookies, plans).
- Brand tokens (RGB triplets):

  ```css
  --main-color: 0, 114, 232;       /* #0072e8, also theme-color */
  --main-light: 213, 239, 255;
  --accent-color: 0, 182, 122;
  --secondary-color: 6, 40, 75;
  --content-color: 58, 58, 58;
  --border-color: 239, 239, 239;
  --main-text-color: 0, 94, 194;   /* darker blue for text on light backgrounds: WCAG AA */
  ```

- Fonts: Bricolage Grotesque (headings) and Aspekta (body).
- Shared components: `.check-list`, `.btn-main`, `.btn-outline` (text inside a `<span>`),
  `.theme-title`, `.feature-visual` (icon + tags), `.skeleton-lines`, the WhatsApp float and the
  cookie banner.
- Template pitfalls already fixed: it capitalizes headings (`text-transform: none`), styles every
  `<header>` (cards use a `div`), and its `g-5` gutters caused horizontal scroll (`g-4 g-lg-5` and
  `overflow-x: clip`).

### 2.5 Icons

- Markup `<i data-lucide="calendar-days"></i>`; PHP arrays `'icon' => 'calendar-days'`.
- After adding or changing an icon: `node tools/build-icons.js`. It scans `*.php` in the root and
  `includes/`, and `assets/js/*.js`, for those two literal patterns only (it missed `circle-x` when
  it was chosen at runtime; the plans page now writes both icons literally).

### 2.6 Marketing images

- `node resource-tmp-folder/promo/make-promo.js` writes `promo-front.html`, `promo-back.html` and
  their PNGs (`cismed-promo-front.png`, `cismed-promo-back.png`, 3840 × 2160) with headless Chrome or
  Edge. The back has six feature cards, the Google Calendar and MediRed strips, the cloud note, the QR
  to `https://cismed.mx` (`qr-cismed.png`) and the contact bar.
- `resource-tmp-folder/social/facebook-cover.html` → `facebook-cover.png` (1640 × 856): render it
  with headless Chrome at that window size.
- Look at the PNG after regenerating: text must not overlap the QR or wrap badly.

---

## 3. Local development and verification

- **WAMP** serves `D:\WORK\TOOLS\wamp64\www`; locally the site lives in a subfolder, which is why
  every link goes through `url()` / `asset()` (`base_path()` derives the subfolder).
- **PHP CLI:** `D:\WORK\TOOLS\wamp64\bin\php\php8.4.0\php.exe` (8.4, as `PR - Checks`;
  `php8.3.14` is also installed). Not on the `PATH`.
- **Quick render without Apache:** `php -S 127.0.0.1:18093 -t .` and request `page.php` (the PHP
  server ignores `.htaccess`). Port 8090 is reserved by Windows. Stop it afterwards
  (`taskkill //F //IM php.exe` from Git Bash stops every `php.exe`).
- **Apache with `.htaccess`:** a temporary `httpd.exe -X -f <conf>` (WAMP's Apache 2.4.62, port
  8091) with `DocumentRoot` at the project; the config lives in the session scratchpad and has to be
  recreated in a new session.
- **Checks that worked:**
  - `curl -s -o /dev/null -w "%{http_code}"` per page, and `grep -c "Warning\|Notice\|Fatal"` on
    the HTML;
  - `grep -o` counts on the rendered HTML: plan rows (`is-included` / `is-excluded`), cards, links;
  - the browser pane: Lenis intercepts `window.scrollTo`, so scroll with wheel events, and add
    `aos-animate` to `[data-aos]` elements before a screenshot, or sections look empty;
  - a hidden browser tab pauses transitions: a menu that "looks stuck" there is not a bug.
- **CISMed facts:** read its `docs/specs/<feature>.md` and the `*Messages` classes of the feature on
  the right branch (`git show qa:<path>` without switching the owner's checkout), and compare
  `origin/main` with `origin/qa` to know what is in production.
- **Windows shells:** Git Bash for scripts; PowerShell 5.1 for `gh`. In PowerShell, reload the
  machine `PATH` before `gh`, and pass pull request bodies with `--body-file` (a UTF-8 file without
  BOM) to keep line breaks and accents.

---

## 4. Lessons learned (avoid repeating them)

- Code in English from the very first proposal, including file names in plans.
- Never touch existing `.htaccess` rules; add only what the owner asks, around them.
- Never invent clinical or product facts: describe a sheet from CISMed's specification, and leave a
  feature only where its description is known.
- Every mention of a removed feature goes: SMS was removed from plans, modules, FAQ, the hero card,
  the meta description, the promo and the Facebook cover.
- Numeric wording that dates quickly («5 hojas de consulta») was replaced by «consulta general y
  hojas de consulta especializadas».
- The nav pill used to move twice on load (fonts, then layout): the initial state is static CSS.
- A branch not named `feature/*` or `hotfix/*` fails `PR - Checks`, and renaming it on GitHub left
  the pull request (#6) closed and unreopenable: name branches right from the start.
- A Python or `sed` replacement chain can break when an earlier replacement changes the text a later
  one looks for: apply the most specific replacements first and assert each match count.
