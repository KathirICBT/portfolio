@extends('admin.layouts.admin')
@section('title','Media Library')
@section('page-title','Media Library')
@section('page-subtitle','Upload and manage images used across the website')

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <h1>Media Library <span style="font-size:.8rem;font-weight:400;color:var(--text-muted)">({{ $media->total() }} files)</span></h1>
        <p>{{ $media->currentPage() }} of {{ $media->lastPage() }} pages · JPEG, PNG, WebP, GIF, SVG · max 10 MB</p>
    </div>
</div>

{{-- Upload Zone --}}
<div class="card" style="margin-bottom:24px" id="uploadCard">
    <div class="card-header">
        <h2>Upload New File</h2>
        <button type="button" onclick="document.getElementById('uploadCard').classList.toggle('upload-collapsed')"
                style="background:none;border:none;cursor:pointer;color:var(--text-muted);font-size:.78rem;display:flex;align-items:center;gap:5px"
                aria-label="Collapse upload section">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="18 15 12 9 6 15"/></svg>
            Collapse
        </button>
    </div>
    <div class="card-body upload-body">
        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" id="uploadForm">
            @csrf

            {{-- Drag & drop zone --}}
            <div class="upload-zone" id="dropZone" onclick="document.getElementById('fileInput').click()" role="button" tabindex="0"
                 aria-label="Click or drag an image here to upload" onkeydown="if(event.key==='Enter'||event.key===' ')document.getElementById('fileInput').click()">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 12px;color:var(--gold)" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                <p style="font-weight:600;color:var(--text);font-size:.88rem;margin-bottom:4px">Drop image here or <span style="color:var(--gold)">browse</span></p>
                <p style="font-size:.75rem">JPEG, PNG, WebP, GIF, SVG · Recommended: 1920×1080px for sliders</p>
                <input type="file" id="fileInput" name="file" accept="image/*" required style="display:none"
                       onchange="handleFileSelect(this)">
                <div id="filePreview" style="display:none;margin-top:16px;align-items:center;gap:12px">
                    <img id="previewImg" src="" alt="" style="width:80px;height:56px;object-fit:cover;border-radius:8px;border:1px solid var(--border)">
                    <span id="previewName" style="font-size:.8rem;color:var(--text);font-weight:600"></span>
                </div>
            </div>

            <div style="display:flex;align-items:flex-end;gap:16px;margin-top:16px;flex-wrap:wrap">
                <div class="form-group" style="flex:1;min-width:200px">
                    <label class="form-label" for="altText">Alt Text <span style="font-weight:400;color:var(--text-muted)">(Accessibility + SEO)</span></label>
                    <input type="text" id="altText" name="alt_text" class="form-control" maxlength="255"
                           placeholder="e.g. Suresh Kumar speaking at a GTA networking event">
                    <span class="form-hint">Describe the image for screen readers. Be specific and descriptive.</span>
                </div>
                <div style="flex-shrink:0;padding-bottom:22px">
                    <button type="submit" class="btn btn-primary" id="uploadBtn" disabled>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        Upload File
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Search + Grid --}}
<div class="card">
    <div class="card-header">
        <h2>All Files</h2>
        <div class="filter-bar" style="margin:0">
            <div class="search-wrap" style="min-width:180px">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" class="search-input" id="mediaSearch" placeholder="Search files…" aria-label="Search media files">
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($media->count())
        <div class="media-grid" id="mediaGrid">
            @foreach($media as $file)
            <div class="media-item" data-name="{{ strtolower($file->filename) }} {{ strtolower($file->original_name ?? '') }}"
                 title="{{ $file->original_name ?? $file->filename }}">
                @if(str_starts_with($file->mime_type ?? '', 'image/'))
                <img src="{{ $file->url }}" alt="{{ $file->alt_text ?? $file->filename }}" loading="lazy">
                @else
                <div style="height:96px;background:var(--bg);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:6px">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <span style="font-size:.65rem;color:var(--text-muted)">{{ strtoupper(pathinfo($file->filename, PATHINFO_EXTENSION)) }}</span>
                </div>
                @endif

                <div class="media-item-info">
                    <p class="media-item-name" title="{{ $file->original_name ?? $file->filename }}">{{ $file->filename }}</p>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:3px">
                        <span style="font-size:.65rem;color:var(--text-muted)">{{ $file->human_size }}</span>
                        <form method="POST" action="{{ route('admin.media.destroy', $file) }}"
                              onsubmit="return confirm('Permanently delete \'{{ addslashes($file->original_name ?? $file->filename) }}\'?\n\nThis cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none;border:none;cursor:pointer;color:var(--danger);font-size:.7rem;padding:2px 4px;border-radius:4px;transition:background 0.15s"
                                    onmouseover="this.style.background='rgba(239,68,68,0.1)'"
                                    onmouseout="this.style.background='none'"
                                    aria-label="Delete {{ $file->original_name ?? $file->filename }}"
                                    title="Delete permanently">✕</button>
                        </form>
                    </div>

                    {{-- Inline alt text edit --}}
                    <form method="POST" action="{{ route('admin.media.update', $file) }}" style="margin-top:7px">
                        @csrf @method('PATCH')
                        <input type="text" name="alt_text" class="form-control"
                               value="{{ $file->alt_text }}"
                               placeholder="Add alt text…"
                               style="font-size:.68rem;padding:5px 8px;border-radius:6px;min-height:0"
                               aria-label="Alt text for {{ $file->filename }}">
                        <button type="submit" style="margin-top:5px;background:var(--gold);border:none;cursor:pointer;font-size:.65rem;padding:4px 10px;border-radius:5px;font-weight:700;color:var(--navy);width:100%;transition:background 0.15s"
                                onmouseover="this.style.background='var(--gold-light)'"
                                onmouseout="this.style.background='var(--gold)'"
                                aria-label="Save alt text">
                            Save Alt Text
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($media->lastPage() > 1)
        <div style="margin-top:28px;display:flex;justify-content:center">
            {{ $media->links() }}
        </div>
        @endif

        @else
        <div class="empty-state">
            <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <h3>No media files yet</h3>
            <p>Upload your first image to get started. Use the upload form above.</p>
        </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<style>
