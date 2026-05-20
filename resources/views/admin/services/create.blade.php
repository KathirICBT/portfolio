@extends('admin.layouts.admin')
@section('title', isset($service) ? 'Edit Service' : 'Add Service')
@section('page-title', isset($service) ? 'Edit Service' : 'Add New Service')
@section('page-subtitle','Service cards management')

@section('content')
<form method="POST" action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" style="max-width:800px">
    @csrf @if(isset($service)) @method('PUT') @endif

    <div class="card" style="margin-bottom:20px">
        <div class="card-header"><h2>Service Details</h2></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Icon Name <span style="font-weight:400;color:var(--muted)">(chart-bar, users, rocket, computer, megaphone, building, star)</span></label>
                    <input type="text" name="icon" class="form-control"
                           value="{{ old('icon', $service->icon ?? '') }}"
                           placeholder="e.g. chart-bar">
                    <span class="form-hint">Used to select the SVG icon. See available names above.</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" min="1"
                           value="{{ old('sort_order', $service->sort_order ?? 1) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Service Title <span class="req">*</span></label>
                <input type="text" name="title" class="form-control" required maxlength="255"
                       value="{{ old('title', $service->title ?? '') }}"
                       placeholder="e.g. Strategic Business Advisory">
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Description <span class="req">*</span></label>
                <textarea name="body" class="form-control" rows="5" required maxlength="2000"
                          placeholder="Describe this service in detail...">{{ old('body', $service->body ?? '') }}</textarea>
                @error('body')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Link Label <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
                    <input type="text" name="link_label" class="form-control" maxlength="100"
                           value="{{ old('link_label', $service->link_label ?? '') }}"
                           placeholder="e.g. Learn More">
                </div>
                <div class="form-group">
                    <label class="form-label">Link URL <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
                    <input type="text" name="link_url" class="form-control" maxlength="255"
                           value="{{ old('link_url', $service->link_url ?? '') }}"
                           placeholder="#contact or https://...">
                </div>
            </div>
            <div class="toggle-wrap">
                <label class="toggle">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $service->is_active ?? true) ? 'checked':'' }}>
                    <span class="toggle-slider"></span>
                </label>
                <span class="toggle-label">Active (visible on site)</span>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px">
        <button type="submit" class="btn btn-primary">{{ isset($service) ? 'Update Service':'Create Service' }}</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
