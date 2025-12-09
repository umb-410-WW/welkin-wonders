@extends('layouts.ww_layouts.app')
@section('title', 'Shop')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
@endsection
@section('scripts')
    <link rel=""
@endsection
@section('content')
    <section id="shop-strip">

        <div id="shop-strip-header">
            <h1>Shop</h1>
            <p>Choose from a selection of perfect gemstones.</p>
            <p>Use this button to guide you if you're not sure</p>
            <a href="{{ route('products.random') }}"><img alt="Crystal Ball" src="{{ asset('assets/img/crystal_ball_round.png') }}"></a>
        </div>

        {{-- Display all of the product cards --}}
        <div id="products">
            @forelse ($products as $product)
                <x-ww_components.product-card :product="$product"></x-ww_components.product-card>
                {{-- Display a message if there are no products in the database --}}
            @empty
                <p>We could not find any products for you. Stay tuned!</p>
            @endforelse
        </div>
    </section>

    <!-- Footer Area -->
    <footer>
        <p>Placeholder footer text</p>
    </footer>
@endsection
