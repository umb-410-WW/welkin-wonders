@extends('layouts.ww_layouts.app')
@section('title', 'Admin Dashboard')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@endsection
@section('content')
    <section id="admin-strip">
        <div id="admin-strip-header">
            <h1>Admin Dashboard</h1>
            <p>Create a Product by Clicking the Crystal Ball Below</p>
            <a href="{{ route('products.create') }}"><img alt="Crystal Ball" src="{{ asset('assets/img/crystal_ball_round.png') }}"></a>
        </div>

        {{-- Display all of the product cards --}}
        <div id="products">
            @forelse ($products as $product)
                <x-ww_components.admin-product-card :product="$product"></x-ww_components.admin-product-card>
                {{-- Display a message if there are no products in the database --}}
            @empty
                <p>No products are available at the moment. Stay tuned!</p>
            @endforelse
        </div>
    </section>
@endsection

@php
    $user = Auth::user();
@endphp

