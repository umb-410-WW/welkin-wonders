{{-- Name: Liam Wllis --}}
{{-- This page displays the Readings form for customers --}}

@extends('layouts.ww_layouts.app')
@section('title', 'Readings')
@section('style')
    <link rel="stylesheet" href= {{ asset('assets/css/contact.css') }} />
@endsection
@section('content')
    <section>
        <h1>Readings</h1>
        <p>Wonder where your life is going? Get a reading!</p>
        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScS9oQURWyhY9uJMujg5CtWbeGzZatnzxWVav6jVcngwMqIRg/viewform?embedded=true">
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
