# Render Deployment Verification Checklist

## Current Status
- ✅ Sessions table migration created and pushed to `production-stable`
- ⏳ Render redeploy in progress (watch GitHub Actions)
- 🔄 Migrations will run automatically at container startup

---

## Post-Deploy Verification (After ~5-10 minutes)

### 1. Monitor Build & Deployment
- [ ] Go to Render Dashboard: https://dashboard.render.com/
- [ ] Select **nere-mining** web service
- [ ] Watch **Events** section for:
  - ✅ Build succeeded
  - ✅ Deploy succeeded
- [ ] Check **Logs** for:
  ```
  📊 Exécution des migrations...
  Migrating: ... create_sessions_table
  Migrated: ... create_sessions_table (XXms)
  ```

### 2. Test Admin Login
- [ ] Navigate to: `https://nere-mining-ex3a.onrender.com/gestion-nm/connexion`
- [ ] Enter credentials:
  - Email: `admin@nere-mining.com` (from `ADMIN_EMAIL` env var)
  - Password: `NereAdmin2024!` (from `ADMIN_PASSWORD` env var)
- [ ] Click **Connexion**
- [ ] Expected result:
  - ✅ Redirected to `/gestion-nm/tableau-de-bord` (dashboard)
  - ✅ No 419 error
  - ✅ Dashboard loads with statistics

### 3. Verify Session Persistence
- [ ] In admin panel, click **Déconnexion** (logout)
- [ ] Expected: Redirected to login page with "Déconnexion réussie" message
- [ ] Login again with same credentials
- [ ] Expected: Login succeeds (session works)

### 4. Test Key Admin Features
After login succeeds, verify core functionality:

#### News Management
- [ ] Navigate to **Actualités** (sidebar)
- [ ] Create/edit a news article
- [ ] Verify form submits without CSRF errors

#### Message Board
- [ ] Navigate to **Messages** (sidebar)
- [ ] Check for any pending contact messages

#### Job Applications
- [ ] Navigate to **Candidatures** (sidebar)
- [ ] View recent applications

#### Settings
- [ ] Navigate to **Paramètres** (sidebar)
- [ ] Verify settings can be updated

### 5. Check Database Migrations
- [ ] In Render console, run:
  ```bash
  php artisan migrate:status
  ```
- [ ] Verify all migrations show status: `Ran`
- [ ] Sessions table should exist in PostgreSQL

### 6. Monitor Error Logs
- [ ] In Render dashboard, check **Logs** for:
  - ❌ No 419 errors
  - ❌ No CSRF token validation errors
  - ✅ Normal operation logs

---

## If 419 Error Still Occurs

### Troubleshooting Steps

1. **Force clear cache** (Render console):
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. **Verify sessions table exists**:
   ```bash
   php artisan tinker
   >>> DB::table('sessions')->get();
   ```
   Should return empty array `[]` initially.

3. **Check session driver config**:
   ```bash
   php artisan tinker
   >>> config('session.driver')
   // Should output: "database"
   ```

4. **Re-run migration manually** (if needed):
   ```bash
   php artisan migrate --force
   ```

5. **Restart container** (via Render dashboard):
   - Click **Manual Deploy**
   - Wait for new container to start

---

## Public Site Verification

While admin panel is verified, also check public site:

- [ ] Homepage loads: `https://nere-mining-ex3a.onrender.com/`
- [ ] French site: `https://nere-mining-ex3a.onrender.com/fr` or `https://nere-mining-ex3a.onrender.com/`
- [ ] English site: `https://nere-mining-ex3a.onrender.com/en`
- [ ] Newsletter form works
- [ ] Contact form works
- [ ] Job applications form works
- [ ] Sitemap loads: `https://nere-mining-ex3a.onrender.com/sitemap.xml`
- [ ] Robots.txt loads: `https://nere-mining-ex3a.onrender.com/robots.txt`

---

## Long-Term Monitoring

After successful deployment:

1. **Monitor for 24-48 hours**:
   - Check Render logs periodically for errors
   - Test admin login daily
   - Monitor application performance

2. **Database backups** (Render manages automatically for free tier)
   - No action needed, but good to know

3. **Keep local `.env.render` as reference**:
   - Useful for future deployments
   - Documents production configuration

---

## Success Criteria ✅

Deployment is successful when:
1. ✅ Build succeeds on Render
2. ✅ Migrations run without errors (visible in logs)
3. ✅ Admin login page loads (no 419 error)
4. ✅ Admin can login with email/password
5. ✅ Admin dashboard loads
6. ✅ Admin can navigate all sections
7. ✅ Forms submit without CSRF errors
8. ✅ Public site fully functional

---

## Quick Reference: Environment Variables

These are set in Render dashboard and used in `.env.render`:

| Variable | Value | Location |
|----------|-------|----------|
| `APP_URL` | `https://nere-mining-ex3a.onrender.com` | Render auto-generated |
| `DB_HOST` | `nere-mining-db.xxx` | Render managed database |
| `DB_USERNAME` | `nere_user` | Render managed database |
| `DB_PASSWORD` | `[generated]` | Render managed database |
| `ADMIN_EMAIL` | `admin@nere-mining.com` | Set manually (first admin) |
| `ADMIN_PASSWORD` | `NereAdmin2024!` | Set manually (should be changed) |
| `SESSION_DRIVER` | `database` | .env.render |
| `LOG_CHANNEL` | `stderr` | .env.render (for Render logs) |

---

## Contact for Issues

If 419 error persists after all steps:
1. Check Render logs for specific error messages
2. Review CSRF_FIX_419_ERROR.md for detailed explanation
3. Verify production-stable branch has latest migration
4. Force manual redeploy in Render dashboard
