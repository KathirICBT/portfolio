@extends('admin.layouts.admin')
@section('title','Edit Gallery Image')
@section('page-title','Edit Gallery Image')
@section('page-subtitle','Gallery management')

@section('content')
<form method="POST" action="{{ route('admin.gallery.update', $item) }}" style="max-width:600px">
    @csrf @method('PUT')
    @include('admin.gallery._form', ['item' => $item])
</form>
@endsection
