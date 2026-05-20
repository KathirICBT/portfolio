@extends('admin.layouts.admin')
@section('title','Gallery')
@section('page-title','Gallery')
@section('page-subtitle','Manage gallery images displayed on the website')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Gallery Items ({{ $items->count() }})</h2>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Image
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Image</th><th>Title</th><th>Caption</th><th>Order</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>
                        @if($item->media)
                        <img src="{{ $item->media->url }}" alt="{{ $item->title ?? $item->media->original_name }}" class="td-thumb">
                        @else
                        <div class="td-thumb-placeholder">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                        @endif
                    </td>
                    <td><strong style="font-size:.85rem">{{ $item->title ?? '—' }}</strong></td>
                    <td style="font-size:.78rem;color:var(--muted);max-width:240px">{{ $item->caption ? \Str::limit($item->caption, 60) : '—' }}</td>
                    <td style="color:var(--muted)">{{ $item->sort_order }}</td>
                    <td><span class="badge {{ $item->is_active ? 'badge-green':'badge-red' }}">{{ $item->is_active ? 'Active':'Hidden' }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" onsubmit="return confirm('Delete this gallery item?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted)">No gallery items yet. Add your first image.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
