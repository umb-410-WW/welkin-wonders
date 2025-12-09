@extends('layouts.ww_layouts.app')
@section('title', 'About Us')
@section('banner')
    <header>
        <!-- Banner -->
        <div class="banner">
            <img class="welcome-banner" src="{{ asset('assets/img/banner_purple.png')}}" alt="Welkin Wonders Banner" width="auto" height="auto">
        </div>
    </header>
@endsection
@section('content')
    <section id="about">
        <div class="letter">
            <div class="letter-flap"></div>
            <div class="letter-inner">
                <h1>Welcome to Welkin Wonders!</h1>
                <p>A space created to inspire balance and positivity. With a strong curiosity about crystals and the meaning people find in them, we developed this shop. Across cultures, crystals have been used as symbols of focus, energy, and intention. This experience was built to explore that idea in a creative, modern way through design, storytelling, and interactive experiences.</p>
                <p>Alongside our crystal collection, we offer affirmations and readings to encourage reflection and self-awareness. These features are meant to be thoughtful pauses in a fast digital world, giving users a moment to reset and engage with something uplifting. Our kission was to create an exdperience that feels calming, welcoming, and empowering. At the heart of Welkin Wonders, is the belief that slowing down and engaging with meaning can create powerful change.</p>
                <p>Welkin Wonders is more than just a shop, it's a digital sanctuary for curiosity, creativity, and growth.</p>
            </div>
        </div>
    </section>

    <div id="genie-float">
        <img src="{{ asset('assets/img/genie_3.png') }}" alt="Floating Genie" width="500" height="500" />
    </div>

    <!-- Footer Area -->
    <footer>
        <div class="footer-container">Footer Area</div>
    </footer>
@endsection

