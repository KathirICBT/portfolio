@extends('admin.layouts.admin')

@section('title','Create Product')
@section('page-title','Create Product')
@section('page-subtitle','Add new product information')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    body{
        font-family:'Inter',sans-serif;
    }

    .container{
        max-width:1100px;
        margin:auto;
        background:#0d1b2e;
        padding:30px;
        border-radius:12px;
        border:1px solid rgba(255,255,255,0.06);
        color:white;
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
        margin-bottom:6px;
        color:#ccc;
        font-size:14px;
    }

    input, textarea, select{
        width:100%;
        padding:10px;
        border-radius:6px;
        border:none;
        outline:none;
        background:#12243d;
        color:white;
    }

    textarea{
        min-height:100px;
        resize:none;
    }

    .full{
        grid-column:span 2;
    }

    button{
        grid-column:span 2;
        padding:12px;
        background:#d9b054;
        border:none;
        border-radius:6px;
        font-weight:600;
        cursor:pointer;
    }

    button:hover{
        background:#c7a04c;
    }

    .error{
        color:#ff6b6b;
        font-size:13px;
        margin-top:5px;
    }
    .unit-btn{
        padding:8px 14px;
        border-radius:6px;
        border:1px solid rgba(255,255,255,0.15);
        background:#12243d;
        color:white;
        cursor:pointer;
        font-size:13px;
        transition:0.3s;
    }

    .unit-btn:hover{
        border-color:#d9b054;
    }

    .unit-btn.active{
        background:#d9b054;
        color:#000;
        font-weight:600;
    }

    .add-btn{
        border-style:dashed;
    }
</style>

<div class="container">

    <h2>Create Product</h2>

    <form action="{{ route('admin.products.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        {{-- Product Name --}}
        <div class="field">
            <label>Product Name</label>
            <input type="text" name="product_name"
                   value="{{ old('product_name') }}">
            @error('product_name') <div class="error">{{ $message }}</div> @enderror
        </div>

        {{-- Product Number --}}
        <div class="field">
            <label>Product Number</label>
            <input type="text" name="product_number"
                   value="{{ old('product_number') }}">
            @error('product_number') <div class="error">{{ $message }}</div> @enderror
        </div>

        {{-- Category --}}
        <div class="field">
            <label>Category</label>
            <select name="category_id">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        {{-- Price --}}
        <div class="field">
            <label>Price</label>
            <input type="number" name="price"
                   value="{{ old('price') }}">
        </div>

        {{-- Quantity --}}
        <div class="field">
            <label>Quantity</label>
            <input type="number" name="quantity"
                   value="{{ old('quantity') }}">
        </div>

        {{-- Unit Type --}}
        
        {{-- Unit Type (Selectable + Custom Add) --}}
        <div class="field full">
            <label>Unit Type</label>

            <div id="unitTypeContainer" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:10px;">

                {{-- Default options --}}
                <button type="button" class="unit-btn active" data-value="gram">Gram</button>
                <button type="button" class="unit-btn" data-value="litre">Litre</button>
                <button type="button" class="unit-btn" data-value="pcs">Pieces</button>

                {{-- Add new --}}
                <button type="button" id="addUnitBtn" class="unit-btn add-btn">+ Add</button>
            </div>

            {{-- Hidden input --}}
            <input type="hidden" name="unit_type" id="unit_type" value="gram">
        </div>

        {{-- Description --}}
        <div class="field full">
            <label>Description</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        {{-- Image --}}
        <div class="field full">
            <label>Product Image</label>
            <input type="file" name="image">
            @error('image') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Save Product</button>

    </form>

</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const container = document.getElementById("unitTypeContainer");
    const hiddenInput = document.getElementById("unit_type");
    const addBtn = document.getElementById("addUnitBtn");

    // select unit
    container.addEventListener("click", function (e) {
        if (e.target.classList.contains("unit-btn") && e.target.dataset.value) {

            document.querySelectorAll(".unit-btn").forEach(btn => {
                btn.classList.remove("active");
            });

            e.target.classList.add("active");
            hiddenInput.value = e.target.dataset.value;
        }
    });

    // add custom unit
    addBtn.addEventListener("click", function () {

        const value = prompt("Enter new unit type (e.g. kg, bottle, pack):");

        if (!value) return;

        const trimmed = value.trim().toLowerCase();

        // create new button
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "unit-btn";
        btn.dataset.value = trimmed;
        btn.innerText = value;

        container.insertBefore(btn, addBtn);

        // auto select new one
        document.querySelectorAll(".unit-btn").forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        hiddenInput.value = trimmed;
    });

});
</script>
@endsection