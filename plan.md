# estudio.com.py — launch-readiness plan (written by Fable, 2026-09-09)

State when this plan was written: the site is live at https://estudio.com.py/ (old build). A
Fable pass on 2026-09-09 built the 56 área × ciudad pages, self-hosted fonts, schema, redirects
and a deploy zip (`dist/estudio-2026-09-09.zip`) — none of it uploaded yet, and the repo has
**no git history**. This plan takes the site from "built locally" to "live, verified, wired to
VenderCRM, and content-complete", in one Opus phase followed by Sonnet phases.

Phase table

| id | lane | model | prompt | plan § | Owns | Depends on |
|---|---|---|---|---|---|---|
| O1 Foundation & deploy | 1 | Opus | `prompts/opus-1-foundation-deploy.md` | §5 | `verify.sh`, `enviar.php`, `lib/**`, `partials/**`, `templates/**`, `deploy/**`, `.github/**`, `content/abogados.php`, `content/site.php`, `content/ui.php` (keys listed in §5 only), `docs/log/O1.md` | none |
| S2 Guías | 2 | Sonnet | `prompts/sonnet-2-guias.md` | §6.1 | `content/guias.php`, `guias/**`, `docs/log/S2.md` | O1 |
| S3 Áreas depth | 2 | Sonnet | `prompts/sonnet-3-areas-depth.md` | §6.2 | `content/services.php`, `content/areas-ciudades.php`, `docs/log/S3.md` | O1 |
| S4 Pages & trust copy | 2 | Sonnet | `prompts/sonnet-4-pages-trust.md` | §6.3 | `content/pages.php`, `content/ui.php` (keys listed in §6.3), `contacto/**`, `privacidad/**`, `terminos/**`, `404.php`, `docs/log/S4.md` | O1 |
| S5 Link pass | — | Sonnet | `prompts/sonnet-5-link-pass.md` | §6.4 | `content/services.php` (`guides`/`related` keys only), `content/nav.php`, `index.php`, `KNOWN-ISSUES.md`, `docs/log/S5.md` | S2, S3, S4 |

Anton's stated way of running this: **Opus first in one chat, then the Sonnet phases in a second
chat.** So the default is the manual path: no watcher Routine, no `create_session` chains. S2, S3
and S4 own disjoint files and may run as three parallel Sonnet windows or one after another in a
single Sonnet window — either way each is its own branch and PR. S5 runs last.

## 1. Decisions already made — do not re-litigate

1. estudio.com.py is a **referral service**, not a law firm. Copy never says "nuestros abogados",
   "nuestro estudio", never implies it practises law. JSON-LD is `Organization` + `Service`
   (never `LegalService`).
2. **No invented facts.** No lawyer names, ratings, review counts, team sizes, founding years,
   court addresses, processing times, prices. `content/site.php` credentials/team/stats stay
   empty until a real lawyer signs. Null/omit rather than fabricate. Jurisdiction claims stay at
   the level of `docs/facts-to-verify.md`.
3. **Design system is locked** (approved Claude Design mockup): paper `#f4f3ee` / ink `#1c1b18` /
   terracotta `#a24a30`, Spectral for headings only, Work Sans for everything else, text-only —
   no icons, photography, logos, image libraries. WhatsApp green only on real WhatsApp actions;
   `site.php` `whatsapp` is null, so every CTA is the plain ink "Contactar" → `/contacto/`.
   Tokens block in `assets/css/site.css` changes only for a contrast finding (as
   `--accent-on-ink` did on 2026-09-09).
4. **Headings render Spectral 800** (real ExtraBold, self-hosted). The CSS always asked for 800;
   the old CDN placeholder only served 600 and browsers faked the bold. Keep 800 unless Anton
   says otherwise in `docs/decisions-needed.md`.
5. **URL scheme is frozen:** áreas `/servicios/<área>/`, cities `/ciudades/<ciudad>/`,
   área × ciudad `/ciudades/<ciudad>/<área>/`, guides `/guias/<slug>/`. `/blog/` is a 301 to
   `/guias/`. Trailing slashes everywhere.
6. **Content is data.** Every page is a record in `content/*.php` plus a three-line route file
   rendered by a template. Nobody writes a bespoke page.
7. **Lead routing:** every form posts to `enviar.php` → VenderCRM (degraded log mode until
   `config.php` has `VENDERCRM_URL`/`VENDERCRM_API_KEY`). Área pages and área × ciudad pages
   route as their área (tier B), city pages as `familia` with the chip deciding, home/contacto as
   the chip decides. Tier values in `content/lead-values.php` stay as they are.
