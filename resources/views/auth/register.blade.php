<!-- php file that will register a new user -->

@extends('layouts.app')

@section('title', 'Sign Up')

<!-- set the styling to form.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@push('scripts')
    <script src="{{ asset('js/user-auth.js') }}" defer></script>
@endpush

@section('content')
<header>
    <!-- meta tag instructs browsers to scale to screen size. it is critical for mobile-first indexing and SEO -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</header>

<div id="signup-page">

    <h1>Sign Up</h1>

    <h3>Create an account to get started!</h3>

    <!-- POST method used to ensure security -->
    <form method="POST" action="{{ route('register.post') }}" class="user-form-card" id="signup-form">
        
        <!-- @csrf used to prevent cross-site requests and malicious attacks -->
        @csrf

        <!-- user signup information, everything except a phone number is required -->
        <div class="signup-info">

            <!-- input for user's name -->
            <label for="regname">Name</label>
            <input type="text" name="name" id="regname" value="{{ old('name') }}" required autofocus>

            <!-- input for user's UWindsor email address -->
            <!-- a placeholder is used to guide the user for input format -->
            <label for="email">UWindsor Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="uwinID@uwindsor.ca" required>

            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <!-- input for user's phone number (optional) with placeholder -->
            <label for="phone">Phone Number (Optional)</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="e.g. 123-456-7890">

            <!-- input to create user's password -->
            <label>Password (must be at least 8 characters)</label>
            <input type="password" name="password" id="password" required>

            <!-- password confirmation will happen in user-auth.js -->
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="password_confirmation" id="confirmPassword" required>

            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror

        </div>

        <!-- buttons related to registration are in this separate container -->
        <div id="signup-btn-container">
            <button type="submit" class="userRegBtn">Sign Up</button>
            <button type="reset" class="userRegBtn" id="cancelBtn">Cancel</button>
        </div>

        <!-- footer for extra link unrelated to main signup features -->
        <div class="user-info-footer" id="signup-footer">
            <span class="login-link">Already have an account? <a href="{{ route('login') }}">Sign in</a></span>
        </div>
    </form>

</div>
@endsection