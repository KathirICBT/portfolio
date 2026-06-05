@extends('front.layouts.app')

@section('content')

{{-- ═══════════════════════════════════════════════
     HERO SLIDER
     ═══════════════════════════════════════════════ --}}
<section aria-label="Hero banner" id="hero-slider">
<div class="hero-slider" id="heroSlider" role="region" aria-roledescription="carousel" aria-label="Featured slides">

    @forelse($sliders as $index => $slide)
    <div class="hero-slide {{ $index === 0 ? 'active slide-enter' : '' }}"
         role="group"
         aria-roledescription="slide"
         aria-label="Slide {{ $index + 1 }} of {{ $sliders->count() }}"
         data-index="{{ $index }}">

        <div class="hero-slide-bg"
             @if($slide->media)
             style="background-image:url('{{ $slide->media->url }}')"
             @else
             style="background:linear-gradient(135deg,#0F2644 0%,#1A3A5C 50%,#2A527D 100%)"
             @endif
             role="img"
             aria-label="{{ $slide->media?->alt_text ?? $slide->title }}"
             style="background-color: {{ $slide->overlay_color }};">
        </div>

        <div class="container" style="position:relative;z-index:3;width:100%">
            <div class="hero-content">
                @if($slide->eyebrow_label)
                <span class="hero-eyebrow" aria-label="Category: {{ $slide->eyebrow_label }}">{{ $slide->eyebrow_label }}</span>
                @endif

                @if($index === 0)
                <h1>{{ $slide->title }}</h1>
                @else
                <h2>{{ $slide->title }}</h2>
                @endif

                @if($slide->subtitle)
                <p class="hero-subtitle">{{ $slide->subtitle }}</p>
                @endif

                <div class="hero-btns">
                    @if($slide->cta1_label)
                    <a href="{{ $slide->cta1_url ?? '#contact' }}" class="btn btn-primary">
                        {{ $slide->cta1_label }}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    @endif
                    @if($slide->cta2_label)
                    <a href="{{ $slide->cta2_url ?? '#about' }}" class="btn btn-outline">
                        {{ $slide->cta2_label }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="hero-slide active" style="background:var(--navy)">
        <div class="container" style="position:relative;z-index:3;width:100%">
            <div class="hero-content">
                <h1 class="display-xl" style="color:white">Strategic Business Advisor & Growth Consultant</h1>
            </div>
        </div>
    </div>
    @endforelse

    {{-- Navigation Arrows --}}
    @if($sliders->count() > 1)
    <button class="slider-arrow slider-prev" id="sliderPrev" aria-label="Previous slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <button class="slider-arrow slider-next" id="sliderNext" aria-label="Next slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
    </button>

    {{-- Dots + Pause control --}}
    <div class="slider-controls">
        <div class="slider-dots" role="tablist" aria-label="Slide navigation">
            @foreach($sliders as $i => $slide)
            <button class="slider-dot {{ $i===0?'active':'' }}"
                    role="tab"
                    aria-selected="{{ $i===0?'true':'false' }}"
                    aria-label="Go to slide {{ $i+1 }}"
                    data-index="{{ $i }}"></button>
            @endforeach
        </div>
        <button class="slider-pause" id="sliderPauseBtn"
                aria-label="Pause automatic slide rotation"
                aria-pressed="false"
                title="Pause/resume automatic rotation">
            <svg class="icon-pause" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
            <svg class="icon-play" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="margin-left:1px"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        </button>
    </div>
    @endif

    {{-- Progress bar --}}
    <div class="slider-progress" aria-hidden="true"><div class="slider-progress-bar" id="sliderProgress"></div></div>
</div>
</section>


{{-- ═══════════════════════════════════════════════
     ABOUT
     ═══════════════════════════════════════════════ --}}
@if(isset($sections['about']) && $sections['about']->is_visible)
@php $about = $sections['about']; @endphp
<section id="about" aria-labelledby="about-heading">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <span class="section-eyebrow">{{ $about->subtitle ?? 'About Me' }}</span>
                <h2 class="display-md" id="about-heading">{{ $about->title }}</h2>
                <div class="gold-line" aria-hidden="true"></div>
                @foreach(array_filter(explode("\n\n", $about->body ?? '')) as $para)
                <p>{{ trim($para) }}</p>
                @endforeach

                {{-- Community Badges --}}
                <div class="about-badges" role="list" aria-label="Community involvement">
                    @php
                    $badges = [
                        ['label'=>'Board Director – Alzheimer Society of Durham Region'],
                        ['label'=>'Canadian Tamil Chamber of Commerce'],
                        ['label'=>'Rouge Valley Health System Foundation'],
                        ['label'=>'100 Men of Toronto'],
                        ['label'=>'Connecting GTA Networking Club – Founder'],
                        ['label'=>'Kashden Consulting'],
                    ];
                    @endphp
                    @foreach($badges as $badge)
                    <div class="badge" role="listitem">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ $badge['label'] }}
                    </div>
                    @endforeach
                </div>

                <div style="margin-top:40px">
                    <a href="#contact" class="btn btn-navy">
                        Book a Free Consultation
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>

            <div class="about-visual">
                <div class="about-photo-frame">
                    @php
                        $aboutPhoto = !empty($gs['about_photo_id'])
                            ? \App\Models\Media::find($gs['about_photo_id'])
                            : null;
                    @endphp
                    <img src="{{ $aboutPhoto?->url ?? 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'480\' height=\'600\' viewBox=\'0 0 480 600\'%3E%3Crect width=\'480\' height=\'600\' fill=\'%231A3A5C\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' fill=\'%23C9A84C\' font-size=\'80\' font-family=\'Georgia\'%3ESK%3C/text%3E%3C/svg%3E' }}"
                         alt="{{ $aboutPhoto?->alt_text ?? 'Suresh Kumar – Strategic Business Advisor' }}"
                         width="480" height="600"
                         loading="lazy"
                         style="width:100%;height:100%;object-fit:cover">
                    @if(!empty($gs['about_video_url']))
                    <div class="about-photo-overlay">
                        <button class="about-video-btn" onclick="openVideoModal()" aria-label="Watch Suresh's Story video">
                            <div class="play-circle" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="margin-left:3px"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                            </div>
                            <span>Watch Story</span>
                        </button>
                    </div>
                    @endif
                </div>
                <div class="about-accent-card" aria-label="22 plus years of strategic experience">
                    <div class="accent-card-number">2<span style="color:var(--gold)">+</span></div>
                    <div class="accent-card-label">Years of Strategic<br>Experience</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════
     STATS
     ═══════════════════════════════════════════════ --}}
@if($stats->count())
<section id="stats" aria-labelledby="stats-heading">
    <div class="container">
        <h2 id="stats-heading" class="sr-only">Our Impact by the Numbers</h2>
        <div class="stats-grid" role="list">
            @foreach($stats as $stat)
            <div class="stat-item" role="listitem">
                @if($stat->icon)
                <div class="stat-icon" aria-hidden="true">
                    @include('front.partials.icon', ['name' => $stat->icon])
                </div>
                @endif
                <div class="stat-number" aria-label="{{ $stat->value }}{{ $stat->suffix }} {{ $stat->label }}">
                    <span data-counter data-target="{{ $stat->value }}">0</span><span class="stat-suffix">{{ $stat->suffix }}</span>
                </div>
                <div class="stat-label">{{ $stat->label }}</div>
                @if($stat->description)
                <p class="stat-desc">{{ $stat->description }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════
     SERVICES
     ═══════════════════════════════════════════════ --}}
@if(isset($sections['services']) && $sections['services']->is_visible && $services->count())
@php $svcSection = $sections['services']; @endphp
<section id="services" aria-labelledby="services-heading">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">{{ $svcSection->subtitle ?? 'What We Offer' }}</span>
            <h2 class="display-md" id="services-heading">{{ $svcSection->title }}</h2>
            <div class="gold-line" aria-hidden="true"></div>
            @if($svcSection->body)
            <p class="lead">{{ $svcSection->body }}</p>
            @endif
        </div>

        <div class="services-grid" role="list">
            @foreach($services as $service)
            <article class="service-card card" role="listitem">
                <div class="service-icon" aria-hidden="true">
                    @include('front.partials.icon', ['name' => $service->icon ?? 'star'])
                </div>
                <h3>{{ $service->title }}</h3>
                <p>{{ $service->body }}</p>
                @if($service->link_label && $service->link_url)
                <a href="{{ $service->link_url }}" class="service-link" aria-label="{{ $service->link_label }} – {{ $service->title }}">
                    {{ $service->link_label }}
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                @endif
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════
     TRUSTED NETWORKS
     ═══════════════════════════════════════════════ --}}
