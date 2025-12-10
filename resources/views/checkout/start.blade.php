@extends('layouts.ww_layouts.app')

@section('content')
<script src="https://js.stripe.com/v3/"></script>

<div class="ww-container">
    <h1 style="color:white; text-align:center;">Checkout</h1>

    <button id="checkoutBtn" class="ww-submit" style="width:100%; margin-top:20px;">
        Proceed to Payment
    </button>
</div>

<script>
    const stripe = Stripe("{{ env('STRIPE_PUBLIC') }}");

    document.getElementById("checkoutBtn").addEventListener("click", function () {
        fetch("{{ route('checkout.create') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        })
        .then(res => res.json())
        .then(data => {
            return stripe.redirectToCheckout({ sessionId: data.id });
        });
    });
</script>
@endsection
