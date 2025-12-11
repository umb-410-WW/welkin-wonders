{{-- Name: Liam Wllis --}}
{{-- This page displays products for customers to see on the shop page --}}

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
                @if ($product->is_active)
                    <x-ww_components.product-card :product="$product"></x-ww_components.product-card>
                    {{-- Display a message if there are no products in the database --}}
                @endif
            @empty
                <p>We could not find any products for you. Stay tuned!</p>
            @endforelse
        </div>
    </section>

    <!-- Footer Area -->
    <footer>
        <div class="footer-container">

            <!-- Footer Navigation -->
            <ul class="footer-nav">
                <li><a href="{{ route('about')}}">Home</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('readings') }}">Readings</a></li>
                <li><a href="{{ route('products.shop') }}">Shop</a></li>
            </ul>

            <!-- Footer Info -->
            <div class="footer-info">
                <p>© 2025 Welkin Wonders. All rights reserved.</p>
            </div>

            @guest
                <a class="admin-link" href="{{ route('login') }}">Admin Sign In</a>
            @endguest
        </div>
    </footer>
@endsection