.upload-collapsed .upload-body { display:none }
.upload-collapsed .card-header button svg { transform:rotate(180deg) }
</style>
<script>
/* ── Drag & Drop ── */
(function(){
    var zone = document.getElementById('dropZone');
    if(!zone) return;
    ['dragenter','dragover'].forEach(function(e){
        zone.addEventListener(e, function(ev){ ev.preventDefault(); zone.classList.add('drag') });
    });
    ['dragleave','drop'].forEach(function(e){
        zone.addEventListener(e, function(ev){ ev.preventDefault(); zone.classList.remove('drag') });
    });
    zone.addEventListener('drop', function(ev){
        var files = ev.dataTransfer.files;
        if(files.length){
            document.getElementById('fileInput').files = files;
            handleFileSelect(document.getElementById('fileInput'));
        }
    });
})();

function handleFileSelect(input){
    var btn     = document.getElementById('uploadBtn');
    var preview = document.getElementById('filePreview');
    var img     = document.getElementById('previewImg');
    var name    = document.getElementById('previewName');
    if(input.files && input.files[0]){
        var file = input.files[0];
        name.textContent = file.name + ' (' + (file.size/1024/1024).toFixed(2) + ' MB)';
        if(file.type.startsWith('image/')){
            var reader = new FileReader();
            reader.onload = function(e){ img.src = e.target.result; img.style.display = 'block' };
            reader.readAsDataURL(file);
        } else {
            img.style.display = 'none';
        }
        preview.style.display = 'flex';
        btn.disabled = false;
    }
}

/* ── Media search filter ── */
(function(){
    var search = document.getElementById('mediaSearch');
    if(!search) return;
    search.addEventListener('input', function(){
        var q = this.value.toLowerCase().trim();
        document.querySelectorAll('#mediaGrid .media-item').forEach(function(el){
            el.style.display = !q || (el.dataset.name||'').includes(q) ? '' : 'none';
        });
    });
})();
</script>
@endpush
