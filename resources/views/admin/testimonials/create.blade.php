@extends('admin.layouts.admin')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')
@section('page-title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')
@section('page-subtitle','Client testimonials management')

@section('content')
<form method="POST" action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" style="max-width:700px">
    @csrf @if(isset($testimonial)) @method('PUT') @endif

    <div class="card" style="margin-bottom:20px">
        <div class="card-header"><h2>Testimonial Details</h2></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
            <div class="form-group">
                <label class="form-label">Quote <span class="req">*</span></label>
                <textarea name="quote" class="form-control" rows="4" required maxlength="1000"
                          placeholder="The testimonial quote text...">{{ old('quote', $testimonial->quote ?? '') }}</textarea>
                @error('quote')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Author Name <span class="req">*</span></label>
                    <input type="text" name="author_name" class="form-control" required maxlength="255"
                           value="{{ old('author_name', $testimonial->author_name ?? '') }}"
                           placeholder="e.g. Donald Blair">
                    @error('author_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Author Title / Company</label>
                    <input type="text" name="author_title" class="form-control" maxlength="255"
                           value="{{ old('author_title', $testimonial->author_title ?? '') }}"
                           placeholder="e.g. CEO, Acme Corp">
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" min="1"
                           value="{{ old('sort_order', $testimonial->sort_order ?? 1) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Author Photo</label>
                    <select name="media_id" class="form-control">
                        <option value="">— No photo —</option>
                        @foreach($mediaList as $m)
                        <option value="{{ $m->id }}" {{ old('media_id', $testimonial->media_id ?? '') == $m->id ? 'selected':'' }}>
                            {{ $m->original_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="toggle-wrap">
                <label class="toggle">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $testimonial->is_active ?? true) ? 'checked':'' }}>
                    <span class="toggle-slider"></span>
                </label>
                <span class="toggle-label">Active (visible on site)</span>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px">
        <button type="submit" class="btn btn-primary">{{ isset($testimonial) ? 'Update Testimonial':'Add Testimonial' }}</button>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
