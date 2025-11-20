{{-- This is the main styling of a product card for the admin page --}}
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
    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" onclick="return confirm('Are you sure?')">
            Delete
        </button>
    </form>
</div>
