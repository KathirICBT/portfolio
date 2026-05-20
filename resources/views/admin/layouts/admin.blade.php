<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard') – CMS Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
    (function(){
        var t = localStorage.getItem('sk-admin-theme') ||
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        document.documentElement.setAttribute('data-theme', t);
    })();
    </script>
<style>
/* ═══════════════════════════════════════════
   ADMIN DESIGN TOKENS
   ═══════════════════════════════════════════ */
:root {
  --navy:         #0F2644;
  --navy-mid:     #1A3A5C;
  --gold:         #C9A84C;
  --gold-light:   #E2C57A;
  --gold-pale:    #F7F0DC;

  /* Light theme */
  --bg:           #F0F3F8;
  --surface:      #FFFFFF;
  --surface-alt:  #F7F9FC;
  --text:         #1A2332;
  --text-muted:   #64748B;
  --border:       #E2E8F0;
  --sidebar-bg:   #0F2644;
  --sidebar-text: rgba(255,255,255,0.68);
  --sidebar-hover:rgba(255,255,255,0.08);
  --sidebar-active:rgba(201,168,76,0.18);
  --topbar-bg:    #FFFFFF;
  --shadow-xs:    0 1px 3px rgba(15,38,68,0.08), 0 1px 2px rgba(15,38,68,0.04);
  --shadow-sm:    0 2px 8px rgba(15,38,68,0.08), 0 1px 3px rgba(15,38,68,0.05);
  --shadow-md:    0 4px 16px rgba(15,38,68,0.1), 0 2px 6px rgba(15,38,68,0.06);
  --danger:       #EF4444;
  --success:      #22C55E;
  --warning:      #F59E0B;
  --info:         #3B82F6;
  --radius:       10px;
  --radius-sm:    7px;
  --transition:   0.2s ease;
  --sidebar-w:    264px;
  --topbar-h:     64px;
  --font:         'DM Sans', system-ui, sans-serif;
}
[data-theme="dark"] {
  --bg:           #0B1829;
  --surface:      #112236;
  --surface-alt:  #0E1E30;
  --text:         #DDE4EF;
  --text-muted:   #7A9ABF;
  --border:       #1A3254;
  --sidebar-bg:   #070F1C;
  --sidebar-text: rgba(255,255,255,0.6);
  --sidebar-hover:rgba(255,255,255,0.07);
  --sidebar-active:rgba(201,168,76,0.15);
  --topbar-bg:    #112236;
  --shadow-xs:    0 1px 3px rgba(0,0,0,0.25);
  --shadow-sm:    0 2px 8px rgba(0,0,0,0.3);
  --shadow-md:    0 4px 16px rgba(0,0,0,0.4);
  --gold-pale:    rgba(201,168,76,0.1);
}

/* ── Reset ─── */
*,*::before,*::after { box-sizing:border-box; margin:0; padding:0 }
body {
  font-family:var(--font); background:var(--bg); color:var(--text);
  font-size:14px; line-height:1.6;
  transition:background-color 0.3s ease, color 0.3s ease;
}
a { text-decoration:none; color:inherit }
input,textarea,select,button { font-family:inherit; font-size:inherit }
img { max-width:100%; display:block }
:focus-visible { outline:2px solid var(--gold); outline-offset:2px; border-radius:4px }

/* ═══════════════════════════════════════════
   LAYOUT
   ═══════════════════════════════════════════ */
.admin-wrap { display:flex; min-height:100vh }
.sidebar {
  width:var(--sidebar-w); background:var(--sidebar-bg);
  position:fixed; top:0; left:0; bottom:0; overflow-y:auto;
  z-index:200; display:flex; flex-direction:column;
  transition:background var(--transition), transform 0.3s ease;
}
.main-area { margin-left:var(--sidebar-w); flex:1; display:flex; flex-direction:column; min-height:100vh }
.topbar {
  height:var(--topbar-h); background:var(--topbar-bg);
  border-bottom:1px solid var(--border);
  display:flex; align-items:center; justify-content:space-between;
  padding:0 28px; position:sticky; top:0; z-index:100;
  box-shadow:var(--shadow-xs);
  transition:background var(--transition);
}
.page-body { padding:28px; flex:1 }

/* ═══════════════════════════════════════════
   SIDEBAR
   ═══════════════════════════════════════════ */
