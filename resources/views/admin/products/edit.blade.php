{{-- This page will be the form to edit an existing product --}}


@extends('layouts.ww_layouts.app')
@section('title', 'Edit Product')

@section('content')

<style>
    body {
        font-family: 'Rubik', sans-serif;
    }

    .ww-container {
        width: 90%;
        max-width: 750px; /* makes it wider */
        margin: 70px auto;
        background: rgba(20, 17, 31, 0.65);
        padding: 40px 40px;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.55);
        color: #e4d8ff;
        text-align: left;
    }

    .ww-title {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 700;
        color: #d7b7ff;
        margin-bottom: 5px;
    }

    .ww-subtitle {
        text-align: center;
        font-size: 0.95rem;
        color: #9c85c9;
        margin-bottom: 25px;
    }

    .ww-group {
        margin-bottom: 18px;
    }

    .ww-label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #d9caff;
    }

    .ww-input,
    .ww-textarea,
    .ww-file {
        width: 100%;
        background: #1a1a22;
        border: 1px solid rgba(255,255,255,0.08);
        padding: 12px 14px;
        border-radius: 10px;
        color: #e4d8ff;
        outline: none;
        transition: 0.2s;
        font-size: 0.95rem;
    }

    .ww-input:focus,
    .ww-textarea:focus,
    .ww-file:focus {
        border-color: #b77bff;
        box-shadow: 0 0 8px rgba(183, 123, 255, 0.5);
    }

    .ww-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .ww-checkbox-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: -5px;
        margin-bottom: 12px;
    }

    /* Error text */
    .ww-error {
        color: #ff7b7b;
        font-size: 0.85rem;
        margin-top: 4px;
    }

    /* Submit button */
    .ww-submit {
        width: 100%;
        background: linear-gradient(90deg, #b06bff, #9d3cff);
        padding: 13px 0;
        border: none;
        border-radius: 10px;
        margin-top: 10px;
        color: white;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
        box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    }

    .ww-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.55);
    }
</style>


<div class="ww-container">

    <div class="ww-title">Edit Product</div>
    <div class="ww-subtitle">Modify this product’s details</div>

    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="ww-group">
            <label class="ww-label" for="name">Product Name</label>
            <input type="text" id="name" name="name"
                   class="ww-input"
                   value="{{ old('name', $product->name) }}"
                   required>
            @error('name')
                <div class="ww-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="ww-group">
            <label class="ww-label" for="slug">Slug</label>
            <input type="text" id="slug" name="slug"
                   class="ww-input"
                   value="{{ old('slug', $product->slug) }}"
                   required>
            @error('slug')
                <div class="ww-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="ww-group">
            <label class="ww-label" for="description">Description</label>
            <textarea id="description" name="description"
                      class="ww-textarea">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="ww-group">
            <label class="ww-label" for="price">Price ($)</label>
            <input type="number" step="0.01" id="price" name="price"
                   class="ww-input"
                   value="{{ old('price', $product->price) }}"
                   required>
        </div>

        <div class="ww-group">
            <label class="ww-label" for="stock_quantity">Stock Quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity"
                   class="ww-input"
                   value="{{ old('stock_quantity', $product->stock_quantity) }}"
                   required>
        </div>

        <div class="ww-checkbox-row">
            <input type="checkbox" id="is_active" name="is_active"
                   @if(old('is_active', $product->is_active)) checked @endif>
            <label class="ww-label" for="is_active" style="margin:0;">Active</label>
        </div>

        <label for="image">Product Image</label>
        <input type="file" name="image" id="image" accept="image/*">

    </form>

</div>

@endsection
