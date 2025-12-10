@extends('layouts.ww_layouts.app')
@section('title', 'Checkout')

@section('content')

<style>
    body { font-family: 'Rubik', sans-serif; }

    .checkout-container {
        width: 90%;
        max-width: 900px;
        margin: 70px auto;
        background: rgba(20, 17, 31, 0.65);
        padding: 35px 40px;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.55);
        color: #e4d8ff;
    }

    .checkout-title {
        font-size: 2rem;
        font-weight: 700;
        color: #d7b7ff;
        margin-bottom: 15px;
        text-align: center;
    }

    .checkout-flex {
        display: flex;
        gap: 30px;
    }

    .checkout-left, .checkout-right {
        flex: 1;
    }

    .checkout-product-box {
        background: #1b1b23;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.08);
        margin-bottom: 20px;
    }

    .checkout-product-box img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 15px;
    }

    .checkout-label {
        font-size: 0.9rem;
        color: #c8baff;
        margin-bottom: 6px;
        display: block;
    }

    .checkout-input {
        width: 100%;
        background: #1a1a22;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.08);
        padding: 12px 14px;
        color: #e4d8ff;
        margin-bottom: 15px;
    }

    .checkout-input:focus {
        border-color: #b77bff;
        box-shadow: 0 0 8px rgba(183, 123, 255, 0.5);
    }

    .summary-box {
        background: #1f1b29;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 1rem;
    }

    .summary-total {
        margin-top: 15px;
        font-size: 1.3rem;
        font-weight: 700;
        color: #e4d8ff;
        display: flex;
        justify-content: space-between;
    }

    .checkout-btn {
        margin-top: 25px;
        width: 100%;
        background: linear-gradient(90deg, #b06bff, #9d3cff);
        padding: 14px 0;
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        transition: 0.2s;
    }

    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.55);
    }
</style>


<div class="checkout-container">

    <div class="checkout-title">Checkout</div>

    <div class="checkout-flex">

        {{-- LEFT SIDE: PRODUCT INFO --}}
        <div class="checkout-left">

            <div class="checkout-product-box">

                @if($product->images->count() > 0)
                    <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/600x400?text=No+Image" alt="No Image">
                @endif

                <h2 style="margin-bottom:5px; font-size:1.4rem;">{{ $product->name }}</h2>
                <p style="margin-bottom:15px; color:#c9b7ff;">${{ number_format($product->price, 2) }}</p>

                <label class="checkout-label">Quantity</label>
                <input type="number" id="quantity" value="1" min="1" class="checkout-input">
            </div>

        </div>

        {{-- RIGHT SIDE: ORDER SUMMARY --}}
        <div class="checkout-right">

            <div class="summary-box">

                <div class="summary-row">
                    <span>Item Price:</span>
                    <span>${{ number_format($product->price, 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Quantity:</span>
                    <span id="q-display">1</span>
                </div>

                <div class="summary-total">
                    <span>Total:</span>
                    <span id="total-display">${{ number_format($product->price, 2) }}</span>
                </div>

                <button id="checkoutBtn" class="checkout-btn">
                    Proceed to Payment
                </button>

            </div>
        </div>

    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe("{{ env('STRIPE_PUBLIC') }}");
    const unitPrice = {{ $product->price }};
    const prodId = {{ $product->id }};

    const qtyInput = document.getElementById('quantity');
    const qtyDisplay = document.getElementById('q-display');
    const totalDisplay = document.getElementById('total-display');

    qtyInput.addEventListener('input', () => {
        qtyDisplay.textContent = qtyInput.value;
        totalDisplay.textContent = "$" + (unitPrice * qtyInput.value).toFixed(2);
    });

    document.getElementById("checkoutBtn").addEventListener("click", function () {

        fetch("/checkout/" + prodId, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                quantity: qtyInput.value
            })
        })
        .then(res => res.json())
        .then(data => {
            return stripe.redirectToCheckout({ sessionId: data.id });
        });
    });
</script>

@endsection
