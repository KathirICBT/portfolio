@extends('admin.layouts.admin')
@section('title', isset($slider) ? 'Edit Slide' : 'Add Slide')
@section('page-title', isset($slider) ? 'Edit Slide' : 'Add New Slide')
@section('page-subtitle', 'Hero slider management')

@section('content')
<form method="POST" action="{{ isset($slider) ? route('admin.sliders.update', $slider) : route('admin.sliders.store') }}">
    @csrf
    @if(isset($slider)) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start">

        {{-- Main Fields --}}
        <div style="display:flex;flex-direction:column;gap:20px">
            <div class="card">
                <div class="card-header"><h2>Slide Content</h2></div>
                <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
                    <div class="form-group">
                        <label class="form-label">Eyebrow Label <span style="color:var(--muted);font-weight:400">(Optional small text above title)</span></label>
                        <input type="text" name="eyebrow_label" class="form-control" maxlength="100"
                               value="{{ old('eyebrow_label', $slider->eyebrow_label ?? '') }}"
                               placeholder="e.g. Strategic Advisory · GTA">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Title <span class="req">*</span></label>
                        <input type="text" name="title" class="form-control" required maxlength="255"
                               value="{{ old('title', $slider->title ?? '') }}"
                               placeholder="Main slide headline">
                        @error('title')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subtitle / Description</label>
                        <textarea name="subtitle" class="form-control" rows="3" maxlength="600"
                                  placeholder="Supporting text shown below the title">{{ old('subtitle', $slider->subtitle ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2>Call-to-Action Buttons</h2></div>
                <div class="card-body">
                    <div class="form-grid" style="margin-bottom:16px">
                        <div class="form-group">
                            <label class="form-label">CTA 1 Label</label>
                            <input type="text" name="cta1_label" class="form-control" maxlength="100"
                                   value="{{ old('cta1_label', $slider->cta1_label ?? '') }}"
                                   placeholder="e.g. Book a Free Consultation">
                        </div>
                        <div class="form-group">
                            <label class="form-label">CTA 1 URL</label>
                            <input type="text" name="cta1_url" class="form-control" maxlength="255"
                                   value="{{ old('cta1_url', $slider->cta1_url ?? '') }}"
                                   placeholder="#contact or https://...">
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">CTA 2 Label <span style="color:var(--muted);font-weight:400">(Optional)</span></label>
                            <input type="text" name="cta2_label" class="form-control" maxlength="100"
                                   value="{{ old('cta2_label', $slider->cta2_label ?? '') }}"
                                   placeholder="e.g. Learn More">
                        </div>
                        <div class="form-group">
                            <label class="form-label">CTA 2 URL</label>
                            <input type="text" name="cta2_url" class="form-control" maxlength="255"
                                   value="{{ old('cta2_url', $slider->cta2_url ?? '') }}"
                                   placeholder="#about or https://...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2>Overlay Settings</h2></div>
                <div class="card-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Overlay Color</label>
                            <div style="display:flex;gap:10px;align-items:center">
                                <input type="color" name="overlay_color"
                                       value="{{ old('overlay_color', $slider->overlay_color ?? '#1A3A5C') }}"
                                       style="width:48px;height:38px;border-radius:6px;border:1.5px solid var(--border);padding:2px;cursor:pointer">
                                <input type="text" name="overlay_color_hex" class="form-control"
                                       value="{{ old('overlay_color', $slider->overlay_color ?? '#1A3A5C') }}"
                                       placeholder="#1A3A5C" maxlength="7" style="flex:1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Overlay Opacity (0.0 – 1.0)</label>
                            <input type="number" name="overlay_opacity" class="form-control"
                                   min="0" max="1" step="0.05"
                                   value="{{ old('overlay_opacity', $slider->overlay_opacity ?? 0.70) }}">
                            <span class="form-hint">0 = transparent, 1 = fully opaque. Recommended: 0.65–0.80</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Options --}}
        <div style="display:flex;flex-direction:column;gap:20px">
            <div class="card">
                <div class="card-header"><h2>Publish Settings</h2></div>
                <div class="card-body" style="display:flex;flex-direction:column;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control"
                               value="{{ old('sort_order', $slider->sort_order ?? 1) }}" min="1">
                        <span class="form-hint">Lower numbers appear first</span>
                    </div>
                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Active (visible on site)</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2>Background Image</h2></div>
                <div class="card-body">
                    <p class="form-hint" style="margin-bottom:12px">Select from media library. Recommended: 1920×1080px JPEG.</p>
                    @if(isset($slider) && $slider->media)
                    <div style="margin-bottom:12px">
                        <img src="{{ $slider->media->url }}" alt="{{ $slider->media->alt_text }}"
                             style="width:100%;height:120px;object-fit:cover;border-radius:8px;border:1.5px solid var(--border)">
                        <p style="font-size:.72rem;color:var(--muted);margin-top:4px">Current image</p>
                    </div>
                    @endif
                    <select name="media_id" class="form-control">
                        <option value="">— No image (gradient fallback) —</option>
                        @foreach($mediaList as $m)
                        <option value="{{ $m->id }}" {{ old('media_id', $slider->media_id ?? '') == $m->id ? 'selected' : '' }}>
                            {{ $m->original_name }} ({{ $m->human_size }})
                        </option>
                        @endforeach
                    </select>
                    <div style="margin-top:10px">
                        <a href="{{ route('admin.media.index') }}" target="_blank" class="btn btn-outline btn-sm">
                            Upload New Image →
                        </a>
                    </div>
                </div>
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">
                    {{ isset($slider) ? 'Update Slide' : 'Create Slide' }}
                </button>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection
