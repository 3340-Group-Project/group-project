<!DOCTYPE html>
<html>
    <head>
        <title>Campus Swap</title>
        <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
        
    </head>
    <body>
        <body id="book">
        <nav>
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
                <li class="nav-auth-buttons">
                    <a class="nav-link nav-btn" href="{{ route('login') }}">Sign In</a>
                    <a class="nav-link nav-btn nav-btn-signup" href="{{ route('register') }}">Sign Up</a>
                </li>
            </ul>
        </nav>

        <h1>Welcome!!</h1>
    
    </body>

</html>