{{-- This file will display each individual product --}}
@extends('layouts.ww_layouts.app')
@section('title', $product->name)
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/product-page.css') }}">
    <style>
        .product-cart {
            background-image: url({{ asset('assets/img/icon_cart.svg') }});
        }
    </style>
@endsection

@section('content')
    <article id="product-strip">
        <section id="product-top">
            {{-- Display the image, if it exists --}}
            @if ($product->image)
                <img id="product-img" alt="Product Image" src="{{ asset('storage/' . $product->image->image_path) }}">
            @else
                <img id="product-img" alt="Product Image" src="">
            @endif
            <div>
                <div id="product-title">
                    <h1>{{ $product->name }}</h1>
                    <p>$ {{ $product->price }}</p>
                </div>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit">
                        Add to Cart
                    </button>
                </form>
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
