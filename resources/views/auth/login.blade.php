@extends('layouts.app')

@section('title', 'Login')

@section('content')
<h1>Welcome Back!</h1>

<form method="POST" action="{{ route('login.post') }}" class="card">
    @csrf
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label class="row">
        <input type="checkbox" name="remember" value="1"> Remember me
    </label>

    <button type="submit">Login</button>
</form>
@endsection
