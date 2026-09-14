# 📊 Admin Analytics Page - Quick Start Guide

## 🌐 Access the Dashboard

**URL**: `http://localhost:8000/gestion-nm/statistiques` (local)  
**URL Production**: `https://nere-mining-ex3a.onrender.com/gestion-nm/statistiques`

**Requirements**:
- ✅ Admin login required
- ✅ Email: `admin@nere-mining.bf`
- ✅ Password: `AdminNereMining2026!`

---

## 📈 Dashboard Overview

```
┌─────────────────────────────────────────────────────────┐
│  📊 STATISTICS DASHBOARD                          │ 🔄  │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐             │
│  │ 📈 1200  │  │ 👥  850  │  │ 📄 3.2   │  ...       │
│  │ Visits   │  │ Unique   │  │ Pages    │             │
│  │ ↑ 15%    │  │ Visitors │  │ per Visit│             │
│  └──────────┘  └──────────┘  └──────────┘             │
│                                                         │
│  ┌─────────────────────────┐  ┌──────────────────┐    │
│  │   📊 Visit Trends       │  │  📱 Devices      │    │
│  │   (Line Chart)          │  │  (Doughnut)      │    │
│  │                         │  │                  │    │
│  │   ╱╲     ╱╲╲            │  │  ●●●●●●●●●●●●  │    │
│  │  ╱  ╲   ╱    ╲          │  │  Desktop: 45%    │    │
│  │ ╱    ╲╱      ╲╲        │  │  Mobile:  50%    │    │
│  └─────────────────────────┘  │  Tablet:   5%    │    │
│                                │                  │    │
│  ┌──────────────────────────────────────────────┐    │
│  │  🌐 Traffic Sources   │  🔥 Top Pages      │    │
│  │  Direct      480      │  1. /accueil  250  │    │
│  │  Google      320      │  2. /about    180  │    │
│  │  Facebook    150      │  3. /contact  120  │    │
│  └──────────────────────────────────────────────┘    │
│                                                         │
└─────────────────────────────────────────────────────────┘
```

---

## 🎛️ Key Controls

### Period Selector
```
📅 Select Range:
  └─ 7 derniers jours     (Last 7 days)
  └─ 30 derniers jours    (Last 30 days) ← Default
  └─ 3 derniers mois      (Last 3 months)
  └─ 12 derniers mois     (Last 12 months)
```

### Export Options
```
📥 Export CSV   → Downloadable .csv file (Excel-compatible, UTF-8)
📄 Export JSON  → API format (.json) for integration
🔄 Refresh      → Reload data from database
```

---

## 📊 Understanding the Metrics

### 1️⃣ KPI Cards (Top Row)

| Metric | Meaning | Good Range |
|--------|---------|-----------|
| **📈 Total Visits** | Total page views | Increasing trend |
| **👥 Unique Visitors** | Unique IP addresses | Growing week/week |
| **🗓️ Today's Visits** | Visits since midnight | Consistent daily |
| **📄 Pages/Visit** | Avg pages per session | 2-4+ is healthy |
| **⚡ Bounce Rate** | % left after 1 page | Lower is better (<50%) |
| **🔄 Recurring** | Visitors who returned | High = loyalty |

### 2️⃣ Chart 1: Visit Trends (Line Chart)

**What it shows**: Daily visitor count over selected period

**How to read**:
- Horizontal axis = Days (dates)
- Vertical axis = Number of visits
- Orange line = Trend over time
- Peaks = High traffic days
- Dips = Low traffic days

**Action**: Look for patterns or anomalies

### 3️⃣ Chart 2: Device Distribution (Doughnut)

**What it shows**: What devices visitors use

**Breakdown**:
- 🖥️ Desktop (45-60% typical)
- 📱 Mobile (35-50% typical)
- 💻 Tablet (5-15% typical)

**Action**: Optimize for dominant device type

### 4️⃣ Chart 3: Traffic Sources (Bar Chart)

**What it shows**: Where visitors come from

**Categories**:
- 🔗 Direct = Type URL directly
- 🌐 Google = Search engine
- 🌐 Facebook = Social media
- 🌐 Other = Referral sites

**Action**: Invest in top-performing channels

---

## 📋 Data Panels Explained

### 🔥 Top Pages
- **Ranking**: 1-10 most visited
- **Percentage**: % of total traffic
- **Progress bar**: Visual representation

**Use case**: Identify popular content, optimize underperformers

### 📱 Types of Devices
- **Count**: Total visits from device type
- **Percentage**: Device market share
- **Bars**: Visual comparison

**Use case**: Allocate design/testing resources

### 🌐 Traffic Sources
- **Domain**: Where visitors came from
- **Count**: Number of referral visits

**Use case**: Identify partnership opportunities, evaluate campaigns

### ⏰ Peak Hours
- **24-hour grid**: Visits by hour of day
- **Bar height**: Volume at that hour
- **Pattern**: When most active

