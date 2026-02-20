<!DOCTYPE html>
<html>
<head>
    <title>Campus Swap</title>
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}"/>
</head>
<body>
<nav class="nav">
    <ul id="nav-menu">

        <!-- Hamburger button (only visible on mobile) -->
        <li class="hamburger-item">
            <button class="hamburger" onclick="document.getElementById('nav-menu').classList.toggle('open')">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </li>

        <!-- Brand — shows on right in mobile, hidden in dropdown -->
        <li class="brand-item">
            <span class="home-link">
                <img src="{{ asset('images/logo.svg') }}" class="logo" alt="logo" />
                <span class="campus-shelf"><a class="nav-link" href="{{ route('home') }}">Campus Shelf</a></span>
            </span>
        </li>

        <li><a class="nav-link" href="{{ route('about') }}">About</a></li>
        <li><a class="nav-link" href="/wiki">Wiki</a></li>
        <li><a class="nav-link" href="{{ route('books.index') }}">Book Listings</a></li>
        <li><a class="nav-link" href="/contact">Contact us</a></li>

        <!-- if user is not logged in -->
        @guest
        <li class="nav-auth-buttons">
            <a class="nav-link nav-btn" href="{{ route('login') }}">Sign In</a>
            <a class="nav-link nav-btn nav-btn-signup" href="{{ route('register') }}">Sign Up</a>
        </li>
        @endguest

        <!-- if user is logged in -->
        @auth
        <li><a class="nav-link" href="{{ route('books.my') }}">My Listings</a></li>
        <li><a class="nav-link" href="{{ route('requests.index') }}">Requests</a></li>
        @if(auth()->user()->is_admin)
        <li><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
        @endif
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button class="linklike nav-link" type="submit">Logout</button>
            </form>
        </li>
        @endauth

    </ul>
</nav>
</body>
</html>