@if(isset($sections['network']) && $sections['network']->is_visible && $networkProfiles->count())
@php $netSection = $sections['network']; @endphp
<section id="network" aria-labelledby="network-heading">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">{{ $netSection->subtitle ?? 'Influential Connections' }}</span>
            <h2 class="display-md" id="network-heading">{{ $netSection->title }}</h2>
            <div class="gold-line" aria-hidden="true"></div>
            @if($netSection->body)
            <p class="lead">{{ $netSection->body }}</p>
            @endif
        </div>

        <div class="network-grid" role="list">
            @foreach($networkProfiles as $profile)
            <article class="network-card" role="listitem">
                <div class="network-avatar">
                    @if($profile->media)
                    <img src="{{ $profile->media->url }}"
                         alt="{{ $profile->media->alt_text ?? $profile->name }}"
                         width="96" height="96"
                         loading="lazy">
                    @else
                    <div class="network-initials" aria-hidden="true">
                        {{ strtoupper(substr($profile->name,0,1)) }}{{ strtoupper(substr(strrchr($profile->name,' '),1,1)) }}
                    </div>
                    @endif
                </div>
                <h3 class="network-name">{{ $profile->name }}</h3>
                <p class="network-title">{{ $profile->title }}</p>
                @if($profile->bio)
                <p class="network-bio">{{ $profile->bio }}</p>
                @endif
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════
     CLIENTS
     ═══════════════════════════════════════════════ --}}
@if(isset($sections['clients']) && $sections['clients']->is_visible && $clients->count())
<section id="clients" aria-label="Clients and Partners">
    <div class="container">
        <div class="clients-heading">
            <p>Trusted By Local Businesses</p>
        </div>
        <div class="clients-track">
            <div class="clients-marquee" aria-label="Client logos">
                @foreach($clients as $client)
                <div class="client-logo" title="{{ $client->name }}">
                    @if($client->media)
                    <img src="{{ $client->media->url }}"
                         alt="{{ $client->media->alt_text ?? $client->name }} logo"
                         loading="lazy"
                         width="120" height="44">
                    @else
                    <div class="client-logo-placeholder">
                        <span>{{ $client->name }}</span>
                    </div>
                    @endif
                </div>
                @endforeach
                {{-- Duplicate for infinite scroll effect --}}
                @foreach($clients as $client)
                <div class="client-logo" aria-hidden="true" title="{{ $client->name }}">
                    @if($client->media)
                    <img src="{{ $client->media->url }}" alt="" loading="lazy" width="120" height="44">
                    @else
                    <div class="client-logo-placeholder"><span>{{ $client->name }}</span></div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════
     TESTIMONIALS
     ═══════════════════════════════════════════════ --}}
