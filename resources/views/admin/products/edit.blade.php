{{-- This page will be the form to edit an existing product --}}
@extends('layouts.ww_layouts.app')
@section('title', 'Edit Product')
@section('content')
    <form style="color: white; display: flex; flex-direction: column" action="{{ route('products.update') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
        @error('name')
        <div>{{ $message }}</div>
        @enderror

        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" required>

        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>

        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required>

        <label for="stock_quantity">Stock Quantity</label>
        <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>

        <input type="checkbox" name="is_active" id="is_active">
        <label for="is_active">Active</label>

        <label for="image">Product Image</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit">Create Product</button>
    </form>
@endsection
