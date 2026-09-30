# 08 — Data

The lean model needs very little data, and none of it scraped.

| Data | Source | Where |
|---|---|---|
| Partner lawyers (1–3) | Your own contacts and checks (`05` §3) | `content/abogados.php` (public text they approved) + your private check notes (not in the repo) |
| Client leads | The site's form | VenderCRM only (plus the local degraded-mode log until `config.php` exists). Retention per `05` §4 |
| Keyword volumes | Keyword-library MCP, or a Google Keyword Planner CSV export | `plan/data/kwp-export.csv` → `plan/data/keywords.csv` (S4) |
| Arancel table + jornal mínimo (Gs 117,077 from 2026-07-01 per Decreto 6225/2026, to verify) | Ley 1376/88 (+ Ley 4590/2012) | `lib/market/py.php` (M4), lawyer-reviewed |
| Severance rules | Código del Trabajo | `lib/market/py.php` `laboral` table (M4), lawyer-reviewed |
| Local jurisdiction facts | Public official sources, one URL per fact | `content/local-blocks.php` (S3); unverifiable facts go to `plan/data/facts-to-verify.md` |

**Not used in this model:**
- the CSJ open dataset (you check 1–3 partners by hand);
- lawyer outreach lists;
- the Leads DB scraper.
If the marketplace plan is revived, `later-marketplace/08-data.md` covers them.
