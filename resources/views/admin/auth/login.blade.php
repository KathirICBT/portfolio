<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In – {{ $gs['site_name'] ?? 'Suresh Kumar' }} CMS</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@500;600&display=swap" rel="stylesheet">
    <script>
    (function(){
        var t = localStorage.getItem('sk-admin-theme') ||
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        document.documentElement.setAttribute('data-theme', t);
    })();
    </script>
<style>
:root {
  --gold:#C9A84C; --gold-light:#E2C57A; --gold-pale:#F7F0DC;
  --navy:#0F2644; --navy-mid:#1A3A5C;
  --bg-brand:#0D1F38;
  --bg-form:#FFFFFF;
  --text:#1A2332; --text-muted:#64748B;
  --border:#E2E8F0; --input-bg:#F7F9FC;
  --shadow:0 20px 60px rgba(0,0,0,0.22);
  --radius:12px;
}
[data-theme="dark"] {
  --bg-brand:#060E1C;
  --bg-form:#112236;
  --text:#DDE4EF; --text-muted:#7A9ABF;
  --border:#1A3254; --input-bg:#0E1E30;
  --shadow:0 20px 60px rgba(0,0,0,0.55);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body {
  font-family:'DM Sans',system-ui,sans-serif;
  background:var(--bg-brand);
  min-height:100vh; display:flex;
  transition:background 0.3s ease;
}

/* ── Brand Panel (left) ── */
.login-brand-panel {
  flex:0 0 45%; display:flex; flex-direction:column;
  justify-content:space-between;
  background:linear-gradient(160deg, #0F2644 0%, #0A1829 60%, #071120 100%);
  padding:52px 56px; position:relative; overflow:hidden;
}
.login-brand-panel::before {
  content:''; position:absolute; top:-20%; right:-15%;
  width:500px; height:500px; border-radius:50%;
  background:radial-gradient(circle, rgba(201,168,76,0.12) 0%, transparent 65%);
  pointer-events:none;
}
.login-brand-panel::after {
  content:''; position:absolute; bottom:-10%; left:-10%;
  width:380px; height:380px; border-radius:50%;
  background:radial-gradient(circle, rgba(42,82,125,0.2) 0%, transparent 65%);
  pointer-events:none;
}
.brand-mark-lg {
  width:56px; height:56px; background:var(--gold); border-radius:14px;
  display:flex; align-items:center; justify-content:center;
  font-family:'Cormorant Garamond',serif; font-size:1.75rem; font-weight:600;
  color:var(--navy); box-shadow:0 8px 28px rgba(201,168,76,0.4);
  position:relative; z-index:1; flex-shrink:0;
}
.brand-panel-content { position:relative; z-index:1 }
.brand-panel-content h1 {
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(2rem,3.5vw,2.8rem); font-weight:600; color:#fff;
  line-height:1.15; letter-spacing:-0.02em; margin-bottom:18px;
}
.brand-panel-content p {
  font-size:.9rem; color:rgba(255,255,255,0.55); line-height:1.7; max-width:340px;
}
.brand-divider {
  width:40px; height:3px;
  background:linear-gradient(90deg, var(--gold), var(--gold-light));
  border-radius:2px; margin:20px 0;
}
.brand-stats {
  display:flex; gap:32px; margin-top:40px; position:relative; z-index:1;
}
.brand-stat-item strong {
  display:block; font-family:'Cormorant Garamond',serif;
  font-size:1.6rem; font-weight:600; color:var(--gold); line-height:1;
}
.brand-stat-item span { font-size:.75rem; color:rgba(255,255,255,0.45); margin-top:4px; display:block }
.brand-footer { font-size:.72rem; color:rgba(255,255,255,0.25); position:relative; z-index:1 }

/* ── Form Panel (right) ── */
.login-form-panel {
  flex:1; display:flex; flex-direction:column;
  align-items:center; justify-content:center;
  background:var(--bg-form); padding:52px 48px;
  transition:background 0.3s ease;
  position:relative;
}
.form-panel-inner { width:100%; max-width:400px }
.form-panel-header { margin-bottom:36px }
.form-panel-header h2 {
  font-family:'Cormorant Garamond',serif;
  font-size:1.9rem; font-weight:600; color:var(--text); margin-bottom:6px;
}
.form-panel-header p { font-size:.84rem; color:var(--text-muted) }

.form-group { margin-bottom:18px }
.form-label {
  display:block; font-size:.75rem; font-weight:700;
  color:var(--text); margin-bottom:7px; letter-spacing:.04em; text-transform:uppercase;
}
.form-control {
  width:100%; padding:12px 15px; border:1.5px solid var(--border);
  border-radius:var(--radius); font-size:.92rem; font-family:inherit;
  color:var(--text); background:var(--input-bg); outline:none;
  transition:border-color 0.2s, box-shadow 0.2s, background 0.2s;
}
.form-control:focus {
  border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,168,76,0.14);
  background:var(--bg-form);
}
.form-error { font-size:.72rem; color:#EF4444; margin-top:5px; display:block }

/* Password field with visibility toggle */
.password-wrap { position:relative }
.password-wrap .form-control { padding-right:46px }
.password-toggle {
  position:absolute; right:12px; top:50%; transform:translateY(-50%);
  background:none; border:none; cursor:pointer;
  color:var(--text-muted); padding:4px;
  border-radius:6px; display:flex; align-items:center;
  transition:color 0.2s;
}
.password-toggle:hover { color:var(--gold) }
.password-toggle:focus-visible { outline:2px solid var(--gold); outline-offset:2px }
.icon-eye-off { display:none }
.password-toggle.showing .icon-eye { display:none }
.password-toggle.showing .icon-eye-off { display:block }

.check-row { display:flex; align-items:center; gap:9px; margin-bottom:26px }
.check-row input { width:16px; height:16px; accent-color:var(--gold); cursor:pointer }
.check-row label { font-size:.82rem; color:var(--text-muted) }

.btn-login {
  width:100%; padding:14px; background:var(--gold); color:var(--navy);
  border:none; border-radius:var(--radius); font-size:.92rem; font-weight:700;
  font-family:inherit; cursor:pointer; letter-spacing:.04em;
  transition:all 0.2s; box-shadow:0 4px 14px rgba(201,168,76,0.3);
  display:flex; align-items:center; justify-content:center; gap:8px;
}
.btn-login:hover {
  background:var(--gold-light); transform:translateY(-2px);
  box-shadow:0 8px 24px rgba(201,168,76,0.4);
}
.btn-login:active { transform:translateY(0) }
.btn-login:disabled { opacity:0.6; cursor:not-allowed; transform:none }

.form-panel-footer {
  margin-top:28px; padding-top:24px;
  border-top:1px solid var(--border);
  display:flex; align-items:center; justify-content:space-between;
}
.theme-toggle-btn {
  background:transparent; border:1.5px solid var(--border); border-radius:9px;
  color:var(--text-muted); width:36px; height:36px;
  display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:all 0.2s;
}
.theme-toggle-btn:hover { border-color:var(--gold); color:var(--gold); background:var(--gold-pale) }
.icon-sun-l { display:none }
.icon-moon-l { display:block }
[data-theme="dark"] .icon-sun-l { display:block }
[data-theme="dark"] .icon-moon-l { display:none }

.alert {
  padding:12px 16px; border-radius:var(--radius);
  font-size:.82rem; margin-bottom:20px; border:1px solid transparent;
  display:flex; align-items:flex-start; gap:8px;
}
.alert-danger { background:#fee2e2; color:#991b1b; border-color:#fecaca }
[data-theme="dark"] .alert-danger { background:rgba(239,68,68,0.12); color:#fca5a5; border-color:rgba(239,68,68,0.25) }

/* Responsive – hide brand panel on small screens */
@media(max-width:768px){
  .login-brand-panel { display:none }
  .login-form-panel { padding:40px 28px }
}
</style>
</head>
<body>

{{-- Brand Panel --}}
<div class="login-brand-panel" aria-hidden="true">
    <div class="brand-mark-lg">SK</div>

    <div class="brand-panel-content">
        <h1>Suresh Kumar</h1>
        <div class="brand-divider"></div>
        <p>Founder of the Connecting GTA Business Networking Club — a dynamic platform for professionals to collaborate, grow, and lead together across the Greater Toronto Area.</p>
        <div class="brand-stats">
            <div class="brand-stat-item">
                <strong>22+</strong>
                <span>Years of Strategic Experience</span>
            </div>
            <div class="brand-stat-item">
                <strong>200+</strong>
                <span>Partnerships Created</span>
            </div>
        </div>
    </div>

    <div class="brand-footer">
        {{ $gs['site_name'] ?? 'Suresh Kumar' }} &copy; {{ date('Y') }} · Secure Admin Area
    </div>
</div>

{{-- Form Panel --}}
<div class="login-form-panel">
    <div class="form-panel-inner">
        <div class="form-panel-header">
            <h2>Welcome back</h2>
            <p>Sign in to your admin dashboard</p>
        </div>

        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:1px" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>@foreach($errors->all() as $e){{ $e }}@endforeach</span>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" id="loginForm">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email') }}" placeholder="admin@example.com"
                       required autocomplete="email" autofocus>
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="password-wrap">
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="••••••••••••"
                           required autocomplete="current-password">
                    <button type="button" class="password-toggle" id="passwordToggle"
                            aria-label="Show password" aria-controls="password">
                        <svg class="icon-eye" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg class="icon-eye-off" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
                @error('password')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="check-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Keep me signed in</label>
            </div>

            <button type="submit" class="btn-login" id="loginBtn">
                Sign In to Dashboard
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
        </form>

        <div class="form-panel-footer">
            <span style="font-size:.75rem;color:var(--text-muted)">Secure, encrypted session</span>
            <button class="theme-toggle-btn" onclick="toggleLoginTheme()" aria-label="Toggle dark/light mode">
                <svg class="icon-moon-l" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                <svg class="icon-sun-l" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            </button>
        </div>
    </div>
</div>

<script>
/* Theme toggle */
function toggleLoginTheme(){
    var cur = document.documentElement.getAttribute('data-theme');
    var next = cur === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('sk-admin-theme', next);
}

/* Password visibility toggle */
(function(){
    var toggle = document.getElementById('passwordToggle');
    var input  = document.getElementById('password');
    if(!toggle || !input) return;
    toggle.addEventListener('click', function(){
        var isShowing = input.type === 'text';
        input.type = isShowing ? 'password' : 'text';
        toggle.classList.toggle('showing', !isShowing);
        toggle.setAttribute('aria-label', isShowing ? 'Show password' : 'Hide password');
    });
})();

/* Loading state on submit */
(function(){
    var form = document.getElementById('loginForm');
    var btn  = document.getElementById('loginBtn');
    if(!form || !btn) return;
    form.addEventListener('submit', function(){
        btn.disabled = true;
        btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="animation:spin 0.8s linear infinite"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg> Signing in…';
    });
})();
</script>
<style>@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}</style>
</body>
</html>
