# Owner checklist

- [ ] Build the zip (`deploy/make-zip.sh` or `.ps1`) from merged main and upload it to Hostinger `public_html` (the live site returned 500 last time it was checked).
- [ ] Create `config.php` on the server with `VENDERCRM_URL` / `VENDERCRM_API_KEY` (and `GA4_ID`); until then leads only land in `logs/leads.log`.
- [ ] Run `deploy/verify-live.sh https://estudio.com.py` after upload.
- [ ] Have a lawyer check `docs/facts-to-verify.md` before launch marketing.
- [ ] When they exist: real phone/WhatsApp/email in `content/site.php`; first signed lawyer in `content/abogados.php`.
- [ ] Confirm Spectral 800 headings (or say "600" in `docs/decisions-needed.md`).
- [ ] Optional: submit `/sitemap.xml` in Search Console; create the Google Business Profile only if a real office exists.
