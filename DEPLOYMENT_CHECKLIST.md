# ✅ GitHub Actions Deployment - Setup Checklist

## 🎯 Overview

Use this checklist to complete your GitHub Actions deployment setup in order.

---

## Phase 1: Server Preparation ✅

### Generate SSH Key on Production Server

```bash
# SSH to your server
ssh user@your-server-ip

# Generate ED25519 key
ssh-keygen -t ed25519 -C "github-actions" -f ~/.ssh/github_deploy -N ""

# Display the private key (you'll need this)
cat ~/.ssh/github_deploy
```

**☐ Key generated successfully**

### Add Public Key to Authorized Keys

```bash
# Still on your server
cat ~/.ssh/github_deploy.pub >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
chmod 700 ~/.ssh
```

**☐ Public key added to authorized_keys**

### Verify SSH Access

```bash
# Test SSH connection (should work without password)
ssh -i ~/.ssh/github_deploy your-username@your-server-ip

# If successful, type "exit" to return
exit
```

**☐ SSH connection verified**

### Check Project Directory

```bash
# On your server, verify project path exists
ls -la /var/www/html/nere-mining
# Should show Laravel project structure

# Check if composer is installed
which composer
# Should return: /usr/local/bin/composer

# Check PHP version
php -v
# Should be 8.0+

# Check MySQL is running
mysql -u root -p
# (enter password, then type \q to exit)
```

**☐ Project directory exists and is accessible**
**☐ Composer is installed**
**☐ PHP 8.0+ is installed**
**☐ MySQL is running**

---

## Phase 2: GitHub Secrets Configuration ✅

### Create GitHub Secrets

**Go to:** https://github.com/YOUR-USERNAME/YOUR-REPO/settings/secrets/actions

**Click:** "New repository secret" for each:

#### Secret 1: DEPLOY_HOST
- **Name:** `DEPLOY_HOST`
- **Value:** Your server IP or hostname
- **Example:** `192.168.1.100` or `your-server.com`
- **Click:** "Add secret"

**☐ DEPLOY_HOST added**

#### Secret 2: DEPLOY_USER
- **Name:** `DEPLOY_USER`
- **Value:** SSH username on your server
- **Example:** `ubuntu` or `deployer`
- **Click:** "Add secret"

**☐ DEPLOY_USER added**

#### Secret 3: DEPLOY_SSH_KEY
- **Name:** `DEPLOY_SSH_KEY`
- **Value:** Contents of `cat ~/.ssh/github_deploy` (from your server)
- **Important:** Copy the ENTIRE private key including `-----BEGIN PRIVATE KEY-----` and `-----END PRIVATE KEY-----`
- **Click:** "Add secret"

**☐ DEPLOY_SSH_KEY added**

#### Secret 4: PROJECT_PATH
- **Name:** `PROJECT_PATH`
- **Value:** Full path to your project directory
- **Example:** `/var/www/html/nere-mining`
- **Click:** "Add secret"

**☐ PROJECT_PATH added**

#### Secret 5 (Optional): SLACK_WEBHOOK_URL
- **Name:** `SLACK_WEBHOOK_URL`
- **Value:** Your Slack incoming webhook URL
- **Get from:** https://api.slack.com/apps → Your App → Incoming Webhooks
- **Click:** "Add secret"

**☐ SLACK_WEBHOOK_URL added (optional)**

### Verify All Secrets Are Added

Go to Settings → Secrets and variables → Actions

You should see:
- ✓ DEPLOY_HOST
- ✓ DEPLOY_USER
- ✓ DEPLOY_SSH_KEY
- ✓ PROJECT_PATH
- ✓ SLACK_WEBHOOK_URL (optional)

**☐ All secrets visible in GitHub (values hidden)**

---

## Phase 3: Workflow Verification ✅

### Check Workflows Are Detected

1. Go to your GitHub repository
2. Click **Actions** tab
3. You should see workflows:
   - "Deploy to Production (Simple)"
   - "Deploy to Production"