@if(isset($sections['testimonials']) && $sections['testimonials']->is_visible && $testimonials->count())
<section id="testimonials" aria-labelledby="testimonials-heading">
    <div class="container">
        <div class="testimonials-inner">
            <span class="section-eyebrow">{{ $sections['testimonials']->subtitle ?? 'Client Testimonials' }}</span>
            <h2 class="display-md" id="testimonials-heading" style="color:var(--white)">{{ $sections['testimonials']->title }}</h2>
            <div class="gold-line" aria-hidden="true"></div>

            <div id="testimonialSlider" role="region" aria-label="Testimonials">
                @foreach($testimonials as $i => $testimonial)
                <div class="testimonial-item" data-testimonial="{{ $i }}" style="{{ $i > 0 ? 'display:none' : '' }}" aria-hidden="{{ $i > 0 ? 'true':'false' }}">
                    <div class="quote-mark" aria-hidden="true">"</div>
                    <blockquote>
                        <p class="testimonial-text">"{{ $testimonial->quote }}"</p>
                        <footer class="testimonial-author">
                            <div class="author-avatar">
                                @if($testimonial->media)
                                <img src="{{ $testimonial->media->url }}"
                                     alt="{{ $testimonial->author_name }}"
                                     width="52" height="52"
                                     loading="lazy">
                                @else
                                <div class="author-initials-circle" aria-hidden="true">
                                    {{ strtoupper(substr($testimonial->author_name,0,1)) }}
                                </div>
                                @endif
                            </div>
                            <div>
                                <cite class="author-name" style="font-style:normal">{{ $testimonial->author_name }}</cite>
                                @if($testimonial->author_title)
                                <p class="author-title">{{ $testimonial->author_title }}</p>
                                @endif
                            </div>
                        </footer>
                    </blockquote>
                </div>
                @endforeach
            </div>

            @if($testimonials->count() > 1)
            <div class="testimonial-nav" role="tablist" aria-label="Testimonial navigation">
                @foreach($testimonials as $i => $t)
                <button class="testimonial-dot {{ $i===0?'active':'' }}"
                        role="tab"
                        aria-selected="{{ $i===0?'true':'false' }}"
                        aria-label="View testimonial from {{ $t->author_name }}"
                        onclick="showTestimonial({{ $i }})"></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════
     GALLERY
     ═══════════════════════════════════════════════ --}}
@if(isset($sections['gallery']) && $sections['gallery']->is_visible && $galleryItems->count())
@php $galSection = $sections['gallery']; @endphp
<section id="gallery" aria-labelledby="gallery-heading">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">{{ $galSection->subtitle ?? 'Photo Gallery' }}</span>
            <h2 class="display-md" id="gallery-heading">{{ $galSection->title }}</h2>
            <div class="gold-line" aria-hidden="true"></div>
            @if($galSection->body)
            <p class="lead">{{ $galSection->body }}</p>
            @endif
        </div>

        <div class="gallery-grid" role="list">
            @foreach($galleryItems as $gitem)
            <figure class="gallery-item" role="listitem"
                    onclick="openLightbox('{{ $gitem->media?->url }}','{{ addslashes($gitem->title ?? '') }}','{{ addslashes($gitem->caption ?? '') }}')"
                    tabindex="0"
                    onkeydown="if(event.key==='Enter'||event.key===' ')this.click()"
                    aria-label="{{ $gitem->title ?? 'Gallery image' }}">
                @if($gitem->media)
                <img src="{{ $gitem->media->url }}"
                     alt="{{ $gitem->media->alt_text ?? $gitem->title ?? 'Gallery image' }}"
                     loading="lazy">
                @else
                <div class="gallery-placeholder" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                @endif
                <div class="gallery-overlay" aria-hidden="true">
                    <div class="gallery-overlay-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                    @if($gitem->title || $gitem->caption)
                    <figcaption class="gallery-caption">
                        @if($gitem->title)<strong>{{ $gitem->title }}</strong>@endif
                        @if($gitem->caption)<span>{{ $gitem->caption }}</span>@endif
                    </figcaption>
                    @endif
                </div>
            </figure>
            @endforeach
        </div>
    </div>
</section>
@elseif($galleryItems->count())
<section id="gallery" aria-labelledby="gallery-heading">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Photo Gallery</span>
            <h2 class="display-md" id="gallery-heading">Gallery</h2>
            <div class="gold-line" aria-hidden="true"></div>
        </div>
        <div class="gallery-grid" role="list">
            @foreach($galleryItems as $gitem)
            <figure class="gallery-item" role="listitem"
                    onclick="openLightbox('{{ $gitem->media?->url }}','{{ addslashes($gitem->title ?? '') }}','{{ addslashes($gitem->caption ?? '') }}')"
                    tabindex="0"
                    onkeydown="if(event.key==='Enter'||event.key===' ')this.click()"
                    aria-label="{{ $gitem->title ?? 'Gallery image' }}">
                @if($gitem->media)
                <img src="{{ $gitem->media->url }}"
                     alt="{{ $gitem->media->alt_text ?? $gitem->title ?? 'Gallery image' }}"
                     loading="lazy">
                @else
                <div class="gallery-placeholder" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                @endif
                <div class="gallery-overlay" aria-hidden="true">
                    <div class="gallery-overlay-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                    @if($gitem->title || $gitem->caption)
                    <figcaption class="gallery-caption">
                        @if($gitem->title)<strong>{{ $gitem->title }}</strong>@endif
                        @if($gitem->caption)<span>{{ $gitem->caption }}</span>@endif
                    </figcaption>
                    @endif
                </div>
            </figure>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Video Modal --}}