.sidebar-brand {
  padding:22px 18px 18px;
  border-bottom:1px solid rgba(255,255,255,0.07);
  flex-shrink:0;
}
.brand-logo { display:flex; align-items:center; gap:10px }
.brand-mark {
  width:38px; height:38px; background:var(--gold); border-radius:9px;
  display:flex; align-items:center; justify-content:center;
  font-size:1.1rem; font-weight:700; color:var(--navy); flex-shrink:0;
  transition:transform var(--transition);
}
.brand-logo:hover .brand-mark { transform:rotate(-5deg) scale(1.05) }
.brand-text strong { display:block; color:#fff; font-size:.9rem; font-weight:600; line-height:1.2 }
.brand-text span { display:block; color:rgba(255,255,255,0.38); font-size:.64rem; letter-spacing:.1em; text-transform:uppercase }

.nav-section { padding:14px 10px 4px }
.nav-section-label {
  font-size:.6rem; letter-spacing:.16em; text-transform:uppercase;
  color:rgba(255,255,255,0.28); font-weight:700; padding:0 10px; margin-bottom:5px;
}
.nav-item {
  display:flex; align-items:center; gap:10px; padding:9px 12px;
  border-radius:8px; color:var(--sidebar-text); font-size:.84rem; font-weight:500;
  transition:all var(--transition); cursor:pointer; margin-bottom:2px; position:relative;
}
.nav-item:hover { background:var(--sidebar-hover); color:#fff }
.nav-item.active {
  background:var(--sidebar-active); color:var(--gold);
}
.nav-item.active::before {
  content:''; position:absolute; left:0; top:6px; bottom:6px;
  width:3px; background:var(--gold); border-radius:0 2px 2px 0;
}
.nav-item svg { flex-shrink:0; opacity:.65; transition:opacity var(--transition) }
.nav-item:hover svg, .nav-item.active svg { opacity:1 }

.sidebar-footer {
  margin-top:auto; padding:14px 10px;
  border-top:1px solid rgba(255,255,255,0.06); flex-shrink:0;
}

/* ═══════════════════════════════════════════
   TOPBAR
   ═══════════════════════════════════════════ */
.topbar-breadcrumb h1 { font-size:.98rem; font-weight:700; color:var(--text) }
.topbar-breadcrumb p { font-size:.73rem; color:var(--text-muted); margin-top:1px }
.topbar-actions { display:flex; align-items:center; gap:10px }
.topbar-user {
  display:flex; align-items:center; gap:10px; padding:7px 14px;
  border-radius:9px; background:var(--bg); border:1px solid var(--border);
  transition:border-color var(--transition);
}
.topbar-user:hover { border-color:var(--gold) }
.user-avatar {
  width:30px; height:30px; border-radius:50%; background:var(--gold);
  display:flex; align-items:center; justify-content:center;
  font-size:.85rem; font-weight:700; color:var(--navy); flex-shrink:0;
}
.user-name { font-size:.82rem; font-weight:600; color:var(--text) }

/* Admin theme toggle */
.admin-theme-btn {
  width:36px; height:36px; border-radius:8px;
  background:var(--bg); border:1px solid var(--border);
  color:var(--text-muted); display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:all var(--transition);
}
.admin-theme-btn:hover { border-color:var(--gold); color:var(--gold); background:var(--gold-pale) }
.admin-theme-btn .icon-sun { display:none }
.admin-theme-btn .icon-moon { display:block }
[data-theme="dark"] .admin-theme-btn .icon-sun { display:block }
[data-theme="dark"] .admin-theme-btn .icon-moon { display:none }

/* Live site btn */
.topbar-live {
  display:flex; align-items:center; gap:6px; padding:7px 14px;
  border-radius:9px; background:var(--bg); border:1px solid var(--border);
  color:var(--text-muted); font-size:.78rem; font-weight:600;
  transition:all var(--transition);
}
.topbar-live:hover { border-color:var(--gold); color:var(--gold) }

/* ═══════════════════════════════════════════
   ALERTS
   ═══════════════════════════════════════════ */
.alert {
  padding:13px 18px; border-radius:9px; font-size:.84rem;
  margin-bottom:20px; display:flex; align-items:center; gap:10px;
  border:1px solid transparent; animation:alertIn 0.35s ease;
}
@keyframes alertIn { from{opacity:0;transform:translateY(-6px)} to{opacity:1;transform:translateY(0)} }
.alert-success { background:#f0fdf4; color:#166534; border-color:#bbf7d0 }
.alert-danger   { background:#fef2f2; color:#991b1b; border-color:#fecaca }
.alert-warning  { background:#fffbeb; color:#92400e; border-color:#fde68a }
[data-theme="dark"] .alert-success { background:rgba(34,197,94,0.1); color:#86efac; border-color:rgba(34,197,94,0.25) }
[data-theme="dark"] .alert-danger  { background:rgba(239,68,68,0.1); color:#fca5a5; border-color:rgba(239,68,68,0.25) }
[data-theme="dark"] .alert-warning { background:rgba(245,158,11,0.1); color:#fcd34d; border-color:rgba(245,158,11,0.25) }

/* ═══════════════════════════════════════════
   CARDS
   ═══════════════════════════════════════════ */
.card {
  background:var(--surface); border-radius:var(--radius);
  border:1px solid var(--border); box-shadow:var(--shadow-xs);
  transition:box-shadow var(--transition);
}
.card-header {
  padding:18px 22px; border-bottom:1px solid var(--border);
  display:flex; align-items:center; justify-content:space-between;
}
.card-header h2 { font-size:.92rem; font-weight:700; color:var(--text); letter-spacing:.01em }
.card-body { padding:22px }

/* ═══════════════════════════════════════════
   BUTTONS
   ═══════════════════════════════════════════ */
.btn {
  display:inline-flex; align-items:center; gap:6px;
  padding:9px 18px; border-radius:8px; font-size:.82rem; font-weight:600;
  cursor:pointer; transition:all var(--transition);
  border:1.5px solid transparent; white-space:nowrap;
}
.btn-primary { background:var(--gold); color:var(--navy); border-color:var(--gold) }
.btn-primary:hover { background:var(--gold-light); filter:brightness(1.04); transform:translateY(-1px); box-shadow:0 4px 12px rgba(201,168,76,0.35) }
.btn-navy { background:var(--navy); color:#fff; border-color:var(--navy) }
.btn-navy:hover { background:var(--navy-mid) }
.btn-outline { background:transparent; color:var(--text); border-color:var(--border) }
.btn-outline:hover { border-color:var(--text-muted); background:var(--bg) }
.btn-danger { background:#fef2f2; color:var(--danger); border-color:#fecaca }
.btn-danger:hover { background:var(--danger); color:#fff; border-color:var(--danger) }
[data-theme="dark"] .btn-danger { background:rgba(239,68,68,0.1); border-color:rgba(239,68,68,0.3) }
[data-theme="dark"] .btn-danger:hover { background:var(--danger); border-color:var(--danger) }
.btn-sm { padding:5px 12px; font-size:.75rem }
.btn-icon { width:34px; height:34px; padding:0; justify-content:center; border-radius:8px }

/* ═══════════════════════════════════════════
   FORMS
   ═══════════════════════════════════════════ */
.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px }
.form-grid-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:20px }
.form-full { grid-column:1/-1 }
.form-group { display:flex; flex-direction:column; gap:6px }
.form-label { font-size:.78rem; font-weight:700; color:var(--text); letter-spacing:.02em }
.form-label .req { color:var(--gold) }
.form-control {
  padding:9px 14px; border:1.5px solid var(--border); border-radius:8px;
  color:var(--text); background:var(--surface-alt);
  transition:border-color var(--transition), box-shadow var(--transition), background var(--transition);
  outline:none;
}
.form-control:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,168,76,0.14); background:var(--surface) }
textarea.form-control { resize:vertical; min-height:110px }
.form-hint { font-size:.72rem; color:var(--text-muted) }
.form-error { font-size:.72rem; color:var(--danger) }
.char-count { font-size:.7rem; color:var(--text-muted); text-align:right; margin-top:2px }

/* ═══════════════════════════════════════════
   TABLES
   ═══════════════════════════════════════════ */
.table-wrap { overflow-x:auto; border-radius:0 0 var(--radius) var(--radius) }
table { width:100%; border-collapse:collapse }
thead th {
  padding:11px 16px; background:var(--surface-alt);
  font-size:.68rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
  color:var(--text-muted); text-align:left; border-bottom:1px solid var(--border);
  white-space:nowrap;
}
tbody td { padding:13px 16px; border-bottom:1px solid var(--border); font-size:.84rem; vertical-align:middle }
tbody tr:last-child td { border-bottom:none }
tbody tr { transition:background var(--transition) }
tbody tr:hover td { background:var(--surface-alt) }
.td-thumb { width:52px; height:40px; border-radius:6px; object-fit:cover; background:var(--bg) }
.td-thumb-placeholder {
  width:52px; height:40px; border-radius:6px; background:var(--bg);
  display:flex; align-items:center; justify-content:center; color:var(--text-muted);
}

/* ═══════════════════════════════════════════
   BADGES
   ═══════════════════════════════════════════ */
.badge {
  display:inline-flex; align-items:center; gap:4px;
  padding:3px 10px; border-radius:20px;
  font-size:.68rem; font-weight:700; letter-spacing:.04em;
}
.badge-green  { background:#dcfce7; color:#166534 }
.badge-red    { background:#fee2e2; color:#991b1b }
.badge-yellow { background:#fef3c7; color:#92400e }
.badge-blue   { background:#dbeafe; color:#1e40af }
[data-theme="dark"] .badge-green  { background:rgba(34,197,94,0.15); color:#86efac }
[data-theme="dark"] .badge-red    { background:rgba(239,68,68,0.15); color:#fca5a5 }
[data-theme="dark"] .badge-yellow { background:rgba(245,158,11,0.15); color:#fcd34d }
[data-theme="dark"] .badge-blue   { background:rgba(59,130,246,0.15); color:#93c5fd }

/* ═══════════════════════════════════════════
   DASHBOARD STATS
   ═══════════════════════════════════════════ */
.dash-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-bottom:22px }
.dash-stat {
  background:var(--surface); border:1px solid var(--border); border-radius:var(--radius);
  padding:22px; display:flex; align-items:flex-start; justify-content:space-between;
  transition:all var(--transition); box-shadow:var(--shadow-xs);
}
.dash-stat:hover { box-shadow:var(--shadow-sm); border-color:var(--gold); transform:translateY(-2px) }
.dash-stat-info h3 { font-size:1.9rem; font-weight:700; color:var(--navy); line-height:1 }
[data-theme="dark"] .dash-stat-info h3 { color:var(--gold) }
.dash-stat-info p { font-size:.78rem; color:var(--text-muted); font-weight:600; margin-top:5px; letter-spacing:.01em }
.dash-stat-icon {
  width:46px; height:46px; border-radius:11px;
  display:flex; align-items:center; justify-content:center; color:var(--navy); flex-shrink:0;
}
[data-theme="dark"] .dash-stat-icon { color:var(--gold); filter:brightness(0.85) }

.quick-actions { display:grid; grid-template-columns:repeat(auto-fit,minmax(170px,1fr)); gap:12px }
.quick-action-btn {
  background:var(--surface); border:1.5px solid var(--border); border-radius:var(--radius);
  padding:16px; display:flex; align-items:center; gap:12px;
  transition:all var(--transition); cursor:pointer; color:var(--text);
  font-weight:600; font-size:.83rem;
}
.quick-action-btn:hover { border-color:var(--gold); background:var(--gold-pale); color:var(--navy); transform:translateY(-2px); box-shadow:var(--shadow-sm) }
[data-theme="dark"] .quick-action-btn:hover { background:rgba(201,168,76,0.1); color:var(--gold) }

/* ═══════════════════════════════════════════
   TOGGLE SWITCH
   ═══════════════════════════════════════════ */
.toggle-wrap { display:flex; align-items:center; gap:10px }
.toggle { position:relative; display:inline-block; width:42px; height:24px }
.toggle input { opacity:0; width:0; height:0; position:absolute }
.toggle-slider {
  position:absolute; inset:0; background:#CBD5E1; border-radius:24px;
  cursor:pointer; transition:var(--transition);
}
.toggle-slider::before {
  content:''; position:absolute; width:18px; height:18px;
  left:3px; top:3px; background:#fff; border-radius:50%;
  transition:var(--transition); box-shadow:0 1px 3px rgba(0,0,0,0.2);
}
.toggle input:checked + .toggle-slider { background:var(--gold) }
.toggle input:checked + .toggle-slider::before { transform:translateX(18px) }
.toggle-label { font-size:.82rem; font-weight:500; color:var(--text) }

/* ═══════════════════════════════════════════
   MEDIA GRID
   ═══════════════════════════════════════════ */
.media-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(145px,1fr)); gap:14px }
.media-item {
  border:1.5px solid var(--border); border-radius:var(--radius);
  overflow:hidden; background:var(--surface); transition:all var(--transition);
  cursor:pointer; position:relative;
}
.media-item:hover { border-color:var(--gold); box-shadow:var(--shadow-md) }
.media-item.selected { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,168,76,0.25) }
.media-item img { width:100%; height:96px; object-fit:cover; display:block }
.media-item-info { padding:9px 11px }
.media-item-name { font-size:.7rem; color:var(--text-muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis }
.media-item-size { font-size:.65rem; color:var(--border) }
.media-check {
  position:absolute; top:6px; right:6px; width:22px; height:22px; border-radius:50%;
  background:var(--gold); display:none; align-items:center; justify-content:center;
  box-shadow:0 2px 6px rgba(0,0,0,0.2);
}
.media-item.selected .media-check { display:flex }
.upload-zone {
  border:2px dashed var(--border); border-radius:var(--radius); padding:44px;
  text-align:center; cursor:pointer; transition:all var(--transition); background:var(--bg);
}
.upload-zone:hover, .upload-zone.drag { border-color:var(--gold); background:var(--gold-pale) }
[data-theme="dark"] .upload-zone:hover { background:rgba(201,168,76,0.08) }
.upload-zone p { color:var(--text-muted); font-size:.85rem; margin-top:10px }

/* ═══════════════════════════════════════════
   RESPONSIVE
   ═══════════════════════════════════════════ */
@media(max-width:960px){
  .sidebar { transform:translateX(-100%) }
  .sidebar.open { transform:translateX(0) }
  .main-area { margin-left:0 }
  .form-grid,.form-grid-3 { grid-template-columns:1fr }
  .dash-grid { grid-template-columns:repeat(2,1fr) }
  .topbar-hamburger { display:flex !important }
}
@media(max-width:600px){
  .dash-grid { grid-template-columns:1fr }
  .page-body { padding:18px }
  .topbar { padding:0 18px }
  .topbar-live span { display:none }
}

/* ═══════════════════════════════════════════
   MOBILE SIDEBAR BACKDROP
   ═══════════════════════════════════════════ */
.sidebar-backdrop {
  display:none; position:fixed; inset:0;
  background:rgba(0,0,0,0.55); z-index:199;
  backdrop-filter:blur(3px);
  animation:backdropIn 0.25s ease;
}
.sidebar-backdrop.show { display:block }
@keyframes backdropIn { from{opacity:0} to{opacity:1} }

/* Topbar hamburger */
.topbar-hamburger {
  display:none; flex-direction:column; justify-content:center; gap:5px;
  width:38px; height:38px; padding:8px;
  background:var(--bg); border:1px solid var(--border);
  border-radius:8px; cursor:pointer;
  transition:border-color var(--transition), background var(--transition); flex-shrink:0;
}
.topbar-hamburger:hover { border-color:var(--gold); background:var(--gold-pale) }
.topbar-hamburger span {
  display:block; width:100%; height:2px;
  background:var(--text); border-radius:2px;
  transition:all 0.25s cubic-bezier(0.4,0,0.2,1);
}
.topbar-hamburger.is-open span:nth-child(1) { transform:translateY(7px) rotate(45deg) }
.topbar-hamburger.is-open span:nth-child(2) { opacity:0; transform:scaleX(0) }
.topbar-hamburger.is-open span:nth-child(3) { transform:translateY(-7px) rotate(-45deg) }

/* ═══════════════════════════════════════════
   TOAST NOTIFICATIONS
   ═══════════════════════════════════════════ */
.toast-container {
  position:fixed; top:80px; right:20px; z-index:9999;
  display:flex; flex-direction:column; gap:10px;
  pointer-events:none;
}
.toast {
  display:flex; align-items:flex-start; gap:12px;
  padding:14px 16px; border-radius:var(--radius);
  background:var(--surface); border:1px solid var(--border);
  box-shadow:var(--shadow-md); pointer-events:all;
  min-width:300px; max-width:380px;
  animation:toastIn 0.3s cubic-bezier(0.4,0,0.2,1) forwards;
  border-left:4px solid transparent; position:relative;
}
.toast-success { border-left-color:var(--success) }
.toast-error   { border-left-color:var(--danger) }
.toast-warning { border-left-color:var(--warning) }
.toast-info    { border-left-color:var(--info) }
.toast-icon { flex-shrink:0; margin-top:1px }
.toast-icon svg { display:block }
.toast-body { flex:1; min-width:0 }
.toast-title { font-size:.83rem; font-weight:700; color:var(--text); line-height:1.3 }
.toast-msg   { font-size:.78rem; color:var(--text-muted); margin-top:2px; line-height:1.4 }
.toast-close {
  flex-shrink:0; background:none; border:none; cursor:pointer;
  color:var(--text-muted); padding:2px 4px; border-radius:4px;
  line-height:1; font-size:1rem; opacity:0.5;
  transition:opacity var(--transition);
}
.toast-close:hover { opacity:1 }
.toast.toast-hiding { animation:toastOut 0.25s ease forwards }
@keyframes toastIn  { from{opacity:0;transform:translateX(24px)} to{opacity:1;transform:translateX(0)} }
@keyframes toastOut { from{opacity:1;transform:translateX(0)} to{opacity:0;transform:translateX(24px)} }

/* ═══════════════════════════════════════════
   INLINE STATUS TOGGLE (AJAX)
   ═══════════════════════════════════════════ */
.status-toggle-btn {
  display:inline-flex; align-items:center; gap:6px;
  padding:4px 10px; border-radius:20px; font-size:.68rem;
  font-weight:700; letter-spacing:.04em; cursor:pointer;
  border:none; transition:all var(--transition);
}
.status-toggle-btn.is-active {
  background:#dcfce7; color:#166534;
}
.status-toggle-btn.is-inactive {
  background:#fee2e2; color:#991b1b;
}
[data-theme="dark"] .status-toggle-btn.is-active  { background:rgba(34,197,94,0.15); color:#86efac }
[data-theme="dark"] .status-toggle-btn.is-inactive { background:rgba(239,68,68,0.15); color:#fca5a5 }
.status-toggle-btn:hover { filter:brightness(0.92); transform:scale(0.97) }
.status-toggle-btn.is-loading { opacity:0.6; pointer-events:none }

/* ═══════════════════════════════════════════
   PAGE HEADER (index pages)
   ═══════════════════════════════════════════ */
.page-header {
  display:flex; align-items:flex-start; justify-content:space-between;
  gap:16px; margin-bottom:20px; flex-wrap:wrap;
}
.page-header-left h1 { font-size:1.1rem; font-weight:700; color:var(--text) }
.page-header-left p  { font-size:.78rem; color:var(--text-muted); margin-top:2px }
.filter-bar {
  display:flex; align-items:center; gap:10px; flex-wrap:wrap;
  margin-bottom:16px;
}
.filter-bar .search-wrap { position:relative; flex:1; min-width:200px; max-width:320px }
.filter-bar .search-wrap svg { position:absolute; left:11px; top:50%; transform:translateY(-50%); pointer-events:none; color:var(--text-muted) }
.filter-bar .search-input {
  width:100%; padding:8px 12px 8px 34px;
  border:1.5px solid var(--border); border-radius:8px;
  font-size:.82rem; color:var(--text); background:var(--surface-alt);
  transition:border-color var(--transition), box-shadow var(--transition); outline:none;
}
.filter-bar .search-input:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,168,76,0.14); background:var(--surface) }
.filter-select {
  padding:8px 12px; border:1.5px solid var(--border); border-radius:8px;
  font-size:.82rem; color:var(--text); background:var(--surface-alt);
  cursor:pointer; outline:none;
  transition:border-color var(--transition);
}
.filter-select:focus { border-color:var(--gold) }

/* Empty state */
.empty-state {
  text-align:center; padding:64px 32px; color:var(--text-muted);
}
.empty-state svg { margin:0 auto 16px; opacity:0.3 }
.empty-state h3 { font-size:.95rem; font-weight:700; color:var(--text); margin-bottom:6px }
.empty-state p { font-size:.82rem; margin-bottom:20px }

/* Dashboard welcome */
.dash-welcome {
  background:linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
  border-radius:var(--radius); padding:24px 28px;
  display:flex; align-items:center; justify-content:space-between;
  gap:16px; margin-bottom:22px; border:1px solid rgba(201,168,76,0.2);
  box-shadow:var(--shadow-sm);
}
.dash-welcome-text h2 { font-size:1.05rem; font-weight:700; color:#fff; margin-bottom:4px }
.dash-welcome-text p { font-size:.8rem; color:rgba(255,255,255,0.6) }
.dash-welcome-actions { display:flex; gap:8px; flex-shrink:0; flex-wrap:wrap }
.dash-welcome-actions .btn-sm { padding:6px 14px; font-size:.75rem }

/* Stat card top accent */
.dash-stat { border-top:3px solid transparent }
.dash-stat:hover { border-top-color:var(--gold) }
</style>
</head>
<body>
<div class="admin-wrap">

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="adminSidebar" role="navigation" aria-label="Admin navigation">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="brand-logo" style="text-decoration:none">
                <div class="brand-mark" aria-hidden="true">SK</div>
                <div class="brand-text">
                    <strong>{{ $gs['site_name'] ?? 'Suresh Kumar' }}</strong>
                    <span>CMS Admin</span>
                </div>
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-section-label">Overview</p>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-section-label">Content</p>
            <a href="{{ route('admin.sliders.index') }}" class="nav-item {{ request()->routeIs('admin.sliders*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="7" width="20" height="15" rx="2"/><polyline points="17 2 12 7 7 2"/></svg>
                Hero Sliders
            </a>
            <a href="{{ route('admin.services.index') }}" class="nav-item {{ request()->routeIs('admin.services*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41"/><path d="M4.93 4.93l1.41 1.41"/><path d="M19.07 19.07l-1.41-1.41"/><path d="M4.93 19.07l1.41-1.41"/><line x1="12" y1="2" x2="12" y2="4"/><line x1="12" y1="20" x2="12" y2="22"/><line x1="2" y1="12" x2="4" y2="12"/><line x1="20" y1="12" x2="22" y2="12"/></svg>
                Services
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-item {{ request()->routeIs('admin.testimonials*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Testimonials
            </a>
            <a href="{{ route('admin.network-profiles.index') }}" class="nav-item {{ request()->routeIs('admin.network-profiles*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Network Profiles
            </a>
            <a href="{{ route('admin.clients.index') }}" class="nav-item {{ request()->routeIs('admin.clients*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                Clients & Logos
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="nav-item {{ request()->routeIs('admin.gallery*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                Gallery
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-section-label">Pages</p>
            <a href="{{ route('admin.sections.index') }}" class="nav-item {{ request()->routeIs('admin.sections*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                Page Sections
            </a>
            <a href="{{ route('admin.stats.index') }}" class="nav-item {{ request()->routeIs('admin.stats*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg>
                Stats & Counters
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-section-label">Assets</p>
            <a href="{{ route('admin.media.index') }}" class="nav-item {{ request()->routeIs('admin.media*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/><rect x="2" y="2" width="20" height="20" rx="3"/></svg>
                Media Library
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-section-label">Settings</p>
            <a href="{{ route('admin.settings.edit') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M19.07 19.07l-1.41-1.41M4.93 19.07l1.41-1.41M12 2v2M12 20v2M2 12H4M20 12h2"/></svg>
                Site Settings
            </a>
            <a href="{{ route('admin.seo.edit') }}" class="nav-item {{ request()->routeIs('admin.seo*') ? 'active':'' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                SEO Settings
            </a>
        </div>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="nav-item" style="width:100%;text-align:left;background:none;border:none">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    {{-- Mobile backdrop overlay --}}
    <div class="sidebar-backdrop" id="sidebarBackdrop" aria-hidden="true"></div>

    {{-- MAIN AREA --}}
    <div class="main-area">
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:14px">
                <button class="topbar-hamburger" id="sidebarToggle" aria-label="Toggle navigation" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
                <div class="topbar-breadcrumb">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>@yield('page-subtitle', 'Manage your website content')</p>
                </div>
            </div>
            <div class="topbar-actions">
                {{-- Theme toggle --}}
                <button class="admin-theme-btn" onclick="toggleAdminTheme()" aria-label="Toggle dark/light mode">
                    <svg class="icon-moon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    <svg class="icon-sun" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                </button>
                {{-- Live site --}}
                <a href="{{ url('/') }}" target="_blank" class="topbar-live" aria-label="Preview live site in new tab">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    <span>Preview Site</span>
                </a>
                <div class="topbar-user">
                    <div class="user-avatar" aria-hidden="true">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <span class="user-name">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        <main class="page-body">
            @if(session('success'))
            <div class="alert alert-success" role="alert">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin-top:4px;padding-left:16px">
                        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

{{-- Toast notification container --}}
<div class="toast-container" id="toastContainer" aria-live="polite" aria-atomic="false"></div>

<script>
/* ── Theme ── */
function toggleAdminTheme(){
    var cur = document.documentElement.getAttribute('data-theme');
    var next = cur === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('sk-admin-theme', next);
}

/* ── Mobile Sidebar ── */
(function(){
    var sidebar   = document.getElementById('adminSidebar');
    var backdrop  = document.getElementById('sidebarBackdrop');
    var toggle    = document.getElementById('sidebarToggle');
    if(!sidebar || !backdrop || !toggle) return;

    function openSidebar(){
        sidebar.classList.add('open');
        backdrop.classList.add('show');
        toggle.classList.add('is-open');
        toggle.setAttribute('aria-expanded','true');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar(){
        sidebar.classList.remove('open');
        backdrop.classList.remove('show');
        toggle.classList.remove('is-open');
        toggle.setAttribute('aria-expanded','false');
        document.body.style.overflow = '';
    }
    toggle.addEventListener('click', function(){
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });
    backdrop.addEventListener('click', closeSidebar);
    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape') closeSidebar();
    });
})();

/* ── Toast System ── */
var CmsToast = (function(){
    var container = document.getElementById('toastContainer');
    var icons = {
        success: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
        error:   '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
        warning: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
        info:    '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
    };

    function show(type, title, msg, duration){
        if(!container) return;
        duration = duration || 4000;
        var el = document.createElement('div');
        el.className = 'toast toast-' + type;
        el.setAttribute('role','status');
        el.innerHTML =
            '<div class="toast-icon">' + (icons[type]||icons.info) + '</div>' +
            '<div class="toast-body">' +
                '<div class="toast-title">' + title + '</div>' +
                (msg ? '<div class="toast-msg">' + msg + '</div>' : '') +
            '</div>' +
            '<button class="toast-close" aria-label="Dismiss notification">✕</button>';
        el.querySelector('.toast-close').addEventListener('click', function(){ dismiss(el) });
        container.appendChild(el);
        var timer = setTimeout(function(){ dismiss(el) }, duration);
        el._timer = timer;
        return el;
    }
    function dismiss(el){
        if(!el || el._dismissing) return;
        el._dismissing = true;
        clearTimeout(el._timer);
        el.classList.add('toast-hiding');
        el.addEventListener('animationend', function(){ el.remove() }, {once:true});
    }
    return { show:show, dismiss:dismiss,
        success: function(t,m,d){ return show('success',t,m,d) },
        error:   function(t,m,d){ return show('error',t,m,d) },
        warning: function(t,m,d){ return show('warning',t,m,d) },
        info:    function(t,m,d){ return show('info',t,m,d) }
    };
})();

/* ── Auto-convert flash alerts to toasts ── */
document.addEventListener('DOMContentLoaded', function(){
    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(el){
        var type = el.classList.contains('alert-success') ? 'success'
                 : el.classList.contains('alert-danger')  ? 'error'
                 : el.classList.contains('alert-warning') ? 'warning' : 'info';
        var text = el.textContent.trim();
        if(text) CmsToast.show(type, text, null, 5000);
        el.style.display = 'none';
    });
});

/* ── Inline status toggle (AJAX) ── */
function toggleStatus(btn, url, csrfToken){
    btn.classList.add('is-loading');
    fetch(url, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(function(r){ return r.json() })
    .then(function(data){
        var active = data.is_active;
        btn.classList.remove('is-loading','is-active','is-inactive');
        btn.classList.add(active ? 'is-active' : 'is-inactive');
        btn.innerHTML = (active
            ? '<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Live'
            : '<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Draft');
        CmsToast.success('Status updated', 'Item is now ' + (active ? 'published.' : 'set to draft.'));
    })
    .catch(function(){
        btn.classList.remove('is-loading');
        CmsToast.error('Update failed', 'Could not toggle status. Please try again.');
    });
}
</script>
@stack('scripts')
</body>
</html>
