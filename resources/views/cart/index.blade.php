@extends('layouts.ww_layouts.app')
@section('title', 'Cart')
@section('content')
    <section id="cart-strip">
        <div id="cart-header">
            <h1>Cart</h1>
            <a>Checkout > $ {{ $total }}  (Total Price)</a>
        </div>
        <div id="cart-items">
            @foreach ($cart->items as $item)
                <div>
                    <strong>{{ $item->product->name }}</strong>
                    ({{ $item->quantity }} * ${{ $item->product->price }})

                    <form action="{{ route('cart.update', $item) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                        <button>Update</button>
                    </form>

                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                        @csrf
                        <button>Remove</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
@endsection
