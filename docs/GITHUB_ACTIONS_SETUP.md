# GitHub Actions Setup - Quick Start

## ✅ What's Been Deployed

Your GitHub Actions workflows are now configured and ready to use!

### Files Created:

1. **`.github/workflows/deploy-simple.yml`** - Recommended workflow for direct SSH deployment
2. **`.github/workflows/deploy.yml`** - Advanced workflow with Docker support
3. **`Dockerfile`** - Docker containerization (optional)
4. **`docker/` directory** - Docker configuration files
5. **`DEPLOYMENT_GUIDE.md`** - Comprehensive deployment guide

---

## 🚀 Quick Start (5 minutes)

### Step 1: Configure GitHub Secrets

Go to your GitHub repository: **Settings → Secrets and variables → Actions**

Add these 4 secrets:

```
DEPLOY_HOST      = your-server-ip (e.g., 192.168.1.100)
DEPLOY_USER      = ssh-username (e.g., ubuntu)
DEPLOY_SSH_KEY   = contents of private SSH key
PROJECT_PATH     = /var/www/html/nere-mining
```

### Step 2: Generate SSH Key (On Your Server)

```bash
# SSH into your server
ssh user@your-server

# Generate deployment key
ssh-keygen -t ed25519 -C "github-actions" -f ~/.ssh/github_deploy -N ""

# Show private key
cat ~/.ssh/github_deploy
```

### Step 3: Add Public Key to Server

```bash
# Still on your server
cat ~/.ssh/github_deploy.pub >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
```

### Step 4: Copy Private Key to GitHub

1. Copy output from: `cat ~/.ssh/github_deploy`
2. In GitHub: Create secret `DEPLOY_SSH_KEY`
3. Paste the private key content

### Step 5: Deploy

Push to production branch:

```bash
git push origin production
```

**That's it!** Deployment will run automatically.

---

## 📊 Checking Deployment Status

1. Go to GitHub repository
2. Click **Actions** tab
3. See workflow runs and logs
4. Click on a run to see details

---

## 🧪 Test Deployment

Make a small test commit:

```bash
echo "# Deployment test" >> README.md
git add README.md
git commit -m "test: verify deployment"
git push origin production
```

Then watch the Actions tab for the workflow to run.

---

## 🔑 SSH Setup (Detailed)

### Generate Key Pair:

```bash
# On your server
cd ~/.ssh
ssh-keygen -t ed25519 -C "nere-mining-github" -f github_deploy -N ""
```

This creates:
- `github_deploy` (private key) - Goes to GitHub Secrets
- `github_deploy.pub` (public key) - Goes to authorized_keys

### Add Public Key to Authorized Keys:

```bash
cat github_deploy.pub >> authorized_keys
chmod 700 ~/.ssh
chmod 600 ~/.ssh/authorized_keys
```

### Verify Setup:

```bash
# Test SSH connection (should work without password)
ssh -i ~/.ssh/github_deploy your-username@your-server

# If it works, you're good!
```

---

## 📋 What Deployment Does

When you push to `production` branch, GitHub Actions will:

1. ✅ Pull latest code from GitHub
2. ✅ Install Composer dependencies
3. ✅ Clear and rebuild caches
4. ✅ Run database migrations
5. ✅ Set correct file permissions
6. ✅ Restart PHP-FPM and Nginx
7. ✅ Send Slack notification (if configured)
8. ✅ Create automatic backup before deployment

---

## 🆘 Troubleshooting

### Workflow not showing up?

- Workflows are stored in `.github/workflows/`
- They appear in Actions tab after first push
- May take a few seconds to show up

### "Permission denied" error?

```bash
# On your server, check SSH key permissions
ls -la ~/.ssh/
# Should show:
# -rw------- authorized_keys
# -rw------- github_deploy (private key)
# -rw-r--r-- github_deploy.pub
```

### Deployment fails?

1. Check workflow logs in GitHub Actions
2. SSH to server and check logs: `tail -f storage/logs/laravel.log`
3. Verify database connection in `.env`
4. Check file permissions: `ls -la storage/`

### Can't connect to server?

Test SSH manually:
```bash
# Locally, test the connection
ssh -i ~/path/to/private/key user@server-ip

# If connection fails, check:
# - Server IP is correct
# - Username is correct
# - SSH key has correct permissions
# - Server allows SSH access
```

---

## 🔄 Manual Trigger

You can deploy without pushing code:

1. Go to Actions tab
2. Select "Deploy to Production (Simple)"
3. Click "Run workflow"
4. Click "Run workflow" again to confirm

This pulls latest code from production branch and deploys.

---

## 📧 Slack Notifications (Optional)

To get deployment notifications in Slack:

1. Create Slack Webhook: https://api.slack.com/apps
2. Add secret `SLACK_WEBHOOK_URL` to GitHub
3. Workflow will send success/failure notifications

---

## 🔒 Security Checklist

- [ ] SSH key is stored only in GitHub Secrets
- [ ] SSH key never committed to repository
- [ ] Server SSH key has correct permissions (600)
- [ ] Deploy user has minimal necessary permissions
- [ ] Deployment path exists on server
- [ ] Database credentials in `.env` are secure
- [ ] `.env` file not tracked in git

---

## 📚 Next Steps

1. **Configure Secrets** (as detailed above)
2. **Test Deployment** with a small change
3. **Monitor Logs** to ensure smooth deployment
4. **Set up Slack** for notifications (optional)
5. **Document Issues** found during testing

---

## 📖 Full Documentation

For more details, see: `DEPLOYMENT_GUIDE.md`

---

## 💡 Pro Tips

### Auto-deploy on multiple branches:

Edit `.github/workflows/deploy-simple.yml`:
```yaml
on:
  push:
    branches:
      - production
      - staging  # Add more branches as needed
```

### Slack notifications:

Get deployment alerts in your team Slack channel when deployments succeed or fail.

### Rollback on failure:

Automatic backups are created before each deployment in `/backups/` directory.

---

## ✨ You're All Set!

Your deployment pipeline is ready. Push to `production` branch and watch the magic happen! 🚀

For questions, check `DEPLOYMENT_GUIDE.md` or GitHub Actions logs.