8. **Deploy = zip to Hostinger public_html**, forward-slash entry names only
   (`deploy/make-zip.ps1` on Windows, `deploy/make-zip.sh` where `zip` exists). Never
   Compress-Archive. Anton uploads; no phase has hosting credentials.
9. **Model guardrail:** phases are Opus or Sonnet only. Fable is never spawned (§4.8).

1.9 **Second Fable pass, 2026-09-09 16:40 (already in the tree, do not undo).** `templates/service.php`
    and `templates/segment.php` already render a `.trust-empty` block beside the lead form (strings
    `ui('service.trust_empty*')` / `ui('segment.trust_empty*')`, the segment one interpolates
    `{ciudad}`); the CTA band on those two templates links `#solicitar` (`$ctaContactPath`), not
    `/contacto/`; `.chip` has a 44 px `min-height` (last block of `site.css`); the generated FAQ
    "¿El abogado atiende en X?" no longer opens with "Sí."; the me-despidieron guide description
    is 120+ chars. O1 §5.4 replaces the two template blocks with the partial *in that same
    position* and folds the three strings into `ui('trust.empty')` — one empty state per page.
    `dist/estudio-2026-09-09.zip` (13:47) contains all of this; `dist/estudio-2026-09-09-v2.zip`
    is a stale pre-design-fix build — never upload it.

## 2. Content model

Already in place from the template; the contract is documented in `README.md` "Content model".
Files and who owns them in this plan:

- `content/site.php` — business facts (O1 may add keys; values stay honest/null).
- `content/services.php` — 8 áreas (S3). Keys: path, title, navLabel, cluster, seoTitle,
  metaDescription, hero{eyebrow,h1,h2,lead}, includes[], excludes[], weNeed[], sections[],
  benefits[], faq[], cta, related[], guides[], articles[], toolLinks[].
- `content/areas-ciudades.php` — 56 generated records (S3 may edit the two tables only).
- `content/segmentos.php` — 7 city pages (unchanged in this plan).
- `content/guias.php` — how-to guides (S2). Keys: path, title, navLabel, seoTitle,
  metaDescription, lastReviewed, hero, intro[], steps[{title,body[]}], faq[], relatedService,
  toolLink, related[].
- `content/pages.php`, `content/ui.php` — static pages and every UI string (S4, key-scoped).
- `content/lead-values.php` — lead value model (unchanged).
- **New in O1: `content/abogados.php`** — the "quién recibe su consulta" collection. Shape
  (contract, written once): `[slug => ['name', 'areas' => [área slugs], 'cities' => [city slugs],
  'since' => 'YYYY-MM', 'note' => string|null]]`. Empty array = the honest empty state renders
  exactly as today. A record renders a text-only card (name, áreas, cities) on the home trust
  band, on matching área pages and on matching área × ciudad pages. No photos, no ratings.

## 3. Feature scope

Core (this plan): deploy + live verification; verify.sh green on Windows; lead handler sends the
city as a city; `abogados` collection + partial; 8 guides (one per área); área pages at full depth;
static pages and trust copy complete; cross-links; KNOWN-ISSUES.

Approved extras: none. Everything else → §10 Backlog.

## 4. Autonomy protocol

The 15 rules of the `phased-autonomous-build` skill §"The autonomy protocol" apply verbatim.
Repo-specific notes:

