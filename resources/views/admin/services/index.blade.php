@extends('admin.layouts.admin')
@section('title','Services')
@section('page-title','Services')
@section('page-subtitle','Manage service cards displayed on the website')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Services ({{ $services->count() }})</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Service
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Order</th><th>Icon</th><th>Title</th><th>Body Preview</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($services as $svc)
                <tr>
                    <td style="color:var(--muted);font-weight:600">{{ $svc->sort_order }}</td>
                    <td><span class="badge badge-blue">{{ $svc->icon ?? '–' }}</span></td>
                    <td><strong style="font-size:.85rem">{{ $svc->title }}</strong></td>
                    <td style="color:var(--muted);font-size:.82rem;max-width:300px">{{ Str::limit($svc->body, 80) }}</td>
                    <td><span class="badge {{ $svc->is_active ? 'badge-green':'badge-red' }}">{{ $svc->is_active ? 'Active':'Hidden' }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.services.edit', $svc) }}" class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.services.destroy', $svc) }}" onsubmit="return confirm('Delete this service?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted)">No services found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
