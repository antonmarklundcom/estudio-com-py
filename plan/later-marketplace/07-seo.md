# 07 — SEO

The goal is to outrank thin directory pages with pages that answer the visitor's real question:
*what happens now, what does it cost, and who can take my case here.* Every indexable page must
pass the "would this page be useful with zero lawyers on it?" test.

## 1. URL scheme (frozen in P1)

| Page | URL | Notes |
|---|---|---|
| Home | `/` | |
| Directory hub | `/abogados/` | search: specialty + city + language |
| Specialty hub | `/abogados/<especialidad>/` | national, content-rich |
| Specialty × city | `/abogados/<especialidad>/<ciudad>/` | indexable only per §4 |
| City hub | `/ciudades/<ciudad>/` | URL kept from the PHP site |
| Lawyer profile | `/abogado/<slug>/` | singular, no ID in URL |
| Guides | `/guias/`, `/guias/<slug>/` | URLs kept from the PHP site |
| Tools | `/herramientas/<slug>/` | calculators (§5) |
| Intake | `/consulta/`, `/consulta/<situacion>/` | `noindex` on steps; the situation landing is indexable only if it has guide-level content (otherwise canonical → guide) |
| Trust pages | `/como-verificamos/`, `/como-funciona/`, `/para-abogados/`, `/para-abogados/planes/` | |
| Legal | `/terminos/`, `/privacidad/`, `/contacto/` | |
| Secondary wedge | `/en/…`, `/pt/…` | fixed page set, §6 |
| Private | `/panel/**`, `/admin/**`, `/mi-consulta/**`, `/api/**` | `Disallow` + `noindex` |

Everything is lowercase, uses hyphens, has a trailing slash (`trailingSlash: true`), and uses
ASCII slugs (ñ→n). A request with filter query params (`?idioma=gn`) has its canonical set to the
clean path and gets `noindex`.

## 2. Keyword research

The **keyword-library MCP is not connected in this session** (no `list_projects` or
`semantic_search` tools were available). Google Trends and Keyword Planner could not be reached
from the sandbox either. **No volumes below are real numbers.** Window S5 runs these seeds
through keyword-library (create the project `estudio-com-py` if missing), or Keyword Planner with
geo PY, and write the volumes into `plan/data/keywords.csv`. The indexable combo list (§4) is then
re-ranked by that data.

Seeds to pull, grouped by the page that owns them (one page, one primary intent):

| Owner page | Seed keywords |
|---|---|
| `/abogados/laboral/` + guide | abogado laboral, abogado laboralista, despido injustificado paraguay, liquidación por despido, cálculo de liquidación laboral, preaviso e indemnización, mtess denuncia |
| `/herramientas/liquidacion-por-despido/` | calcular liquidación paraguay, cuánto me corresponde si me despiden |
| `/abogados/familia/` + guides | abogado de familia, abogado divorcio, divorcio paraguay, divorcio mutuo acuerdo, cuánto cuesta un divorcio en paraguay, pensión alimentaria paraguay, cuánto es la pensión alimentaria, tenencia de hijos, régimen de visitas |
| `/abogados/sucesiones/` + guide | sucesión paraguay, juicio sucesorio, herencia sin testamento, cuánto cuesta una sucesión, declaratoria de herederos |
| `/abogados/inmobiliario/` + guides | desalojo paraguay, juicio de desalojo, inquilino no paga, contrato de alquiler, título de propiedad, abogado inmobiliario |
| `/abogados/penal/` | abogado penalista, abogado penal asunción, me imputaron, denuncia en fiscalía, qué hacer si detienen a un familiar |
| `/abogados/civil/` | cobro de deudas, pagaré vencido, embargo de sueldo, me demandaron por una deuda, intimación de pago |
| `/abogados/accidentes/` | accidente de tránsito abogado, reclamo al seguro accidente, indemnización accidente paraguay |
| `/abogados/empresas/` | abogado empresarial, constituir eas, crear empresa en paraguay, sa o srl, contrato de socios |
| `/abogados/tributario/` | abogado tributario, fiscalización dnit, sumario dnit, multa dnit |
| `/abogados/marcas/` | registrar marca paraguay, dinapi marca, cuánto cuesta registrar una marca |
| `/abogados/migraciones/` + `/en/`, `/pt/` | residencia permanente paraguay, residencia temporaria, abogado migraciones · paraguay residency lawyer · residência no paraguai advogado, abrir empresa no paraguai |
| `/herramientas/honorarios-minimos-abogado/` + `/guias/cuanto-cobra-un-abogado-en-paraguay/` | honorarios abogado paraguay, arancel abogados, cuánto cobra un abogado, precio consulta abogado |
| `/guias/abogado-gratis-defensoria-publica/` | abogado gratis, defensoría pública paraguay, defensor público |
| `/guias/como-verificar-la-matricula-de-un-abogado/` | verificar matrícula abogado, abogado matriculado, consulta de abogados corte suprema |
| combos | "abogado <especialidad> <ciudad>" for Asunción, Ciudad del Este, Encarnación, San Lorenzo, Luque, Capiatá, Lambaré, Fernando de la Mora, Pedro Juan Caballero, Coronel Oviedo |

