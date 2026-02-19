<!DOCTYPE html>
<html>
    <head>
        <title>Campus Swap</title>
        <link rel="stylesheet" href="{{ asset('css/nav.css') }}"/>
        
    </head>
    <body>
        <body id="book">
        <nav class = "nav">
            <ul>
                <li>
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
                <a href="{{ route('books.my') }}">My Listings</a>
                <a href="{{ route('requests.index') }}">Requests</a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button class="linklike" type="submit">Logout</button>
                </form>
                @endauth
            </ul>
        </nav>
    </body>

</html>