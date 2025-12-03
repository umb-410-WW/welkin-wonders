{{-- This page will be the form to edit an existing product --}}
@extends('layouts.ww_layouts.app')
@section('title', 'Edit Product')
@section('content')
    <form style="color: white; display: flex; flex-direction: column" action="{{ route('products.update') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" class="form-control" required>

        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" required>

        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>

        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" id="price" value="0" required>

        <label for="stock_quantity">Stock Quantity</label>
        <input type="number" name="stock_quantity" id="stock_quantity" required>

        <input type="checkbox" name="is_active" id="is_active">
        <label for="is_active">Active</label>

        <label for="image">Product Image</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit">Create Product</button>
    </form>
@endsection
