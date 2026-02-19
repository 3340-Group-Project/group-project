@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')

<header>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</header>


<h1>Sign up to be a CampusShelf Member</h1>


<form method="POST" action="{{ route('register.post') }}" class="card">
    @csrf
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name') }}" required>

    <label>UWindsor Email</label>
    <input type="email" name="email" value="{{ old('email') }}" placeholder="uwinID@uwindsor.ca" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Sign Up</button>
</form>
@endsection