**Never target competitor brand names** (no pages, titles, or ads on "buscaabogados" and
similar), and never use comparison pages that name them.

## 3. Redirects from the PHP site (301, in `next.config` `redirects()`, with a test that walks the list)

`/servicios/` → `/abogados/` · `/servicios/<a>/` → `/abogados/<a>/` (8) ·
`/ciudades/<c>/<a>/` → `/abogados/<a>/<c>/` (56) · `/blog/` → `/guias/` (already a 301) ·
`/ciudades/<c>/` and `/guias/<slug>/` stay 200 at the same URL · anything in `legacy-php/deploy/routes.php`
with status 410 stays 410. The P1 acceptance test fetches every URL in the old sitemap (86) and
asserts 200 or a single-hop 301 to a 200.

## 4. Indexability rules (implemented in `src/lib/seo/indexability.ts`, unit-tested)

| Page | Indexable when | Otherwise |
|---|---|---|
| Specialty hub | always (content ≥ 800 words, includes fee section §5) | — |
| Specialty × city | (≥ 2 verified lawyers with routing in the cell) **or** (a hand-written local block `content/local/<ciudad>/<esp>.mdx` of ≥ 150 words with sourced facts exists) | `noindex,follow`, excluded from sitemap, still reachable for users |
| City hub | ≥ 3 verified lawyers **or** `is_seo_priority` with a local intro | `noindex,follow` |
| Profile | verified **and** bio ≥ 300 chars **and** photo **and** ≥ 1 specialty | `noindex` (and not public at all if unverified) |
| Guide | always (≥ 900 words, `lastReviewed` date, reviewed per §7) | — |
| Tool | always | — |

The 56 generated combos of the PHP site fail this rule today (template text with the city name
swapped). At cutover they redirect to their new URL, and that URL is `noindex` until it earns
indexability. That is intended: thin pages hurt the whole domain.

P1 writes local blocks for **25 cells**: Asunción, Ciudad del Este, Encarnación, San Lorenzo and
Luque × laboral, familia, sucesiones, inmobiliario and penal. The content is which
circunscripción judicial handles the case, where the relevant public office is, and local
practicalities, with every fact sourced in the MDX front-matter. The cell list is re-ranked once
the §2 data exists.

## 5. Content that competitors don't have (the primary wedge, `02-market.md` §4)

1. **Fee transparency, done lawfully.** Each specialty hub and guide has a "¿Cuánto cuesta?"
   section containing:
   - the **legal minimum from the arancel (Ley 1376/88)** for the typical acts of that
     specialty, expressed in jornales and computed live from the current jornal mínimo (a
     `settings` value, Gs 117.077 since 2026-07-01 per Decreto 6225/2026, to be verified);
   - the declared ranges of the lawyers in that cell, once ≥ 3 lawyers have declared one;
   - a plain explanation of fixed-fee vs percentage vs cuota litis.
   The legal-minimum tables are reviewed by a lawyer before publishing (`05-legal.md` §2).
2. **Tools:** `/herramientas/honorarios-minimos-abogado/` (pick an act → minimum in Gs) and
   `/herramientas/liquidacion-por-despido/`. The second reuses the labour tables of the PHP
   template's `lib/market/py.php`, re-verified, and shows "orientativo, confirme con un abogado".
   Each tool ends in a situation-preselected intake CTA.
3. **Situation guides:** one per intake situation (14). The 8 existing guides are ported and 6
   are new: me-demandan, cobrar, deudas, accidente, extranjero-residencia and
   hijos-pension-alimentaria. Plus 3 trust guides: cómo verificar la matrícula, abogado gratis /
   defensoría pública, and cuánto cobra un abogado.
   Every guide has this shape: *qué pasa ahora → pasos → plazos (only when a public rule states
   them, named generically) → qué documentos → cuánto cuesta → cuándo necesita abogado → CTA*.

