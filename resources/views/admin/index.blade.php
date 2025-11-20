@extends('layouts.ww_layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <h1>Admin Dashboard!</h1>
    <a href="{{ route('products.create') }}">Create a product</a>
    <form method="POST" action="{{ route('logout') }}">
        <input type="submit" value="Logout"></form>
        @csrf
        @forelse ($products as $product)
            <x-ww_components.admin-product-card :product="$product"></x-ww_components.admin-product-card>
            {{-- Display a message if there are no products in the database --}}
        @empty
            <p>No products are available at the moment. Stay tuned!</p>
        @endforelse
@endsection

