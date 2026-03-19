<!-- php file that handles main app layout and rendering ensuring consistent styling, theme rendering, and status checks-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CampusShelf')</title>
    <!-- short summary of the webpage for search engines -> good for SEO responsiveness -->
    <meta name="description" content="@yield('meta_description', 'Buy and sell used textbooks and study notes for UWindsor students.')">
    <meta name="keywords" content="UWindsor, textbooks, used books, study notes, marketplace">
    <link rel="icon" href="/favicon.ico">

    {{-- Theme CSS (admin can change siteTheme in DB setting) --}}
    <link rel="stylesheet" href="/css/theme-{{ $siteTheme ?? 'default' }}.css">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('styles')
</head>
<body @yield('body-attributes')>
    @include('navbar')

    <!-- status check -->
    @if(session('status'))
        <div class="flash success">{{ session('status') }}</div>
    @endif
    <!-- error handling -->
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

<!-- footer for pages -->
<footer class="footer">
    <div class="container">
        <small>© {{ date('Y') }} CampusShelf</small>
    </div>
</footer>
@stack('scripts')
</body>
</html>
