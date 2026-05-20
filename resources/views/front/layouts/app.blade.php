<!DOCTYPE html>
<html lang="en" data-theme="light" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    {{-- Prevent flash of wrong theme --}}
    <script>
    (function(){
        var t = localStorage.getItem('sk-theme') ||
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        document.documentElement.setAttribute('data-theme', t);
    })();
    </script>

    {{-- SEO Meta --}}
    <title>{{ $seo->meta_title ?? ($gs['site_name'] ?? 'Suresh Kumar') }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? '' }}">
    <meta name="robots" content="{{ $seo->robots ?? 'index, follow' }}">
    @if(!empty($seo->canonical_url))
    <link rel="canonical" href="{{ $seo->canonical_url }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="{{ $seo->og_title ?? $seo->meta_title ?? '' }}">
    <meta property="og:description" content="{{ $seo->og_description ?? $seo->meta_description ?? '' }}">
    <meta property="og:url"         content="{{ $seo->canonical_url ?? url('/') }}">
    @if($seo->ogImage)
    <meta property="og:image"       content="{{ $seo->ogImage->url }}">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="{{ $seo->twitter_card ?? 'summary_large_image' }}">
    <meta name="twitter:title"       content="{{ $seo->og_title ?? $seo->meta_title ?? '' }}">
    <meta name="twitter:description" content="{{ $seo->og_description ?? $seo->meta_description ?? '' }}">

    {{-- Schema.org JSON-LD --}}
    @if(!empty($schemaJson))
    <script type="application/ld+json">{!! $schemaJson !!}</script>
    @endif

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- GA --}}
    @if(!empty($gs['ga_id']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gs['ga_id'] }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $gs['ga_id'] }}');</script>
    @endif

<style>
/* ═══════════════════════════════════════════════
   DESIGN TOKENS
   ═══════════════════════════════════════════════ */
:root {
  /* Brand — always fixed */
  --navy:        #0F2644;
  --navy-mid:    #1A3A5C;
  --navy-light:  #2A527D;
  --gold:        #C9A84C;
  --gold-light:  #E2C57A;

  /* Light mode (default) */
  --bg:          #FFFFFF;
  --bg-alt:      #F8F6F1;
  --bg-card:     #FFFFFF;
  --text:        #1C1C1E;
  --text-muted:  #64748B;
  --border:      #E5E0D5;
  --gold-pale:   #F7F0DC;
  --shadow-sm:   0 2px 12px rgba(15,38,68,0.08);
  --shadow-md:   0 8px 32px rgba(15,38,68,0.12);
  --shadow-lg:   0 24px 64px rgba(15,38,68,0.18);
  --shadow-gold: 0 8px 24px rgba(201,168,76,0.35);

  /* Layout */
  --radius:      12px;
  --radius-lg:   20px;
  --transition:  0.3s cubic-bezier(0.4,0,0.2,1);
  --font-display:'Cormorant Garamond', Georgia, serif;
  --font-body:   'DM Sans', system-ui, sans-serif;
  --max-w:       1200px;
  --section-py:  100px;
}

/* Dark mode overrides */
[data-theme="dark"] {
  --bg:          #0B1829;
  --bg-alt:      #0E2035;
  --bg-card:     #142B47;
  --text:        #E8EDF5;
  --text-muted:  #8BA3BE;
  --border:      #1C3A5C;
  --gold-pale:   rgba(201,168,76,0.12);
  --shadow-sm:   0 2px 12px rgba(0,0,0,0.3);
  --shadow-md:   0 8px 32px rgba(0,0,0,0.45);
  --shadow-lg:   0 24px 64px rgba(0,0,0,0.6);
  --shadow-gold: 0 8px 24px rgba(201,168,76,0.2);
}

/* ═══════════════════════════════════════════════
   GLOBAL RESET & BASE
   ═══════════════════════════════════════════════ */
*,*::before,*::after { box-sizing:border-box; margin:0; padding:0 }
html { scroll-behavior:smooth; font-size:16px }
body {
  font-family:var(--font-body);
  color:var(--text);
  background:var(--bg);
  line-height:1.65;
  -webkit-font-smoothing:antialiased;
  transition:background-color 0.35s ease, color 0.35s ease;
}
img { max-width:100%; height:auto; display:block }
a { text-decoration:none; color:inherit }
button { border:none; cursor:pointer; font-family:inherit }

/* ─── Layout ─── */
.container { max-width:var(--max-w); margin:0 auto; padding:0 40px }
section { padding:var(--section-py) 0 }

/* ─── Typography ─── */
.display-xl { font-family:var(--font-display); font-size:clamp(2.8rem,6vw,5rem); font-weight:600; line-height:1.1; letter-spacing:-0.02em }
.display-lg { font-family:var(--font-display); font-size:clamp(2.2rem,4.5vw,3.5rem); font-weight:600; line-height:1.15; letter-spacing:-0.02em }
.display-md { font-family:var(--font-display); font-size:clamp(1.8rem,3.5vw,2.5rem); font-weight:500; line-height:1.2 }
h1,h2,h3 { font-family:var(--font-display) }
h2,h3 { color:var(--text) }
.section-eyebrow {
  font-family:var(--font-body); font-size:.75rem; font-weight:700;
  letter-spacing:.22em; text-transform:uppercase; color:var(--gold);
  display:flex; align-items:center; gap:12px; margin-bottom:16px;
}
.section-eyebrow::before { content:''; display:block; width:24px; height:2px; background:var(--gold); border-radius:2px; flex-shrink:0 }
.lead { font-size:1.1rem; line-height:1.8; color:var(--text-muted); max-width:640px }

/* ─── Accessibility ─── */
.sr-only { position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap }
:focus-visible { outline:2px solid var(--gold); outline-offset:3px; border-radius:4px }

