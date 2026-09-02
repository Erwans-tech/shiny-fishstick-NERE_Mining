# 📊 GitHub Actions Deployment Overview

## 🎯 Visual Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                     YOUR DEVELOPMENT FLOW                       │
└─────────────────────────────────────────────────────────────────┘
                              │
                              │
                         git push origin
                          production
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                  GitHub Repository                              │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ .github/workflows/                                         │ │
│  │  ├── deploy-simple.yml  ← SSH Direct Deployment           │ │
│  │  └── deploy.yml         ← Docker + Tests (advanced)       │ │
│  └────────────────────────────────────────────────────────────┘ │
└─────────────────────────────────────────────────────────────────┘
                              │
                              │
                    GitHub Actions Trigger
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                  GitHub Actions Workflow                        │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ Step 1: Checkout Repository                               │ │
│  ├────────────────────────────────────────────────────────────┤ │
│  │ Step 2: SSH to Production Server                           │ │
│  ├────────────────────────────────────────────────────────────┤ │
│  │ Step 3: Pull Latest Code (git pull origin production)      │ │
│  ├────────────────────────────────────────────────────────────┤ │
│  │ Step 4: Install Dependencies (composer install)           │ │
│  ├────────────────────────────────────────────────────────────┤ │
│  │ Step 5: Clear Caches                                      │ │
│  ├────────────────────────────────────────────────────────────┤ │
│  │ Step 6: Run Migrations (database updates)                 │ │
│  ├────────────────────────────────────────────────────────────┤ │
│  │ Step 7: Rebuild Caches                                    │ │
│  ├────────────────────────────────────────────────────────────┤ │
│  │ Step 8: Set Permissions                                   │ │
│  ├────────────────────────────────────────────────────────────┤ │
│  │ Step 9: Restart Services (PHP-FPM, Nginx)                 │ │
│  ├────────────────────────────────────────────────────────────┤ │
│  │ Step 10: Send Slack Notification                          │ │
│  └────────────────────────────────────────────────────────────┘ │
└─────────────────────────────────────────────────────────────────┘
                              │
                              │
                    SSH Command Execution
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│            Your Production Server                               │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ /var/www/html/nere-mining/                                │ │
│  │ ├── app/                 (updated code)                   │ │
│  │ ├── resources/           (updated views)                  │ │
│  │ ├── storage/logs/        (deployment logs)                │ │
│  │ ├── bootstrap/cache/     (rebuilt cache)                  │ │
│  │ ├── public/hero/         (images/videos)                  │ │
│  │ └── .env                 (configuration)                  │ │
│  └────────────────────────────────────────────────────────────┘ │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ Services                                                   │ │
│  │ ├── PHP-FPM (restarted)                                   │ │
│  │ └── Nginx (restarted)                                     │ │
│  └────────────────────────────────────────────────────────────┘ │
└─────────────────────────────────────────────────────────────────┘
                              │
                              │
                        Website Updated ✅
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│          Your Website (nere-mining.com)                         │
│  ✅ Latest code deployed                                       │
│  ✅ Database migrated                                          │
│  ✅ Caches optimized                                           │
│  ✅ Services running                                           │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📋 File Structure

```
REFONTESITE/
│
├── .github/workflows/              ← GitHub Actions Configuration
│   ├── deploy-simple.yml           ← Main deployment workflow (SSH)
│   └── deploy.yml                  ← Advanced workflow (Docker)
│
├── docker/                         ← Docker configuration (optional)
│   ├── php.ini                     ← PHP production settings
│   ├── opcache.ini                 ← PHP OPCache optimization
│   ├── nginx.conf                  ← Nginx configuration
│   ├── default.conf                ← Laravel app Nginx settings
│   └── supervisord.conf            ← Process management
│
├── Dockerfile                      ← Docker container build
│
├── DEPLOYMENT_GUIDE.md             ← Comprehensive setup guide
├── GITHUB_ACTIONS_SETUP.md         ← Quick start (5 min)
├── DEPLOYMENT_SUMMARY.md           ← Executive summary
├── DEPLOYMENT_CHECKLIST.md         ← Step-by-step checklist
└── GITHUB_ACTIONS_OVERVIEW.md      ← This file
```

---

## 🔄 Workflow Comparison

| Feature | deploy-simple.yml | deploy.yml |
|---------|-------------------|-----------|
| **Method** | Direct SSH | Docker Build |
| **Speed** | ⚡ Fast | 🏗️ Slower |
| **Testing** | ❌ None | ✅ Automated |
| **Complexity** | ✅ Simple | 🔧 Advanced |
| **Best For** | Traditional hosting | Cloud/K8s |
| **Setup Time** | 5 minutes | 30 minutes |
| **Cost** | Low | Medium |
| **Recommended** | ✅ YES | Optional |

