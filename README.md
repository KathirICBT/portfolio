# Suresh Kumar — Laravel 12 Single-Page Website + CMS

A production-ready, fully dynamic single-page website and admin CMS built with **Laravel 12**, **PHP 8.2.4**, and **MySQL**. All content is extracted from sureshkumar.ca and rebuilt with a completely new UI/UX.

---

## 🚀 Quick Start

### Requirements
- PHP 8.2.4+
- MySQL 8.0+
- Composer 2.x
- Node.js (optional, for asset compilation)

---

## 📦 Installation

### 1. Extract & Install Dependencies

```bash
cd sureshkumar
composer install
```

### 2. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database and mail credentials:

```env
APP_URL=https://yourdomain.com

DB_DATABASE=sureshkumar
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.yourprovider.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=yourpassword
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@sureshkumar.ca
MAIL_FROM_NAME="Suresh Kumar"
```

### 3. Database Setup

```bash
php artisan migrate
php artisan db:seed
```

This will create all tables and seed with the extracted content from sureshkumar.ca.

### 4. Storage Link

```bash
php artisan storage:link
```

### 5. Serve the Application

```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## 🔐 Admin Access

URL: **http://localhost:8000/admin**

Default credentials (change immediately after first login):
- **Email:** `admin@sureshkumar.ca`
- **Password:** `Admin@123456`

> ⚠️ **IMPORTANT:** Change the admin password immediately after logging in via Site Settings or by running:
> ```bash
> php artisan tinker
> User::first()->update(['password' => bcrypt('your-new-secure-password')]);
> ```

---

## 🗂️ Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Front/HomeController.php        ← Public website
│   │   └── Admin/                          ← All admin CMS controllers
│   └── Middleware/AdminAuthenticated.php   ← Admin guard
├── Models/                                 ← All Eloquent models
├── Services/
│   ├── MediaService.php                    ← File upload & storage
│   └── SeoService.php                      ← SEO meta resolution
└── Providers/AppServiceProvider.php        ← Global view sharing

resources/views/
├── front/                                  ← Public website views
│   ├── home.blade.php                      ← Main one-page template
│   ├── layouts/app.blade.php               ← Frontend layout + CSS
│   └── partials/                           ← Nav, footer, icons
└── admin/                                  ← CMS admin panel views

database/
├── migrations/                             ← All table migrations
└── seeders/DatabaseSeeder.php              ← Pre-loaded content

routes/web.php                              ← All routes (public + admin)
```

---

## 🎨 Frontend Sections

| Section        | Anchor       | CMS Managed |
|----------------|--------------|-------------|
| Hero Slider    | #home        | ✅ Full CRUD |
| About          | #about       | ✅ Full edit |
| Stats          | #stats       | ✅ Full edit |
| Services       | #services    | ✅ Full CRUD |
| Network        | #network     | ✅ Full CRUD |
| Clients        | #clients     | ✅ Full CRUD |
| Testimonials   | #testimonials| ✅ Full CRUD |
| CTA Banner     | #cta-banner  | ✅ Via Sections |
| Contact        | #contact     | ✅ Via Settings |

---

## 🛠️ Admin Panel Modules

| Module              | Route                    |
|---------------------|--------------------------|
| Dashboard           | /admin                   |
| Hero Slider         | /admin/sliders           |
| Page Sections       | /admin/sections          |
| Services            | /admin/services          |
| Network Profiles    | /admin/network-profiles  |
| Client Logos        | /admin/clients           |
| Testimonials        | /admin/testimonials      |
| Stats & Counters    | /admin/stats             |
| Media Library       | /admin/media             |
| SEO Settings        | /admin/seo               |
| Site Settings       | /admin/settings          |

---

## 🗄️ Database Tables

| Table              | Purpose                          |
|--------------------|----------------------------------|
| `users`            | Admin authentication             |
| `sliders`          | Hero banner slides               |
| `page_sections`    | All page section content         |
| `services`         | Service cards                    |
| `network_profiles` | Political/civic connections      |
| `clients`          | Client logo strip                |
| `testimonials`     | Client quotes                    |
| `stats`            | Animated achievement counters    |
| `media`            | Uploaded files registry          |
| `seo_settings`     | Meta, OG, schema per page        |
| `site_settings`    | Global key-value configuration   |

---

## 🌐 SEO Features

- Editable meta title, description, canonical URL
- Open Graph tags (Facebook, LinkedIn sharing)
- Twitter Card support
- JSON-LD Schema.org markup (Person schema pre-configured)
- Robots.txt dynamically generated from CMS
- Sitemap.xml at `/sitemap.xml`
- Alt text management per media file
- Heading hierarchy H1 (first slide only) → H2 (section headings) → H3 (card titles)

---

## 🖼️ Media Handling

- Upload via Admin → Media Library
- Files stored in `storage/app/public/uploads/YYYY/MM/`
- Accessible via `/storage/uploads/YYYY/MM/filename.jpg`
- Alt text editable per file
- Usage: select from dropdown in Slider, Network Profile, Client, and Testimonial editors

### Recommended Image Sizes

| Usage              | Size          | Format |
|--------------------|---------------|--------|
| Slider backgrounds | 1920×1080px   | JPEG   |
| Profile photos     | 400×400px     | JPEG   |
| Client logos       | 300×120px     | PNG/SVG|
| OG image           | 1200×630px    | JPEG   |

---

## ⚡ Performance Tips

1. Enable OPcache on your PHP server
2. Run `php artisan config:cache` and `php artisan route:cache` in production
3. Set `APP_DEBUG=false` in production `.env`
4. Configure a CDN for `/storage/` assets
5. Enable Gzip/Brotli compression on your web server
6. Images lazy-load by default (native `loading="lazy"`)
7. Settings are cached for 1 hour via Laravel Cache

---

## 🔒 Security

- CSRF protection on all forms (including contact)
- Admin middleware on all `/admin/*` routes
- Input validation on all form requests
- SQL injection protection via Eloquent ORM
- XSS protection via Blade `{{ }}` escaping
- File upload restricted to image MIME types only

---

## 🚢 Deployment (cPanel / Shared Hosting)

1. Upload files to `public_html/` (or a subdirectory)
2. Move `public/` contents to `public_html/`, update `index.php` paths
3. Set document root to `public_html/`
4. Create MySQL database and user in cPanel
5. Set `.env` values
6. Run migrations via SSH: `php artisan migrate --seed`
7. Run `php artisan storage:link`
8. Set `APP_DEBUG=false`, `APP_ENV=production`

---

## 🎨 Design System

| Token          | Value         | Usage                  |
|----------------|---------------|------------------------|
| `--navy`       | `#0F2644`     | Primary dark           |
| `--gold`       | `#C9A84C`     | Accent, CTAs           |
| `--cream`      | `#F8F6F1`     | Section backgrounds    |
| Font Display   | Cormorant Garamond | Headings          |
| Font Body      | DM Sans       | Body text, UI          |

---

## 📞 Support

For setup assistance or customization, contact the development team.

---

*Built with Laravel 12 · PHP 8.2 · MySQL · Alpine.js · No build step required*
