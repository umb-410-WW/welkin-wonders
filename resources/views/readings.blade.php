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
@endsection
