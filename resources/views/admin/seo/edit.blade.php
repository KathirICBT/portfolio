@extends('admin.layouts.admin')
@section('title','SEO Settings')
@section('page-title','SEO Settings')
@section('page-subtitle','Manage meta tags, Open Graph, schema, and indexing')

@section('content')
<form method="POST" action="{{ route('admin.seo.update') }}">
    @csrf @method('PATCH')

    <div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start">

        <div style="display:flex;flex-direction:column;gap:20px">

            {{-- Basic Meta --}}
            <div class="card">
                <div class="card-header"><h2>Basic Meta Tags</h2></div>
                <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
                    <div class="form-group">
                        <label class="form-label">Meta Title <span style="color:var(--muted);font-weight:400">(Max 60 chars recommended)</span></label>
                        <input type="text" name="meta_title" id="metaTitle" class="form-control" maxlength="160"
                               value="{{ old('meta_title', $seo->meta_title) }}"
                               placeholder="Page Title | Site Name"
                               oninput="updateCount('metaTitle','metaTitleCount',60)">
                        <div style="display:flex;justify-content:space-between;margin-top:4px">
                            <span class="form-hint">Shown in browser tab and Google search results.</span>
                            <span class="char-count" id="metaTitleCount">{{ strlen($seo->meta_title ?? '') }}/160</span>
                        </div>
                        @error('meta_title')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Meta Description <span style="color:var(--muted);font-weight:400">(Max 155 chars recommended)</span></label>
                        <textarea name="meta_description" id="metaDesc" class="form-control" rows="3" maxlength="320"
                                  oninput="updateCount('metaDesc','metaDescCount',155)"
                                  placeholder="Compelling summary shown in Google search snippets…">{{ old('meta_description', $seo->meta_description) }}</textarea>
                        <div style="display:flex;justify-content:space-between;margin-top:4px">
                            <span class="form-hint">Appears in search engine result pages below the title.</span>
                            <span class="char-count" id="metaDescCount">{{ strlen($seo->meta_description ?? '') }}/320</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Canonical URL</label>
                        <input type="url" name="canonical_url" class="form-control" maxlength="500"
                               value="{{ old('canonical_url', $seo->canonical_url) }}"
                               placeholder="https://sureshkumar.ca/">
                        <span class="form-hint">Prevents duplicate content. Usually your homepage URL.</span>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Robots Directive</label>
                            <select name="robots" class="form-control">
                                @foreach(['index, follow','index, nofollow','noindex, follow','noindex, nofollow'] as $r)
                                <option value="{{ $r }}" {{ old('robots',$seo->robots) === $r ? 'selected':'' }}>{{ $r }}</option>
                                @endforeach
                            </select>
                            <span class="form-hint">Use "index, follow" for a live production site.</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Open Graph --}}
            <div class="card">
                <div class="card-header"><h2>Open Graph (Facebook / LinkedIn)</h2></div>
                <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
                    <div class="form-group">
                        <label class="form-label">OG Title</label>
                        <input type="text" name="og_title" class="form-control" maxlength="255"
                               value="{{ old('og_title', $seo->og_title) }}"
                               placeholder="Defaults to meta title if empty">
                    </div>
                    <div class="form-group">
                        <label class="form-label">OG Description</label>
                        <textarea name="og_description" class="form-control" rows="3" maxlength="600"
                                  placeholder="Defaults to meta description if empty">{{ old('og_description', $seo->og_description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">OG Image</label>
                        @if($seo->ogImage)
                        <div style="margin-bottom:8px"><img src="{{ $seo->ogImage->url }}" style="height:80px;border-radius:6px;object-fit:cover;border:1px solid var(--border)"></div>
                        @endif
                        <select name="og_image_id" class="form-control">
                            <option value="">— No image —</option>
                            @foreach($mediaList as $m)
                            <option value="{{ $m->id }}" {{ old('og_image_id',$seo->og_image_id) == $m->id ? 'selected':'' }}>{{ $m->original_name }}</option>
                            @endforeach
                        </select>
                        <span class="form-hint">Recommended: 1200×630px. Shown when page is shared on social media.</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Twitter Card Type</label>
                        <select name="twitter_card" class="form-control">
                            <option value="summary_large_image" {{ old('twitter_card',$seo->twitter_card) === 'summary_large_image' ? 'selected':'' }}>Summary Large Image (recommended)</option>
                            <option value="summary" {{ old('twitter_card',$seo->twitter_card) === 'summary' ? 'selected':'' }}>Summary</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Schema --}}
            <div class="card">
                <div class="card-header"><h2>Schema.org / JSON-LD</h2></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Custom Schema JSON-LD</label>
                        <textarea name="schema_json" class="form-control" rows="14"
                                  style="font-family:monospace;font-size:.78rem"
                                  placeholder='{"@@context":"https://schema.org","@@type":"Person",...}'>{{ old('schema_json', $seo->schema_json) }}</textarea>
                        <span class="form-hint">Advanced: Paste a valid JSON-LD object. Leave blank to use the system-generated schema. Validate at <a href="https://search.google.com/test/rich-results" target="_blank" style="color:var(--gold)">Google Rich Results Test →</a></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Preview --}}
        <div style="position:sticky;top:80px;display:flex;flex-direction:column;gap:16px">
            <div class="card">
                <div class="card-header"><h2>Google Preview</h2></div>
                <div class="card-body">
                    <div style="font-size:.78rem;padding:12px;background:#f8f9fa;border-radius:8px;border:1px solid var(--border)">
                        <div style="color:#1a0dab;font-size:.9rem;font-weight:500;margin-bottom:2px" id="previewTitle">{{ $seo->meta_title ?? 'Page Title' }}</div>
                        <div style="color:#006621;font-size:.72rem;margin-bottom:4px">{{ config('app.url') }}</div>
                        <div style="color:#545454;font-size:.78rem;line-height:1.5" id="previewDesc">{{ $seo->meta_description ?? 'Meta description will appear here…' }}</div>
                    </div>
                    <p class="form-hint" style="margin-top:8px">Preview updates as you type.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h2>SEO Checklist</h2></div>
                <div class="card-body" style="display:flex;flex-direction:column;gap:8px">
                    @php
                    $checks = [
                        ['label'=>'Meta title set',        'pass'=>!empty($seo->meta_title)],
                        ['label'=>'Meta description set',  'pass'=>!empty($seo->meta_description)],
                        ['label'=>'Canonical URL set',     'pass'=>!empty($seo->canonical_url)],
                        ['label'=>'OG image set',          'pass'=>!empty($seo->og_image_id)],
                        ['label'=>'Indexing enabled',      'pass'=>str_contains($seo->robots ?? 'index','index')],
                        ['label'=>'Schema JSON set',       'pass'=>!empty($seo->schema_json)],
                    ];
                    @endphp
                    @foreach($checks as $c)
                    <div style="display:flex;align-items:center;gap:8px;font-size:.78rem">
                        <span style="color:{{ $c['pass'] ? '#22C55E':'#EF4444' }};font-size:1rem">{{ $c['pass'] ? '✓':'✗' }}</span>
                        <span style="color:{{ $c['pass'] ? 'var(--ink)':'var(--muted)' }}">{{ $c['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:13px">Save SEO Settings</button>
        </div>
    </div>
</form>

<script>
function updateCount(fieldId, countId, warn) {
    const el = document.getElementById(fieldId);
    const counter = document.getElementById(countId);
    const len = el.value.length;
    counter.textContent = len + '/' + el.maxLength;
    counter.style.color = len > warn ? 'var(--danger)' : 'var(--muted)';
}
// Live preview
document.getElementById('metaTitle')?.addEventListener('input', e => {
    document.getElementById('previewTitle').textContent = e.target.value || 'Page Title';
});
document.getElementById('metaDesc')?.addEventListener('input', e => {
    document.getElementById('previewDesc').textContent = e.target.value || 'Meta description will appear here…';
});
</script>
@endsection
