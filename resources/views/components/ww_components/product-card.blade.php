{{-- This is the main styling of a product card --}}
@props(['product'])
<div class="product-card">
    <div class="product-desc">
        <div class="product-title">
            <h3>{{ $product->name }}</h3>
            <p class="product-price">$ {{ $product->price }}</p>
        </div>
        <p>{{ $product->description }}</p>
        <a href="{{ route('products.show', $product->slug) }}">Product Page</a>
    </div>
    {{-- Add to cart button --}}
    <form action="{{ route('cart.add', $product->id) }}" method="POST">
        @csrf
        <button type="submit">
            Add to Cart
        </button>
    </form>
</div>
