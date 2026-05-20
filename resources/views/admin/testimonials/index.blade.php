@extends('admin.layouts.admin')
@section('title','Testimonials')
@section('page-title','Testimonials')
@section('page-subtitle','Manage client testimonials and quotes')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Testimonials ({{ $testimonials->count() }})</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Testimonial
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Photo</th><th>Author</th><th>Quote Preview</th><th>Order</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr>
                    <td>
                        @if($t->media)
                        <img src="{{ $t->media->url }}" alt="{{ $t->author_name }}" class="td-thumb" style="border-radius:50%">
                        @else
                        <div class="td-thumb-placeholder" style="border-radius:50%">
                            <span style="font-size:.9rem;font-weight:700;color:var(--muted)">{{ strtoupper(substr($t->author_name,0,1)) }}</span>
                        </div>
                        @endif
                    </td>
                    <td>
                        <strong style="font-size:.85rem">{{ $t->author_name }}</strong>
                        @if($t->author_title)<br><span style="font-size:.75rem;color:var(--muted)">{{ $t->author_title }}</span>@endif
                    </td>
                    <td style="color:var(--muted);font-size:.82rem;max-width:300px;font-style:italic">"{{ Str::limit($t->quote, 80) }}"</td>
                    <td style="color:var(--muted)">{{ $t->sort_order }}</td>
                    <td><span class="badge {{ $t->is_active ? 'badge-green':'badge-red' }}">{{ $t->is_active ? 'Active':'Hidden' }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete this testimonial?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted)">No testimonials yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
