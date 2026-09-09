# Facts to verify / follow-up before launch

Business facts intentionally left `null`/empty in `content/site.php` because
nobody has confirmed them yet:

- `phone` / `whatsapp` / `email` — no WhatsApp reception is set up yet. Anton
  plans to add it once lawyers are signed and leads start flowing (see the
  planning conversation, 2026-09-09). Setting `content/site.php`'s
  `whatsapp` turns the WhatsApp CTA back on everywhere automatically — no
  template change needed.
- `registration`, `foundedYear`, `teamSize`, `credentials` — this is a
  referral service, not a firm with these facts to begin with. Leave null.
- `photos` — the design system is deliberately text-only (no icons, no
  photography). Leave null.

## Real firms, when the first one signs

The homepage and every área page render an honest empty state for "quién
recibe su consulta" (see `index.php` and `templates/service.php`/
`templates/segment.php` via `partials/`). When a firm signs in a given área
and city, that empty state becomes a real card — this needs a small content
addition (a `signedFirms` key keyed by área/city) and a partial, not yet built.

## Área × ciudad combination pages

Built 2026-09-09: `content/areas-ciudades.php` generates the 8 × 7 = 56
records ("Abogado de divorcio en Luque") from two small tables and the
área's own record in `content/services.php`, rendered by
`templates/segment.php` at `/ciudades/<ciudad>/<área>/`. The only
city-specific claims are the jurisdiction facts below plus one national
institution per área (MTESS, DINAPI, DNIT, DGRP, Ministerio Público,
Juzgados de la Niñez y la Adolescencia). Verify those names are current
before launch; everything else defers to the lawyer.

## Fonts

Done 2026-09-09: Spectral (400, 400 italic, 600, 800) and Work Sans
(variable 400–600) are self-hosted in `assets/fonts/`, subset to the Latin
range in `deploy/subset-fonts.sh`, preloaded from `partials/head.php`. The
Google Fonts CDN links are gone. Note: the CSS asks for Spectral 800 on
headings; the CDN placeholder only served up to 600, so headings were
browser-synthesised bold before and are true ExtraBold now.

## Jurisdiction facts

City pages state that Luque, San Lorenzo, Lambaré, Fernando de la Mora,
Capiatá and Mariano Roque Alonso fall under the Circunscripción Judicial de
Central, and that Asunción is its own circunscripción. This is general
public information, not case-specific — verify it is still current before
launch, and do not add more specific claims (court addresses, judge names,
processing times) without a source.
