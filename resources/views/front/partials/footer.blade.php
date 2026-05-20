<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">
            {{-- Brand --}}
            <div>
                <div class="footer-brand-mark">
                    <div class="footer-logo-mark" aria-hidden="true">SK</div>
                    <span class="footer-brand-name">{{ $gs['site_name'] ?? 'Suresh Kumar' }}</span>
                </div>
                <p class="footer-tagline">{{ $gs['tagline'] ?? 'Strategic Business Advisor & Growth Consultant' }}. Empowering SMEs across the Greater Toronto Area.</p>
                <div class="footer-socials">
                    @if(!empty($gs['social_linkedin']))
                    <a href="{{ $gs['social_linkedin'] }}" target="_blank" rel="noopener" class="social-link" aria-label="LinkedIn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    @endif
                    @if(!empty($gs['social_twitter']))
                    <a href="{{ $gs['social_twitter'] }}" target="_blank" rel="noopener" class="social-link" aria-label="Twitter / X">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Nav --}}
            <div>
                <p class="footer-heading">Quick Links</p>
                <ul class="footer-nav" role="list">
                    @foreach($sections->filter(fn($s)=>$s->nav_label && $s->is_visible) as $sec)
                    <li><a href="{{ $sec->anchor }}">{{ $sec->nav_label }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <p class="footer-heading">Contact</p>
                <div class="footer-contact-list">
                    @if(!empty($gs['contact_email']))
                    <div class="footer-contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a href="mailto:{{ $gs['contact_email'] }}">{{ $gs['contact_email'] }}</a>
                    </div>
                    @endif
                    @if(!empty($gs['contact_phone_main']))
                    <div class="footer-contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8a19.79 19.79 0 01-3.07-8.66A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                        <span>Mobile: {{ $gs['contact_phone_main'] }}</span>
                    </div>
                    @endif
                    @if(!empty($gs['contact_phone_cgta']))
                    <div class="footer-contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8a19.79 19.79 0 01-3.07-8.66A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                        <span>CGTA: {{ $gs['contact_phone_cgta'] }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copy">{{ $gs['footer_copyright'] ?? '© '.date('Y').' Suresh Kumar. All rights reserved.' }}</p>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>
