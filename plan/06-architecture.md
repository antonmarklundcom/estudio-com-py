# 06 — Architecture

## 1. Stack decision

**Next.js (App Router, TypeScript, current stable) + Tailwind v4 + MySQL 8 + Drizzle ORM on a
Hostinger managed Node.js slot (LATAM account).** It's your proven stack (`nodejs-mysql-hostinger-stack`,
`nextjs-deploy-hostinger`, propia).

Why not the alternatives:
- *Keep extending the PHP site.* It has no database, sessions, cron, webhooks or file uploads. A
  marketplace needs all of them, so the PHP site would become a hand-rolled framework.
- *Postgres on Neon.* Hostinger has known broken IPv6 routing to Neon, and MySQL sits next to the
  app for free.
- *Cloudflare Workers + D1 full stack.* It's cheaper at scale, but it's a new stack for you and
  the builders. Revisit only if a Node slot becomes the bottleneck.

**Cloudflare, used for what it's good at:** DNS; Turnstile; R2 object storage; Email Routing and
Sending (`cloudflare-email`); a cron Worker that ticks the app (§8).

The existing PHP site (`/` of this repo today) moves to `legacy-php/` in P0 and stays live on
shared hosting until the P1 cutover (§11).

## 2. Repository layout (after P0)

```
legacy-php/                 the current PHP site, verbatim (deleted in P5 after cutover + 30 days)
plan/                       this plan
prompts/                    per-phase prompt files (written in P0 from 09-phases.md)
src/
  app/
    (public)/               home, /abogados/**, /ciudades/**, /abogado/[slug], /guias/**, /herramientas/**,
                            /consulta/**, /mi-consulta/[token], /como-verificamos, /como-funciona,
                            /para-abogados/**, /privacidad, /terminos, /contacto, /en/**, /pt/**
    (lawyer)/panel/**       lawyer dashboard (auth: lawyer)
    admin/**                admin (auth: admin|editor, TOTP)
    api/                    push/subscribe, cron/tick, intake/*, uploads/*
    sitemap.ts robots.ts
  db/  schema.ts  index.ts  relations.ts
  lib/
    auth/        session (iron-session), password (bcryptjs), totp, guards (requireRole, requireOwner)
    matching/    eligibility.ts, score.ts, shortlist.ts        ← pure functions, unit-tested
    sla/         businessHours.ts, deadlines.ts, reassign.ts   ← pure functions, unit-tested
    ai/          summarize.ts, schema.ts, filter.ts, fallback.ts
    intake/      questionSets.ts (loads content/intake/*.json), redact.ts, urgency.ts
    notify/      outbox.ts, email.ts (Cloudflare), webpush.ts (VAPID, `web-push`)
    crm/         vendercrm.ts (per `vendercrm-lead-capture` references/nextjs.md)
    billing/     periods.ts (paid_until, grace, reminders), confirm.ts (admin confirmation)
    storage/     r2.ts (S3 client, signed URLs), images.ts (sharp → AVIF/WebP)
    security/    crypto.ts (AES-256-GCM + HMAC lookup), ratelimit.ts, turnstile.ts, audit.ts
    seo/         meta.ts, jsonld.ts, indexability.ts
    analytics/   events.ts (server funnel events), ga4.ts
  components/    ui/ (tokens-only primitives), public/, panel/, admin/
content/
  guias/*.mdx               guides (ported from legacy-php/content/guias.php, then extended)
  especialidades/*.mdx      specialty hub copy (ported from services.php)
  local/<ciudad>/<esp>.mdx  hand-written local blocks for indexable specialty×city pages
  intake/<situation>.json   question sets
  legal/*.mdx               terminos, privacidad (versioned; hash stored with each consent)
public/img/                 editorial images from the webimg pipeline + manifest.json
public/fonts/               the existing self-hosted woff2 files, moved from legacy-php/assets/fonts
scripts/                    seed-taxonomy.ts, seed-plans.ts, import-csj-dataset.ts, create-admin.ts,
                            purge-expired.ts (idempotent, onDuplicateKeyUpdate)
tests/unit/ (vitest)  tests/e2e/ (playwright, uses /opt/pw-browsers/chromium in cloud)
workers/cron-tick/          Cloudflare Worker (wrangler), README with deploy steps
```

Identifiers and code in English. URLs, copy and emails in Spanish (es-PY, *usted*). All UI strings
go through `src/i18n/es.ts` (plus `en.ts`/`pt.ts` only for the secondary-wedge pages).

## 3. Rendering and caching