**Use case**: Schedule marketing, plan server maintenance

---

## 💡 Quick Tips

### Read the Trends 📈
✅ Look at "↑ 15%" next to Total Visits  
✅ Means 15% increase vs previous period  
✅ Green = Good, Red = Declining  

### Export for Reports 📄
✅ Export CSV for presentation  
✅ Export JSON for dashboards  
✅ Data auto-sorted by date  

### Mobile First 📱
✅ Check if Mobile > Desktop  
✅ Indicates responsive design importance  
✅ Plan content for smaller screens  

### Track Bounces ⚡
✅ High bounce rate? Content mismatch  
✅ Check top pages for engagement  
✅ Improve with clear CTAs  

### Monitor Recurring 🔄
✅ High recurring = Brand loyalty  
✅ Low recurring = Attract new visitors  
✅ Balance acquisition & retention  

---

## 🔄 Interpretation Examples

### Scenario 1: Healthy Analytics
```
📈 Total Visits: 1,500 ↑ 25%
👥 Unique: 900
🗓️ Today: 85
📄 Pages: 3.2
⚡ Bounce: 35% ↓ 5%
🔄 Recurring: 45%

✅ Interpretation:
  - Strong growth (+25%)
  - Good engagement (3.2 pages)
  - Bouncing less (35%)
  - Good repeat visitors (45%)
```

### Scenario 2: Declining Performance
```
📈 Total Visits: 800 ↓ 10%
👥 Unique: 450
🗓️ Today: 22
📄 Pages: 1.8
⚡ Bounce: 62% ↑ 8%
🔄 Recurring: 15%

⚠️ Interpretation:
  - Declining traffic (-10%)
  - Low engagement (1.8 pages)
  - High bounce rate (62%)
  - Few returning visitors (15%)
  - Action: Review content, improve UX
```

### Scenario 3: Mobile-Heavy Traffic
```
Desktop: 35% 📊
Mobile:  60% 📱
Tablet:   5% 💻

✅ Actions:
  - Prioritize mobile UX
  - Test on phones first
  - Check load times on 3G
  - Responsive design critical
```

---

## 📊 Exporting Data

### CSV Format (for Excel)
```
Date,Page,Source,Appareil,Pays
2026-09-05 14:30,/accueil,Direct,Mobile,Burkina Faso
2026-09-05 14:29,/about,Google,Desktop,France
2026-09-05 14:28,/contact,Facebook,Mobile,Côte d'Ivoire
```

✅ **Use when**: Creating reports, charts, sharing with non-technical users

### JSON Format (for APIs)
```json
{
  "export_date": "2026-09-05T14:35:00Z",
  "period_days": 30,
  "total_records": 1250,
  "data": [
    {
      "date": "2026-09-05 14:30:00",
      "page": "/accueil",
      "source": "Direct",
      "device": "Mobile",
      "country": "Burkina Faso"
    }
  ]
}
```

✅ **Use when**: Integrating with external tools, building dashboards

---

## 🐛 Troubleshooting

### Issue: No data showing
**Solution**: 
- Ensure site has recent visitors
- Check SiteAnalytics table populated
- Wait 24 hours for data collection

### Issue: Charts not rendering
**Solution**:
- Check browser console for errors
- Verify Chart.js CDN accessible
- Clear browser cache
- Try different browser

### Issue: Export file empty
**Solution**:
- Check selected period has data
- Verify admin access
- Refresh page and retry
- Contact support if persists

### Issue: Mobile layout broken
**Solution**:
- Try rotating device
- Clear mobile cache
- Update browser
- Test on different phone

---

## 📱 Mobile Access

✅ Dashboard fully responsive  
✅ Works on phone (320px+)  
✅ Touch-friendly controls  
✅ Readable on all screens  

**Mobile Tips**:
- Tap period selector to change dates
- Scroll panels for full data
- Tap charts for zoom/details
- Use landscape for better view

---

## 🔐 Admin-Only Features

This page is **admin-only**. Non-admins will see:
```
❌ "Access Denied"
❌ "You must be logged in as an administrator"
```

**To grant access**:
1. Go to admin users page
2. Edit user account
3. Check "Is Admin" checkbox
4. Save changes

---

## 📞 Need Help?

**Issues**:
- Check this guide first
- Review browser console (F12)
- Test with different period
- Try clearing cache

**Report Bugs**:
- Document exact steps to reproduce
- Include screenshot/video
- Note browser and device
- Share with admin team

---

## 🎯 Key Takeaways

1. **Monitor Trends**: Check metrics regularly for patterns
2. **Understand Devices**: Know how visitors access your site
3. **Track Sources**: Identify your best traffic channels
4. **Find Content**: See what pages visitors love
5. **Export Data**: Share insights with team
6. **Improve UX**: Use data to make better decisions

---

**Last Updated**: 5 September 2026  
**Version**: 1.0  
**Status**: ✅ Ready to use
