@extends('layouts.app')
@include('navbar')

@section('title', 'Login')

@section('content')
<div id="login-page">
    <div class="login-container">
        <h1>Welcome Back!</h1>

        <form method="POST" action="{{ route('login.post') }}" class="login-form-card">
            @csrf
            
            <label for="email">Email</label>
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
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>

            <button type="submit">Login</button>
        </form>
    </div>
</div>
@endsection