---

## 🔑 How Secrets Work

```
┌──────────────────────────────────────────────────────┐
│            GitHub Secrets Storage (Encrypted)       │
├──────────────────────────────────────────────────────┤
│                                                      │
│  DEPLOY_HOST     → 192.168.1.100                   │
│  DEPLOY_USER     → ubuntu                          │
│  DEPLOY_SSH_KEY  → -----BEGIN PRIVATE KEY-----...  │
│  PROJECT_PATH    → /var/www/html/nere-mining       │
│  SLACK_WEBHOOK   → https://hooks.slack.com/...     │
│                                                      │
└──────────────────────────────────────────────────────┘
                        │
                        │ Injected at Runtime
                        │
                        ▼
┌──────────────────────────────────────────────────────┐
│         Workflow Runtime (Secure Execution)         │
│                                                      │
│  SSH_KEY = ${{ secrets.DEPLOY_SSH_KEY }}           │
│  ssh -i $SSH_KEY ${{ secrets.DEPLOY_USER }}@...    │
│                                                      │
└──────────────────────────────────────────────────────┘
                        │
                        │ Connects Securely
                        │
                        ▼
┌──────────────────────────────────────────────────────┐
│    Your Production Server (SSH Access Granted)      │
│                                                      │
│  ✅ Commands executed                              │
│  ✅ Code deployed                                  │
│  ✅ Database migrated                              │
│                                                      │
└──────────────────────────────────────────────────────┘
```

---

## 📊 Deployment Timeline

```
Time    Event                          Duration
────────────────────────────────────────────────────
00:00   You: git push origin production
00:02   GitHub: Detect push
00:05   GitHub Actions: Workflow triggered
        │
        ├─ Checkout (5s)
        ├─ SSH Connect (10s)                  ← Can fail here
        ├─ Git Pull (20s)
        ├─ Composer Install (2-3 min)        ← Longest step
        ├─ Clear Caches (5s)
        ├─ Migrations (10s)                  ← Can fail here
        ├─ Rebuild Caches (5s)
        ├─ Set Permissions (5s)
        ├─ Restart Services (10s)
        └─ Slack Notify (5s)
        │
04:00   ✅ Deployment Complete!
```

---

## 🎯 Deployment Lifecycle

```
BEFORE DEPLOYMENT
┌──────────────────┐
│ Production Site  │
│ (Running stably) │
└──────────────────┘
         │
         │ You push code to GitHub
         ▼

DEPLOYMENT STARTS
┌──────────────────────────────────────────┐
│ 1. Create Backup                        │
│    └─ Backup current code/config        │
└──────────────────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────────┐
│ 2. Pull Code                             │
│    └─ git pull origin production         │
└──────────────────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────────┐
│ 3. Install Dependencies                  │
│    └─ composer install --no-dev          │
└──────────────────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────────┐
│ 4. Database Operations                   │
│    └─ php artisan migrate --force        │
└──────────────────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────────┐
│ 5. Optimize                              │
│    └─ Rebuild config/route/view caches  │
└──────────────────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────────┐
│ 6. Restart Services                      │
│    ├─ systemctl restart php-fpm         │
│    └─ systemctl restart nginx           │
└──────────────────────────────────────────┘
         │
         ▼

AFTER DEPLOYMENT
┌──────────────────┐
│ Production Site  │
│ (Updated + Fast) │
│ (Backup Ready)   │
└──────────────────┘
```

---

## 🆘 Error Recovery

```
Deployment Fails at Any Step
        │
        ▼
┌─────────────────────────────────┐
│ 1. Check Logs in GitHub         │
│    Settings → Actions → Run     │
└─────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────┐
│ 2. Identify Issue               │
│    ├─ SSH connection failed?    │
│    ├─ Composer install failed?  │
│    ├─ Migration failed?         │
│    └─ Service restart failed?   │
└─────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────┐
│ 3. Fix on Server                │
│    ├─ Manual SSH                │
│    ├─ Check logs/errors         │
│    └─ Apply fix                 │
└─────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────┐
│ 4. Automatic Rollback (Optional)│
│    ├─ Restore from backup       │
│    ├─ Restart services          │
│    └─ Verify website            │
└─────────────────────────────────┘
```

---

## 📈 Performance Metrics

### Typical Deployment Performance

