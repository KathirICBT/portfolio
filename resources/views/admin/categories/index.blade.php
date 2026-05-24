@extends('admin.layouts.admin')

@section('title','Category Management')
@section('page-title','Category Management')
@section('page-subtitle','Manage all product categories')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest"></script>

<style>
    :root{
        --main-bg:#081426;
        --card-bg:#0d1b2e;
        --card-hover:#12243d;
        --gold:#d9b054;
        --gold-hover:#c7a04c;
        --text:#fff;
        --muted:#8892b0;
        --border:rgba(255,255,255,0.06);
        --success:#52b788;
        --danger:#e63946;
    }

    .container{
        padding:30px;
    }

    .topbar{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    }

    .title h1{
        font-size:26px;
        margin-bottom:4px;
    }

    .title p{
        color:var(--muted);
        font-size:14px;
    }

    .btn-add{
        background:var(--gold);
        color:#000;
        padding:10px 16px;
        border-radius:6px;
        text-decoration:none;
        font-weight:600;
        display:flex;
        gap:8px;
        align-items:center;
    }

    .btn-add:hover{
        background:var(--gold-hover);
    }

    .table{
        background:var(--card-bg);
        border:1px solid var(--border);
        border-radius:10px;
        overflow:hidden;
    }

    .table-header,
    .table-row{
        display:grid;
        grid-template-columns:80px 1fr 140px 200px;
        padding:18px;
        align-items:center;
    }

    .table-header{
        background:rgba(255,255,255,0.03);
        color:var(--muted);
        font-size:13px;
        font-weight:600;
    }

    .table-row{
        border-top:1px solid var(--border);
        transition:0.2s;
    }

    .table-row:hover{
        background:var(--card-hover);
    }

    .id{
        color:var(--gold);
        font-weight:600;
    }

    .status{
        display:inline-flex;
        align-items:center;
        gap:5px;
        background:rgba(82,183,136,0.15);
        color:var(--success);
        padding:5px 10px;
        border-radius:20px;
        font-size:13px;
        width:fit-content;
    }

    .actions{
        display:flex;
        justify-content:flex-end;
        gap:10px;
    }

    .btn-edit{
        background:rgba(255,255,255,0.06);
        color:#fff;
        padding:6px 12px;
        border-radius:5px;
        text-decoration:none;
        font-size:13px;
    }

    .btn-delete{
        background:rgba(230,57,70,0.15);
        color:#ff6b75;
        border:none;
        padding:6px 12px;
        border-radius:5px;
        cursor:pointer;
        font-size:13px;
    }

    .btn-delete:hover{
        background:rgba(230,57,70,0.3);
    }

    .empty{
        padding:40px;
        text-align:center;
        color:var(--muted);
    }

    .alert{
        background:rgba(82,183,136,0.12);
        border-left:4px solid var(--success);
        padding:12px;
        margin-bottom:15px;
        border-radius:6px;
    }
</style>

<div class="container">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Top Bar --}}
    <div class="topbar">

        <div class="title">
            <h1>Category Management</h1>
            <p>Manage all product categories</p>
        </div>

        <a href="{{ route('admin.categories.create') }}" class="btn-add">
            <i data-lucide="plus"></i>
            Add Category
        </a>

    </div>

    {{-- Table --}}
    <div class="table">

        <div class="table-header">
            <div>ID</div>
            <div>Name</div>
            <div>Status</div>
            <div style="text-align:right;">Actions</div>
        </div>

        @forelse($categories as $category)

            <div class="table-row">

                <div class="id">{{ $category->id }}</div>

                <div>{{ $category->name }}</div>

                <div>
                    <span class="status">
                        <i data-lucide="check-circle" style="width:14px;height:14px;"></i>
                        Active
                    </span>
                </div>

                <div class="actions">

                    <a href="{{ route('admin.categories.edit',$category->id) }}" class="btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('admin.categories.destroy',$category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn-delete"
                                onclick="return confirm('Delete this category?')">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @empty

            <div class="empty">
                No categories found
            </div>

        @endforelse

    </div>

</div>

<script>
    lucide.createIcons();
</script>

@endsection