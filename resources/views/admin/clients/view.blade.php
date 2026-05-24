@extends('admin.layouts.admin')
@section('title','Clients & Logos')
@section('page-title','Clients & Partner Logos')
@section('page-subtitle','Manage the scrolling logo strip')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Clients ({{ $clients->count() }})</h2>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Client
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Logo</th><th>Client Name</th><th>URL</th><th>Order</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($clients as $c)
                <tr>
                    <td>
                        @if($c->media)
                        <img src="{{ $c->media->url }}" alt="{{ $c->name }} logo" class="td-thumb" style="object-fit:contain;background:var(--bg)">
                        @else
                        <div class="td-thumb-placeholder"><span style="font-size:.7rem;color:var(--muted)">No logo</span></div>
                        @endif
                    </td>
                    <td><strong style="font-size:.85rem">{{ $c->name }}</strong></td>
                    <td style="font-size:.78rem;color:var(--muted)">{{ $c->url ? Str::limit($c->url,40) : '—' }}</td>
                    <td style="color:var(--muted)">{{ $c->sort_order }}</td>
                    <td><span class="badge {{ $c->is_active ? 'badge-green':'badge-red' }}">{{ $c->is_active ? 'Active':'Hidden' }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.clients.edit', $c) }}" class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.clients.destroy', $c) }}" onsubmit="return confirm('Delete this client?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted)">No clients yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
