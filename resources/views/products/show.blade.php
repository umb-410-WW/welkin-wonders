{{-- This file will display each individual product --}}
@extends('layouts.ww_layouts.app')
@section('title', $product->name)
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/product-page.css') }}"
@endsection

@section('content')
    <article id="product-strip">
        <section id="product-top">
            <img id="product-img" alt="Product Image" src="{{ asset('assets/shop_img/dark_gray_black_stone_labradorite.jpg') }}">
            <div>
                <div id="product-title">
                    <h1>{{ $product->name }}</h1>
                    <p>{{ $product->price }}</p>
                </div>
                <div id="product-cart">
                    <p>Shopping Cart</p>
                </div>
            </div>
        </section>
        <p id="product-desc">{{ $product->description }}</p>
        <div id="product-review">
            <h2>Reviews</h2>
            <div id="product-review-subdiv">
                <section class="review">
                    <div>
                        <p>Name</p>
                        <p>Rating</p>
                    </div>
                    <p>Review. The Swerve Star is a star-type rideable machine in Kirby Air Ride. Its standout characteristic is the need to stop and charge or glide in order to turn. It is also set to reappear in Kirby Air Riders. </p>
                </section>
                <section class="review">
                    <div>
                        <p>Name</p>
                        <p>Rating</p>
                    </div>
                    <p>Review. The Swerve Star is a star-type rideable machine in Kirby Air Ride. Its standout characteristic is the need to stop and charge or glide in order to turn. It is also set to reappear in Kirby Air Riders. </p>
                </section>
            </div>
        </div>
    </article>
@endsection
