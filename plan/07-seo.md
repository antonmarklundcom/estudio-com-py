# 07 — SEO and content (rank first)

The goal is to rank for what people search when a legal problem starts, with pages that are
useful even before any lawyer is attached. That is the primary wedge from `02-market.md` §4:
*what happens now, what it costs by law, and who can take the case.*

## 1. URL scheme: frozen, already live

| Page | URL |
|---|---|
| Área | `/servicios/<área>/` |
| City | `/ciudades/<ciudad>/` |
| Área × ciudad | `/ciudades/<ciudad>/<área>/` |
| Guide | `/guias/<slug>/` |
| Tool | `/herramientas/<slug>/` (new) |
| Trust | `/como-trabajamos/` (new), `/contacto/`, `/terminos/`, `/privacidad/` |

There are no URL changes and no redirects: the site is small and it's cheaper to keep what
exists.

## 2. Keyword research

The keyword-library MCP wasn't connected in the planning session. There are **no volume numbers
yet**, and pulling them is the first content task (§6):
- connect the MCP (question 8), or
- export a CSV from Google Keyword Planner (geo Paraguay) to `plan/data/kwp-export.csv`.

The seed list with page mapping is in `later-marketplace/07-seo.md` §2. Use it as-is, with
`/abogados/<esp>/` read as `/servicios/<área>/`. **Never target competitor brand names.**

## 3. Indexability (no thin pages)

| Page | Indexed when | Otherwise |
|---|---|---|
| Área page (8) | always (content ≥ 800 words, fee section) | — |
| Guide | always (≥ 900 words, `lastReviewed`) | — |
| Tool | once `TOOLS_LIVE` is on | stub, `noindex` |
| City page (7) | always (keeps jurisdiction facts) | — |
| Área × ciudad (56) | a hand-written local block exists (≥ 150 words, every fact sourced) | `noindex,follow`, not in the sitemap |

Start with **10 local blocks**: Asunción, San Lorenzo, Luque, Lambaré, Fernando de la Mora ×
familia and laboral. Re-rank once the keyword data exists.

## 4. Content to add (the wedge)

1. **Fee transparency, done lawfully:** a "¿Cuánto cuesta?" section on each of the 8 área pages
   with the arancel legal minimum for that área's typical acts, computed from the jornal mínimo
   (the tables in the market module are reviewed, `05` §5). Plus the guide
   `/guias/cuanto-cobra-un-abogado-en-paraguay/`.
2. **Tools:** fee minimums and severance (`06` C9).
3. **Guides (9 new, 17 total), each one situation:**
   - Fees: `cuanto-cuesta-un-divorcio-en-paraguay`, `cuanto-cuesta-una-sucesion`.
   - Situations: `me-demandaron-por-una-deuda`, `inquilino-no-paga-desalojo`,
     `pension-alimentaria-como-se-pide`, `despido-injustificado-que-me-corresponde`.
   - Trust: `como-verificar-la-matricula-de-un-abogado`, `abogado-gratis-defensoria-publica`,
     `cuanto-cobra-un-abogado-en-paraguay`.
   Shape: *qué pasa ahora → pasos → plazos (only when a public rule states them) → documentos →
   cuánto cuesta (arancel) → cuándo necesita abogado → form*.
4. **Local blocks:** the 10 cells in §3.

## 5. Technical

It's mostly done on this site:
- self-hosted subset fonts, no Google Fonts CDN;
- unique titles and descriptions checked by `verify.sh`;
- `Organization` + `Service` JSON-LD;
- sitemap and robots;
- `es-PY` hreflang.

To add:
- `FAQPage` JSON-LD on área pages and guides, where FAQs exist;
- a Lighthouse mobile run after upload, target ≥ 95 in all four categories on `/`, one área,
  one guide and one tool;
- Search Console: verify the domain and submit `/sitemap.xml` (your step).

Images: the design system is text-only by design, which suits Lighthouse. Adding editorial images
via the Higgsfield → webimg pipeline is question 9.
