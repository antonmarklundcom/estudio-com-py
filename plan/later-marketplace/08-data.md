# 08 — Seed data

Every lawyer on the site signed up themselves and passed verification. **No profile is
created from any list, dataset or website.** Seed data exists only to verify lawyers, to fill
the taxonomy and content, and to reach lawyers lawfully so they can sign up.

## 1. Reference data (P0, `scripts/seed-taxonomy.ts`, idempotent)

| Data | Source | Notes |
|---|---|---|
| 11 specialties, 14 situations | `03-product.md` §2 | slugs frozen at P0 |
| 17 departments + ~28 cities with population | INE Census 2022 (`02-market.md` §2) | `is_seo_priority`: Asunción, CDE, Encarnación, San Lorenzo, Luque; population numbers marked for check |
| Plans | `04-business-model.md` §2 | `scripts/seed-plans.ts` |
| Settings | jornal mínimo Gs 117,077 (verify), SLA hours, max 3 lawyers per case, fair use 40, founder cap 50 | admin-editable |
| Holidays 2026–2027 (PY) | official list, owner-verified | `holidays` table; SLA pauses on them |
| Intake question sets | written in P3 | `content/intake/*.json` |

## 2. CSJ "Abogados" open dataset (verification aid only)

- **What:**
  - Official CSJ roll of matriculated lawyers, published on datos.gov.py and datos.csj.gov.py.
  - Licensed under the Paraguayan government's public-information licence.
  - Reported fields: matrícula + name.
  - **Last modified 2019-10-15.** Download status: you saw a 404 on datos.gov.py, and this
    environment couldn't reach either site.
- **Use:**
  - A secondary cross-check in the admin verification screen: "number and name found in the CSJ
    2019 roll: yes/no".
  - It never proves *current* status. Lawyers matriculated after 2019 won't be in it, and a
    suspension won't show.
  - Step 3 of verification (`03` §4.3) still needs the QR matrícula digital or a CSJ constancia.
- **How:**
  1. You download the CSV/JSON in a normal browser (try datos.csj.gov.py/pjopendata/ first,
     then datos.gov.py/dataset/abogados). Put it in the private path `data/private/csj-abogados-<date>.csv`.
     `data/private/` is git-ignored.
  2. `scripts/import-csj-dataset.ts` loads it into table `csj_roll(matricula, nombre_normalizado,
     source_date)`. The table is admin-read-only and never exposed publicly or used for outreach.
  3. If the file is unusable or unreachable, skip it. The verification flow works without it:
     `official_source = qr_matricula_digital | constancia_csj`.
- **Never:**
  - generate public profiles, "claim your profile" pages or SEO pages from the roll;
  - message people from it.
  The roll's purpose is public verification, not marketing (`05-legal.md` §4).

## 3. Lawyer outreach list (cold start): a dependency on your Leads DB

- **Not built in this repo.** Outreach prospects come only from your Leads DB
  (`C:\Claude 1\leads-db`) and its existing scraper process.
- This plan asks that process for a CSV export with these columns:
  `nombre, estudio, ciudad, especialidades_publicas, telefono_publico, email_publico,
  web, fuente_url, fuente_permite_uso (bool), no_molestar_verificado (bool + fecha)`.
- Rules the Leads DB process must meet (write them into its run notes; not enforced here):
  - only sources whose terms and robots.txt allow it (public business listings the firm itself
    published);
  - **never buscaabogados.com.py or any site that forbids scraping**;
  - never get around bot protection;
  - only business contact data the firm itself published;
  - personal mobiles are checked against SEDECO *No Molestar* before any WhatsApp or call.
- **Destination: VenderCRM**, as a B2B pipeline "Abogados – captación". Not the app database: the
  app never stores prospects.
- **Message rules:** it says who we are, why we're writing, and how to opt out; one follow-up
  maximum; opt-outs are honoured in VenderCRM and in the Leads DB.

## 4. Opt-in signups

- P1 ships `/para-abogados/` with a short interest form (name, phone, city, areas, consent).
  It posts to VenderCRM with the estudio site key and `source: para-abogados` (or the optional
  second key, `06` §9).
- When P2 opens real signup, these people get a personal invite link:
  `/para-abogados/registro?ref=<code>`. The code attributes founders and skips nothing in
  verification.

## 5. Content data carried over from the PHP site (P1 port)

| From `legacy-php/` | To | Treatment |
|---|---|---|
| `content/guias.php` (8 guides) | `content/guias/*.mdx` | port text, then extend to the guide shape in `07-seo.md` §5 |
| `content/services.php` (8 áreas) | `content/especialidades/*.mdx` | port includes/excludes/weNeed/FAQ; add fee section |
| `content/segmentos.php` (7 cities) | `content/local/<ciudad>/_intro.mdx` | keep jurisdiction facts, still "to verify" |
| `content/areas-ciudades.php` (56 combos) | nothing | generated text is not ported (thin), URLs redirect (`07` §3) |
| `lib/market/py.php` labour tables | `src/lib/tools/laboral.ts` | re-verify against current MTESS/Código del Trabajo rules before the calculator ships |
| `docs/facts-to-verify.md` | `plan/data/facts-to-verify.md` | extended with the new facts from `05-legal.md` §7 |
| fonts `assets/fonts/*.woff2` | `public/fonts/` | as-is |

## 6. Keyword data

`plan/data/keywords.csv` has the columns `keyword, volume_py, cpc_gs, intent, owner_page, source,
pulled_at`. It is filled by window S5 from the keyword-library MCP, or from Keyword Planner if the MCP
is still missing. Seeds are in `07-seo.md` §2.

## 7. Development and test data

- `scripts/seed-dev.ts` creates fake lawyers named "Abg. Prueba N", fake leads and one admin.
- It refuses to run unless `NODE_ENV !== 'production'` and `DATABASE_URL` points at a database
  whose name ends in `_dev`.
- It never touches production.
- `tests/fixtures/intakes/*.json`: 20 realistic but invented intakes (including Guaraní/jopara
  text and one attempt to extract legal advice). They are used by the AI filter tests.