@if(!empty($gs['about_video_url']))
<div id="videoModal" role="dialog" aria-modal="true" aria-label="Video player" onclick="closeVideoModal()"
     style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.88);align-items:center;justify-content:center;padding:20px">
    <div onclick="event.stopPropagation()" style="position:relative;width:100%;max-width:860px;aspect-ratio:16/9;border-radius:12px;overflow:hidden;background:#000">
        <button onclick="closeVideoModal()" aria-label="Close video"
                style="position:absolute;top:-44px;right:0;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);color:#fff;width:36px;height:36px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.1rem;z-index:10">✕</button>
        <iframe id="videoIframe" src="" allow="autoplay; encrypted-media" allowfullscreen
                style="width:100%;height:100%;border:none"></iframe>
    </div>
</div>
<script>
function openVideoModal() {
    var raw = '{{ $gs['about_video_url'] }}';
    var embedUrl = '';
    // YouTube
    var ytMatch = raw.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([A-Za-z0-9_-]{11})/);
    if (ytMatch) embedUrl = 'https://www.youtube.com/embed/' + ytMatch[1] + '?autoplay=1&rel=0';
    // Vimeo
    var vmMatch = raw.match(/vimeo\.com\/(\d+)/);
    if (vmMatch) embedUrl = 'https://player.vimeo.com/video/' + vmMatch[1] + '?autoplay=1';
    if (!embedUrl) embedUrl = raw;
    document.getElementById('videoIframe').src = embedUrl;
    var m = document.getElementById('videoModal');
    m.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeVideoModal() {
    document.getElementById('videoModal').style.display = 'none';
    document.getElementById('videoIframe').src = '';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeVideoModal(); });
</script>
@endif

{{-- Lightbox --}}
<div id="galleryLightbox" class="gallery-lightbox" role="dialog" aria-modal="true" aria-label="Image lightbox" onclick="closeLightbox()" style="display:none">
    <button class="lightbox-close" onclick="closeLightbox()" aria-label="Close lightbox">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div class="lightbox-inner" onclick="event.stopPropagation()">
        <img id="lightboxImg" src="" alt="" style="max-width:100%;max-height:80vh;border-radius:var(--radius);display:block">
        <div id="lightboxCaption" class="lightbox-caption"></div>
    </div>
</div>


{{-- ═══════════════════════════════════════════════
     CTA BANNER
     ═══════════════════════════════════════════════ --}}
@if(isset($sections['cta']) && $sections['cta']->is_visible)
@php $cta = $sections['cta']; @endphp
<section id="cta-banner" aria-labelledby="cta-heading">
    <div class="container">
        <div class="cta-inner">
            <h2 id="cta-heading">{{ $cta->title }}</h2>
            @if($cta->body)
            <p>{{ $cta->body }}</p>
            @endif
            <a href="{{ $gs['cta_button_url'] ?? '#contact' }}" class="btn btn-primary" style="font-size:1rem;padding:16px 40px">
                {{ $gs['cta_button_label'] ?? 'Book Free Consultation' }}
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════
     CONTACT
     ═══════════════════════════════════════════════ --}}
