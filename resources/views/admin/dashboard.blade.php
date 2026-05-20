@extends('admin.layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('page-subtitle','Welcome back, '.auth()->user()->name)

@section('content')

{{-- Welcome Banner --}}
<div class="dash-welcome">
    <div class="dash-welcome-text">
        <h2>Good to see you, {{ explode(' ', auth()->user()->name)[0] }} 👋</h2>
        <p>Here's an overview of your website content. Everything looks good.</p>
    </div>
    <div class="dash-welcome-actions">
        <a href="{{ url('/') }}" target="_blank" class="btn btn-sm" style="background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.2)">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            View Live Site
        </a>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Content
        </a>
    </div>
</div>

{{-- Stat Cards --}}
@php
$cards = [
    ['label'=>'Hero Slides',       'value'=>$stats['sliders'],      'href'=>route('admin.sliders.index'),          'color'=>'#dbeafe', 'icon'=>'M4 7h16M4 12h16M4 17h7'],
    ['label'=>'Services',          'value'=>$stats['services'],     'href'=>route('admin.services.index'),         'color'=>'#dcfce7', 'icon'=>'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5'],
    ['label'=>'Testimonials',      'value'=>$stats['testimonials'], 'href'=>route('admin.testimonials.index'),     'color'=>'#fef3c7', 'icon'=>'M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z'],
    ['label'=>'Network Profiles',  'value'=>$stats['networks'],     'href'=>route('admin.network-profiles.index'), 'color'=>'#f3e8ff', 'icon'=>'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2'],
    ['label'=>'Client Logos',      'value'=>$stats['clients'],      'href'=>route('admin.clients.index'),          'color'=>'#fce7f3', 'icon'=>'M2 3h20M2 9h20M2 15h20'],
    ['label'=>'Media Files',       'value'=>$stats['media'],        'href'=>route('admin.media.index'),            'color'=>'#e0f2fe', 'icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14'],
];
@endphp

<div class="dash-grid">
    @foreach($cards as $card)
    <a href="{{ $card['href'] }}" class="dash-stat" style="text-decoration:none">
        <div class="dash-stat-info">
            <h3>{{ $card['value'] }}</h3>
            <p>{{ $card['label'] }}</p>
        </div>
        <div class="dash-stat-icon" style="background:{{ $card['color'] }}">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $card['icon'] }}"/></svg>
        </div>
    </a>
    @endforeach
</div>

{{-- Quick Actions --}}
<div class="card">
    <div class="card-header">
        <h2>Quick Actions</h2>
        <span style="font-size:.72rem;color:var(--text-muted)">Common tasks</span>
    </div>
    <div class="card-body">
        <div class="quick-actions">
            <a href="{{ route('admin.sliders.create') }}" class="quick-action-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="7" width="20" height="15" rx="2"/><polyline points="17 2 12 7 7 2"/></svg>
                <div>
                    <strong style="display:block;font-size:.82rem">New Slide</strong>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:400">Add hero banner</span>
                </div>
            </a>
            <a href="{{ route('admin.services.create') }}" class="quick-action-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                <div>
                    <strong style="display:block;font-size:.82rem">New Service</strong>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:400">Add service card</span>
                </div>
            </a>
            <a href="{{ route('admin.testimonials.create') }}" class="quick-action-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                <div>
                    <strong style="display:block;font-size:.82rem">New Testimonial</strong>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:400">Add client quote</span>
                </div>
            </a>
            <a href="{{ route('admin.media.index') }}" class="quick-action-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                <div>
                    <strong style="display:block;font-size:.82rem">Upload Media</strong>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:400">Add images</span>
                </div>
            </a>
            <a href="{{ route('admin.settings.edit') }}" class="quick-action-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41"/></svg>
                <div>
                    <strong style="display:block;font-size:.82rem">Site Settings</strong>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:400">Brand & contact</span>
                </div>
            </a>
            <a href="{{ route('admin.seo.edit') }}" class="quick-action-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <div>
                    <strong style="display:block;font-size:.82rem">SEO Settings</strong>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:400">Meta & search</span>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
