@extends('admin.layouts.admin')
@section('title','Page Sections')
@section('page-title','Page Sections')
@section('page-subtitle','Manage visibility and content of each website section')

@section('content')
<div class="card">
    <div class="card-header"><h2>All Sections</h2></div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Section</th><th>Anchor</th><th>Nav Label</th><th>Title</th><th>Visible</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @foreach($sections as $sec)
                <tr>
                    <td><span class="badge badge-blue">{{ $sec->key }}</span></td>
                    <td style="font-size:.8rem;color:var(--muted)">{{ $sec->anchor }}</td>
                    <td style="font-size:.82rem">{{ $sec->nav_label ?? '—' }}</td>
                    <td style="font-size:.82rem">{{ Str::limit($sec->title, 50) }}</td>
                    <td>
                        <span class="badge {{ $sec->is_visible ? 'badge-green':'badge-red' }}">
                            {{ $sec->is_visible ? 'Visible':'Hidden' }}
                        </span>
                    </td>
                    <td><a href="{{ route('admin.sections.edit', $sec) }}" class="btn btn-outline btn-sm">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