- Public content pages (guides, specialty/city hubs, combos, profiles) are statically generated.
  They are revalidated by tag when a lawyer, review or taxonomy row changes (`revalidateTag('lawyer:<id>')`,
  `revalidateTag('cell:<esp>:<city>')`). There is also a 24 h time-based fallback.
- `/consulta/**` renders on the server with a small client component for the stepper. It is the
  only public route that ships meaningful JS.
- Panel and admin render dynamically. No public page reads the session.
- Server Actions handle form mutations, and Route Handlers handle webhooks and cron.

## 4. Data model (Drizzle, MySQL, `utf8mb4`, all times UTC)

Every public-facing table has `status`, `created_at`, `updated_at`, `updated_by`. `*_enc` columns
use AES-256-GCM with `ENCRYPTION_KEY`, and `*_hash` columns are HMAC-SHA256 with `HASH_KEY` (for
dedupe and lookup without decrypting). Enum values are listed in full so P0 writes them once.

| Table | Key columns |
|---|---|
| `users` | id, email (uniq), password_hash, role enum(admin,editor,lawyer), email_verified_at, phone_e164, phone_verified_at, totp_secret_enc, status enum(active,disabled), last_login_at |
| `departments` | id, slug, name |
| `cities` | id, slug (uniq), name, department_id, population, is_seo_priority bool, sort |
| `specialties` | id, slug (uniq), name, short_name, sort, active |
| `situations` | id, slug, specialty_id (nullable for `otro`), card_text, question_set, sort, active |
| `lawyers` | id, user_id (uniq), slug (uniq), display_name, matricula_number (uniq), matricula_year, headline, bio, photo_key, years_declared, office_address, office_city_id, show_address, whatsapp_e164, whatsapp_public, website, virtual_nationwide, status enum(draft,pending,verified,suspended,hidden,deleted), routing_paused_until, routing_pause_reason, vacation_until, completeness, billing_ruc, billing_name, founder bool |
| `lawyer_specialties` | lawyer_id, specialty_id, level enum(principal,secundaria), fee_mode enum(arancel,desde,a_convenir), fee_from_gs, fee_note(300) — PK(lawyer_id, specialty_id) |
| `lawyer_cities` | lawyer_id, city_id — PK both |
| `lawyer_languages` | lawyer_id, lang enum(es,gn,pt,en,de) |
| `verifications` | id, lawyer_id, status enum(pending,approved,rejected,expired), identity_ok, matricula_doc_ok, official_source enum(qr_matricula_digital,constancia_csj,csj_dataset_2019,other), official_source_ref, official_status enum(habilitado,suspendido,cancelado,desconocido), liveness_method enum(video_call,selfie), phone_confirmed, decided_by, decided_at, expires_at, rejection_reason, notes |
| `verification_documents` | id, verification_id, kind enum(cedula_frente,cedula_dorso,matricula,selfie,constancia,otro), storage_key, mime, sha256, uploaded_at, purge_after, purged_at |
| `leads` | id, token_hash (uniq), situation_id, specialty_id, city_id, accepts_virtual, language, urgency enum(normal,alta), detained_now, answers_json, free_text_enc, ai_summary_json, ai_status enum(ok,fallback,failed), ai_model, ai_confidence, client_name_enc, client_phone_enc, client_phone_hash, client_email_enc, contact_pref enum(whatsapp,llamada,email), phone_verified_at, reassign_consent, status enum(new,triage,offered,accepted,no_coverage,closed,spam,deleted), utm_source/medium/campaign/term/content, gclid, fbclid, page_url, referrer, ip_hash, retention_until |
| `lead_assignments` | id, lead_id, lawyer_id, origin enum(client_choice,auto_reassign,admin), rank, score, score_json, status enum(offered,viewed,accepted,declined,expired,withdrawn), offered_at, sla_due_at, viewed_at, responded_at, decline_reason enum(fuera_area,sin_agenda,conflicto,otro), contacted_at, client_confirmed enum(si,no), client_confirmed_at — UNIQUE(lead_id,lawyer_id) |
| `lead_reports` | id, assignment_id, reason enum(contacto_falso,duplicado,fuera_area,ya_tiene_abogado,spam), note, status enum(open,upheld,rejected), decided_by, decided_at |
| `contact_clicks` | id, lawyer_id, page_path, session_hash, created_at |
| `reviews` | id, assignment_id (uniq), lawyer_id, token_hash, rating_atencion, rating_claridad, body, status enum(invited,submitted,published,rejected), lawyer_reply, lawyer_replied_at, moderated_by, moderated_at, rejection_reason, invited_at, submitted_at |
| `plans` | id, code (uniq), name, price_gs_month, price_gs_year, routing bool, max_principal, max_secondary, max_cities, fair_use_month, active |
| `subscriptions` | id, lawyer_id, plan_id, status enum(founder_free,active,grace,lapsed,canceled), paid_until, grace_until, billing_period enum(monthly,yearly), locked_price_gs, founder bool |
| `sponsored_slots` | id, lawyer_id, specialty_id, city_id, starts_at, ends_at, status enum(active,paused,ended), price_gs — UNIQUE active per (specialty, city) |
| `payments` | id, lawyer_id, subscription_id, sponsored_slot_id, amount_gs, method enum(transferencia,link_manual,efectivo,otro), reference, receipt_key, status enum(reported,confirmed,rejected), reported_at, confirmed_by, confirmed_at, period_from, period_to, invoice_number |
| `consents` | id, lead_id?, user_id?, kind enum(terms_privacy,share_with_lawyers,reassign,marketing,lawyer_terms,lawyer_public_phone), doc_version_hash, granted, ip_hash, created_at |
| `abuse_reports` | id, reporter_type, reporter_ref, target_type, target_id, reason, body, status, handled_by |
| `blocklist` | id, kind enum(phone_hash,ip_hash,email_hash), value, reason, expires_at |
| `push_subscriptions` | id, user_id, endpoint (uniq), p256dh, auth, user_agent, created_at, last_ok_at, failed_count |
| `notifications` | id, channel enum(email,webpush,whatsapp — reserved, unused in v1), template, to_hash, entity_type, entity_id, payload_json, status enum(queued,sent,failed,skipped), attempts, provider_ref, error, send_after, sent_at — **outbox** |
| `funnel_events` | id, event, session_id, lead_id?, lawyer_id?, props_json, created_at |
| `audit_log` | id, actor_user_id, actor_role, action, entity_type, entity_id, diff_json, ip_hash, created_at — append-only |
| `csj_roll` | matricula, nombre_normalizado, source_date — admin-only cross-check, never public (`08-data.md` §2) |
| `settings` | key, value_json (SLA hours, max lawyers per case, fair-use, founder cap, jornal_minimo) |
| `holidays` | date, name |
| `rate_limits` | key, window_start, count — PK(key, window_start) |
| `job_locks` | job, locked_until, last_run_at, last_result |

