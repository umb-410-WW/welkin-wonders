{{-- Name: Liam Wllis --}}
{{-- This page displays the Contact form for customers --}}

@extends('layouts.ww_layouts.app')
@section('title', 'Contact Us')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
@endsection
@section('content')
    <section>
        <h1>Welkin Wonders Contact Genie</h1>
        <p>Ask the Genie whatever question you desire.</p>
        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfX9y51Ql0_u5idhfsS3GgQPLnYFftabKl2tQaTEwXx5-QqTQ/viewform?embedded=true">
            Loading…
        </iframe>
    </section>

    <!-- Footer Area -->
    <footer>
        <div class="footer-container">

            <!-- Footer Navigation -->
            <ul class="footer-nav">
                <li><a href="{{ route('about')}}">Home</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('readings') }}">Readings</a></li>
                <li><a href="{{ route('products.shop') }}">Shop</a></li>
            </ul>

            <!-- Footer Info -->
            <div class="footer-info">
                <p>© 2025 Welkin Wonders. All rights reserved.</p>
            </div>

            @guest
                <a class="admin-link" href="{{ route('login') }}">Admin Sign In</a>
            @endguest
        </div>
    </footer>
@endsection
