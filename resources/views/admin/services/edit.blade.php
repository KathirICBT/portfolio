@extends('admin.layouts.admin')
@section('title','Edit Service')
@section('page-title','Edit Service')
@section('page-subtitle','Update service card content')

@section('content')
<form method="POST" action="{{ route('admin.services.update', $service) }}" style="max-width:800px">
    @csrf @method('PUT')

    <div class="card" style="margin-bottom:20px">
        <div class="card-header"><h2>Service Details</h2></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Icon Name</label>
                    <input type="text" name="icon" class="form-control"
                           value="{{ old('icon', $service->icon) }}"
                           placeholder="chart-bar, users, rocket, computer, megaphone, building, star">
                </div>
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" min="1"
                           value="{{ old('sort_order', $service->sort_order) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Service Title <span class="req">*</span></label>
                <input type="text" name="title" class="form-control" required maxlength="255"
                       value="{{ old('title', $service->title) }}">
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Description <span class="req">*</span></label>
                <textarea name="body" class="form-control" rows="5" required maxlength="2000">{{ old('body', $service->body) }}</textarea>
                @error('body')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Link Label (Optional)</label>
                    <input type="text" name="link_label" class="form-control" maxlength="100"
                           value="{{ old('link_label', $service->link_label) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Link URL (Optional)</label>
                    <input type="text" name="link_url" class="form-control" maxlength="255"
                           value="{{ old('link_url', $service->link_url) }}">
                </div>
            </div>
            <div class="toggle-wrap">
                <label class="toggle">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $service->is_active) ? 'checked':'' }}>
                    <span class="toggle-slider"></span>
                </label>
                <span class="toggle-label">Active (visible on site)</span>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px">
        <button type="submit" class="btn btn-primary">Update Service</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