**If workflows don't show:**
- They may take a few seconds to appear
- Refresh the page
- Check if `.github/workflows/deploy-simple.yml` exists

**☐ Workflows appear in Actions tab**

### Verify Workflow Files

```bash
# Locally, check workflow files exist
ls -la .github/workflows/

# Should show:
# deploy-simple.yml
# deploy.yml
```

**☐ Workflow files verified**

---

## Phase 4: Test Deployment ✅

### Make a Test Change

```bash
# Create a test file
echo "Deployment test on $(date)" >> DEPLOYMENT_TEST.txt

# Stage and commit
git add DEPLOYMENT_TEST.txt
git commit -m "test: verify GitHub Actions deployment"

# Push to production
git push origin production
```

**☐ Test change pushed to GitHub**

### Monitor Workflow Execution

1. Go to GitHub → Actions tab
2. Watch for "Deploy to Production (Simple)" workflow
3. Expand each step to see logs
4. Look for:
   - ✓ SSH connection succeeds
   - ✓ Git pull succeeds
   - ✓ Composer install completes
   - ✓ Migrations run
   - ✓ Caches rebuilt
   - ✓ Services restart

**If workflow fails:**
- Click the workflow run to see full logs
- Check SSH connectivity: Can GitHub Actions SSH to your server?
- Check Composer: Is composer installed on server?
- See Troubleshooting section below

**☐ Workflow completed successfully**

### Verify on Server

```bash
# SSH to server
ssh user@your-server-ip

# Check if test file was deployed
ls -la /var/www/html/nere-mining/ | grep DEPLOYMENT_TEST

# Should show the file
```

**☐ Test file present on server**

### Verify Website Still Works

1. Open your website in browser
2. Try to navigate to a page
3. Check if it loads correctly
4. No 500 errors should appear

**☐ Website loads correctly after deployment**

---

## Phase 5: Production Configuration ✅

### Set Environment Variables on Server

```bash
# SSH to server
ssh user@your-server-ip

# Navigate to project
cd /var/www/html/nere-mining

# Verify .env file exists
ls -la .env

# Check key variables
grep -E "APP_ENV|APP_DEBUG|DB_HOST" .env
```

Should show:
```
APP_ENV=production
APP_DEBUG=false
DB_HOST=localhost
```

**☐ .env file configured correctly**

### Create Backup Directory

```bash
# On server
mkdir -p /var/www/html/nere-mining/backups
chmod 755 /var/www/html/nere-mining/backups
```

**☐ Backup directory created**

### Set Up Log Rotation

```bash
# Check storage logs exist
ls -la /var/www/html/nere-mining/storage/logs/

# Create logrotate config (optional but recommended)
# Usually: /etc/logrotate.d/nere-mining
```

**☐ Logs properly configured**

---

## Phase 6: Documentation ✅

### Review Documentation

**☐ Read:** `GITHUB_ACTIONS_SETUP.md` (5 min overview)
**☐ Read:** `DEPLOYMENT_GUIDE.md` (comprehensive guide)
**☐ Read:** `DEPLOYMENT_SUMMARY.md` (overview)
**☐ Bookmark:** GitHub Actions tab in your repository

### Document Your Setup

Create a file in your team wiki/docs with:
- ☐ Your server IP
- ☐ Your project path
- ☐ SSH username
- ☐ GitHub repository URL
- ☐ When to use manual trigger vs automatic
- ☐ Who has access to GitHub Secrets

---

## Phase 7: Team Training ✅

### Share With Team

**Share these files:**
- ✅ `GITHUB_ACTIONS_SETUP.md` - Quick start
- ✅ `DEPLOYMENT_GUIDE.md` - Full reference
- ✅ `DEPLOYMENT_SUMMARY.md` - Overview

**Communicate:**
- ✅ How to trigger deployments
- ✅ How to monitor deployment logs
- ✅ What to do if deployment fails
- ✅ How to rollback if needed