```
Metric                  Value          Status
─────────────────────────────────────────────────
Total Time              3-4 minutes    ✅ Acceptable
SSH Connection          < 5s           ✅ Fast
Code Pull               10-30s         ✅ Depends on size
Composer Install        60-180s        ⚠️ Longest step
Database Migrations     5-30s          ✅ Usually fast
Cache Rebuild           < 10s          ✅ Fast
Service Restart         < 30s          ✅ Fast
Downtime                ~ 0-5s         ✅ Minimal
                                       (during service restart)
```

### Optimization Tips

- ✅ Use `composer install --no-dev` (faster)
- ✅ Enable OPCache for production
- ✅ Use config caching
- ✅ Pre-generate caches
- ✅ Minimize migration time

---

## 🔒 Security Model

```
┌──────────────────────────────────────────────────┐
│              Security Layers                     │
├──────────────────────────────────────────────────┤
│                                                  │
│  Layer 1: GitHub Secrets (Encrypted at rest)   │
│  ✅ Values hidden in logs                       │
│  ✅ Masked in console output                    │
│  ✅ Only injected at runtime                    │
│                                                  │
│  Layer 2: SSH Transport (Encrypted in transit) │
│  ✅ ED25519 SSH keys (modern crypto)           │
│  ✅ No password authentication                  │
│  ✅ Public key infrastructure                   │
│                                                  │
│  Layer 3: Server Security                       │
│  ✅ Restricted deploy user                      │
│  ✅ Limited sudo permissions                    │
│  ✅ Firewall rules                              │
│  ✅ SSH key access control                      │
│                                                  │
│  Layer 4: Application Security                  │
│  ✅ Environment-based configuration             │
│  ✅ .env file not in version control           │
│  ✅ Database credentials secured                │
│  ✅ API keys protected                          │
│                                                  │
└──────────────────────────────────────────────────┘
```

---

## 📞 Support & Resources

### Documentation
- 📖 `GITHUB_ACTIONS_SETUP.md` - Quick start (5 min)
- 📖 `DEPLOYMENT_GUIDE.md` - Complete reference
- 📖 `DEPLOYMENT_CHECKLIST.md` - Step-by-step setup

### External Resources
- 🌐 [GitHub Actions Docs](https://docs.github.com/en/actions)
- 🌐 [Laravel Deployment](https://laravel.com/docs/deployment)
- 🌐 [SSH Keys Guide](https://docs.github.com/en/authentication/connecting-to-github-with-ssh)

### Common Issues
| Issue | Solution | Docs |
|-------|----------|------|
| Permission denied | Check SSH key permissions | DEPLOYMENT_GUIDE.md |
| Composer not found | Install composer on server | DEPLOYMENT_GUIDE.md |
| Database connection fails | Check .env on server | DEPLOYMENT_GUIDE.md |
| Migrations fail | Check database exists | DEPLOYMENT_GUIDE.md |
| Permission denied on storage | Run chmod/chown | DEPLOYMENT_GUIDE.md |

---

## ✅ Success Indicators

### Deployment is Working When:

✅ Workflow runs on every `git push origin production`  
✅ Workflow completes in 3-4 minutes  
✅ All steps show green checkmarks  
✅ Code appears on server within 5 minutes  
✅ Website loads without errors  
✅ New code is live and functional  
✅ Database migrations applied successfully  
✅ Slack notifications received (if configured)  

### Problem Indicators:

❌ Workflow stuck on SSH connection  
❌ "Composer not found" error  
❌ "Permission denied" during file operations  
❌ Migrations fail  
❌ Services don't restart  
❌ Website shows 500 errors  
❌ Code not updated on server  

---

## 🎓 Learning Path

### Beginner
1. Read `GITHUB_ACTIONS_SETUP.md`
2. Follow the checklist
3. Complete first test deployment

### Intermediate
1. Read `DEPLOYMENT_GUIDE.md`
2. Configure Slack notifications
3. Set up monitoring

### Advanced
1. Customize workflows
2. Add additional environments (staging)
3. Implement multi-branch deployments
4. Explore Docker deployment option

---

## 🚀 Quick Commands Reference

### Deploy
```bash
git push origin production
```

### Manual Trigger (no push needed)
- GitHub Actions → Deploy to Production (Simple) → Run workflow

### Check Deployment Status
- GitHub → Actions tab → See workflow progress

### Rollback (if needed)
```bash
ssh user@server
cd /var/www/html/nere-mining/backups
cp -r LATEST/* ../
sudo systemctl restart php-fpm nginx
```

### Monitor Logs
```bash
ssh user@server
tail -f storage/logs/laravel.log
tail -f /var/log/nginx/error.log
```

---

**Status:** ✅ Ready for Production  
**Last Updated:** August 25, 2026  
**Version:** 1.0
