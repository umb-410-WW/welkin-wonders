@extends('layouts.ww_layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <h1>Admin Dashboard!</h1>
    <a href="{{ route('products.create') }}">Create a product</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <input type="submit" value="Logout">
    </form>
@endsection