- Git: O1 initialises the repository and pushes it to GitHub `antonmarklundcom/estudio-com-py`
  (private, `gh` is authenticated on Anton's PC). From then on: branch `phase/<id>`, PR, merge
  green. CI is `.github/workflows/verify.yml` (already in the template).
- verify: `./verify.sh` must be green — after O1, including on Windows/Git Bash (the two
  "market module" / "degraded mode: not JSON" failures are a `php -r` path-quoting bug O1 fixes).
- Screenshots go to CI artifacts (`tests/screenshots.mjs`), never committed. `docs/screenshots/`
  is git-ignored.
- Ask only via `docs/decisions-needed.md` (append, commit, push, end). Nobody messages a session.
- Manual-run mode (Anton's choice for this plan): no watcher Routine; Anton opens each phase
  himself. `prompts/_handoff.md` still defines the four done-gates; the "spawn the next phase"
  step is replaced by "end with the phase report and name the next prompt file".

## 5. Lane 1 — O1 Foundation & deploy (Opus, ≤ 2 h)

Everything here either constrains the Sonnet phases or touches the lead handler/deploy path.

5.1 **Git + GitHub.** `git init` on `main`, first commit = the tree as-is (respect `.gitignore`;
    confirm `config.php`, `logs/`, `dist/`, `docs/screenshots/` are ignored). `gh repo create
    antonmarklundcom/estudio-com-py --private --source . --push`. Commit this plan and the
    prompts as part of that first commit. CI must run green on the first PR.

5.2 **verify.sh on Windows.** The `php -r '…require "'"$SITE_ROOT"'/lib/bootstrap.php"…'`
    blocks fail under Git Bash because `$SITE_ROOT` is `/c/…` (a Git Bash path PHP cannot open).
    Fix once, for all four blocks: write each snippet to a temp file and call `php <file>
    <root>`, and convert the root with `cygpath -w` when `cygpath` exists. Same green output on
    Linux CI. Exit: `./verify.sh` prints zero FAIL lines on Windows and in CI.

5.3 **Lead handler: city.** `enviar.php` currently maps the form's `company` field (labelled
    "Ciudad" on this site) to the CRM `empresa` field. Load `vendercrm-lead-capture`; send the city
    as a city (the API's city/address field if it has one, otherwise a `ciudad` custom field AND
    keep it in the message body as "Ciudad: X"). Log line gets `ciudad`. Keep `company` as the POST
    field name (shared partial), do not rename inputs. Exit: a POST with `company=Luque` shows
    `ciudad: Luque` in `logs/leads.log` and in the JSON response's `thanks` block is unchanged.

5.4 **`content/abogados.php` + partial.** Create the file (empty array, contract in §2) and
    `partials/abogados.php`: given `$abogadosArea` and/or `$abogadosCity`, filter the collection;
    empty → render the existing empty-state copy (move the hard-coded paragraph from `index.php`
    into `ui('trust.empty')` and reuse it); non-empty → text-only cards. Wire it into `index.php`
    (trust band), and into `templates/service.php` / `templates/segment.php` **in place of the
    `.trust-empty` block already beside the form there** (§1.9) — same position, remove the
    `service.trust_empty*` / `segment.trust_empty*` keys once the partial reads `ui('trust.empty')`
    (keep the city interpolation for segment pages). Add one commented example record in the file so a later phase knows the shape.
    Exit: with the array empty, every page renders byte-for-byte the same visible copy as before
    (diff the HTML); with the example uncommented locally, the three placements show the card;
    recommit with it commented out.

5.5 **Deploy pipeline parity.** `deploy/make-zip.sh` and `deploy/make-zip.ps1` must stage the
    same file set (ship list, page dirs, logs/, minified CSS). Add a `deploy/verify-live.sh`
    check (the template has one — extend it) that, given a base URL, asserts: 200 on `/`, on 5
    sampled área × ciudad URLs, `/sitemap.xml` lists ≥ 80 URLs, `/blog/` → 301, `/robots.txt`
    names the sitemap, no `fonts.googleapis.com` in the HTML, `assets/fonts/*.woff2` served with
    `font/woff2`. Handle Hostinger's anti-bot challenge (retry after 6 s, or a browser UA).
    Exit: `deploy/verify-live.sh https://estudio.com.py` passes against the site **after Anton
    uploads** (§7 item 1) — if he has not yet, the script is committed and the log says "not run
    against live; run `deploy/verify-live.sh https://estudio.com.py` after upload".

5.6 **Build the zip** (`deploy/make-zip.ps1` or `.sh`) at the end of the phase from merged main,
    verify the artifact with `./verify.sh --root dist/<name>`, and name it in `docs/log/O1.md`.
    The zip is not committed (`dist/` is ignored).

5.7 **Phase log + handoff.** `docs/log/O1.md`; §9 line; end with the report naming
    `prompts/sonnet-2-guias.md`, `sonnet-3-areas-depth.md`, `sonnet-4-pages-trust.md` as
    runnable now, in parallel or in sequence, and `sonnet-5-link-pass.md` after them.

## 6. Lane 2 — Sonnet phases (parallel, ≤ 90 min each)

Hard limits for every lane 2 phase: no changes to `lib/**`, `partials/**`, `templates/**`,
`enviar.php`, `router.php`, `.htaccess`, `verify.sh`, `deploy/**`, the tokens block, or any content
file another phase owns. Workaround + Backlog note instead; truly blocked → `docs/decisions-needed.md`.

### 6.1 S2 Guías (owns `content/guias.php`, `guias/**`)

Today: 3 guides (laboral, familia, sucesiones). Target: **8 guides, one per área**, each the
single most-searched "what do I do now" situation for that área, in the existing record shape
and voice (usted, neutral PY Spanish, plain language, every guide ends in "Consulte con un
abogado …" and delegates via `relatedService`). Add 5: penal ("Me notificaron una imputación:
qué hacer"), empresas ("SA o SRL: cómo elegir y qué papeles pide el registro"), marcas
("Cómo registrar una marca en Paraguay ante la DINAPI"), inmobiliario ("Antes de comprar un
inmueble: qué revisar en el título y la DGRP"), tributario ("Me llegó una fiscalización de la
DNIT: primeros pasos"). Keep the three existing ones; fix `related[]` so every guide links to
two others. Rules: no fees, no deadlines in days unless a public rule states it (then name the
rule generically: "la ley fija un plazo; el abogado se lo confirma"), no institution the
`facts-to-verify.md` list doesn't already name (MTESS, IPS, DINAPI, DNIT, DGRP, Ministerio
Público, Registro Civil, escribano). Fan-out per `fable-directs-sonnet-builds` after one
exemplar. Exit: 8 guide URLs 200 with HowTo + FAQPage JSON-LD validating, titles ≤ 43 chars
(page part), descriptions 120–155 and unique, verify green, PR merged. Do NOT touch
`services[…]['guides']` — S5 links guides from áreas.

### 6.2 S3 Áreas depth (owns `content/services.php`, `content/areas-ciudades.php`)

Área pages are thin: one "Qué hacer ahora" paragraph, 1–2 FAQs, `excludes` empty on most. For
each of the 8 áreas: `includes` 5–6 items, `excludes` 2–3 (what this área does NOT cover, and
which área does — a real trust signal), `weNeed` 3–4, `sections` = "Qué hacer ahora" (2 short
paragraphs) + "Qué esperar" with 2 `items` (Plazos / Costo — costs described structurally:
"el abogado le cotiza antes de empezar; estudio.com.py no cobra al usuario", never a number),
`faq` 4–5 questions in the visitor's words. `hero.lead` stays ≤ 2 sentences (the área × ciudad
generator reuses it and replaces "su ciudad"). In `areas-ciudades.php` only the `$areas` table
may change (`kw`, `topic`, `local` text) and only to correct a fact; re-run the length check
in the file header comment (titles ≤ 43, descriptions 120–155). Exit: 8 área URLs + 56 combo
URLs 200, FAQ JSON-LD validates, verify green, no new institution names, PR merged.

### 6.3 S4 Pages & trust copy (owns `content/pages.php`, `contacto/**`, `privacidad/**`,
`terminos/**`, `404.php`, and in `content/ui.php` only these keys: `about`, `process`,
`contact`, `cta_band`, `form`, `footer`, `error404`, `trust`)