The Drizzle migrations are the only way the schema changes. A PR that changes `schema.ts` is titled
`MIGRATION REQUIRED —`. You run `db:migrate` against production; agents never do.

## 5. Auth and permissions

- Lawyers sign in with email + password (bcryptjs, cost 12). Email verification and password
  reset use single-use tokens that expire in 1 h. The phone is confirmed by the admin's call
  during verification; there is no OTP in v1 (no WhatsApp number, no SMS).
- Admins and editors also need TOTP (otplib). Admin sessions are 8 h, lawyer sessions 30 days
  (rolling). Sessions are iron-session, httpOnly, secure, SameSite=Lax.
- `requireRole()` + `requireOwner()` run in every Server Action and route. There is a test per
  panel action proving that lawyer A cannot read or mutate lawyer B's data.
- Clients have no accounts. `/mi-consulta/<token>` uses a 256-bit token, stored hashed and
  rate-limited.
- Every admin read of client PII writes an `audit_log` row (`action = 'pii.view'`).

## 6. AI summary service (`src/lib/ai/`)

- Anthropic TypeScript SDK (`@anthropic-ai/sdk`), called server-side only, key `ANTHROPIC_API_KEY`.
- Model comes from env `AI_MODEL`, default `claude-opus-5-5` with `output_config.effort: "low"`.
  Cost at ~1.5k input / ~400 output tokens: Opus 5.5 ≈ USD 0.014 (plus thinking), Sonnet 5.5 ≈
  USD 0.007, Haiku 4.5 (`claude-haiku-4-5`) ≈ USD 0.0035 per intake. At 1,000 intakes a month
  the difference is under USD 15, so quality wins. Include server-side refusal `fallbacks:
  "default"` as the claude-api skill prescribes. Builders load the `claude-api` skill before
  writing this module.
- **Structured output** (`output_config.format` JSON schema):
  `{ resumen: string[3..5], especialidad_sugerida: slug, confianza: 0..1, plazos_mencionados:
  {fecha?: string, descripcion: string}[], preguntas_para_el_abogado: string[3], idioma_detectado }`.
- The system prompt (versioned in `src/lib/ai/prompt.ts`, hash stored with each lead) forbids
  advice, predictions, amounts, citations and second-person legal conclusions. It also tells the
  model the input may be in Guaraní/jopara, and that the output must be Spanish.
- `filter.ts` post-checks the output with regex/wordlists for forbidden patterns ("tiene derecho",
  "le corresponde", "Gs", "art.", "ganará"). On a hit: regenerate once, then use the fallback
  template. There are unit tests with 20 fixture intakes.
- Timeout 8 s. On failure, `fallback.ts` builds the summary from the answers alone
  (`ai_status = fallback`).
- Privacy: text is redacted before the call (`redact.ts`). The privacy policy discloses the
  processor (Anthropic, USA) and the international transfer.

## 7. Notifications (outbox)

Everything goes through the `notifications` outbox. The cron tick sends it with retries and
backoff; nothing sends inline in a request except account emails (verification, reset).
- **Email:** Cloudflare Email Sending REST, sender `avisos@estudio.com.py`, Reply-To
  `hola@estudio.com.py` (`cloudflare-email`). The daily quota is **200 per account, shared by all
  your sites**, so v1 sends email only for account mail, verification results, digests and
  invoices, plus case alerts to lawyers and client updates (clients only if they left an email).
  Budget: about 4 emails per case. At 30 cases/day that is ~120/day, so **ask Cloudflare for a
  quota increase before P3 goes live**; until then case alerts batch into a digest past 150/day.
- **Web Push:** the lawyer panel is an installable PWA (manifest + service worker). The lawyer
  opts in from the panel; `webpush.ts` sends "Nueva consulta de <especialidad> en <ciudad> — vence
  <hora>" with no client data. Dead subscriptions (404/410) are removed. This is the instant
  alert channel, free, no Meta account.
- **WhatsApp:** not in v1 (your decision). The client contacts and is contacted through the
  lawyer's own WhatsApp (`wa.me` links); estudio has no number. The outbox enum keeps `whatsapp`
  reserved so adding it later needs no migration.
- Every template text lives in `src/notify/templates/` with a test that renders each one.

## 8. Scheduled work

A Cloudflare Worker `cron-tick` fires every 5 min and sends `POST /api/cron/tick` with an HMAC
header. `tick` runs these idempotent jobs, each guarded by `job_locks`:
SLA expiry + auto-reassign · outbox sender · client check-ins (+24 h after accept) · review
invitations (+14 d, reminder +30 d) · verification expiry (12 months) · document purge (90 d after
decision) · lead retention purge (§10) · subscription period roll / past_due · daily digest
(07:30 PY time).
Fallback if the Worker is down: an hPanel cron hitting the same URL every 15 min, if the plan
offers cron.

## 9. Integrations

| Integration | Where | Degrades to |
|---|---|---|
| VenderCRM | **Every form posts to VenderCRM**, server-side via the outbox, never from the browser: intake (`source: consulta`), lawyer interest form (`para-abogados`), lawyer signup (`registro-abogado`), contact page (`contacto`). Endpoint `POST https://crm.clientes.com.py/api/v1/leads` (`VENDERCRM_URL` = the base URL), header `X-Api-Key` = the **estudio** site key from your VenderCRM Sitios list (hosting env only — never in the repo, never in client JS). Payload: `phone` (+595 format, the contact identity), `name`, `email` if given, `message` (a one-line label such as "Consulta laboral — Luque"), `source`, `idempotency_key` (a UUID generated when the form renders, so a double-click dedupes but a new submission never does), `fields {situacion, especialidad, ciudad, urgencia, lead_id}`, utm/gclid from the `vc_attr` cookie. **No free text or AI summary to the CRM** (data minimisation). One key for the whole site; if you later want lawyer prospects in a separate pipeline, create a second site in VenderCRM and set the optional `VENDERCRM_API_KEY_LAWYERS` | outbox row stays `failed` and retries; the visitor never sees an error |
| Turnstile | intake step 5, lawyer signup, review form, login after 3 failures | block submit if the secret is set and verification fails; skip in dev |
| R2 | `estudio-public` (lawyer photos, served via `img.estudio.com.py`), `estudio-private` (verification docs, signed URLs of 5 min) | uploads disabled with a message |
| Billing | **manual** (`04` §6): transfer or hand-made payment link → lawyer clicks "Ya pagué" → admin confirms → `paid_until` set; invoices issued by you outside the app, number recorded | — |
| GA4 + Google Ads | `lib/analytics/ga4.ts`, loaded `lazyOnload` | no-op |

## 10. Security, privacy and abuse

- **Lead form:** honeypot field · min 4 s from render to submit · Turnstile · rate limits (MySQL
  fixed window): 5 intakes/h and 20/day per IP hash, 3/day per phone hash · blocklist check ·
  phone format check (PY +595 or valid international) · duplicate detection (same phone hash +
  situation within 72 h → attach to the existing lead).
