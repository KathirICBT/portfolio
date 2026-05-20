@extends('admin.layouts.admin')
@section('title','Add Gallery Image')
@section('page-title','Add Gallery Image')
@section('page-subtitle','Gallery management')

@section('content')
<form method="POST" action="{{ route('admin.gallery.store') }}" style="max-width:600px">
    @csrf
    @include('admin.gallery._form', ['item' => null])
</form>
@endsection