**☐ Team notified and trained**

---

## Phase 8: Monitoring Setup (Optional) ✅

### Configure Slack Notifications

If you added `SLACK_WEBHOOK_URL` secret:

1. Create a Slack channel: `#deployments`
2. Add GitHub to channel
3. Next deployment will send notifications

**☐ Slack channel created (optional)**

### Set Up Monitoring

Monitor these during deployment:
- GitHub Actions logs
- Your website uptime
- Server logs: `tail -f storage/logs/laravel.log`
- Error logs: `tail -f /var/log/nginx/error.log`

**☐ Monitoring tools identified**

---

## Phase 9: Post-Deployment Verification ✅

### After First Deployment

```bash
# SSH to server
ssh user@your-server-ip

# Check application is running
cd /var/www/html/nere-mining
php artisan tinker
# Type: exit

# Check database migrations
php artisan migrate:status

# Verify cache is working
php artisan cache:clear
php artisan cache:forget key

# Check if services are running
sudo systemctl status php-fpm
sudo systemctl status nginx
```

**☐ Application verified after deployment**

### Monitor First Week

- ✅ Check website daily
- ✅ Monitor error logs
- ✅ Watch for any issues
- ✅ Test form submissions (especially hero slides)

**☐ First week monitoring plan confirmed**

---

## 🆘 Troubleshooting Checklist

### If Workflow Fails

**1. Check SSH Connection**
```bash
# Locally, test SSH manually
ssh -i ~/path/to/key user@server-ip
# Should connect without password
```

**2. Check GitHub Secrets**
- Go to Settings → Secrets
- Verify all 4 secrets are present
- Verify values match server setup

**3. Check Server Connectivity**
```bash
# On server, check if accepting SSH
sudo systemctl status sshd
```

**4. Check Composer**
```bash
# On server
which composer
php -r "echo 'PHP works';"
```

**5. Check Database**
```bash
# On server
mysql -u root -p -e "SELECT VERSION();"
```

### If Website Breaks After Deployment

**Quick Rollback:**
```bash
# SSH to server
cd /var/www/html/nere-mining/backups

# Find latest backup
ls -lrt | tail -1

# Restore
cp -r YYYYMMDD_HHMMSS/* ../

# Restart
sudo systemctl restart php-fpm nginx
```

---

## ✨ Success Criteria

Your deployment is **ready** when you can check ALL these boxes:

- ✅ SSH key generated and added to authorized_keys
- ✅ All 4 GitHub Secrets configured
- ✅ Workflows visible in Actions tab
- ✅ Test deployment succeeded
- ✅ Test file appeared on server
- ✅ Website loads after deployment
- ✅ No errors in deployment logs
- ✅ Team trained and aware
- ✅ Documentation reviewed

---

## 📞 Final Verification

### Before Going Live

1. **Test one more time:**
   ```bash
   git push origin production
   # Watch Actions tab
   # Verify website still works
   ```

2. **Backup current state:**
   ```bash
   # On server
   tar -czf ~/backup-pre-github-actions.tar.gz /var/www/html/nere-mining/
   ```

3. **Have rollback plan:**
   - ✅ Know how to manually SSH and rollback
   - ✅ Know where backups are stored
   - ✅ Know how to restart services

4. **Communicate with team:**
   - ✅ Let team know deployment is now automated
   - ✅ Share documentation
   - ✅ Provide contact for issues

---

## 🎉 Ready to Deploy!

When all checkboxes are complete, you're ready for production deployments with GitHub Actions.

**To deploy in future:**
```bash
git push origin production
# Automatic deployment starts!
```

**Questions?** Check:
- `GITHUB_ACTIONS_SETUP.md` - Quick reference
- `DEPLOYMENT_GUIDE.md` - Detailed guide
- GitHub Actions documentation - Official help

---

**Status:** Ready for Production ✅

---

**Date Completed:** _______________  
**Completed By:** _______________  
**Verified By:** _______________  
