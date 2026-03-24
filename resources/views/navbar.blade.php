<nav class="nav">
    <ul id="nav-menu">

        <!-- Hamburger button (only visible on mobile) -->
        <li class="hamburger-item">
            <button class="hamburger" type="button" onclick="document.getElementById('nav-menu').classList.toggle('open')">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </li>

        <!-- Brand — shows on right in mobile, hidden in dropdown -->
        <li class="brand-item">
            <span class="home-link">
                <!-- replaced svg with CampusLogo.png to match homepage branding -->
                <img src="{{ asset('images/CampusLogo.png') }}" class="logo" alt="CampusShelf Logo" />
                <span class="campus-shelf"><a class="nav-link" href="{{ route('home') }}">Campus Shelf</a></span>
            </span>
        </li>

        <li><a class="nav-link" href="{{ route('about') }}">About</a></li>
        <li><a class="nav-link" href="{{ route('meet-team') }}">Team</a></li>
        <li><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
        <li><a class="nav-link" href="{{ route('wiki.index') }}">Wiki</a></li>
        <li><a class="nav-link" href="{{ route('books.index') }}">Book Listings</a></li>
        <li><a class="nav-link" href="{{ route('contact') }}">Contact us</a></li>

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

        {{-- Admin Portal (admins only) --}}
        @if(auth()->user()->isAdmin())
        <li class="nav-dropdown-wrap">
            <details class="nav-dropdown">
                <summary class="nav-link">Admin Portal</summary>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                    <li><a class="nav-link" href="{{ route('admin.books.index') }}">Admin Book Listings</a></li>
                    <li><a class="nav-link" href="{{ route('admin.users.index') }}">Admin User Listings</a></li>
                    <li><a class="nav-link" href="{{ route('admin.settings.theme') }}">Settings</a></li>
                </ul>
            </details>
        </li>
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
