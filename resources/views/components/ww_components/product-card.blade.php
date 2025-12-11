{{-- This is the main styling of a product card --}}
@props(['product'])
<div class="product-card">
    @if ($product->image)
        <img class="product-img" alt="Product Image" src="{{ asset('storage/' . $product->image->image_path) }}">
    @else
        <img class="product-img" alt="Product Image" src="">
    @endif
    <div class="product-desc">
        <div class="product-title">
            <h3>{{ $product->name }}</h3>
            <p class="product-price">$ {{ $product->price }}</p>
        </div>
        <p>{{ $product->description }}</p>
        <a href="{{ route('products.show', $product->slug) }}">Product Page</a>
    </div>
</div>
