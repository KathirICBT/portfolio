@extends('admin.layouts.admin')
@section('title','Edit Section')
@section('page-title','Edit Section: '.ucfirst($section->key))
@section('page-subtitle','Update section content and visibility')

@section('content')
<form method="POST" action="{{ route('admin.sections.update', $section) }}" style="max-width:800px">
    @csrf @method('PATCH')

    <div class="card" style="margin-bottom:20px">
        <div class="card-header">
            <h2>Section: <span class="badge badge-blue">{{ $section->key }}</span></h2>
        </div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Navigation Label</label>
                    <input type="text" name="nav_label" class="form-control" maxlength="100"
                           value="{{ old('nav_label', $section->nav_label) }}"
                           placeholder="e.g. About, Services, Contact">
                    <span class="form-hint">Shown in the top navigation bar. Leave blank to hide from nav.</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Anchor</label>
                    <input type="text" class="form-control" value="{{ $section->anchor }}" disabled
                           style="background:var(--bg);color:var(--muted)">
                    <span class="form-hint">Fixed — cannot be changed here.</span>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Section Title</label>
                <input type="text" name="title" class="form-control" maxlength="255"
                       value="{{ old('title', $section->title) }}">
            </div>
            <div class="form-group">
                <label class="form-label">Subtitle / Eyebrow Label</label>
                <input type="text" name="subtitle" class="form-control" maxlength="255"
                       value="{{ old('subtitle', $section->subtitle) }}"
                       placeholder="Short label shown above the title">
            </div>
            <div class="form-group">
                <label class="form-label">Body Content</label>
                <textarea name="body" class="form-control" rows="8"
                          placeholder="Main text content for this section...">{{ old('body', $section->body) }}</textarea>
                <span class="form-hint">Use double line breaks (Enter twice) to create separate paragraphs.</span>
            </div>
            <div class="toggle-wrap">
                <label class="toggle">
                    <input type="checkbox" name="is_visible" value="1"
                           {{ old('is_visible', $section->is_visible) ? 'checked':'' }}>
                    <span class="toggle-slider"></span>
                </label>
                <span class="toggle-label">Section visible on website</span>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px">
        <button type="submit" class="btn btn-primary">Save Section</button>
        <a href="{{ route('admin.sections.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
