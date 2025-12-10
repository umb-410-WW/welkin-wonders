<h1 style="color:white; text-align:center;">Payment Successful!</h1>

@if(request('product'))
    <p style="color:#c8b8ff; text-align:center;">
        Thank you for purchasing {{ \App\Models\Product::find(request('product'))->name }}!
    </p>
@endif
