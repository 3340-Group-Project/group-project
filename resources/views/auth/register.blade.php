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

    <h3>Create an account to get started!</h3>

    <form method="POST" action="{{ route('register.post') }}" class="user-form-card" id="signup-form">
        @csrf

        <div class="signup-info">
            <label for="regname">Name</label>
            <input type="text" name="name" id="regname" value="{{ old('name') }}" required autofocus>

            <label for="email">UWindsor Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="uwinID@uwindsor.ca" required>

            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <label for="phone">Phone Number (Optional)</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="e.g. 123-456-7890">

            <label>Password (must be at least 8 characters)</label>
            <input type="password" name="password" id="password" required>

            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="password_confirmation" id="confirmPassword" required>

            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror

        </div>

        <div id="signup-btn-container">
            <button type="submit" class="userRegBtn">Sign Up</button>
            <button type="reset" class="userRegBtn" id="cancelBtn">Cancel</button>
        </div>

        <div class="user-info-footer" id="signup-footer">
            <span class="login-link">Already have an account? <a href="{{ route('login') }}">Sign in</a></span>
        </div>
    </form>

</div>
@endsection