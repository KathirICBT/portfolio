@extends('admin.layouts.admin')
@section('title', isset($client) ? 'Edit Client' : 'Add Client')
@section('page-title', isset($client) ? 'Edit Client' : 'Add Client Logo')
@section('page-subtitle','Client logo management')

@section('content')
<form method="POST" action="{{ isset($client) ? route('admin.clients.update', $client) : route('admin.clients.store') }}" style="max-width:600px">
    @csrf @if(isset($client)) @method('PUT') @endif

    <div class="card" style="margin-bottom:20px">
        <div class="card-header"><h2>Client Details</h2></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:18px">
            <div class="form-group">
                <label class="form-label">Client / Company Name <span class="req">*</span></label>
                <input type="text" name="name" class="form-control" required maxlength="255"
                       value="{{ old('name', $client->name ?? '') }}"
                       placeholder="e.g. Ramachandral Law">
                @error('name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Website URL <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
                <input type="url" name="url" class="form-control" maxlength="255"
                       value="{{ old('url', $client->url ?? '') }}"
                       placeholder="https://example.com">
            </div>
            <div class="form-group">
                <label class="form-label">Logo Image</label>
                @if(isset($client) && $client->media)
                <div style="margin-bottom:10px;padding:12px;background:var(--bg);border-radius:8px;display:inline-block">
                    <img src="{{ $client->media->url }}" alt="{{ $client->name }}" style="height:48px;object-fit:contain">
                </div>
                @endif
                <select name="media_id" class="form-control">
                    <option value="">— No logo (text fallback) —</option>
                    @foreach($mediaList as $m)
                    <option value="{{ $m->id }}" {{ old('media_id', $client->media_id ?? '') == $m->id ? 'selected':'' }}>
                        {{ $m->original_name }}
                    </option>
                    @endforeach
                </select>
                <a href="{{ route('admin.media.index') }}" target="_blank" style="font-size:.75rem;color:var(--gold);margin-top:6px;display:inline-block">Upload new logo →</a>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" min="1"
                           value="{{ old('sort_order', $client->sort_order ?? 1) }}">
                </div>
                <div class="form-group" style="justify-content:flex-end;padding-bottom:4px">
                    <div class="toggle-wrap" style="margin-top:auto">
                        <label class="toggle">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $client->is_active ?? true) ? 'checked':'' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px">
        <button type="submit" class="btn btn-primary">{{ isset($client) ? 'Update Client':'Add Client' }}</button>
        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
