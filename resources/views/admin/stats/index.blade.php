@extends('admin.layouts.admin')
@section('title','Stats & Counters')
@section('page-title','Stats & Counters')
@section('page-subtitle','Manage the animated achievement numbers')

@section('content')
<div style="display:flex;flex-direction:column;gap:16px">
    @foreach($stats as $stat)
    <div class="card">
        <div class="card-header">
            <h2>Stat #{{ $stat->sort_order }}: {{ $stat->label }}</h2>
            <span class="badge {{ $stat->is_active ? 'badge-green':'badge-red' }}">{{ $stat->is_active ? 'Active':'Hidden' }}</span>
        </div>
        <form method="POST" action="{{ route('admin.stats.update', $stat) }}">
            @csrf @method('PATCH')
            <div class="card-body">
                <div class="form-grid" style="margin-bottom:16px">
                    <div class="form-group">
                        <label class="form-label">Number Value</label>
                        <input type="text" name="value" class="form-control" maxlength="20"
                               value="{{ old('value', $stat->value) }}"
                               placeholder="e.g. 22, 200, 1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Suffix</label>
                        <input type="text" name="suffix" class="form-control" maxlength="10"
                               value="{{ old('suffix', $stat->suffix) }}"
                               placeholder="e.g. +, K+, M+">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Label</label>
                        <input type="text" name="label" class="form-control" required maxlength="255"
                               value="{{ old('label', $stat->label) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Icon Name</label>
                        <input type="text" name="icon" class="form-control" maxlength="100"
                               value="{{ old('icon', $stat->icon) }}"
                               placeholder="trophy, handshake, heart, calendar">
                    </div>
                    <div class="form-group form-full">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" maxlength="500"
                               value="{{ old('description', $stat->description) }}">
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:20px">
                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" name="is_active" value="1" {{ $stat->is_active ? 'checked':'' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Active</span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Save Stat</button>
                </div>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endsection
