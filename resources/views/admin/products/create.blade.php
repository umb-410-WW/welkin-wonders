@extends('layouts.ww_layouts.app')
@section('title', 'Create Product')

@section('content')

<style>
    body {
        font-family: 'Rubik', sans-serif;
    }

    .ww-container {
        width: 420px;
        margin: 70px auto;
        background: rgba(20, 17, 31, 0.65);
        padding: 40px 35px;
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
        transition: .2s;
        font-size: 0.95rem;
    }

    .ww-input:focus,
    .ww-textarea:focus,
    .ww-file:focus {
        border-color: #b77bff;
        box-shadow: 0 0 8px rgba(183, 123, 255, 0.5);
    }

    .ww-textarea {
        min-height: 90px;
        resize: vertical;
    }

    .ww-checkbox-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: -6px;
        margin-bottom: 10px;
    }

    .ww-submit {
        width: 100%;
        background: linear-gradient(90deg, #b06bff, #9d3cff);
        padding: 13px 0;
        border: none;
        border-radius: 10px;
        margin-top: 8px;
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

    .ww-bottom-link {
        text-align: center;
        margin-top: 20px;
        font-size: .9rem;
    }

    .ww-bottom-link a {
        color: #a88fff;
        text-decoration: none;
    }

    .ww-bottom-link a:hover {
        text-decoration: underline;
    }
</style>


<div class="ww-container">

    <div class="ww-title">Create Product</div>
    <div class="ww-subtitle">Add a new item to the Welkin Wonders shop</div>

    <form action="{{ route('products.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="ww-group">
            <label class="ww-label" for="name">Product Name</label>
            <input type="text" id="name" name="name" class="ww-input" required>
        </div>

        <div class="ww-group">
            <label class="ww-label" for="slug">Slug</label>
            <input type="text" id="slug" name="slug" class="ww-input" required>
        </div>

        <div class="ww-group">
            <label class="ww-label" for="description">Description</label>
            <textarea id="description" name="description" class="ww-textarea"></textarea>
        </div>

        <div class="ww-group">
            <label class="ww-label" for="price">Price ($)</label>
            <input type="number" step="0.01" id="price" name="price" value="0" class="ww-input" required>
        </div>

        <div class="ww-group">
            <label class="ww-label" for="stock_quantity">Stock Quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity" class="ww-input" required>
        </div>

        <div class="ww-checkbox-row">
            <input type="checkbox" id="is_active" name="is_active">
            <label class="ww-label" for="is_active" style="margin:0;">Active</label>
        </div>

        <label for="image">Product Image</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button class="ww-submit" type="submit">Create Product</button>
    </form>

</div>

@endsection
