@extends('admin.layouts.admin')
@section('title','Site Settings')
@section('page-title','Site Settings')
@section('page-subtitle','Global configuration for your website')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf @method('PATCH')

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start">

        {{-- Identity --}}
        <div class="card">
            <div class="card-header"><h2>Brand Identity</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
                <div class="form-group">
                    <label class="form-label">Site Name <span class="req">*</span></label>
                    <input type="text" name="site_name" class="form-control" required maxlength="255"
                           value="{{ old('site_name', $settings['site_name'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Tagline / Sub-heading</label>
                    <input type="text" name="tagline" class="form-control" maxlength="255"
                           value="{{ old('tagline', $settings['tagline'] ?? '') }}"
                           placeholder="Strategic Business Advisor & Growth Consultant">
                </div>
                <div class="form-group">
                    <label class="form-label">Footer Copyright Text</label>
                    <input type="text" name="footer_copyright" class="form-control" maxlength="255"
                           value="{{ old('footer_copyright', $settings['footer_copyright'] ?? '') }}"
                           placeholder="© 2025 Suresh Kumar. All rights reserved.">
                </div>
                <div class="form-group">
                    <label class="form-label">CTA Button Label <span style="color:var(--muted);font-weight:400">(nav &amp; CTA section)</span></label>
                    <input type="text" name="cta_button_label" class="form-control" maxlength="100"
                           value="{{ old('cta_button_label', $settings['cta_button_label'] ?? '') }}"
                           placeholder="Book Free Consultation">
                </div>
                <div class="form-group">
                    <label class="form-label">CTA Button URL</label>
                    <input type="text" name="cta_button_url" class="form-control" maxlength="255"
                           value="{{ old('cta_button_url', $settings['cta_button_url'] ?? '') }}"
                           placeholder="#contact">
                </div>
            </div>
        </div>

        {{-- Contact --}}
        <div class="card">
            <div class="card-header"><h2>Contact Details</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
                <div class="form-group">
                    <label class="form-label">Primary Email</label>
                    <input type="email" name="contact_email" class="form-control" maxlength="255"
                           value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                           placeholder="info@sureshkumar.ca">
                </div>
                <div class="form-group">
                    <label class="form-label">Form Recipient Email <span style="color:var(--muted);font-weight:400">(where contact form submissions go)</span></label>
                    <input type="email" name="form_recipient_email" class="form-control" maxlength="255"
                           value="{{ old('form_recipient_email', $settings['form_recipient_email'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Mobile Phone</label>
                    <input type="text" name="contact_phone_main" class="form-control" maxlength="30"
                           value="{{ old('contact_phone_main', $settings['contact_phone_main'] ?? '') }}"
                           placeholder="416-818-7444">
                </div>
                <div class="form-group">
                    <label class="form-label">CGTA Phone</label>
                    <input type="text" name="contact_phone_cgta" class="form-control" maxlength="30"
                           value="{{ old('contact_phone_cgta', $settings['contact_phone_cgta'] ?? '') }}"
                           placeholder="416-917-7617">
                </div>
                <div class="form-group">
                    <label class="form-label">Kashden Phone</label>
                    <input type="text" name="contact_phone_kashden" class="form-control" maxlength="30"
                           value="{{ old('contact_phone_kashden', $settings['contact_phone_kashden'] ?? '') }}"
                           placeholder="416-333-2004">
                </div>
            </div>
        </div>

        {{-- About Section --}}
        <div class="card">
            <div class="card-header"><h2>About Section</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
                <div class="form-group">
                    <label class="form-label">About Photo</label>
                    @php $currentPhoto = !empty($settings['about_photo_id']) ? \App\Models\Media::find($settings['about_photo_id']) : null; @endphp
                    @if($currentPhoto)
                    <div style="margin-bottom:8px">
                        <img src="{{ $currentPhoto->url }}" style="height:100px;border-radius:8px;object-fit:cover;border:1px solid var(--border)">
                    </div>
                    @endif
                    <select name="about_photo_id" class="form-control">
                        <option value="">— No photo (show placeholder) —</option>
                        @foreach($mediaList as $m)
                        <option value="{{ $m->id }}" {{ old('about_photo_id', $settings['about_photo_id'] ?? '') == $m->id ? 'selected' : '' }}>
                            {{ $m->original_name }}
                        </option>
                        @endforeach
                    </select>
                    <span class="form-hint">First upload your photo via <a href="{{ route('admin.media.index') }}" style="color:var(--gold)">Media Library →</a> then select it here.</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Video URL <span style="color:var(--muted);font-weight:400">(YouTube or Vimeo)</span></label>
                    <input type="url" name="about_video_url" class="form-control" maxlength="500"
                           value="{{ old('about_video_url', $settings['about_video_url'] ?? '') }}"
                           placeholder="https://www.youtube.com/watch?v=XXXXXXXXXXX">
                    <span class="form-hint">The "Watch Suresh's Story" button will open this video in a popup.</span>
                </div>
            </div>
        </div>

        {{-- Social --}}
        <div class="card">
            <div class="card-header"><h2>Social Media Links</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
                <div class="form-group">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="url" name="social_linkedin" class="form-control" maxlength="500"
                           value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}"
                           placeholder="https://linkedin.com/in/sureshkumardca/">
                </div>
                <div class="form-group">
                    <label class="form-label">Twitter / X URL</label>
                    <input type="url" name="social_twitter" class="form-control" maxlength="500"
                           value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}"
                           placeholder="https://twitter.com/...">
                </div>
                <div class="form-group">
                    <label class="form-label">Facebook URL</label>
                    <input type="url" name="social_facebook" class="form-control" maxlength="500"
                           value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                           placeholder="https://facebook.com/...">
                </div>
            </div>
        </div>

        {{-- Analytics --}}
        <div class="card">
            <div class="card-header"><h2>Analytics & Tracking</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
                <div class="form-group">
                    <label class="form-label">Google Analytics ID / GTM ID</label>
                    <input type="text" name="ga_id" class="form-control" maxlength="50"
                           value="{{ old('ga_id', $settings['ga_id'] ?? '') }}"
                           placeholder="G-XXXXXXXXXX or GTM-XXXXXXX">
                    <span class="form-hint">Paste your GA4 Measurement ID or GTM container ID. Leave blank to disable.</span>
                </div>
                <div class="card" style="background:var(--bg);border-color:var(--border)">
                    <div class="card-body" style="padding:14px">
                        <p style="font-size:.78rem;color:var(--muted);font-weight:600;margin-bottom:6px">⚙️ SMTP Mail Settings</p>
                        <p style="font-size:.75rem;color:var(--muted);line-height:1.6">Mail credentials are configured in your <code style="background:rgba(0,0,0,.06);padding:1px 4px;border-radius:3px">.env</code> file for security. Keys: <code style="background:rgba(0,0,0,.06);padding:1px 4px;border-radius:3px">MAIL_HOST</code>, <code style="background:rgba(0,0,0,.06);padding:1px 4px;border-radius:3px">MAIL_USERNAME</code>, <code style="background:rgba(0,0,0,.06);padding:1px 4px;border-radius:3px">MAIL_PASSWORD</code>, <code style="background:rgba(0,0,0,.06);padding:1px 4px;border-radius:3px">MAIL_ENCRYPTION</code>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:24px">
        <button type="submit" class="btn btn-primary" style="padding:13px 40px">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Save All Settings
        </button>
    </div>
</form>
@endsection
