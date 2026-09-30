# 03 — Product: a content site plus lead handling with 1–3 partner lawyers

## 1. What it is

An SEO content site that answers people's legal questions honestly (situations, steps, costs by
law), with one contact form. You handle each request yourself and introduce the client to one of
1–3 partner lawyers who together cover the áreas. There are no lawyer accounts, no directory, no
matching engine and no billing on the site.

It is the existing PHP site (built through phases O1–S5, `/plan.md`), hardened for the rules in
`05-legal.md` and deepened for SEO. The marketplace plan is parked in `later-marketplace/`: revive
it only if leads outgrow 3 lawyers.

## 2. Áreas and partner coverage

The 8 áreas that exist today stay: familia, penal, laboral, sucesiones, empresas, inmobiliario,
tributario, marcas.

A sensible split for 3 partners:
- **A:** familia, sucesiones, inmobiliario;
- **B:** laboral, penal;
- **C:** empresas, tributario, marcas.
One generalist can start alone and hand off what they don't take.

`content/abogados.php` (already built) lists the partners, and each área page shows who takes its
cases. An área with no partner shows the honest empty state (`05` §2).

Optional later áreas (civil/deudas, accidentes, migraciones) are added only when a partner covers
them. Adding one is a content record + route dir + lead-values record, so no code is needed.

## 3. The client flow

1. The visitor reads a guide or área page and fills in the form: name, phone, city (existing
   field), área chip (existing), optional short note (≤ 500 characters, with the sensitive-data
   hint), and the **consent checkbox** (new, required).
2. `enviar.php` posts to VenderCRM (already built) with the área, city, source page, consent
   version and a UUID idempotency key. The visitor sees "Recibimos su consulta. Le respondemos en
   1 día hábil…" plus the honest next steps.
3. **You** (in VenderCRM) reply within 1 business day by phone or WhatsApp from your CRM:
   - **Área covered:** introduce the partner by name and matrícula and ask for consent to share
     (`05` §4). On "sí", forward the lead to the partner and note the date. The partner contacts
     the client, and fees are agreed between them.
   - **Not covered:** say so honestly, mention the Defensoría Pública where relevant, and delete
     within 30 days.
4. Follow-up at +7 days: "¿Le contactó el abogado?" This is your quality check on partners.
5. Monthly clean-up per the retention rules.

The runbook with message templates is written in the build: `docs/ops/lead-handling.md`.

## 4. What the site shows about partners

When a partner exists (their written approval of the text is required):
- a text card on the área pages and the matching área × ciudad pages:
  - **Abg. <nombre>**, matrícula N° <n>;
  - áreas;
  - "atiende en Asunción y de forma virtual";
  - "Abogado independiente asociado a estudio.com.py";
- a photo only if the lawyer supplies one. The design system is text-only, so photos are
  optional (question 9 in `10`).

`/como-trabajamos/` (new) explains:
- who you are;
- how the contact works (two steps);
- that partners pay a fixed monthly publicity fee;
- that the client pays estudio.com.py nothing and no share of fees is taken.

## 5. Out of scope

- Lawyer self-signup, profiles, verification engine, badges;
- automatic routing, SLA, reviews;
- billing or payments on the site;
- client accounts, uploads;
- AI intake;
- an estudio WhatsApp number (you reply from VenderCRM / your phone);
- EN/PT pages (only if a partner speaks the language and takes foreigners' cases).