/* ─── Buttons ─── */
.btn {
  display:inline-flex; align-items:center; gap:8px;
  padding:14px 32px; border-radius:8px;
  font-size:.9rem; font-weight:600; letter-spacing:.04em;
  transition:all var(--transition); cursor:pointer;
}
.btn-primary {
  background:var(--gold); color:var(--navy); border:2px solid var(--gold);
}
.btn-primary:hover {
  background:var(--gold-light); border-color:var(--gold-light);
  transform:translateY(-2px); box-shadow:var(--shadow-gold);
}
.btn-outline {
  background:transparent; color:#fff; border:2px solid rgba(255,255,255,0.55);
}
.btn-outline:hover { background:rgba(255,255,255,0.1); border-color:#fff }
.btn-navy {
  background:var(--navy); color:#fff; border:2px solid var(--navy);
}
.btn-navy:hover { background:var(--navy-mid); transform:translateY(-2px); box-shadow:var(--shadow-md) }

/* ─── Cards ─── */
.card {
  background:var(--bg-card); border-radius:var(--radius);
  box-shadow:var(--shadow-sm); overflow:hidden;
  transition:all var(--transition); border:1px solid var(--border);
}
.card:hover { box-shadow:var(--shadow-md); transform:translateY(-4px) }

/* ─── Gold divider ─── */
.gold-line {
  display:block; width:48px; height:3px;
  background:linear-gradient(90deg, var(--gold), var(--gold-light));
  border-radius:2px; margin:16px 0 28px;
}

/* ─── Scroll Reveal ─── */
.sr-animate {
  opacity:0; transform:translateY(22px);
  transition:opacity 0.65s ease, transform 0.65s ease;
}
.sr-animate.sr-visible { opacity:1; transform:translateY(0) }
.sr-animate.sr-delay-1 { transition-delay:0.1s }
.sr-animate.sr-delay-2 { transition-delay:0.18s }
.sr-animate.sr-delay-3 { transition-delay:0.26s }
.sr-animate.sr-delay-4 { transition-delay:0.34s }
.sr-animate.sr-delay-5 { transition-delay:0.42s }
.sr-animate.sr-delay-6 { transition-delay:0.50s }

/* ═══════════════════════════════════════════════
   NAVIGATION
   ═══════════════════════════════════════════════ */
.site-nav {
  position:fixed; top:0; left:0; right:0; z-index:1000;
  height:88px; display:flex; align-items:center;
  transition:all var(--transition);
  background:linear-gradient(to bottom, rgba(9,20,38,0.80) 0%, rgba(9,20,38,0.0) 100%);
}
.site-nav .container { width:100% }
.site-nav.scrolled {
  height:60px;
  background:rgba(8,17,34,0.96);
  backdrop-filter:blur(20px) saturate(180%);
  -webkit-backdrop-filter:blur(20px) saturate(180%);
  box-shadow:0 1px 0 rgba(201,168,76,0.18), 0 6px 32px rgba(0,0,0,0.28);
}
/* Light mode — unscrolled: transparent nav with dark text */
[data-theme="light"] .site-nav { background:transparent }
[data-theme="light"] .site-nav .nav-logo-text { color:var(--navy) }
[data-theme="light"] .site-nav .nav-links a { color:rgba(15,38,68,0.65) }
[data-theme="light"] .site-nav .nav-links a:hover { color:var(--navy); background:rgba(15,38,68,0.06) }
[data-theme="light"] .site-nav .nav-links a.active { color:var(--gold) }
[data-theme="light"] .site-nav .nav-phone-link { color:rgba(15,38,68,0.6) }
[data-theme="light"] .site-nav .nav-phone-link:hover { color:var(--gold) }
[data-theme="light"] .site-nav .theme-toggle { background:rgba(15,38,68,0.07); border-color:rgba(15,38,68,0.18); color:var(--navy) }
[data-theme="light"] .site-nav .theme-toggle:hover { background:rgba(201,168,76,0.15); border-color:var(--gold); color:var(--gold) }
[data-theme="light"] .site-nav .nav-hamburger span { background:var(--navy) }

/* Light mode — scrolled: white nav with dark text */
[data-theme="light"] .site-nav.scrolled {
  background:rgba(255,255,255,0.97);
  box-shadow:0 1px 0 rgba(15,38,68,0.10), 0 4px 24px rgba(15,38,68,0.10);
}
[data-theme="light"] .site-nav.scrolled .nav-logo-text { color:var(--navy) }
[data-theme="light"] .site-nav.scrolled .nav-links a { color:rgba(15,38,68,0.65) }
[data-theme="light"] .site-nav.scrolled .nav-links a:hover { color:var(--navy); background:rgba(15,38,68,0.05) }
[data-theme="light"] .site-nav.scrolled .nav-links a.active { color:var(--gold) }
[data-theme="light"] .site-nav.scrolled .nav-phone-link { color:rgba(15,38,68,0.6) !important }
[data-theme="light"] .site-nav.scrolled .nav-phone-link:hover { color:var(--gold) !important }
[data-theme="light"] .site-nav.scrolled .theme-toggle {
  background:rgba(15,38,68,0.07); border-color:rgba(15,38,68,0.18); color:var(--navy);
}
[data-theme="light"] .site-nav.scrolled .theme-toggle:hover { background:rgba(201,168,76,0.15); border-color:var(--gold); color:var(--gold) }
[data-theme="light"] .site-nav.scrolled .nav-hamburger span { background:var(--navy) }

/* Dark mode — scrolled */
[data-theme="dark"] .site-nav.scrolled {
  background:rgba(4,9,20,0.97);
  box-shadow:0 1px 0 rgba(201,168,76,0.14), 0 6px 32px rgba(0,0,0,0.45);
}
.site-nav .container { display:flex; align-items:center; justify-content:space-between; gap:20px }

/* Logo */
.nav-logo { display:flex; align-items:center; gap:12px; flex-shrink:0 }
.nav-logo-mark {
  width:42px; height:42px; background:var(--gold); border-radius:10px;
  display:flex; align-items:center; justify-content:center;
  font-family:var(--font-display); font-size:1.35rem; font-weight:700; color:var(--navy);
  box-shadow:0 4px 14px rgba(201,168,76,0.35);
  transition:transform var(--transition), box-shadow var(--transition);
}
.nav-logo:hover .nav-logo-mark { transform:rotate(-5deg) scale(1.07); box-shadow:0 6px 20px rgba(201,168,76,0.55) }
.nav-logo-text { color:#fff }
.nav-logo-text strong { display:block; font-size:1rem; font-weight:600; letter-spacing:0.01em; line-height:1 }

/* Nav links */
.nav-links { display:flex; align-items:center; gap:0; list-style:none }
.nav-links a {
  padding:9px 14px; border-radius:8px; font-size:.84rem; font-weight:500; letter-spacing:0.01em;
  color:rgba(255,255,255,0.72); transition:color 0.2s ease, background 0.2s ease; position:relative;
}
.nav-links a::before {
  content:''; position:absolute; bottom:5px; left:50%; transform:translateX(-50%) scaleX(0);
  width:16px; height:1.5px; background:var(--gold); border-radius:2px;
  transition:transform 0.25s cubic-bezier(0.4,0,0.2,1), opacity 0.2s;
  opacity:0;
}
.nav-links a:hover { color:#fff; background:rgba(255,255,255,0.07) }
.nav-links a:hover::before { transform:translateX(-50%) scaleX(1); opacity:1 }
.nav-links a.active { color:var(--gold) }
.nav-links a.active::before { transform:translateX(-50%) scaleX(1); opacity:1; background:var(--gold) }

/* Phone link in nav */
.nav-phone-link {
  color:rgba(255,255,255,0.68); font-size:.82rem;
  display:flex; align-items:center; gap:6px;
  white-space:nowrap; transition:color 0.2s ease;
}
.nav-phone-link:hover { color:var(--gold) }

/* CTA button in nav */
.nav-cta {
  padding:9px 20px !important; background:var(--gold) !important;
  color:var(--navy) !important; border-radius:8px; font-weight:700 !important;
  letter-spacing:0.03em; font-size:.83rem !important;
  box-shadow:0 3px 12px rgba(201,168,76,0.28);
}
.nav-cta:hover {
  background:var(--gold-light) !important; transform:translateY(-1px);
  box-shadow:0 6px 20px rgba(201,168,76,0.4) !important;
}
.nav-cta::before, .nav-cta::after { display:none !important }

/* ─── Theme Toggle ─── */
.theme-toggle {
  width:40px; height:40px; border-radius:50%;
  background:rgba(255,255,255,0.1); border:1.5px solid rgba(255,255,255,0.18);
  color:#fff; display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:all var(--transition); flex-shrink:0;
}
.theme-toggle:hover { background:rgba(201,168,76,0.25); border-color:var(--gold); color:var(--gold) }
.theme-toggle .icon-sun { display:none }
.theme-toggle .icon-moon { display:block }
[data-theme="dark"] .theme-toggle .icon-sun { display:block }
[data-theme="dark"] .theme-toggle .icon-moon { display:none }

/* ─── Hamburger ─── */
.nav-hamburger { display:none; flex-direction:column; gap:5px; padding:8px; background:none }
.nav-hamburger span { display:block; width:24px; height:2px; background:#fff; border-radius:2px; transition:all var(--transition) }
.nav-hamburger.open span:nth-child(1) { transform:translateY(7px) rotate(45deg) }
.nav-hamburger.open span:nth-child(2) { opacity:0; transform:scaleX(0) }
.nav-hamburger.open span:nth-child(3) { transform:translateY(-7px) rotate(-45deg) }

/* ─── Mobile Menu ─── */
.mobile-menu {
  display:none; position:fixed; top:0; left:0; right:0; bottom:0;
  background:var(--navy); z-index:999; padding:90px 40px 40px;
  flex-direction:column; gap:4px;
  transform:translateX(100%); transition:transform 0.35s cubic-bezier(0.4,0,0.2,1);
}
.mobile-menu.open { display:flex; transform:translateX(0) }
.mobile-menu a {
  font-size:1.4rem; font-family:var(--font-display); color:rgba(255,255,255,0.85);
  padding:14px 0; border-bottom:1px solid rgba(255,255,255,0.08);
  transition:color var(--transition), padding-left var(--transition);
}
.mobile-menu a:hover { color:var(--gold); padding-left:8px }
.mobile-menu .mob-cta { margin-top:28px; align-self:flex-start; font-size:1rem !important; border:none !important }
.mobile-close {
  position:absolute; top:20px; right:20px; background:rgba(255,255,255,0.1);
  color:#fff; font-size:1.2rem; padding:10px 14px; border-radius:8px; border:1px solid rgba(255,255,255,0.15);
  transition:all var(--transition);
}
.mobile-close:hover { background:rgba(255,255,255,0.18) }
.mob-theme-row {
  display:flex; align-items:center; justify-content:space-between;
  padding:16px 0; border-bottom:1px solid rgba(255,255,255,0.08);
  margin-bottom:8px;
}
.mob-theme-row span { font-size:.85rem; color:rgba(255,255,255,0.6); font-weight:500 }
.mob-theme-btn {
  width:52px; height:28px; border-radius:14px; position:relative;
  background:rgba(255,255,255,0.15); border:1.5px solid rgba(255,255,255,0.2);
  cursor:pointer; transition:all var(--transition);
}
.mob-theme-btn::after {
  content:''; position:absolute; top:3px; left:3px;
  width:18px; height:18px; border-radius:50%; background:#fff;
  transition:transform 0.3s ease;
}
[data-theme="dark"] .mob-theme-btn { background:rgba(201,168,76,0.3); border-color:var(--gold) }
[data-theme="dark"] .mob-theme-btn::after { transform:translateX(24px); background:var(--gold) }

/* ═══════════════════════════════════════════════
   HERO SLIDER
   ═══════════════════════════════════════════════ */
.hero-slider { position:relative; height:100vh; min-height:620px; overflow:hidden }
.hero-slide { position:absolute; inset:0; opacity:0; transition:opacity 1.1s ease; display:flex; align-items:center }
.hero-slide.active { opacity:1; z-index:2 }
.hero-slide-bg {
  position:absolute; inset:0;
  background-size:cover; background-position:center; background-repeat:no-repeat;
  transition:transform 6s ease;
}
.hero-slide.active .hero-slide-bg { transform:scale(1.04) }
.hero-slide-bg::after {
  content:''; position:absolute; inset:0;
  background:linear-gradient(135deg,rgba(10,24,44,0.9) 0%,rgba(10,24,44,0.55) 55%,rgba(10,24,44,0.3) 100%);
}
.hero-content { position:relative; z-index:3; max-width:780px; padding:0 }
.hero-eyebrow {
  font-size:.72rem; font-weight:700; letter-spacing:.24em; text-transform:uppercase;
  color:var(--gold); margin-bottom:22px; display:flex; align-items:center; gap:14px;
}
.hero-eyebrow::before { content:''; display:block; width:36px; height:2px; background:var(--gold); border-radius:2px }
.hero-slide h1,.hero-slide h2 {
  font-family:var(--font-display); color:#fff;
  font-size:clamp(2.4rem,5.5vw,4.4rem); font-weight:600; line-height:1.08;
  letter-spacing:-0.025em; margin-bottom:22px;
}
.hero-subtitle { font-size:1.05rem; color:rgba(255,255,255,0.8); line-height:1.8; max-width:560px; margin-bottom:40px }
.hero-btns { display:flex; gap:16px; flex-wrap:wrap }
.slide-enter .hero-eyebrow,.slide-enter h1,.slide-enter h2,.slide-enter .hero-subtitle,.slide-enter .hero-btns {
  animation:slideUp 0.75s cubic-bezier(0.4,0,0.2,1) forwards;
}
.slide-enter .hero-eyebrow { animation-delay:.08s; opacity:0 }
.slide-enter h1,.slide-enter h2 { animation-delay:.2s; opacity:0 }
.slide-enter .hero-subtitle { animation-delay:.36s; opacity:0 }
.slide-enter .hero-btns { animation-delay:.52s; opacity:0 }
@keyframes slideUp {
  from { opacity:0; transform:translateY(30px) }
  to   { opacity:1; transform:translateY(0) }
}
.slider-controls { position:absolute; bottom:36px; left:50%; transform:translateX(-50%); z-index:10; display:flex; align-items:center; gap:12px }
.slider-dots { display:flex; gap:10px; align-items:center }
.slider-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.35); cursor:pointer; transition:all var(--transition); border:none }
.slider-dot.active { width:30px; border-radius:4px; background:var(--gold) }

/* Pause/play button – WCAG 2.2 Success Criterion 2.2.2 */
.slider-pause {
  width:34px; height:34px; border-radius:50%;
  background:rgba(255,255,255,0.12); border:1.5px solid rgba(255,255,255,0.22);
  color:#fff; display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:all var(--transition); flex-shrink:0;
}
.slider-pause:hover { background:var(--gold); border-color:var(--gold); color:var(--navy) }
.slider-pause:focus-visible { outline:2px solid var(--gold); outline-offset:3px }
.slider-pause .icon-play  { display:none }
.slider-pause .icon-pause { display:block }
.slider-pause.is-paused .icon-play  { display:block }
.slider-pause.is-paused .icon-pause { display:none }
.slider-arrow {
  position:absolute; top:50%; z-index:10; transform:translateY(-50%);
  width:54px; height:54px; border-radius:50%;
  background:rgba(255,255,255,0.1); border:1.5px solid rgba(255,255,255,0.22);
  color:#fff; display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:all var(--transition); backdrop-filter:blur(10px);
}
.slider-arrow:hover { background:var(--gold); border-color:var(--gold); color:var(--navy); transform:translateY(-50%) scale(1.05) }
.slider-prev { left:32px }
.slider-next { right:32px }
.slider-progress { position:absolute; bottom:0; left:0; right:0; height:3px; background:rgba(255,255,255,0.1); z-index:10 }
.slider-progress-bar { height:100%; background:linear-gradient(90deg,var(--gold),var(--gold-light)); width:0; transition:width 5s linear }

/* ═══════════════════════════════════════════════
   ABOUT
   ═══════════════════════════════════════════════ */
#about { background:var(--bg-alt) }
.about-grid { display:grid; grid-template-columns:1fr 480px; gap:80px; align-items:start }
.about-text p { color:var(--text-muted); line-height:1.88; margin-bottom:20px; font-size:1rem }
.about-badges { display:flex; flex-wrap:wrap; gap:10px; margin-top:32px }
.badge {
  display:inline-flex; align-items:center; gap:8px; padding:9px 16px;
  background:var(--bg-card); border:1px solid var(--border);
  border-radius:30px; font-size:.8rem; font-weight:500; color:var(--text);
  transition:all var(--transition);
}
.badge:hover { border-color:var(--gold); background:var(--gold-pale) }
.badge svg { color:var(--gold); flex-shrink:0 }
.about-visual { position:sticky; top:110px }
.about-photo-frame {
  position:relative; border-radius:var(--radius-lg); overflow:hidden;
  aspect-ratio:4/5; background:var(--navy-mid);
  box-shadow:var(--shadow-lg);
}
.about-photo-frame img { width:100%; height:100%; object-fit:cover }
.about-photo-overlay {
  position:absolute; bottom:0; left:0; right:0; padding:28px;
  background:linear-gradient(to top,rgba(10,24,44,.96) 0%,transparent 100%);
}
.about-video-btn {
  display:flex; align-items:center; gap:14px; color:#fff; font-size:.88rem; font-weight:500;
  background:none; border:none; padding:0; cursor:pointer; width:100%; text-align:left;
}
.play-circle {
  width:50px; height:50px; border-radius:50%; background:var(--gold);
  display:flex; align-items:center; justify-content:center; flex-shrink:0;
  transition:transform var(--transition), box-shadow var(--transition);
}
.about-video-btn:hover .play-circle { transform:scale(1.1); box-shadow:0 0 0 8px rgba(201,168,76,0.2) }
.about-accent-card {
  position:absolute; top:32px; right:-24px;
  background:var(--bg-card); border-radius:var(--radius);
  padding:22px 26px; box-shadow:var(--shadow-lg);
  min-width:185px; border:1px solid var(--border);
}
.accent-card-number {
  font-family:var(--font-display); font-size:2.6rem; font-weight:700;
  color:var(--navy); line-height:1;
}
[data-theme="dark"] .accent-card-number { color:var(--gold) }
.accent-card-label { font-size:.78rem; color:var(--text-muted); font-weight:500; margin-top:6px; line-height:1.4 }

/* ═══════════════════════════════════════════════
   STATS
   ═══════════════════════════════════════════════ */
#stats { background:var(--navy); padding:88px 0 }
[data-theme="dark"] #stats { background:#071224 }
.stats-grid { display:grid; grid-template-columns:repeat(4,1fr) }
.stat-item {
  padding:52px 36px; background:transparent; text-align:center;
  border-right:1px solid rgba(255,255,255,0.07);
  transition:background var(--transition);
  position:relative; overflow:hidden;
}
.stat-item::before {
  content:''; position:absolute; bottom:0; left:50%; transform:translateX(-50%);
  width:0; height:3px; background:var(--gold);
  transition:width 0.4s ease;
}
.stat-item:hover { background:rgba(255,255,255,0.04) }
.stat-item:hover::before { width:80% }
.stat-item:last-child { border-right:none }
.stat-icon { width:48px; height:48px; margin:0 auto 16px; color:var(--gold); opacity:.8 }
.stat-number {
  font-family:var(--font-display); font-size:3.4rem; font-weight:700;
  color:#fff; line-height:1; margin-bottom:10px;
  background:linear-gradient(135deg,#fff 30%,rgba(255,255,255,0.75));
  -webkit-background-clip:text; -webkit-text-fill-color:transparent;
  background-clip:text;
}
.stat-suffix { color:var(--gold); -webkit-text-fill-color:var(--gold) }
.stat-label { font-size:.875rem; font-weight:600; color:rgba(255,255,255,.88); margin-bottom:6px; letter-spacing:.02em }
.stat-desc { font-size:.78rem; color:rgba(255,255,255,.4); line-height:1.65; max-width:180px; margin:0 auto }

/* ═══════════════════════════════════════════════
   SERVICES
   ═══════════════════════════════════════════════ */
#services { background:var(--bg) }
.section-header { max-width:640px; margin-bottom:68px }
.section-header h2 { color:var(--text) }
.services-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:28px }
.service-card {
  padding:38px; border-radius:var(--radius-lg); border:1px solid var(--border);
  background:var(--bg-card); transition:all var(--transition);
  position:relative; overflow:hidden;
}
.service-card::before {
  content:''; position:absolute; top:0; left:0; right:0; height:3px;
  background:linear-gradient(90deg,transparent,var(--gold),transparent);
  opacity:0; transition:opacity var(--transition);
}
.service-card:hover { box-shadow:var(--shadow-md); border-color:transparent; transform:translateY(-7px) }
.service-card:hover::before { opacity:1 }
.service-icon {
  width:56px; height:56px; border-radius:14px; background:var(--gold-pale);
  display:flex; align-items:center; justify-content:center;
  margin-bottom:26px; color:var(--navy); transition:all var(--transition);
}
[data-theme="dark"] .service-icon { color:var(--gold) }
.service-card:hover .service-icon {
  transform:scale(1.1) rotate(-6deg);
  background:rgba(201,168,76,0.18);
}
.service-card h3 {
  font-family:var(--font-display); font-size:1.3rem; font-weight:600;
  color:var(--text); margin-bottom:13px; line-height:1.25;
}
.service-card p { font-size:.9rem; color:var(--text-muted); line-height:1.82 }
.service-link {
  display:inline-flex; align-items:center; gap:6px; margin-top:22px;
  font-size:.8rem; font-weight:700; color:var(--gold);
  letter-spacing:.06em; text-transform:uppercase;
  transition:gap var(--transition);
}
.service-link:hover { gap:10px }

/* ═══════════════════════════════════════════════
   NETWORK
   ═══════════════════════════════════════════════ */
#network { background:var(--bg-alt) }
.network-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:24px }
.network-card {
  background:var(--bg-card); border-radius:var(--radius-lg); padding:34px 24px;
  text-align:center; border:1px solid var(--border); transition:all var(--transition);
  position:relative; overflow:hidden;
}
.network-card::after {
  content:''; position:absolute; inset:0; border-radius:var(--radius-lg);
  border:2px solid var(--gold); opacity:0; transition:opacity var(--transition);
}
.network-card:hover { box-shadow:var(--shadow-md); transform:translateY(-7px) }
.network-card:hover::after { opacity:1 }
.network-avatar {
  width:96px; height:96px; border-radius:50%; margin:0 auto 22px;
  overflow:hidden; background:var(--navy-mid);
  border:3px solid var(--gold-pale);
  transition:border-color var(--transition), box-shadow var(--transition);
}
.network-card:hover .network-avatar { border-color:var(--gold); box-shadow:0 0 0 4px rgba(201,168,76,0.15) }
.network-avatar img { width:100%; height:100%; object-fit:cover }
.network-initials {
  width:100%; height:100%; display:flex; align-items:center; justify-content:center;
  font-family:var(--font-display); font-size:1.8rem; font-weight:600; color:#fff;
}
.network-name { font-family:var(--font-display); font-size:1.15rem; font-weight:600; color:var(--text); margin-bottom:5px }
.network-title { font-size:.75rem; font-weight:700; color:var(--gold); letter-spacing:.08em; text-transform:uppercase; margin-bottom:14px }
.network-bio { font-size:.82rem; color:var(--text-muted); line-height:1.72 }

/* ═══════════════════════════════════════════════
   CLIENTS
   ═══════════════════════════════════════════════ */
#clients { padding:68px 0; background:var(--bg); border-top:1px solid var(--border); border-bottom:1px solid var(--border) }
.clients-heading { text-align:center; margin-bottom:44px }
.clients-heading p { font-size:.72rem; letter-spacing:.22em; text-transform:uppercase; color:var(--text-muted); font-weight:700 }
.clients-track { overflow:hidden; position:relative }
.clients-track::before,.clients-track::after {
  content:''; position:absolute; top:0; bottom:0; width:100px; z-index:2;
}
.clients-track::before { left:0; background:linear-gradient(to right,var(--bg),transparent) }
.clients-track::after  { right:0; background:linear-gradient(to left,var(--bg),transparent) }
.clients-marquee { display:flex; gap:64px; align-items:center; animation:marquee 30s linear infinite; width:max-content }
.clients-marquee:hover { animation-play-state:paused }
.client-logo {
  display:flex; flex-direction:column; align-items:center; gap:8px;
  opacity:.45; filter:grayscale(1); transition:all 0.4s ease; flex-shrink:0;
}
.client-logo:hover { opacity:1; filter:grayscale(0) }
[data-theme="dark"] .client-logo { filter:grayscale(1) brightness(1.6); opacity:.4 }
[data-theme="dark"] .client-logo:hover { filter:grayscale(0) brightness(1.1); opacity:1 }
.client-logo img { height:44px; width:auto; object-fit:contain }
.client-logo-placeholder {
  width:120px; height:44px; background:var(--border); border-radius:6px;
  display:flex; align-items:center; justify-content:center;
}
.client-logo-placeholder span { font-size:.72rem; font-weight:600; color:var(--text-muted); text-align:center; padding:0 8px }
@keyframes marquee { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }

/* ═══════════════════════════════════════════════
   TESTIMONIALS
   ═══════════════════════════════════════════════ */
#testimonials { background:var(--navy); padding:104px 0 }
[data-theme="dark"] #testimonials { background:#071224 }
.testimonials-inner { max-width:820px; margin:0 auto; text-align:center }
.testimonials-inner .section-eyebrow { color:var(--gold-light); justify-content:center }
.testimonials-inner .section-eyebrow::before { display:none }
.testimonials-inner h2 { color:#fff }
.testimonials-inner .gold-line { margin-left:auto; margin-right:auto }
.testimonial-item { position:relative; padding:52px 0 28px }
.quote-mark {
  font-family:var(--font-display); font-size:9rem; line-height:.5;
  color:var(--gold); opacity:.18; position:absolute; top:0; left:50%;
  transform:translateX(-50%); user-select:none;
}
.testimonial-text {
  font-family:var(--font-display); font-size:clamp(1.35rem,3vw,2rem);
  font-style:italic; color:rgba(255,255,255,0.95); line-height:1.55;
  position:relative; z-index:1; margin-bottom:40px;
}
.testimonial-author { display:flex; align-items:center; justify-content:center; gap:18px }
.author-avatar {
  width:56px; height:56px; border-radius:50%; overflow:hidden;
  background:var(--navy-light); border:2px solid var(--gold); flex-shrink:0;
}
.author-avatar img { width:100%; height:100%; object-fit:cover }
.author-initials-circle {
  width:100%; height:100%; display:flex; align-items:center; justify-content:center;
  font-family:var(--font-display); font-size:1.3rem; color:#fff;
}
.author-name { font-weight:600; color:#fff; font-size:.97rem }
.author-title { font-size:.78rem; color:rgba(255,255,255,.45); margin-top:2px }
.testimonial-nav { display:flex; justify-content:center; gap:10px; margin-top:40px }
.testimonial-dot {
  width:8px; height:8px; border-radius:50%;
  background:rgba(255,255,255,.22); border:none; cursor:pointer; transition:all var(--transition);
}
.testimonial-dot.active { background:var(--gold); width:26px; border-radius:4px }

/* ═══════════════════════════════════════════════
   GALLERY
   ═══════════════════════════════════════════════ */
#gallery { background:var(--bg) }
.gallery-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px }
.gallery-item {
  position:relative; border-radius:var(--radius); overflow:hidden;
  aspect-ratio:4/3; background:var(--border); cursor:pointer; margin:0;
}
.gallery-item img { width:100%; height:100%; object-fit:cover; transition:transform 0.55s ease }
.gallery-item:hover img { transform:scale(1.08) }
.gallery-placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:var(--bg-alt); color:var(--text-muted) }
.gallery-overlay {
  position:absolute; inset:0;
  background:linear-gradient(to top,rgba(10,24,44,.85) 0%,rgba(10,24,44,.15) 55%,transparent 100%);
  opacity:0; transition:opacity 0.4s ease;
  display:flex; flex-direction:column; align-items:center; justify-content:center; gap:12px;
}
.gallery-item:hover .gallery-overlay,
.gallery-item:focus .gallery-overlay { opacity:1 }
.gallery-overlay-icon {
  width:54px; height:54px; border-radius:50%;
  background:rgba(201,168,76,0.92); display:flex; align-items:center;
  justify-content:center; color:var(--navy); transform:scale(0.8);
  transition:transform 0.35s ease;
}
.gallery-item:hover .gallery-overlay-icon { transform:scale(1) }
.gallery-caption { position:absolute; bottom:16px; left:18px; right:18px; color:#fff; text-align:left }
.gallery-caption strong { display:block; font-family:var(--font-display); font-size:1rem; font-weight:600; line-height:1.3 }
.gallery-caption span { display:block; font-size:.78rem; color:rgba(255,255,255,.72); margin-top:4px; line-height:1.5 }
/* Lightbox */
.gallery-lightbox {
  position:fixed; inset:0; background:rgba(5,12,24,0.96);
  z-index:9000; display:flex; align-items:center; justify-content:center;
  padding:24px; backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px);
}
.lightbox-inner { position:relative; text-align:center; max-width:90vw }
.lightbox-close {
  position:fixed; top:24px; right:24px; width:50px; height:50px; border-radius:50%;
  background:rgba(255,255,255,0.1); border:1.5px solid rgba(255,255,255,0.2);
  color:#fff; display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:all var(--transition); z-index:9001;
}
.lightbox-close:hover { background:var(--gold); color:var(--navy); border-color:var(--gold) }
.lightbox-caption { margin-top:18px; color:#fff; text-align:center }
.lightbox-caption strong { display:block; font-family:var(--font-display); font-size:1.15rem; font-weight:600 }
.lightbox-caption span { display:block; font-size:.85rem; color:rgba(255,255,255,.6); margin-top:5px }

/* ═══════════════════════════════════════════════
   CTA BANNER
   ═══════════════════════════════════════════════ */
#cta-banner { background:var(--bg-alt); padding:0 }
.cta-inner {
  background:linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
  border-radius:var(--radius-lg); padding:84px 80px; text-align:center;
  position:relative; overflow:hidden; margin:0 40px;
  border:1px solid rgba(201,168,76,0.15);
}
[data-theme="dark"] .cta-inner {
  background:linear-gradient(135deg, #0C1829 0%, var(--navy-mid) 100%);
  border-color:rgba(201,168,76,0.2);
}
.cta-inner::before {
  content:''; position:absolute; inset:0;
  background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23C9A84C' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  opacity:0.6;
}
.cta-inner::after {
  content:''; position:absolute; top:-60px; right:-60px;
  width:260px; height:260px; border-radius:50%;
  background:rgba(201,168,76,0.07); pointer-events:none;
}
.cta-inner h2 {
  font-family:var(--font-display); font-size:clamp(1.9rem,4vw,3rem);
  font-weight:600; color:#fff; margin-bottom:20px; position:relative; z-index:1;
}
.cta-inner p {
  font-size:1.05rem; color:rgba(255,255,255,.76); max-width:580px;
  margin:0 auto 38px; line-height:1.78; position:relative; z-index:1;
}
.cta-inner .btn { position:relative; z-index:1 }

/* ═══════════════════════════════════════════════
   CONTACT
   ═══════════════════════════════════════════════ */
#contact { background:var(--bg-alt) }
.contact-grid { display:grid; grid-template-columns:1fr 440px; gap:80px; align-items:start }
.contact-form {
  background:var(--bg-card); border-radius:var(--radius-lg); padding:50px;
  box-shadow:var(--shadow-md); border:1px solid var(--border);
}
.form-group { margin-bottom:24px }
.form-label { display:block; font-size:.82rem; font-weight:700; color:var(--text); margin-bottom:8px; letter-spacing:.02em }
.form-control {
  width:100%; padding:14px 18px; border:1.5px solid var(--border);
  border-radius:9px; font-size:.95rem; font-family:var(--font-body);
  color:var(--text); background:var(--bg-alt);
  transition:border-color var(--transition), box-shadow var(--transition), background var(--transition);
  outline:none;
}
.form-control:focus { border-color:var(--gold); box-shadow:0 0 0 4px rgba(201,168,76,0.12); background:var(--bg-card) }
textarea.form-control { resize:vertical; min-height:144px }
.form-submit { width:100% }
.contact-info { padding-top:8px }
.contact-info h3 { font-family:var(--font-display); font-size:1.6rem; color:var(--text); margin-bottom:10px }
.contact-info>.lead { margin-bottom:40px }
.contact-item { display:flex; align-items:flex-start; gap:16px; padding:20px 0; border-bottom:1px solid var(--border) }
.contact-item:last-child { border-bottom:none }
.contact-icon {
  width:46px; height:46px; border-radius:11px; background:var(--gold-pale);
  display:flex; align-items:center; justify-content:center; color:var(--navy); flex-shrink:0;
  transition:all var(--transition);
}
[data-theme="dark"] .contact-icon { color:var(--gold) }
.contact-item:hover .contact-icon { background:var(--gold); color:var(--navy) }
.contact-item-label { font-size:.73rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--text-muted); margin-bottom:3px }
.contact-item-value { font-size:.95rem; color:var(--text); font-weight:500 }
.contact-item-value a:hover { color:var(--gold) }
.success-msg {
  background:linear-gradient(135deg,#d4edda,#c3e6cb); border:1px solid #b2dfc1;
  color:#155724; padding:16px 20px; border-radius:9px; font-size:.9rem;
  margin-bottom:24px; display:flex; align-items:center; gap:10px;
}

/* ═══════════════════════════════════════════════
   FOOTER
   ═══════════════════════════════════════════════ */
.site-footer { background:var(--navy); padding:72px 0 36px }
[data-theme="dark"] .site-footer { background:#060E1C }
.footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr; gap:60px; padding-bottom:52px; border-bottom:1px solid rgba(255,255,255,.07) }
.footer-brand-mark { display:flex; align-items:center; gap:12px; margin-bottom:20px }
.footer-logo-mark {
  width:44px; height:44px; background:var(--gold); border-radius:10px;
  display:flex; align-items:center; justify-content:center;
  font-family:var(--font-display); font-size:1.4rem; font-weight:700; color:var(--navy);
}
.footer-brand-name { font-family:var(--font-display); font-size:1.3rem; font-weight:600; color:#fff }
.footer-tagline { font-size:.88rem; color:rgba(255,255,255,.48); line-height:1.72; max-width:290px; margin-bottom:24px }
.footer-socials { display:flex; gap:10px }
.social-link {
  width:40px; height:40px; border-radius:9px; background:rgba(255,255,255,.07);
  display:flex; align-items:center; justify-content:center;
  color:rgba(255,255,255,.55); transition:all var(--transition);
  border:1px solid rgba(255,255,255,.08);
}
.social-link:hover { background:var(--gold); color:var(--navy); border-color:var(--gold); transform:translateY(-2px) }
.footer-heading { font-size:.7rem; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:var(--gold); margin-bottom:22px }
.footer-nav { list-style:none; display:flex; flex-direction:column; gap:10px }
.footer-nav a { font-size:.88rem; color:rgba(255,255,255,.55); transition:all var(--transition); display:inline-block }
.footer-nav a:hover { color:var(--gold); transform:translateX(4px) }
.footer-contact-list { display:flex; flex-direction:column; gap:13px }
.footer-contact-item { display:flex; align-items:center; gap:11px; font-size:.85rem; color:rgba(255,255,255,.55) }
.footer-contact-item svg { color:var(--gold); flex-shrink:0 }
.footer-contact-item a:hover { color:var(--gold) }
.footer-bottom { display:flex; justify-content:space-between; align-items:center; padding-top:30px; gap:16px }
.footer-copy { font-size:.8rem; color:rgba(255,255,255,.3) }
.footer-legal { display:flex; gap:20px }
.footer-legal a { font-size:.8rem; color:rgba(255,255,255,.3); transition:color var(--transition) }
.footer-legal a:hover { color:var(--gold) }

/* ═══════════════════════════════════════════════
   SCROLL-TO-TOP
   ═══════════════════════════════════════════════ */
.scroll-top {
  position:fixed; bottom:32px; right:32px; z-index:500;
  width:50px; height:50px; border-radius:50%;
  background:var(--gold); color:var(--navy);
  display:flex; align-items:center; justify-content:center;
  box-shadow:var(--shadow-gold); cursor:pointer; border:none;
  transition:all var(--transition); opacity:0; pointer-events:none; transform:translateY(12px);
}
.scroll-top.visible { opacity:1; pointer-events:all; transform:translateY(0) }
.scroll-top:hover { background:var(--gold-light); transform:translateY(-4px); box-shadow:0 12px 28px rgba(201,168,76,0.45) }

/* ═══════════════════════════════════════════════
   RESPONSIVE
   ═══════════════════════════════════════════════ */
@media(max-width:1024px){
  .about-grid { grid-template-columns:1fr }
  .about-visual { position:static }
  .about-accent-card { right:16px }
  .services-grid { grid-template-columns:repeat(2,1fr) }
  .network-grid { grid-template-columns:repeat(2,1fr) }
  .contact-grid { grid-template-columns:1fr; gap:48px }
  .footer-grid { grid-template-columns:1fr 1fr }
  .stats-grid { grid-template-columns:repeat(2,1fr) }
  .cta-inner { padding:64px 48px; margin:0 24px }
  .gallery-grid { grid-template-columns:repeat(2,1fr) }
}
@media(max-width:768px){
  :root { --section-py:68px }
  .container { padding:0 24px }
  .nav-links,.nav-cta-wrap { display:none }
  .nav-hamburger { display:flex }
  .services-grid,.network-grid { grid-template-columns:1fr }
  .stats-grid { grid-template-columns:repeat(2,1fr) }
  .footer-grid { grid-template-columns:1fr; gap:40px }
  .footer-bottom { flex-direction:column; text-align:center }
  .cta-inner { padding:52px 28px; margin:0 16px; border-radius:var(--radius) }
  .hero-content { padding:0 8px }
  .slider-arrow { display:none }
  .contact-form { padding:36px 28px }
  .gallery-grid { grid-template-columns:repeat(2,1fr) }
}
@media(max-width:480px){
  :root { --section-py:52px }
  .stats-grid { grid-template-columns:1fr }
  .stat-item { padding:40px 24px; border-right:none; border-bottom:1px solid rgba(255,255,255,.07) }
  .hero-btns { flex-direction:column; gap:12px }
  .hero-btns .btn { width:100%; justify-content:center }
  .gallery-grid { grid-template-columns:1fr }
  .about-accent-card { position:static; margin-top:24px; right:auto }
}
</style>
</head>
<body>

@include('front.partials.nav')

<div id="mobile-menu" class="mobile-menu" role="dialog" aria-modal="true" aria-label="Navigation menu">
    <button class="mobile-close" onclick="closeMobileMenu()" aria-label="Close menu">✕</button>

    <div class="mob-theme-row">
        <span id="mobThemeLabel">Dark Mode</span>
        <button class="mob-theme-btn" id="mobThemeBtn" onclick="toggleTheme()" aria-label="Toggle theme"></button>
    </div>

    @foreach($sections->filter(fn($s)=>$s->nav_label && $s->is_visible) as $sec)
    <a href="{{ $sec->anchor }}" onclick="closeMobileMenu()">{{ $sec->nav_label }}</a>
    @endforeach
    <a href="#contact" class="btn btn-primary mob-cta" onclick="closeMobileMenu()">
        {{ $gs['cta_button_label'] ?? 'Book Free Consultation' }}
    </a>
</div>

<main id="home">
    @yield('content')
</main>

@include('front.partials.footer')

<button class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
</button>

<script>
/* ── Theme System ───────────────────────────────────── */
function setTheme(t) {
    document.documentElement.setAttribute('data-theme', t);
    localStorage.setItem('sk-theme', t);
    var lbl = document.getElementById('mobThemeLabel');
    if(lbl) lbl.textContent = t === 'dark' ? 'Light Mode' : 'Dark Mode';
}
function toggleTheme() {
    var cur = document.documentElement.getAttribute('data-theme');
    setTheme(cur === 'dark' ? 'light' : 'dark');
}
document.addEventListener('DOMContentLoaded', function(){
    var cur = document.documentElement.getAttribute('data-theme');
    var lbl = document.getElementById('mobThemeLabel');
    if(lbl) lbl.textContent = cur === 'dark' ? 'Light Mode' : 'Dark Mode';
});

/* ── Sticky nav ─────────────────────────────────────── */
const nav      = document.getElementById('siteNav');
const scrollTop = document.getElementById('scrollTop');
window.addEventListener('scroll', () => {
    const y = window.scrollY;
    nav.classList.toggle('scrolled', y > 60);
    scrollTop.classList.toggle('visible', y > 400);
    updateActiveNav();
}, { passive:true });

/* ── Active nav ─────────────────────────────────────── */
const pageSections = document.querySelectorAll('section[id]');
const navLinks     = document.querySelectorAll('.nav-links a[href^="#"]');
function updateActiveNav(){
    let current = '';
    pageSections.forEach(s => {
        if(window.scrollY >= s.offsetTop - 140) current = s.getAttribute('id');
    });
    navLinks.forEach(a => a.classList.toggle('active', a.getAttribute('href') === '#'+current));
}

/* ── Mobile menu ────────────────────────────────────── */
const hamburger = document.querySelector('.nav-hamburger');
function closeMobileMenu(){
    document.getElementById('mobile-menu').classList.remove('open');
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded','false');
    document.body.style.overflow = '';
}
hamburger.addEventListener('click', () => {
    const isOpen = document.getElementById('mobile-menu').classList.toggle('open');
    hamburger.classList.toggle('open', isOpen);
    hamburger.setAttribute('aria-expanded', isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
});

/* ── Scroll Reveal ──────────────────────────────────── */
(function(){
    const selectors = [
        '.section-header', '.service-card', '.network-card',
        '.gallery-item', '.about-grid', '.contact-form',
        '.contact-info', '.about-text', '.about-visual',
        '.stat-item', '.client-logo', '.testimonial-item',
        '.about-badges',
    ].join(',');

    const els = document.querySelectorAll(selectors);
    els.forEach((el, i) => {
        el.classList.add('sr-animate');
        const siblings = el.parentElement ? Array.from(el.parentElement.children).indexOf(el) : 0;
        if(siblings > 0 && siblings < 7) {
            el.classList.add('sr-delay-' + siblings);
        }
    });

    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if(e.isIntersecting){
                e.target.classList.add('sr-visible');
                obs.unobserve(e.target);
            }
        });
    }, { threshold:0.08, rootMargin:'0px 0px -40px 0px' });
    els.forEach(el => obs.observe(el));
})();

/* ── Counter animation ──────────────────────────────── */
function animateCounter(el){
    const target   = parseFloat(el.dataset.target);
    const isFloat  = el.dataset.float === '1';
    const duration = 2000;
    const start    = performance.now();
    (function update(now){
        const p  = Math.min((now - start) / duration, 1);
        const e  = 1 - Math.pow(1 - p, 3);
        el.textContent = isFloat ? (target * e).toFixed(1) : Math.floor(target * e);
        if(p < 1) requestAnimationFrame(update);
    })(start);
}
const counterObs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if(e.isIntersecting){ animateCounter(e.target); counterObs.unobserve(e.target); } });
}, { threshold:0.5 });
document.querySelectorAll('[data-counter]').forEach(el => counterObs.observe(el));

/* ── Lazy images ────────────────────────────────────── */
document.querySelectorAll('img[data-src]').forEach(img => {
    new IntersectionObserver(([e], obs) => {
        if(e.isIntersecting){ img.src = img.dataset.src; img.removeAttribute('data-src'); obs.unobserve(img); }
    }).observe(img);
});
</script>

@yield('scripts')
</body>
</html>
