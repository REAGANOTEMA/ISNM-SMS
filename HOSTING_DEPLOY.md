# Hosting deployment checklist

**Official website URL:** https://igangaschoolofnursingandmidwifery.ac.ug

After deploy, run once (optional): `php scripts/update_site_url_db.php` to sync the URL in `site_settings`.

## Database configuration

1. On the server, copy `config/database.local.php.example` to `config/database.local.php`.
2. Set `APP_ENV` to `production` and enter cPanel credentials for each database (students, staff, website).
3. Alternatively, ensure `config/database.php` defaults match your cPanel database names and users.
4. Do **not** commit `config/database.local.php` (it is gitignored).

## Finance module

1. Import `database/finance_module.sql` into the **staff** database (`igangaschoolofl_staffs_db`) if finance tables are created there, or into students DB per your setup script.
2. Visit once: `https://your-domain/setup_finance_module.php?confirm=1`
3. Finance Hub URL: `dashboards/bursar-finance-hub.php` (shared by School Bursar, Director Finance, Director General only).

## Verify

- Homepage (`index.php`) loads with no database warnings.
- Staff login works for all three finance roles.
- Principal/Registrar cannot access the Finance Hub (redirects to login).
- Rotate database passwords if they were shared in plain text.
