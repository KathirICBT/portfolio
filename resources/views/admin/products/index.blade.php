@extends('admin.layouts.admin')

@section('title','Products')
@section('page-title','Product Management')
@section('page-subtitle','Manage all store products')

@section('content')

<style>
    .topbar{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    }

    .btn-add{
        background:#d9b054;
        color:#000;
        padding:10px 18px;
        border-radius:6px;
        text-decoration:none;
        font-weight:600;
        transition:0.3s;
    }

    .btn-add:hover{
        background:#c7a04c;
    }

    .table-wrapper{
        background:#0d1b2e;
        border-radius:12px;
        overflow:hidden;
        border:1px solid rgba(255,255,255,0.05);
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    thead{
        background:rgba(255,255,255,0.03);
    }

    th{
        color:#8892b0;
        font-size:12px;
        font-weight:600;
        text-transform:uppercase;
        padding:18px;
        text-align:left;
        border-bottom:1px solid rgba(255,255,255,0.06);
    }

    td{
        padding:18px;
        border-bottom:1px solid rgba(255,255,255,0.05);
        vertical-align:middle;
    }

    tr:hover{
        background:rgba(255,255,255,0.02);
    }

    .product-info{
        display:flex;
        align-items:center;
        gap:12px;
    }

    .product-info img{
        width:55px;
        height:55px;
        border-radius:8px;
        object-fit:cover;
        background:#12243d;
    }

    .product-name{
        font-weight:600;
        color:white;
    }

    .product-number{
        color:#8892b0;
        font-size:12px;
        margin-top:4px;
    }

    .actions{
        display:flex;
        gap:8px;
    }

    .btn-edit{
        background:#1f2a3a;
        color:white;
        padding:8px 14px;
        border-radius:5px;
        text-decoration:none;
        font-size:13px;
    }

    .btn-delete{
        background:rgba(230,57,70,0.15);
        color:#ff6b75;
        border:none;
        padding:8px 14px;
        border-radius:5px;
        cursor:pointer;
        font-size:13px;
    }

    .btn-delete:hover{
        background:rgba(230,57,70,0.25);
    }

    .empty{
        text-align:center;
        padding:40px;
        color:#8892b0;
    }

    .success-message{
        background:rgba(82,183,136,0.15);
        color:#52b788;
        padding:14px 18px;
        border-radius:8px;
        margin-bottom:20px;
    }
</style>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

{{-- TOP BAR --}}
<div class="topbar">

    <div>
        <h2 style="margin:0;">All Products</h2>
        <p style="color:#8892b0; margin-top:5px;">
            Manage and monitor your store inventory
        </p>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn-add">
        + Add Product
    </a>

</div>

{{-- TABLE --}}
<div class="table-wrapper">

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        @forelse($products as $product)

            <tr>

                {{-- ID --}}
                <td>
                    {{ $product->id }}
                </td>

                {{-- PRODUCT --}}
                <td>

                    <div class="product-info">

                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="">
                        @else
                            <img src="https://via.placeholder.com/55">
                        @endif

                        <div>

                            <div class="product-name">
                                {{ $product->product_name }}
                            </div>

                            <div class="product-number">
                                {{ $product->product_number }}
                            </div>

                        </div>

                    </div>

                </td>

                <td>
                    {{ $product->description }}
                </td>
                {{-- CATEGORY --}}
                <td>
                    {{ $product->category->name ?? 'No Category' }}
                </td>

                {{-- PRICE --}}
                <td>
                    Rs. {{ number_format($product->price,2) }}
                </td>

                {{-- QUANTITY --}}
                <td>
                    {{ $product->quantity }}
                </td>

                {{-- UNIT --}}
                <td>
                    {{ $product->unit_value }} {{ $product->unit_type }}
                </td>

                {{-- ACTIONS --}}
                <td>

                    <div class="actions">

                        <a href="{{ route('admin.products.edit',$product->id) }}"
                           class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('admin.products.destroy',$product->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn-delete"
                                    onclick="return confirm('Delete this product?')">

                                Delete

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7" class="empty">
                    No products found
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection