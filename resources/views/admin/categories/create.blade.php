@extends('admin.layouts.admin')

@section('title','Create Category')
@section('page-title','Create Category')
@section('page-subtitle','Add new category')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --main-bg: #081426;
        --card-bg: #0d1b2e;
        --gold: #d9b054;
        --text: #ffffff;
        --muted: #8892b0;
        --border: rgba(255,255,255,0.06);
    }

    body{
        font-family:'Inter',sans-serif;
    }

    .container{
        max-width:700px;
        margin:auto;
        background:var(--card-bg);
        padding:30px;
        border-radius:12px;
        border:1px solid var(--border);
        color:var(--text);
    }

    h2{
        margin-bottom:20px;
    }

    form{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:20px;
    }

    .field{
        display:flex;
        flex-direction:column;
    }

    label{
        font-size:14px;
        margin-bottom:6px;
        color:var(--muted);
    }

    input{
        padding:10px;
        border-radius:6px;
        border:none;
        outline:none;
        background:#12243d;
        color:white;
    }

    .full{
        grid-column:span 2;
    }

    button{
        grid-column:span 2;
        padding:12px;
        background:var(--gold);
        border:none;
        border-radius:6px;
        font-weight:600;
        cursor:pointer;
    }

    button:hover{
        background:#c7a04c;
    }
</style>

<div class="container">

    <h2>Create Category</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST">

        @csrf

        {{-- ID (optional if auto increment, usually hidden) --}}
        <div class="field">
            <label>ID (Optional)</label>
            <input type="text" name="id" value="{{ old('id') }}">
        </div>

        {{-- Name --}}
        <div class="field">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <button type="submit">Save Category</button>

    </form>

</div>

@endsection