Answer "why trust this with no lawyers signed yet" in the copy, structurally: `about.text` +
`about.credentials` say who pays (the receiving lawyer), what is shared (only the ficha, only
with that lawyer), what happens if nobody takes it (the ficha stays registered, we tell you) —
keep it to the facts in `terminos`. `form.privacy_note` and `form.success_text` say the same
in one line each. `/contacto/` "Qué pasa después" gets a 4th step naming the no-lawyer case.
`/privacidad/` adds a retention sentence and the contact route for deletion (no email exists:
"desde la página de contacto"). `/terminos/` adds "Qué hacemos con su consulta si ningún
abogado la toma" and "Sin garantía de resultado". `404.php` lists cities as well as áreas.
Read O1's log first: O1 moved the empty-state text into `ui('trust.empty')` — edit it there.
Exit: every string uses usted, none claims a firm/lawyer/stat, descriptions 120–155 and unique,
verify green, PR merged.

### 6.4 S5 Link pass (after S2–S4 merge; owns the `guides`/`related` keys in
`content/services.php`, `content/nav.php`, `index.php`, `KNOWN-ISSUES.md`)

Set `services[<área>]['guides']` to that área's guide(s) so the "Guía relacionada" band renders
on all 8 área pages and, through the generator, on all 56 combo pages. Home "Guías" list shows
all 8 (check `.guide-list` still reads well at 8 rows on mobile; if not, cap the home list at 6
newest and link "Ver todas"). Footer column adds "Guías" per área only if it fits the existing
column pattern; otherwise leave. Sitemap sanity: count = pages + 8 + 7 + 56 + 8, no 404s. Promote
still-open cross-phase items from `docs/log/*.md` into `KNOWN-ISSUES.md`. Rebuild the zip
(`deploy/make-zip.ps1`), run `./verify.sh --root dist/<name>`, name the zip in the closing
report as the artifact Anton uploads. Exit: verify green, zip built and verified, closing report.

