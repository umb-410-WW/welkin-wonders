{{-- This is the main styling of a product card for the admin page --}}
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
        <button><a href="{{ route('products.show', $product->slug) }}">Product Page</a></button>
        {{-- Add to cart button --}}
        <button><a href="{{ route('products.edit', $product->id) }}">Edit product</a></button>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" onclick="return confirm('Are you sure you would like to delete this product?')">Delete</button>
        </form>
    </div>
</div>
