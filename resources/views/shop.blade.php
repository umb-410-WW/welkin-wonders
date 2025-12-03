@extends('layouts.ww_layouts.app')
@section('title', 'Shop')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
@endsection
@section('scripts')
    <link rel=""
@endsection
@section('content')
    <section>
        <h1>Shop</h1>
        {{-- Display all of the product cards --}}
        <div id="products">
            @forelse ($products as $product)
                <x-ww_components.product-card :product="$product"></x-ww_components.product-card>
                {{-- Display a message if there are no products in the database --}}
            @empty
                <p>No products are available at the moment. Stay tuned!</p>
            @endforelse
        </div>
    </section>

    <!-- Footer Area -->
    <footer>
        <p>Placeholder footer text</p>
    </footer>
@endsection
