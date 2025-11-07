@extends('layouts.ww-layouts.app')
@section('title', 'Contact Us')
@section('style')
    @vite(['resources/css/contact.css'])
@endsection
@section('content')
    <section>
        <h1>Welkin Wonders Contact Genie</h1>
        <p>Ask the Genie whatever question you desire.</p>
        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfX9y51Ql0_u5idhfsS3GgQPLnYFftabKl2tQaTEwXx5-QqTQ/viewform?embedded=true">
            Loading…
        </iframe>
    </section>

    <footer>
        <p>Placeholder footer text</p>
    </footer>
@endsection
