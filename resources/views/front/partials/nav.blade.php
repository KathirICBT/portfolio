<nav class="site-nav" id="siteNav" role="navigation" aria-label="Main navigation">
    <div class="container">
        <a href="/" class="nav-logo" aria-label="{{ $gs['site_name'] ?? 'Suresh Kumar' }} – Home">
            <div class="nav-logo-mark" aria-hidden="true">SK</div>
            <div class="nav-logo-text">
                <strong>{{ $gs['site_name'] ?? 'Suresh Kumar' }}</strong>
            </div>
        </a>

        <ul class="nav-links" role="list">
            @foreach($sections->filter(fn($s)=>$s->nav_label && $s->is_visible) as $sec)
            <li><a href="{{ $sec->anchor }}">{{ $sec->nav_label }}</a></li>
            @endforeach
        </ul>

        <div class="nav-cta-wrap" style="display:flex;align-items:center;gap:12px">
            @if(!empty($gs['contact_phone_main']))
            <a href="tel:{{ preg_replace('/[^0-9+]/','',$gs['contact_phone_main']) }}" class="nav-phone-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8a19.79 19.79 0 01-3.07-8.66A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                {{ $gs['contact_phone_main'] }}
            </a>
            @endif

            {{-- Theme Toggle --}}
            <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle dark/light mode">
                {{-- Moon: shown in light mode --}}
                <svg class="icon-moon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                {{-- Sun: shown in dark mode --}}
                <svg class="icon-sun" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            </button>

            <a href="{{ route('cartview') }}" class="btn btn-primary nav-cta" style="padding:7px 14px;font-size:.75rem">
                Products
            </a>
        </div>

        <button class="nav-hamburger" aria-label="Open navigation menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>