- **Lawyer signup:** Turnstile · 3 signups/day per IP · email verification required before any
  upload · matrícula number unique · nothing is public before verification (the real gate).
- **Uploads:** max 8 MB, MIME sniffed server-side (jpeg/png/webp/pdf), EXIF stripped, filenames
  random, private bucket.
- **Headers:** CSP (self + Turnstile + GA + R2 image host), HSTS, frame-ancestors none,
  Referrer-Policy strict-origin-when-cross-origin.
- **Retention (defaults, confirm in `05-legal.md`):**
  - Leads with no acceptance: PII purged at 180 days.
  - Accepted leads: PII purged 24 months after acceptance.
  - Anonymised stats are kept.
  - Client "Eliminar mis datos" purges PII within 24 h, and a notification goes to any lawyer who
    accepted.
  - Verification images are purged 90 days after the decision.
- **Backups:** Hostinger daily DB backups plus a weekly `mysqldump` of the database, encrypted,
  to R2 (script in P5).

## 11. Environments and deploy

- `main` deploys to the Hostinger Node slot via the Git integration (`nextjs-deploy-hostinger` §1).
- Before cutover the app runs on the `*.hostingersite.com` URL with `SITE_INDEXABLE=false`, which
  sends a global `noindex` and a robots disallow.
- **Cutover (end of P1):** DNS for `estudio.com.py` points at the Node app and `SITE_INDEXABLE=true`.
  Every legacy URL 301s per `07-seo.md` §3. The PHP hosting stays untouched for 30 days as a rollback.
- DB changes are run by you from your PC (Remote MySQL + `$env:DATABASE_URL`). Seeds are idempotent.
- **Quality gate:** a husky `pre-push` runs typecheck + lint + unit tests + build, per
  `budgeted-runner-deploy`. There is no new GitHub Actions workflow without your yes (question in
  `10-risks-and-open-questions.md`). The legacy PHP `verify.yml` moves with the PHP site and is
  deleted at P5.
- Env vars (all in `.env.example` with a comment on the source of each): `DATABASE_URL`,
  `SESSION_SECRET`, `ENCRYPTION_KEY`, `HASH_KEY`, `SITE_URL`, `SITE_INDEXABLE`,
  `ANTHROPIC_API_KEY`, `AI_MODEL`, `TURNSTILE_SITE_KEY`, `TURNSTILE_SECRET`,
  `R2_ACCOUNT_ID`, `R2_ACCESS_KEY_ID`, `R2_SECRET_ACCESS_KEY`, `R2_PUBLIC_BUCKET`,
  `R2_PRIVATE_BUCKET`, `R2_PUBLIC_HOST`, `CLOUDFLARE_ACCOUNT_ID`, `CLOUDFLARE_EMAIL_TOKEN`,
  `EMAIL_FROM`, `VAPID_PUBLIC_KEY`, `VAPID_PRIVATE_KEY`, `VAPID_SUBJECT`,
  `VENDERCRM_URL` (https://crm.clientes.com.py), `VENDERCRM_API_KEY`, `VENDERCRM_API_KEY_LAWYERS` (optional), `CRON_SECRET`, `GA4_ID`, `ADS_ID`.

## 12. Front-end conventions

- **Brand carries over from the PHP site:** paper `#f4f3ee`, ink `#1c1b18`, terracotta `#a24a30`,
  Spectral (headings, 600/800) + Work Sans (body). These are the same self-hosted subset woff2
  files, loaded with `next/font/local`, `display: swap`, and at most 2 preloads. **No Google Fonts
  CDN.**
- The old "text-only, no photos" rule is replaced. Lawyer photos (their own uploads) and editorial
  images from the Higgsfield → webimg pipeline (`07-seo.md` §8) are allowed. There are still no
  stock photos and no icon libraries beyond a small inline SVG set.
- **Tailwind v4 pitfalls.** Your memory notes weren't readable from this cloud session;
  reconcile these with them in P0:
  - Tokens live in `@theme` in `globals.css`.
  - A token that references another CSS variable goes in `@theme inline`, or it resolves at the
    wrong scope.
  - Arbitrary variable values use the v4 shorthand `bg-(--color-paper)`. The v3 form
    `bg-[--color-paper]` silently fails.
  - Never build class names dynamically.
  - Check opacity modifiers on var-based colours (`bg-(--x)/50`) in the browser, not just in
    the build.
- WhatsApp green appears only on real WhatsApp actions. Contrast is AA. Touch targets are at
  least 44 px.
