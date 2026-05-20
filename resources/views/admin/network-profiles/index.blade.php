@extends('admin.layouts.admin')
@section('title','Network Profiles')
@section('page-title','Network Profiles')
@section('page-subtitle','Manage influential connections and civic leaders')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Profiles ({{ $profiles->count() }})</h2>
        <a href="{{ route('admin.network-profiles.create') }}" class="btn btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Profile
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Photo</th><th>Name</th><th>Title</th><th>Bio Preview</th><th>Order</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($profiles as $p)
                <tr>
                    <td>
                        @if($p->media)
                        <img src="{{ $p->media->url }}" alt="{{ $p->name }}" class="td-thumb" style="border-radius:50%">
                        @else
                        <div class="td-thumb-placeholder" style="border-radius:50%;background:var(--navy-mid)">
                            <span style="font-size:.9rem;font-weight:700;color:#fff">{{ strtoupper(substr($p->name,0,1)) }}</span>
                        </div>
                        @endif
                    </td>
                    <td><strong style="font-size:.85rem">{{ $p->name }}</strong></td>
                    <td style="font-size:.8rem;color:var(--gold)">{{ $p->title }}</td>
                    <td style="font-size:.78rem;color:var(--muted);max-width:260px">{{ Str::limit($p->bio, 70) }}</td>
                    <td style="color:var(--muted)">{{ $p->sort_order }}</td>
                    <td><span class="badge {{ $p->is_active ? 'badge-green':'badge-red' }}">{{ $p->is_active ? 'Active':'Hidden' }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.network-profiles.edit', $p) }}" class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.network-profiles.destroy', $p) }}" onsubmit="return confirm('Delete this profile?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted)">No profiles yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
