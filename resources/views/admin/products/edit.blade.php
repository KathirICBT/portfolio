@extends('admin.layouts.admin')

@section('title','Edit Product')
@section('page-title','Edit Product')
@section('page-subtitle','Update product information')

@section('content')

<style>
    .form-wrapper{
        max-width:900px;
        background:#0d1b2e;
        padding:30px;
        border-radius:12px;
        border:1px solid rgba(255,255,255,0.05);
    }

    .form-grid{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:20px;
    }

    .form-group{
        display:flex;
        flex-direction:column;
    }

    .form-group.full{
        grid-column:1 / -1;
    }

    label{
        margin-bottom:8px;
        color:#8892b0;
        font-size:14px;
        font-weight:500;
    }

    input,
    textarea,
    select{
        background:#081426;
        border:1px solid rgba(255,255,255,0.08);
        color:white;
        padding:12px 14px;
        border-radius:8px;
        outline:none;
        font-size:14px;
    }

    textarea{
        min-height:120px;
        resize:vertical;
    }

    input:focus,
    textarea:focus,
    select:focus{
        border-color:#d9b054;
    }

    .current-image{
        margin-top:12px;
    }

    .current-image img{
        width:120px;
        height:120px;
        object-fit:cover;
        border-radius:10px;
        border:1px solid rgba(255,255,255,0.08);
    }

    .btn-submit{
        background:#d9b054;
        color:#000;
        border:none;
        padding:14px 20px;
        border-radius:8px;
        font-weight:600;
        cursor:pointer;
        margin-top:25px;
        transition:0.3s;
    }

    .btn-submit:hover{
        background:#c7a04c;
    }

    .error{
        color:#ff6b75;
        font-size:13px;
        margin-top:5px;
    }
</style>

<div class="form-wrapper">

    <form action="{{ route('admin.products.update',$product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-grid">

            {{-- PRODUCT NAME --}}
            <div class="form-group">
                <label>Product Name</label>

                <input type="text"
                       name="product_name"
                       value="{{ old('product_name',$product->product_name) }}">

                @error('product_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- PRODUCT NUMBER --}}
            <div class="form-group">
                <label>Product Number</label>

                <input type="text"
                       name="product_number"
                       value="{{ old('product_number',$product->product_number) }}">

                @error('product_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- CATEGORY --}}
            <div class="form-group">
                <label>Category</label>

                <select name="category_id">

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- PRICE --}}
            <div class="form-group">
                <label>Price</label>

                <input type="number"
                       step="0.01"
                       name="price"
                       value="{{ old('price',$product->price) }}">
            </div>

            {{-- QUANTITY --}}
            <div class="form-group">
                <label>Quantity</label>

                <input type="number"
                       name="quantity"
                       value="{{ old('quantity',$product->quantity) }}">
            </div>

            {{-- UNIT TYPE --}}
            <div class="form-group">
                <label>Unit Type</label>

                <input type="text"
                       name="unit_type"
                       value="{{ old('unit_type',$product->unit_type) }}">
            </div>

            {{-- UNIT VALUE --}}
            <div class="form-group">
                <label>Unit Value</label>

                <input type="text"
                       name="unit_value"
                       value="{{ old('unit_value',$product->unit_value) }}">
            </div>

            {{-- IMAGE --}}
            <div class="form-group">
                <label>Product Image</label>

                <input type="file" name="image">

                @if($product->image)

                    <div class="current-image">
                        <img src="{{ asset($product->image) }}">
                    </div>

                @endif
            </div>

            {{-- DESCRIPTION --}}
            <div class="form-group full">

                <label>Description</label>

                <textarea name="description">{{ old('description',$product->description) }}</textarea>

            </div>

        </div>

        <button type="submit" class="btn-submit">
            Update Product
        </button>

    </form>

</div>

@endsection