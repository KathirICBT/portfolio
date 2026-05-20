@extends('admin.layouts.admin')
@section('title','Edit Network Profile')
@section('page-title','Edit Network Profile')
@section('page-subtitle','Update influential connection details')

@section('content')
<form method="POST" action="{{ route('admin.network-profiles.update', $networkProfile) }}" style="max-width:700px">
    @csrf @method('PUT')

    <div class="card" style="margin-bottom:20px">
        <div class="card-header"><h2>Profile Details</h2></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Full Name <span class="req">*</span></label>
                    <input type="text" name="name" class="form-control" required maxlength="255"
                           value="{{ old('name', $networkProfile->name) }}">
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Title / Role</label>
                    <input type="text" name="title" class="form-control" maxlength="255"
                           value="{{ old('title', $networkProfile->title) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="4" maxlength="1000">{{ old('bio', $networkProfile->bio) }}</textarea>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Photo</label>
                    <select name="media_id" class="form-control">
                        <option value="">— No photo (initials shown) —</option>
                        @foreach($mediaList as $m)
                        <option value="{{ $m->id }}" {{ old('media_id', $networkProfile->media_id) == $m->id ? 'selected':'' }}>
                            {{ $m->original_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" min="1"
                           value="{{ old('sort_order', $networkProfile->sort_order) }}">
                </div>
            </div>
            <div class="toggle-wrap">
                <label class="toggle">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $networkProfile->is_active) ? 'checked':'' }}>
                    <span class="toggle-slider"></span>
                </label>
                <span class="toggle-label">Active (visible on site)</span>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px">
        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="{{ route('admin.network-profiles.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
