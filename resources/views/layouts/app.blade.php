<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CampusShelf')</title>
    <meta name="description" content="@yield('meta_description', 'Buy and sell used textbooks and study notes for UWindsor students.')">
    <meta name="keywords" content="UWindsor, textbooks, used books, study notes, marketplace">
    <link rel="icon" href="/favicon.ico">

    {{-- Theme CSS (admin can change siteTheme in DB setting) --}}
    <link rel="stylesheet" href="/css/theme-{{ $siteTheme ?? 'default' }}.css">
</head>
<body>
    @include('navbar')
    
<!-- <header class="navbar">
    <div class="container">
         <a class="brand" href="{{ route('home') }}">CampusShelf</a> 

        
         <nav class="nav">
            <a href="{{ route('books.index') }}">Browse</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('status') }}">Status</a>

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
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Sign Up</a>
            @endauth
        </nav>
    </div> 
</header> -->

<main class="container">
    @if(session('status'))
        <div class="flash success">{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div class="flash error">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <small>© {{ date('Y') }} CampusShelf</small>
    </div>
</footer>
</body>
</html>
