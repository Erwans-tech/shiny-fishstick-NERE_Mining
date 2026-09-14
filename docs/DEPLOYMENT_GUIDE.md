# GitHub Actions Deployment Guide

This guide explains how to set up GitHub Actions for automatic deployment of the NERE Mining website.

## 📋 Prerequisites

- GitHub repository with production branch
- SSH access to your production server
- GitHub Secrets configured

## 🔑 Required GitHub Secrets

Add these secrets to your GitHub repository settings (`Settings → Secrets and variables → Actions`):

### For SSH Deployment:

```
DEPLOY_HOST          → Your production server IP/hostname
DEPLOY_USER          → SSH username (e.g., ubuntu, www-data)
DEPLOY_SSH_KEY       → Private SSH key for authentication
PROJECT_PATH         → Full path to project on server (e.g., /var/www/html/nere-mining)
```

### Optional - Slack Notifications:

```
SLACK_WEBHOOK_URL    → Slack incoming webhook URL for deployment notifications
```

## 🚀 Deployment Workflows

### Option 1: Simple Deployment (Recommended)

**File:** `.github/workflows/deploy-simple.yml`

Uses SSH to connect directly to your server and pull the latest code.

**When it runs:**
- When you push to `production` branch
- When triggered manually via `workflow_dispatch`

**What it does:**
1. Creates backup of current state
2. Pulls latest code from GitHub
3. Installs dependencies with Composer
4. Runs database migrations
5. Rebuilds caches
6. Restarts PHP-FPM and Nginx

### Option 2: Docker Deployment

**File:** `.github/workflows/deploy.yml`

Builds a Docker image, pushes to registry, and deploys via SSH.

**Requires:**
- Docker registry account
- More complex setup

## 🔐 Setting Up SSH Access

### On Your Production Server:

```bash
# Generate SSH key pair (if not already done)
ssh-keygen -t ed25519 -f ~/.ssh/deploy_key -N ""

# Add public key to authorized_keys
cat ~/.ssh/deploy_key.pub >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
```

### In GitHub Repository:

1. Copy the **private key** content:
```bash
cat ~/.ssh/deploy_key
```

2. In GitHub UI:
   - Go to Settings → Secrets and variables → Actions
   - Click "New repository secret"
   - Name: `DEPLOY_SSH_KEY`
   - Paste the entire private key content
   - Click "Add secret"

## 📝 GitHub Secrets Setup

### Step 1: Create SSH Key on Your Server

```bash
# Connect to your server
ssh user@your-server

# Generate deployment key
ssh-keygen -t ed25519 -C "github-actions" -f ~/.ssh/github_deploy -N ""

# Display private key (copy this)
cat ~/.ssh/github_deploy
```

### Step 2: Add Public Key to Authorized Keys

```bash
# On your server
cat ~/.ssh/github_deploy.pub >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
chmod 700 ~/.ssh
```

### Step 3: Configure GitHub Secrets

1. Go to your GitHub repository
2. Settings → Secrets and variables → Actions
3. Add the following secrets:

| Secret Name | Value |
|------------|-------|
| `DEPLOY_HOST` | Your server IP (e.g., `192.168.1.100`) |
| `DEPLOY_USER` | SSH username (e.g., `ubuntu`) |
| `DEPLOY_SSH_KEY` | Content of `~/.ssh/github_deploy` (private key) |
| `PROJECT_PATH` | `/var/www/html/nere-mining` |
| `SLACK_WEBHOOK_URL` | Your Slack webhook (optional) |

## 🧪 Testing the Deployment

### Dry Run:

1. Make a small change to production branch
2. Push to GitHub
3. Go to Actions tab
4. Watch the workflow run
5. Check deployment logs

### Example Test Deployment:

```bash
# Make a change to a non-critical file
echo "# Test" >> README.md

# Commit and push to production
git add README.md
git commit -m "test: deployment workflow"
git push origin production
```

## 📊 Monitoring Deployments

### GitHub Actions Dashboard:

- Go to repository → Actions tab
- See all workflow runs
- Click on a run to see detailed logs

### Slack Notifications (if configured):

- Deployment success/failure notifications
- Commit details and author info

## 🔄 Manual Deployment Trigger

You can trigger deployment without pushing code:

1. Go to Actions tab
2. Select "Deploy to Production (Simple)"
3. Click "Run workflow"
4. Confirm

## 🛠️ Troubleshooting

### Deployment Fails with "Permission denied"

**Solution:** Check SSH key permissions
```bash
# On your server
chmod 700 ~/.ssh
chmod 600 ~/.ssh/authorized_keys
```

### Composer Fails

**Solution:** Ensure Composer is installed on server
```bash
# On your server
which composer
# If not found, install: curl https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
```

### Migrations Fail

**Solution:** Check database connection in `.env`
```bash
# On your server
php artisan migrate:status
php artisan migrate --force --step
```

### Permission Denied on Storage/Bootstrap

**Solution:** Set correct permissions
```bash
# On your server
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 📚 Environment Variables

Ensure your production server has a `.env` file with:

```env
APP_NAME="Nere Mining"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=nere_mining
DB_USERNAME=nere_user
DB_PASSWORD=secure_password

MAIL_MAILER=smtp
MAIL_HOST=your-mail-server
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password

FILESYSTEM_DISK=public
```

## 🔒 Security Best Practices

1. ✅ Use ED25519 SSH keys (more secure than RSA)
2. ✅ Keep SSH keys private - never commit to repo
3. ✅ Use separate deploy user with minimal permissions
4. ✅ Store secrets in GitHub Secrets, not in code
5. ✅ Use HTTPS for all external connections
6. ✅ Regularly rotate SSH keys
7. ✅ Monitor deployment logs for suspicious activity

## 📖 Additional Resources

- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- [SSH Key Pair Generation](https://docs.github.com/en/authentication/connecting-to-github-with-ssh)
- [Laravel Deployment Guide](https://laravel.com/docs/deployment)

## 🚨 Emergency Rollback

If deployment fails or causes issues:

```bash
# On your server
cd /var/www/html/nere-mining

# Restore from backup
BACKUP_DIR="./backups/latest"
cp -r "$BACKUP_DIR/hero" public/
cp "$BACKUP_DIR/.env.backup" .env

# Restart services
sudo systemctl restart php-fpm
sudo systemctl restart nginx
```

## 📞 Support

For issues or questions about the deployment setup:
1. Check workflow logs in GitHub Actions
2. SSH into server and check system logs: `tail -f /var/log/nginx/error.log`
3. Check Laravel logs: `tail -f storage/logs/laravel.log`
