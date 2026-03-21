<!-- php file that will allow an existing user to sign in -->

@extends('layouts.app')

@section('title', 'Login')

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

<div id="login-page">
    <h1>Welcome Back!</h1>

    <h3>Log in to continue</h3>

        <form method="POST" action="{{ route('login.post') }}" class="user-form-card" id="login-form">
            <!-- @csrf used to prevent cross-site requests and malicious attacks -->
            @csrf
            
            <div class="login-info">

                <!-- user email input -->
                <label for="email">UWindsor Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>


                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror

                <label class="remember-me">
                    <input type="checkbox" name="remember" value="1">Remember Me</input>
                </label>

                <button type="submit" class="userRegBtn">Login</button>

            </div>

            <div class="user-info-footer">
                <span class="signup-link">No account? <a href="{{ route('register') }}">Sign Up</a></span>
            </div>


        </form>

</div>
@endsection