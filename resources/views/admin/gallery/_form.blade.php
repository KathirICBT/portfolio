<div class="card" style="margin-bottom:20px">
    <div class="card-header"><h2>Gallery Image Details</h2></div>
    <div class="card-body" style="display:flex;flex-direction:column;gap:18px">

        <div class="form-group">
            <label class="form-label">Image <span class="req">*</span></label>
            @if(isset($item) && $item->media)
            <div style="margin-bottom:10px;padding:12px;background:var(--bg);border-radius:8px;display:inline-block">
                <img src="{{ $item->media->url }}" alt="{{ $item->title ?? '' }}" style="height:100px;object-fit:cover;border-radius:6px">
            </div>
            @endif
            <select name="media_id" class="form-control">
                <option value="">— Select an image —</option>
                @foreach($mediaList as $m)
                <option value="{{ $m->id }}" {{ old('media_id', $item->media_id ?? '') == $m->id ? 'selected':'' }}>
                    {{ $m->original_name }}
                </option>
                @endforeach
            </select>
            <a href="{{ route('admin.media.index') }}" target="_blank" style="font-size:.75rem;color:var(--gold);margin-top:6px;display:inline-block">Upload new image →</a>
            @error('media_id')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Title <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
            <input type="text" name="title" class="form-control" maxlength="255"
                   value="{{ old('title', $item->title ?? '') }}"
                   placeholder="e.g. Networking Event 2024">
            @error('title')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Caption <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
            <textarea name="caption" class="form-control" rows="3" maxlength="500"
                      placeholder="A short description for this image…">{{ old('caption', $item->caption ?? '') }}</textarea>
            @error('caption')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" min="1"
                       value="{{ old('sort_order', $item->sort_order ?? 1) }}">
            </div>
            <div class="form-group" style="justify-content:flex-end;padding-bottom:4px">
                <div class="toggle-wrap" style="margin-top:auto">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $item->is_active ?? true) ? 'checked':'' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">Active</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display:flex;gap:10px">
    <button type="submit" class="btn btn-primary">{{ isset($item) ? 'Update Image' : 'Add Image' }}</button>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline">Cancel</a>
</div>