@if(isset($sections['contact']) && $sections['contact']->is_visible)
@php $contactSec = $sections['contact']; @endphp
<section id="contact" aria-labelledby="contact-heading">
    <div class="container">
        <div class="contact-grid">
            {{-- Form --}}
            <div>
                <span class="section-eyebrow">{{ $contactSec->subtitle ?? 'Get In Touch' }}</span>
                <h2 class="display-md" id="contact-heading">{{ $contactSec->title }}</h2>
                <div class="gold-line" aria-hidden="true"></div>

                @if(session('contact_success'))
                <div class="success-msg" role="alert">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('contact_success') }}
                </div>
                @endif

                <div class="contact-form">
                    <form method="POST" action="{{ route('contact.submit') }}" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name <span aria-hidden="true" style="color:var(--gold)">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                                   placeholder="Your full name" required autocomplete="name"
                                   aria-required="true">
                            @error('name')<span style="color:#c0392b;font-size:.8rem;margin-top:4px;display:block" role="alert">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address <span aria-hidden="true" style="color:var(--gold)">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                                   placeholder="your@email.com" required autocomplete="email"
                                   aria-required="true">
                            @error('email')<span style="color:#c0392b;font-size:.8rem;margin-top:4px;display:block" role="alert">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number <span style="color:var(--muted);font-weight:400">(Optional)</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}"
                                   placeholder="+1 (416) 000-0000" autocomplete="tel">
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Your Message <span aria-hidden="true" style="color:var(--gold)">*</span></label>
                            <textarea id="message" name="message" class="form-control" rows="5"
                                      placeholder="Tell us about your business goals and how we can help…"
                                      required aria-required="true">{{ old('message') }}</textarea>
                            @error('message')<span style="color:#c0392b;font-size:.8rem;margin-top:4px;display:block" role="alert">{{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary form-submit" style="width:100%;justify-content:center;padding:16px">
                            Send Message
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Contact Info --}}
            <div class="contact-info">
                <h3>Let's Work Together</h3>
                <p class="lead">Ready to take your business to the next level? Reach out for a free consultation.</p>

                <div style="margin-top:32px">
                    @if(!empty($gs['contact_email']))
                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <p class="contact-item-label">Email</p>
                            <p class="contact-item-value"><a href="mailto:{{ $gs['contact_email'] }}">{{ $gs['contact_email'] }}</a></p>
                        </div>
                    </div>
                    @endif

                    @if(!empty($gs['contact_phone_main']))
                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8a19.79 19.79 0 01-3.07-8.66A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                        </div>
                        <div>
                            <p class="contact-item-label">Mobile</p>
                            <p class="contact-item-value"><a href="tel:{{ preg_replace('/[^0-9+]/','',$gs['contact_phone_main']) }}">{{ $gs['contact_phone_main'] }}</a></p>
                        </div>
                    </div>
                    @endif

                    @if(!empty($gs['contact_phone_cgta']))
                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8a19.79 19.79 0 01-3.07-8.66A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                        </div>
                        <div>
                            <p class="contact-item-label">Connecting GTA</p>
                            <p class="contact-item-value"><a href="tel:{{ preg_replace('/[^0-9+]/','',$gs['contact_phone_cgta']) }}">{{ $gs['contact_phone_cgta'] }}</a></p>
                        </div>
                    </div>
                    @endif

                    @if(!empty($gs['contact_phone_kashden']))
                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </div>
                        <div>
                            <p class="contact-item-label">Kashden Consulting</p>
                            <p class="contact-item-value"><a href="tel:{{ preg_replace('/[^0-9+]/','',$gs['contact_phone_kashden']) }}">{{ $gs['contact_phone_kashden'] }}</a></p>
                        </div>
                    </div>
                    @endif

                    @if(!empty($gs['social_linkedin']))
                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                        </div>
                        <div>
                            <p class="contact-item-label">LinkedIn</p>
                            <p class="contact-item-value"><a href="{{ $gs['social_linkedin'] }}" target="_blank" rel="noopener">Connect on LinkedIn</a></p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection

@section('scripts')
<script>
/* ─── Hero Slider ──────────────────────────────────────── */
(function(){
    const slides   = document.querySelectorAll('.hero-slide');
    const dots     = document.querySelectorAll('.slider-dot');
    const bar      = document.getElementById('sliderProgress');
    const pauseBtn = document.getElementById('sliderPauseBtn');
    let current = 0, timer, paused = false;

    function goTo(n){
        slides[current].classList.remove('active','slide-enter');
        dots[current]?.classList.remove('active');
        dots[current]?.setAttribute('aria-selected','false');
        current = (n + slides.length) % slides.length;
        slides[current].classList.add('active','slide-enter');
        dots[current]?.classList.add('active');
        dots[current]?.setAttribute('aria-selected','true');
        resetProgress();
    }

    function resetProgress(){
        if(!bar) return;
        bar.style.transition='none'; bar.style.width='0%';
        setTimeout(()=>{
            if(!paused){ bar.style.transition='width 5s linear'; bar.style.width='100%'; }
        }, 50);
    }

    function setPaused(state){
        paused = state;
        if(pauseBtn){
            pauseBtn.classList.toggle('is-paused', paused);
            pauseBtn.setAttribute('aria-pressed', paused ? 'true' : 'false');
            pauseBtn.setAttribute('aria-label', paused ? 'Resume automatic slide rotation' : 'Pause automatic slide rotation');
        }
        if(paused){
            // freeze progress bar
            if(bar){ var w = bar.getBoundingClientRect().width / bar.parentElement.getBoundingClientRect().width * 100; bar.style.transition='none'; bar.style.width=w+'%'; }
        } else {
            resetProgress();
        }
    }

    function startTimer(){ timer = setInterval(()=>{ if(!paused) goTo(current+1); }, 5000); resetProgress(); }

    document.getElementById('sliderPrev')?.addEventListener('click',()=>{ clearInterval(timer); goTo(current-1); startTimer(); });
    document.getElementById('sliderNext')?.addEventListener('click',()=>{ clearInterval(timer); goTo(current+1); startTimer(); });
    dots.forEach((d,i)=>d.addEventListener('click',()=>{ clearInterval(timer); goTo(i); startTimer(); }));

    // Pause/Play toggle button (WCAG 2.2.2)
    pauseBtn?.addEventListener('click',()=>{ setPaused(!paused); });

    const hero = document.getElementById('heroSlider');
    hero?.addEventListener('mouseenter',()=>{ if(!pauseBtn?.classList.contains('is-paused')) paused=true; });
    hero?.addEventListener('mouseleave',()=>{ if(!pauseBtn?.classList.contains('is-paused')) paused=false; });

    // Touch swipe
    let touchStartX=0;
    hero?.addEventListener('touchstart',e=>touchStartX=e.touches[0].clientX,{passive:true});
    hero?.addEventListener('touchend',e=>{
        const diff = touchStartX - e.changedTouches[0].clientX;
        if(Math.abs(diff)>50){ clearInterval(timer); goTo(current+(diff>0?1:-1)); startTimer(); }
    },{passive:true});

    // Keyboard
    document.addEventListener('keydown',e=>{
        if(e.key==='ArrowLeft'){ clearInterval(timer); goTo(current-1); startTimer(); }
        if(e.key==='ArrowRight'){ clearInterval(timer); goTo(current+1); startTimer(); }
    });

    if(slides.length>1) startTimer();
})();

/* ─── Gallery Lightbox ─────────────────────────────────── */
function openLightbox(url, title, caption){
    if(!url) return;
    document.getElementById('lightboxImg').src = url;
    document.getElementById('lightboxImg').alt = title || 'Gallery image';
    var cap = document.getElementById('lightboxCaption');
    cap.innerHTML = (title ? '<strong>'+title+'</strong>' : '') + (caption ? '<span>'+caption+'</span>' : '');
    var lb = document.getElementById('galleryLightbox');
    lb.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    lb.focus();
}
function closeLightbox(){
    document.getElementById('galleryLightbox').style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeLightbox(); });

/* ─── Testimonial switcher ─────────────────────────────── */
function showTestimonial(index){
    document.querySelectorAll('.testimonial-item').forEach((el,i)=>{
        el.style.display = i===index ? '' : 'none';
        el.setAttribute('aria-hidden', i===index ? 'false':'true');
    });
    document.querySelectorAll('.testimonial-dot').forEach((d,i)=>{
        d.classList.toggle('active',i===index);
        d.setAttribute('aria-selected',i===index?'true':'false');
    });
}
</script>
@endsection