## 7. Human-inputs checklist (Anton)

1. **Upload `dist/estudio-2026-09-09.zip`** (built by Fable) to Hostinger public_html now, or
   the zip O1 builds at its end — O1 §5.5 needs a live site to run `verify-live.sh`. After S5,
   upload S5's zip.
2. **`config.php` on the server** with `VENDERCRM_URL` / `VENDERCRM_API_KEY` (and `GA4_ID` when
   you have it). Until then leads land in `logs/leads.log` only. Needed before any ad spend.
3. **Spectral 800 headings** — say "600" in `docs/decisions-needed.md` if the lighter look was
   the mockup's intent; otherwise nothing to do (§1.4).
4. **Verify the jurisdiction facts** in `docs/facts-to-verify.md` with a lawyer before launch
   marketing (Capital vs Central, DNIT judicial stage in Asunción, Niñez y Adolescencia).
5. **WhatsApp number** — when reception exists, set `site.php` `whatsapp`; every CTA turns green
   by itself. Not before.
6. **First signed lawyer** → fill `content/abogados.php` (O1 leaves a commented example).

## 8. Open business questions (parked)

- Which áreas/cities get paid ads first once VenderCRM is wired (tier values assume familia,
  laboral, penal lead).
- Whether area-only pages ("Abogado laboral" national) should eventually redirect to Asunción
  combos or stay as hubs. Stay as hubs for now.
- Pricing of the referral to lawyers (per lead vs. monthly) — affects `terminos` wording later.

## 9. Build log index

(one line per phase, appended by the phase itself)

- O1 Foundation & deploy — `docs/log/O1.md`. Repo created and CI green; `verify.sh` fixed for
  Git Bash; city reaches the CRM as `ciudad`; `content/abogados.php` + `partials/abogados.php`
  replace the three empty-state blocks; `verify-live.sh` extended. Live site found returning 500
  on every URL — `dist/estudio-2026-09-09.zip` is the fix, waiting on Anton to upload.
- S2 Guías — `docs/log/S2.md`. 5 new guides added (penal, empresas, marcas, inmobiliario,
  tributario); all 8 áreas now have a guide; `related[]` fixed on all 8 so every guide links to
  two others that exist. PR #3 merged, CI green. Deviation: wrote all 5 new guides directly
  instead of fanning 4 out to parallel subagents; a concurrent session ran the same phase and
  produced a duplicate audit (PR #4) mid-run, reconciled into one log (see log).

- S3 Áreas depth — `docs/log/S3.md`. All 8 áreas in `content/services.php` deepened: 5–6
  `includes`, 2–3 `excludes` (each naming which área does cover it), 3–4 `weNeed`, a two-part
  "Qué hacer ahora"/"Qué esperar" section shape, 4 FAQs. No change needed to
  `areas-ciudades.php`'s `$areas` table. PR #6 merged, CI green on the first run. Gate-3 audit
  found nothing to fix. Deviation: wrote all 8 áreas directly instead of fanning 7 out to
  parallel subagents after the `laboral` exemplar (see log).

- S3 Áreas depth — `docs/log/S3.md`. All 8 área records deepened (includes/excludes/weNeed,
  two-part sections, 4 FAQs); 18 exclusions each naming the área that does cover it; depth
  reaches the 56 combo pages through the generator. `areas-ciudades.php` needed no change.
  PR #6 merged, CI green.

## 10. Backlog

- Herramientas (calculators: liquidación laboral, pensión alimentaria orientativa) — template
  supports `content/tools.php`; needs market tables verified first.
- More cities (Ñemby, Villa Elisa, Limpio, San Antonio, Itauguá, Areguá) — add to
  `content/segmentos.php` + `$cities` in `areas-ciudades.php`; route dirs; sitemap picks them up.
- Blog articles (`content/blog.php`) for informational long-tail — only after guides prove out.
- GA4 + Ads conversion audit once `GA4_ID` exists (`assets/js/analytics.js` already fires
  `lead_submit` with value/currency).
- Lighthouse run on live after upload (fonts now self-hosted; expect ≥ 95 on all four).
