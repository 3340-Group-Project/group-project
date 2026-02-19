@extends('layouts.app')

@section('title', 'Login')

@section('content')
<header>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</header>

<div id="login-page">
    <h1>Welcome Back!</h1>

    <h3>Log in to continue</h3>

        <form method="POST" action="{{ route('login.post') }}" class="login-form-card">

            @csrf
            
            <div class="login-info">
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

                <button type="submit" class="loginbtn">Login</button>

            </div>

            <div class="login-footer">
                <span class="signup-link"><a href="{{ route('register') }}">Sign Up</a></span>
                <span class="fpsw"><a href="#">Forgot password?</a></span>
            </div>


        </form>

</div>
@endsection
