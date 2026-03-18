# PHPForge PHP Edition

Full server-side PHP learning platform. PHP 8.0+ required.

## File Structure

```
phpforge/
├── api/
│   └── index.php          ← Vercel entry point (routes all requests)
├── includes/
│   ├── data.php            ← All content (topics, examples, quiz, cheatsheet)
│   ├── helpers.php         ← h(), url(), active_page() utilities
│   └── layout.php          ← HTML layout + all page renderers
├── assets/
│   ├── css/style.css
│   └── js/app.js
├── index.php               ← Local dev entry point
├── vercel.json             ← Vercel config (PHP runtime + routing)
└── README.md
```

---

## Deploy to Vercel (Free)

### Step 1 — Push to GitHub
```bash
git init
git add .
git commit -m "PHPForge"
git remote add origin https://github.com/YOUR_USERNAME/phpforge.git
git push -u origin main
```

### Step 2 — Deploy on Vercel
1. Go to https://vercel.com → Sign in with GitHub
2. Click "Add New Project" → Import your phpforge repo
3. Leave all settings as default (Vercel reads vercel.json automatically)
4. Click "Deploy"
5. Done — get a live URL like https://phpforge-xyz.vercel.app

The vercel.json handles everything:
- Routes all requests through api/index.php via PHP runtime
- Serves /assets/ files statically

### Step 3 — Custom Domain (optional)
Vercel dashboard → Project → Settings → Domains → Add your domain.

---

## Local Development

### PHP Built-in Server (quickest)
```bash
cd phpforge
php -S localhost:8080
```

### Laragon / XAMPP / WAMP (Windows)
Copy phpforge/ into htdocs/ then open http://localhost/phpforge/

### Termux (Android)
```bash
pkg install php
cd phpforge
php -S 0.0.0.0:8080
```

## Requirements
- PHP 8.0 or higher
- No Composer, no database, no dependencies
