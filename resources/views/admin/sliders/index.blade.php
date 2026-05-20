@extends('admin.layouts.admin')
@section('title','Slider Management')
@section('page-title','Hero Sliders')
@section('page-subtitle','Manage homepage banner slides')

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <h1>All Slides <span style="font-size:.8rem;font-weight:400;color:var(--text-muted)">({{ $sliders->count() }})</span></h1>
        <p>Drag rows to reorder · Click status to toggle live/draft instantly</p>
    </div>
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Slide
    </a>
</div>

<div class="filter-bar">
    <div class="search-wrap">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" class="search-input" id="slideSearch" placeholder="Search slides…" aria-label="Search slides">
    </div>
    <select class="filter-select" id="statusFilter" aria-label="Filter by status">
        <option value="">All Status</option>
        <option value="active">Live</option>
        <option value="inactive">Draft</option>
    </select>
</div>

<div class="card">
    <div class="table-wrap">
        <table id="slidersTable">
            <thead>
                <tr>
                    <th style="width:40px"></th>
                    <th style="width:68px">Image</th>
                    <th>Title</th>
                    <th>CTA Button</th>
                    <th style="width:90px">Status</th>
                    <th style="width:110px">Actions</th>
                </tr>
            </thead>
            <tbody id="sliderRows">
                @forelse($sliders as $slide)
                <tr data-id="{{ $slide->id }}" data-title="{{ strtolower($slide->title) }}" data-status="{{ $slide->is_active ? 'active' : 'inactive' }}">
                    <td style="color:var(--text-muted);cursor:grab;text-align:center;font-size:1rem;letter-spacing:1px" title="Drag to reorder" aria-label="Drag to reorder">⠿</td>
                    <td>
                        @if($slide->media)
                        <img src="{{ $slide->media->url }}" alt="{{ $slide->media->alt_text }}" class="td-thumb">
                        @else
                        <div class="td-thumb-placeholder" aria-label="No image">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                        @endif
                    </td>
                    <td>
                        <strong style="display:block;font-size:.85rem;color:var(--text)">{{ Str::limit($slide->title, 55) }}</strong>
                        @if($slide->eyebrow_label)
                        <span class="badge badge-blue" style="margin-top:5px">{{ $slide->eyebrow_label }}</span>
                        @endif
                        @if($slide->subtitle)
                        <span style="display:block;font-size:.75rem;color:var(--text-muted);margin-top:4px">{{ Str::limit($slide->subtitle, 60) }}</span>
                        @endif
                    </td>
                    <td style="font-size:.82rem;color:var(--text-muted)">
                        {{ $slide->cta1_label ?? '–' }}
                        @if($slide->cta1_label && $slide->cta1_url)
                        <span style="display:block;font-size:.7rem;opacity:.6;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px">{{ $slide->cta1_url }}</span>
                        @endif
                    </td>
                    <td>
                        <button
                            type="button"
                            class="status-toggle-btn {{ $slide->is_active ? 'is-active' : 'is-inactive' }}"
                            data-url="{{ route('admin.sliders.toggle', $slide) }}"
                            data-csrf="{{ csrf_token() }}"
                            onclick="toggleStatus(this, this.dataset.url, this.dataset.csrf)"
                            aria-label="Toggle status for {{ $slide->title }}"
                            title="{{ $slide->is_active ? 'Click to set to Draft' : 'Click to publish' }}">
                            @if($slide->is_active)
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                            Live
                            @else
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            Draft
                            @endif
                        </button>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;align-items:center">
                            <a href="{{ route('admin.sliders.edit', $slide) }}" class="btn btn-outline btn-sm" aria-label="Edit {{ $slide->title }}">Edit</a>
                            <form method="POST" action="{{ route('admin.sliders.destroy', $slide) }}" id="del-slide-{{ $slide->id }}">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDelete('del-slide-{{ $slide->id }}', '{{ addslashes($slide->title) }}')"
                                    aria-label="Delete {{ $slide->title }}">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr id="emptyRow">
                    <td colspan="6">
                        <div class="empty-state">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="7" width="20" height="15" rx="2"/><polyline points="17 2 12 7 7 2"/></svg>
                            <h3>No slides yet</h3>
                            <p>Create your first hero slide to display on the homepage.</p>
                            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                Create First Slide
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
/* ── Client-side search & filter ── */
(function(){
    var searchInput  = document.getElementById('slideSearch');
    var statusSelect = document.getElementById('statusFilter');
    var rows = document.querySelectorAll('#sliderRows tr[data-id]');

    function applyFilters(){
        var q      = (searchInput.value || '').toLowerCase().trim();
        var status = statusSelect.value;
        var visible = 0;
        rows.forEach(function(row){
            var titleMatch  = !q      || row.dataset.title.includes(q);
            var statusMatch = !status || row.dataset.status === status;
            var show = titleMatch && statusMatch;
            row.style.display = show ? '' : 'none';
            if(show) visible++;
        });
        var noResults = document.getElementById('noResults');
        if(visible === 0 && rows.length > 0){
            if(!noResults){
                var tr = document.createElement('tr');
                tr.id = 'noResults';
                tr.innerHTML = '<td colspan="6"><div class="empty-state" style="padding:40px"><p>No slides match your search.</p></div></td>';
                document.getElementById('sliderRows').appendChild(tr);
            }
        } else if(noResults){
            noResults.remove();
        }
    }

    if(searchInput)  searchInput.addEventListener('input', applyFilters);
    if(statusSelect) statusSelect.addEventListener('change', applyFilters);
})();

/* ── Delete confirmation (inline popover-style) ── */
function confirmDelete(formId, title){
    if(confirm('Delete "' + title + '"?\n\nThis action cannot be undone.')) {
        document.getElementById(formId).submit();
    }
}
</script>
@endpush
