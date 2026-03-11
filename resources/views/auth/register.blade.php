@extends('layouts.app')

@section('title', 'Sign Up')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@push('scripts')
    <script src="{{ asset('js/user-auth.js') }}" defer></script>
@endpush

@section('content')
<header>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</header>

<div id="signup-page">

    <h1>Sign Up</h1>

<form method="POST" action="{{ route('register.post') }}" class="card">
    @csrf
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name') }}" required>

    <label>UWindsor Email</label>
    <input type="email" name="email" value="{{ old('email') }}" placeholder="uwinID@uwindsor.ca" required>

    <label>Password</label>
    <input type="password" name="password" required>

            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="password_confirmation" id="confirmPassword" required>

    <button type="submit">Sign Up</button>
</form>
@endsection
