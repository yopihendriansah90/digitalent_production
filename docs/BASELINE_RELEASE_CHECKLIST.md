# Baseline Release Checklist (Phase: Stabilization)

## 1. Environment Setup

- Ensure `.env` exists and `APP_KEY` is set.
- Verify DB connection is valid for the target environment.
- Ensure storage is writable and queue/cache config is valid.
- Frontend asset mode must be active:
  - Local dev: run `npm run dev` and keep process alive.
  - Demo/staging/prod: run `npm run build` so `public/build/manifest.json` exists.

## 2. Mandatory Commands

Run in order:

```bash
npm install
php artisan migrate --seed
php artisan shield:generate --all --panel=admin --no-interaction
php artisan db:seed --class=Database\\Seeders\\RoleSeeder
php artisan db:seed --class=Database\\Seeders\\UserRoleSeeder
npm run build
php artisan test
```

Expected result:

- Migrations complete without error.
- Vite assets loaded (navigation no longer appears as default bullet list).
- Permission Shield tergenerate untuk semua resource admin.
- Role non-super-admin mendapatkan permission efektif (tidak 0).
- Seeder runs idempotently (no duplicate user/role issues).
- Test suite passes.

## 3. Role Access Smoke Test

Login and verify capability boundaries:

- `superadmin@mail.com` -> full access all resources.
- `admin@mail.com` -> CRUD content + manage inquiries, no role management actions.
- `editor@mail.com` -> create/update/reorder content, no destructive actions.
- `viewer@mail.com` -> view-only across resources.

## 4. Media Flow Smoke Test

For `Site Settings`, `Pages`, `Section Blocks`:

- Upload valid image/file and ensure save succeeds.
- Upload invalid file type/oversized file and ensure validation blocks it.
- Confirm preview/list loads in admin.
- Confirm frontend does not break when media is missing.

## 5. Contact Flow Smoke Test

- Submit valid contact form -> row created in `contact_inquiries` with `status=new`.
- Submit with honeypot field filled -> rejected.
- Rapidly submit > 5 requests per minute from same client -> rate limited (HTTP 429).

## 6. Final Go/No-Go

Release is ready when:

- Automated tests pass.
- Role matrix behavior is verified manually.
- Media and contact smoke checks pass.
- No critical errors in logs during smoke tests.
