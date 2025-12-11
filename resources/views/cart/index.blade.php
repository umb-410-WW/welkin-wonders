@extends('layouts.ww_layouts.app')
@section('title', 'Cart')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
@endsection
@section('content')
    <section id="cart-strip">
        <div id="cart-header">
            <h1>Cart</h1>
            <a>Checkout: $ {{ $total }}</a>
        </div>
        <div id="cart-items">
            @foreach ($cart->items as $item)
                <div class="cart-item">
                    @if ($item->product->image)
                        <img alt="Product Image" src="{{ asset('storage/' . $item->product->image->image_path) }}">
                    @else
                        <img alt="Product Image" src="">
                    @endif
                    <strong class="cart-item-description">{{ $item->product->name }}</strong>
                    ({{ $item->quantity }} * ${{ $item->product->price }})

                    <form class="product-counter" action="{{ route('cart.update', $item) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                        <button>Update</button>
                    </form>

                    <form class="cart-item-remove" action="{{ route('cart.remove', $item) }}" method="POST">
                        @csrf
                        <button>X</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
@endsection
