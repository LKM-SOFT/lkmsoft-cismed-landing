# CISMed landing — Project Constitution

The principles in this file apply to **every change** made to this repository, by a person or by an
AI agent. A feature specification or a brief says *what* to build; this constitution says *how*
everything is built, everywhere. When a plan or a piece of code contradicts it, the plan or the code
is wrong.

The constitution is versioned with the code. Changing a rule is a deliberate decision of the
repository owner, recorded in the [amendment log](#amendment-log), never a side effect of a feature.

> **Status: version 1.1.** It writes down the rules agreed with the owner while the landing was built
> (September and October 2026), and the four decisions of 2026-10-23: texts without a final period,
> specifications in `docs/specs/`, the template license, and the removal of the coming soon page. An
> item listed in [section 11](#11-open-decisions) is not decided yet: until the owner decides it, it
> is **Ask first**.

---

## 1. Objective

The CISMed landing (`https://cismed.mx`) is the public, marketing site of **CISMed**, the cloud
electronic health record and practice-management system of **LKM Soft**, for doctors and clinics in
Mexico. It presents the product and turns visitors into leads or sign-ups:

- it describes what CISMed does (modules, consultation sheets by specialty, plans and prices);
- it collects requests for information through the contact form and WhatsApp;
- it sends doctors who want an account to the CISMed application (`https://app.cismed.mx`), where
  sign-up lives: the landing has no accounts, no logins and no database;
- it presents **MediRed** (`https://medired.mx`), LKM Soft's online medical directory, which every
  CISMed plan includes, and only links to it (6.1).

The visitors are doctors, clinics, nurses and assistants. The UI is in Spanish (Mexico); the
repository is in English.

## 2. Technology stack

| Area | Technology | Version |
|---|---|---|
| Language | PHP, no framework, no Composer | 8.4 (the version `PR - Checks` lints with) |
| Web server | Apache with `.htaccess` (clean URLs, HTTPS, canonical host), on IONOS | 2.4 (WAMP locally) |
| Deployment and CI | GitHub Actions: checks on every pull request, rsync to IONOS on every push to `main` | — |
| Template | Curoxa (Bootstrap 5 telehealth template), licensed for CISMed | 1.0.0 |
| CSS | Bootstrap, template `style.css`, site stylesheet on top | 5.3.3 |
| Animation | AOS, GSAP + ScrollTrigger, SplitType, Lenis (smooth scroll) | GSAP 3.14.2, SplitType 0.3.4 |
| Icons | Lucide, as a generated subset (`tools/build-icons.js`) | 0.577.0 |
| Fonts | Aspekta (self-hosted), Bricolage Grotesque (Google Fonts) | — |
| Email | PHPMailer, included manually under `libraries/`, through the IONOS mailbox `info@cismed.mx` | 7.1.1 |
| Analytics | Google Analytics 4 with Consent Mode v2 | — |

The stack is closed: a new library, framework, build tool, package manager or external service is an
[Ask first](#9-boundaries) decision. jQuery, Swiper, SlimSelect and the other template scripts are
**not** part of the site.

## 3. Project structure

```
/                         One PHP file per page, named in English (index.php, features.php, plans.php, ...)
├── actions/              Form handlers (POST endpoints): send-contact.php; never rendered as pages
├── includes/             Shared PHP; "Require all denied"
│   ├── config.php        Site constants and helpers (url, asset, e, app_url, analytics_enabled)
│   ├── content.php       The product content: modules, specialties, plans, audiences, FAQ
│   ├── navigation.php    Menus, logo, link helpers (create account, MediRed)
│   ├── head.php, header.php, page-header.php, footer.php, cta.php, audiences.php, whatsapp.php
│   ├── contact-form.php  Contact form rules (fields, validation, specialties list, mail)
│   └── mail-config.php   SMTP credentials: git-ignored; mail-config.example.php is committed
├── libraries/            PHPMailer; "Require all denied"
├── assets/
│   ├── css/vendor/       Bootstrap, AOS (minified, untouched)
│   ├── css/template/     Curoxa style.css and the images it references (untouched)
│   ├── css/cismed.css    The site stylesheet: every override and every new component
│   ├── js/vendor/        GSAP, ScrollTrigger, SplitType, Lenis, AOS, Bootstrap (untouched)
│   ├── js/icons.js       Generated Lucide subset (never edited by hand)
│   ├── js/main.js, contact-form.js, analytics.js
│   ├── fonts/            Aspekta
│   └── images/           brand/ (SVG logos), mockups/ (SVG mock screens), template/
├── tools/                Icon builder; not deployed
├── .github/workflows/    PR - Checks, deployment to IONOS
├── docs/specs/           One specification per feature; not deployed
├── resource-tmp-folder/  Licensed template, briefs, promo and social images — never committed
├── robots.txt, sitemap.xml
└── .htaccess             Server rules (6.9)
```

**Content lives in constants** (`includes/content.php`, `includes/config.php`), never repeated in
markup, so one edit updates every page:

- `MODULES`: the features page, the home modules grid (unless `'home' => false`) and `module()`;
- `SPECIALTIES` and `UPCOMING_SPECIALTIES`: the consultation sheets and the "coming soon" cards;
- `PLAN_FEATURES` and `PLANS`: a plan's `'included'` is how many of the first features of
  `PLAN_FEATURES` it covers, so a feature every plan includes goes before the ones some plans lack,
  and every count moves when a feature is inserted;
- `BILLING_CYCLES`, `AUDIENCES`, `FAQ_GROUPS` (`'featured'` items also appear on the home page);
- the WhatsApp number and message, the contact email, the CISMed and MediRed URLs and the GA4 id.

**Specifications** live in `docs/specs/<feature>.md`, in English, always (owner's decision,
2026-10-23):

- what the feature does and why, its rules, where it is shown, and the decisions taken with the owner,
  each one written down once it is agreed;
- a change that alters a rule of a feature, or takes a new decision about it, updates its
  specification in the same change, and a new feature gets its specification in the change that
  adds it;
- a specification that no longer says what the site does is as wrong as a broken page: fix whichever
  of the two is wrong, never leave them apart.

Briefs from the owner (the landing brief, the MediRed brief) live in `resource-tmp-folder/`, outside
git; what is agreed from them is written into the specification.

## 4. Commands

| Task | Command |
|---|---|
| Lint a PHP file | `php -l <file>` (PHP CLI under `D:\WORK\TOOLS\wamp64\bin\php\`, not on the `PATH`) |
| Rebuild the icon subset after adding or changing an icon | `node tools/build-icons.js` |
| Serve locally without Apache (no `.htaccess`, so use `page.php` URLs) | `php -S 127.0.0.1:<port> -t .` |
| Regenerate the promo images (front and back, HTML and PNG) | `node resource-tmp-folder/promo/make-promo.js` |

Port 8090 is reserved by Windows on this machine; use another one (for example 18093).

## 5. Verification strategy

There is no automated test suite. **A change is verified by running it**, and the delivery report
says exactly what was run:

- **Every changed PHP file passes `php -l`.**
- **Every affected page is rendered** through a local server and returns `200` (or `404` for
  `404.php`), with no PHP warning, notice or fatal error in the output.
- **Counts are checked in the rendered HTML** (`grep -o`), not by eye: cards, plan rows included and
  excluded, links, prices.
- **The change is checked in a browser** at desktop width and at phone width (375 px), with no
  horizontal scroll and no console errors.
- **Every new icon is in `icons.js`**: rebuild it and check the icon renders.
- What cannot be verified locally (analytics, which loads only on the production hosts; email
  delivery through IONOS) is reported as **not verified**, never as done.
- **Every pull request runs `PR - Checks`** (`.github/workflows/pr-checks.yml`): the branch policy
  of section 8 and `php -l` on every tracked PHP file with PHP 8.4. It does not replace the checks
  above; it catches what was missed.

## 6. Code conventions

### 6.1 Language and content

- **Everything in the repository is in English**: file and page names (`features.php`, never
  `funciones.php`), CSS classes, ids, data attributes, variables, functions, form field names,
  comments, commit messages and documentation. The owner set this rule at the start and corrected the
  first plan that proposed Spanish file names.
- **Only text the visitor reads is in Spanish (Mexico)**: headings, copy, labels, buttons,
  validation messages, `alt` texts and the emails sent to people.
- **No final period**, as in MediRed (owner's decision, 2026-10-23). A text ends without a period:
  what the visitor reads in Spanish (headings, leads, messages, labels, notes, buttons, validation
  errors, the emails the site sends) and, in English, log lines, PHPDoc and every comment, in PHP,
  JavaScript, CSS and HTML. A period between two sentences of the same text stays, and so does each
  paragraph's own when a comment has several; a text that ends in «?», «!» or «…» keeps its sign, and
  an abbreviation keeps its dot («Dr.», «e.g.»).
  - **Exceptions:** the legal documents (the privacy notice) and the meta descriptions, which are
    prose; and the documentation (`docs/`, this file, `CLAUDE.md`) and commit messages, which keep
    ordinary punctuation. A specification quotes each text as the page shows it.
  - The comments of `.htaccess` are left as they are (6.9).
- **Content is never invented.** No figures (doctors, patients, appointments, cities), testimonials,
  client logos, certifications (NOM-024 or any other), awards or features that do not exist. Where a
  piece of content is missing, ask, or leave a visible `[DATO PENDIENTE]` marker.
- **No promises of what is not built**: no AI, telemedicine, video consultation, chat or mobile app.
- **Product facts come from CISMed itself.** A module or a consultation sheet is described only from
  the CISMed code or its specification (`docs/specs/` in the CISMed repository, section 7), never
  from memory or from the template. A feature the owner announces with no description goes only
  where its description is known, and the rest is asked (inventory, 2026-10-04).
  - Before announcing a feature, check whether it is already on CISMed's `main` (production) or only
    on `qa` (sandbox), and tell the owner; publishing ahead of production is the owner's decision.
- **New copy is approved by the owner before it is published**: propose the texts, wait for the
  approval, then write the code.
- **Plans, prices and features follow the owner's instructions exactly**: prices are MXN per month,
  VAT included; a channel or feature removed from the product (SMS, 2026-10-09) is removed everywhere
  it is mentioned, including the promo images.
- **MediRed is only presented and linked** (owner's rule, 2026-10-23). The landing says what MediRed
  gives a CISMed doctor and links to `https://medired.mx` for everything else. It never copies
  MediRed's subscription prices, the price of its sponsored position, its terms, its conditions or
  its privacy notice, never explains MediRed for doctors who do not use CISMed (at most a link to
  `https://medired.mx/for-doctors`), and never says that every professional license is verified or
  that the listing is ordered by rating.

### 6.2 PHP

- Pages declare a `$page` array (`slug`, `title`, `description`, optional `heading`, `lead`,
  `robots`, `schema`, `scripts`) and then require `includes/head.php`, `includes/header.php`,
  `includes/page-header.php` (inner pages), the content and `includes/footer.php`.
- **Every value printed into HTML goes through `e()`** (`htmlspecialchars` with `ENT_QUOTES`, UTF-8).
- **A value never becomes script text**: values reach JavaScript through `data-*` attributes printed
  with `e()`, and JSON-LD through `json_encode(..., JSON_HEX_TAG | JSON_UNESCAPED_UNICODE |
  JSON_UNESCAPED_SLASHES)`.
- **Links and assets are built with `url()` and `asset()`** (cache-busting by file modification
  time), never hard-coded, so the site works at the domain root and inside a local subfolder.
- Links that leave the site are built by their helpers, which add `target="_blank"`, `rel="noopener"`
  and the analytics hooks: `account_link_attributes()` (CISMed sign-up), `whatsapp_link_attributes()`,
  `medired_link_attributes()`.
- The sign-up URL follows the host: `app_url()` points to `APP_URL_PRODUCTION` on the production
  hosts and to `APP_URL_LOCAL` elsewhere (the owner switches the local one between a local CISMed and
  `https://sandbox.cismed.mx`).

### 6.3 Contact form and email

- Fields, all required: «Nombre y apellidos», «Cédula profesional» (5 to 8 digits; the landing never
  asks for a CURP), «Especialidad» (the list of `MEDICAL_SPECIALTIES`, from the owner's
  `specialties.txt`), «Celular», «Correo electrónico» and the privacy consent.
- Protection: CSRF token, honeypot field `website`, a minimum fill time of 3 seconds and 5 requests
  per hour per IP. It answers JSON to `fetch` and redirects back without JavaScript.
- Mail goes out with PHPMailer through IONOS SMTP (`smtp.ionos.mx`, 587, TLS) as `info@cismed.mx`.
  The credentials live only in `includes/mail-config.php`, which is git-ignored and set by hand on the
  hosting; `mail-config.example.php` holds no real value.

### 6.4 Personal data (LFPDPPP)

- The privacy notice (`privacy-notice.php`, dated 01/09/2026) names CISMed (LKM Soft) as the only
  responsible party, uses the professional license only to validate it with the SEP, and declares no
  secondary purposes and no transfers. Any change to it is the owner's decision.
- **Personal data never goes into a URL, a query string, a log or an analytics event.**
- The landing stores nothing a visitor types: the form data goes by email and is not kept.

### 6.5 Front end

- **The template and vendor files are never edited.** `assets/css/template/style.css`, the files under
  `vendor/` and `icons.js` stay as they are; every change goes into `assets/css/cismed.css` and
  `assets/js/main.js`.
- **The site stylesheet is organized in numbered sections** listed in an index at its top; a new
  component gets its own section.
- **Brand colors are RGB triplets in CSS variables** (`--main-color: 0, 114, 232;`), used as
  `rgba(var(--main-color), 1)`. `--main-text-color` is a darker blue so text meets WCAG AA.
- **Accessibility:** WCAG AA contrast, the skip link, one `h1` per page, a logical heading order,
  labels for every field, `alt` on every meaningful image, visible focus, and `prefers-reduced-motion`
  honored by every animation.
- **Performance:** scripts load with `defer`; icons come from the generated subset, never the full
  Lucide bundle; images have `width` and `height`, and `loading="lazy"` below the fold.
- **Responsive:** every page works from 320 px up, with no horizontal scroll and a 16 px side gutter
  on phones. Grids use `g-4 g-lg-5`, never `g-5`, and the page keeps `overflow-x: clip`.
- **Grids close in full rows**: the specialties grid computes how many "coming soon" cards complete
  its last row of four, and a module that would leave a card alone in the home grid is kept off it
  (`'home' => false`) and presented elsewhere.
- **Icon names are literals** (`data-lucide="..."` or `'icon' => '...'`): `tools/build-icons.js`
  does not find a name built at runtime.
- The navigation is an iOS-style segmented control: the active link is static CSS on load, and only
  a click slides the pill (Web Animations API, both directions).

### 6.6 SEO

- The canonical host is `https://cismed.mx`, without `www`, always over HTTPS.
- Every indexable page has a unique title and description, a canonical URL and Open Graph tags.
- JSON-LD describes only what the page shows: `Organization`, `SoftwareApplication`, `FAQPage`.
- `sitemap.xml` and `robots.txt` are kept in step with the pages that exist.

### 6.7 Analytics and cookies

- Google Analytics (`G-YZ7V24DNB5`) loads **only on the production hosts** (`ANALYTICS_HOSTS`) and
  starts with every consent denied (Consent Mode v2). It is granted only after the visitor accepts
  the cookie banner, and the choice can be changed from «Preferencias de cookies» in the footer.
- Events report actions with a `link_location` and no personal data: `generate_lead`,
  `whatsapp_click`, `email_click`, `create_account_click`, `medired_click`.

### 6.8 Security

- `includes/` and `libraries/` deny every web request (`Require all denied`).
- Errors shown to visitors never include stack traces, paths or server details.

### 6.9 Server configuration

- The `.htaccess` rules that already exist (the `404` page, HTTPS, `www` to the bare domain, the
  rules that hide the `.php` extension) work on the hosting and are **never rewritten or removed**,
  even when they look wrong under a local subfolder. New rules are added around them, and only when
  the owner asks.

### 6.10 Hosting and deployment

- The landing runs on **IONOS**. A push to `main` deploys it with rsync (`.github/workflows/deploy.yml`);
  nobody copies files to the hosting by hand. The host, path, user and key are repository secrets.
- **What the deployment leaves out**: `.git/`, `.github/`, `CLAUDE.md`, `constitution.md`,
  `README.md`, `docs/`, `tests/`, `tools/`, `resource-tmp-folder/` and `includes/*-config.php`. A new
  file that must not be served is added to that list.
- rsync runs without `--delete`: a file removed from the repository stays on the hosting until it is
  deleted there.
- `includes/mail-config.php` is created on the hosting by hand.

### 6.11 Marketing images

- The promo flyer (`resource-tmp-folder/promo/make-promo.js`, front and back) and the Facebook cover
  (`resource-tmp-folder/social/facebook-cover.html`) are HTML rendered to PNG with headless Chrome.
  They follow the same content rules as the site (6.1).
- **A change of product content that they show is made in them too, and their PNGs are regenerated**
  (`make-promo.js` writes both the HTML and the PNGs). They stay outside git.

## 7. Reference sources

- **CISMed** (`LKM-SOFT/lkmsoft-cismed-vaadin`, locally `D:\WORK\PROJECTS\PERSONAL\LKMSOFT\CIS_VAADIN\WEBAPP`):
  the source of every product fact. Its specifications are in `docs/specs/` (for example
  `cardiology-sheet.md`, `medired-directory.md`). `qa` deploys to `https://sandbox.cismed.mx`, `main`
  to `https://app.cismed.mx`.
- **MediRed** (`LKM-SOFT/lkmsoft-medired`, locally `D:\WORK\TOOLS\wamp64\www\medired`): built on this
  landing's template and styles. What the landing may say about it is in
  `resource-tmp-folder/medired/brief-medired-para-cismed.md`.
- **The landing brief**: `resource-tmp-folder/brief-landing-cismed.md`.
- **The Curoxa template**: `resource-tmp-folder/curoxa-html` (`template-file/`, `documentation/`).

## 8. Git workflow

- **`main` is up to date before anything else** (owner's rule, 2026-10-23): before creating a branch
  or committing, run `git fetch --prune`, check that local `main` has nothing to pull from
  `origin/main` (fast-forward it with `git pull --ff-only` if it has), and start the branch from that
  `main`. A branch created before a merge is brought up to the new `main` before its commit.
- **Branches** (`PR - Checks` enforces it):
  - one branch per change, `feature/<name>`, created from `main` and merged into `main` through a
    pull request; `hotfix/<name>` for an urgent fix in production;
  - any other branch name fails `branch-policy`, and renaming the branch on GitHub does not move an
    open pull request: create the branch with the right name from the start;
  - the workflow deletes the branch on GitHub after the merge, so fetch with `--prune`;
  - nobody pushes directly to `main`.
- **Commit messages** are in English, in the imperative ("Add the plans page").
- **Commits, pushes and pull requests happen only when the owner asks for them.** Only the files of
  the change are committed: the owner's own uncommitted edits are left alone unless they ask.
- **Hooks are never skipped** (`--no-verify`).
- **Never committed:** `resource-tmp-folder/` (licensed template, briefs, promo images), `.claude/`
  and `includes/mail-config.php`.
- `gh` is installed at `C:\Program Files\GitHub CLI\gh.exe`; a shell started before its installation
  may need the machine `PATH` reloaded to find it.

## 9. Boundaries

### ✅ Always

- Lint every changed PHP file and render every affected page before declaring a change done, and
  report the real result (section 5).
- Describe product features only from CISMed's code or specification, and say whether they are in
  production yet.
- Propose new copy and wait for the owner's approval before writing it.
- Escape every printed value with `e()`, and pass values to scripts only as data.
- Write English in the repository and Spanish (Mexico) in the UI.
- Keep content in the constants of `includes/content.php` and `includes/config.php`.
- Put every style change in `cismed.css` and rebuild `icons.js` after touching an icon.
- End texts and comments without a period (6.1).
- Keep the specification of a feature in `docs/specs` in step with it, in the same change.
- Update the promo and social images when the content they show changes.
- Fetch and bring local `main` up to `origin/main` before creating a branch or committing, and
  create branches as `feature/*` or `hotfix/*` from it.
- List the decisions made on the owner's behalf when delivering a change.

### ⚠️ Ask first

- Any item of [section 11](#11-open-decisions).
- Adding a library, framework, build step, package manager, test framework or external service.
- Adding any content that is not in CISMed or was not given by the owner.
- Adding or changing `.htaccess` rules, the hosting setup or the deployment.
- Changing the contact form's fields or the privacy notice.
- Deviating from a rule of this constitution for a specific case.
- Committing, pushing or opening a pull request.

### 🚫 Never

- Commit secrets, credentials, `includes/mail-config.php`, `resource-tmp-folder/` or `.claude/`.
- Invent figures, testimonials, certifications or features, or promise AI, telemedicine, video
  consultations, chat or a mobile app.
- Copy MediRed's prices, terms, conditions or privacy notice.
- Print a value without escaping it, or write a value into the text of a script or a URL unencoded.
- Put personal data in a URL, a log or an analytics event.
- Edit the template stylesheet, a vendor file or the generated `icons.js` by hand.
- Rewrite or remove the existing `.htaccess` rules.
- Push directly to `main`, force-push it or delete it.

## 10. Amending this constitution

1. A rule changes only when the repository owner decides it. The change is made in this file, in its
   own commit.
2. Each amendment adds a line to the log below: the date, what changed and why.
3. When code and constitution disagree, decide which one is wrong:
   - if the code is wrong, fix it;
   - if the rule no longer holds, amend the rule first and change the code after.
   Never leave the two silently apart.

## 11. Open decisions

Each item is decided with the owner, written into the right section above, and removed from this
list in the same change. Items keep their number once removed, so a reference such as "decision 2"
stays valid. Items 1 (final period), 2 (specifications), 3 (template license) and 4 (the coming soon
page, removed with its jQuery and images) were decided on 2026-10-23.

No decision is open. A new one is added here, with the next number, when it comes up.

### Amendment log

| Version | Date | Change |
|---|---|---|
| 1.0 | 2026-10-23 | First version, written from the rules agreed with the owner while the landing was built, after MediRed's constitution: English code and Spanish UI, no invented content, product facts from CISMed, MediRed only presented and linked, `.htaccess` preserved, PHPMailer through IONOS, analytics with Consent Mode, `feature/*` and `hotfix/*` branches into `main` checked by `PR - Checks`, deployment to IONOS. |
| 1.1 | 2026-10-23 | The four open decisions, taken by the owner: texts and comments end without a period, as in MediRed (6.1, 9); specifications always in `docs/specs/` (3, 9); Curoxa licensed for CISMed (2); the coming soon page and its files removed (2). |