## 6. Secondary wedge pages (EN/PT), fixed set of 6

`/en/lawyers-in-paraguay/`, `/en/paraguay-residency-lawyer/`, `/en/company-formation-lawyer-paraguay/`,
`/pt/advogado-no-paraguai/`, `/pt/residencia-no-paraguai-advogado/`, `/pt/abrir-empresa-no-paraguai/`.

Each links to a filtered directory (`/abogados/migraciones/?idioma=pt`, canonicalised) and to a
localised intake. The intake UI stays Spanish in v1, with EN/PT labels on the situation step
only, and the AI accepts any language. `hreflang` pairs go only between true equivalents (each
EN/PT page ↔ its ES counterpart, plus `x-default` = ES). The company pages cross-link to
contador.com.py for RUC/IVA/e-Kuatia (a clearly marked partner link, `rel` without `nofollow`,
because it is our own site).

## 7. E-E-A-T and review

- Every guide carries a byline "Redacción estudio.com.py" plus "Revisado por Abg. <name>,
  matrícula N° <n>, el <date>". This line appears **only when a real verified lawyer actually
  reviewed it** (paid review; you own this task, `09-phases.md` P5). Otherwise the page shows only
  the `lastReviewed` date of the editorial check.
- `/como-verificamos/` explains the 4 checks, and profiles link to it from the badge.
- The site identity is in the footer and on `/contacto/`: brand, email, contact form. No RUC for
  now (your decision); the minimum for selling is settled before P4 (`05` §5).

## 8. Technical SEO

- **Metadata:** `generateMetadata` on every route gives a unique title (≤ 60 characters) and
  description (120–155). A unit test builds all indexable routes and asserts uniqueness.
- **JSON-LD:**
  - `Organization` + `WebSite` (SearchAction) on the home page. The platform is never marked up
    as `LegalService`.
  - `BreadcrumbList` everywhere.
  - Profiles get `Person` (`jobTitle: "Abogado"`, `knowsAbout`, `areaServed`, `knowsLanguage`).
    A lawyer who shows an office address also gets `LegalService` with that address.
  - `AggregateRating` appears only with ≥ 3 published reviews, and only on the lawyer entity.
  - `FAQPage` goes on hubs and guides (semantic only; don't expect rich results). No `HowTo` (deprecated).
- **Sitemaps:** a `sitemap.ts` index split into static, specialties, combos (indexable only),
  cities, profiles and guides. `lastmod` comes from `updated_at`. Ping via Search Console
  (a human step). `robots.ts` disallows the private paths and lists the sitemap. While
  `SITE_INDEXABLE=false`, robots returns `Disallow: /`.
- **Canonicals:** self-canonical on every indexable page. Filtered and paginated pages
  canonicalise to page 1 of the clean path. The EN/PT pages canonicalise to themselves.
- **Performance budget (Lighthouse mobile ≥ 95 in all four categories on `/`, one specialty
  hub, one combo, one profile and one guide):**
  - LCP < 2.0 s on a throttled 4G run and CLS < 0.05.
  - Public-page JS ≤ 90 KB gzip, excluding `/consulta/`.
  - Fonts are self-hosted via `next/font/local`, with 2 preloads maximum and metric-adjusted
    fallbacks.
  - GA4, VenderCRM `vc-attribution.js` and Turnstile load `lazyOnload` or only on form pages.
  - No third-party chat widgets.
- **Images:**
  - Editorial images follow `higgsfield-image-pipeline` + `webimg-pipeline`: model
    `gpt_image_2_5` variant `sunburst`, medium quality, 1k for cards and 2k for heroes, and
    Rule 0 (don't regenerate what exists).
  - Output is AVIF + WebP at 640/1280/1920, with SEO slug names such as
    `abogado-laboral-asuncion-oficina` and 8–20 word Spanish alt text passed via `--name` and
    `--alt`. There are no stock photos.
  - Budget: about 30 images in P1 (home, 11 hubs, 6 city heroes, 6 EN/PT heroes, OG default,
    ~5 guide covers).
  - Lawyer photos are processed in-app (sharp → AVIF/WebP 160/320/640 square), and their alt
    text is "Foto de perfil de Abg. <nombre>".
- **Internal links:**
  - guide → its specialty hub + 2 combos + the matching tool;
  - hub → all indexable combos + top guides;
  - combo → profiles in the cell + parent hub + city hub;
  - profile → the combos it covers.
  Links are generated from data, never hand-maintained.
