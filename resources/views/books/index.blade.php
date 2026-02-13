<!DOCTYPE html>
<html>
    <head>
        <title>Campus Swap</title>
        <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
        
    </head>
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

        <!--add random squares that are clickable (to do different page)-->
        <main>
            <form method="GET" action="{{ route('books.index') }}" class="container" style="width: 100%;">
                <div class="a1">
                    <label class="search-label" for="search">Search for Books</label>
                    <input type="text" id="search_bar" name="search_bar" value="{{ request('search_bar') }}" placeholder="Search for Books">
                </div>
                <div class="filters">
                    <div class="a2">
                        <select id="book_format" name="filter">
                            <option value="">Format</option>
                            <option value="Paperback" @selected(request('filter')==='Paperback')>Paperback</option>
                            <option value="Hardcover" @selected(request('filter')==='Hardcover')>Hardcover</option>
                            <option value="Loose-leaf" @selected(request('filter')==='Loose-leaf')>Loose-leaf</option>
                            <option value="eBook" @selected(request('filter')==='eBook')>eBook</option>
                        </select>
                    </div>
                    <div class="a3">
                        <input type="text" id="course" name="course" value="{{ request('course') }}" placeholder="Course Code" style="max-width: 120px;">
                    </div>
                    <div class="a4">
                        <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price" step="1" min="0" style="max-width: 100px;">
                    </div>
                    <div class="a5">
                        <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price" step="1" min="0" style="max-width: 100px;">
                    </div>
                    <div class="a6">
                        <select id="condition" name="condition">
                            <option value="">Condition</option>
                            <option value="New" @selected(request('condition')==='New')>New</option>
                            <option value="Like New" @selected(request('condition')==='Like New')>Like New</option>
                            <option value="Good" @selected(request('condition')==='Good')>Good</option>
                            <option value="Fair" @selected(request('condition')==='Fair')>Fair</option>
                            <option value="Poor" @selected(request('condition')==='Poor')>Poor</option>
                        </select>
                    </div>
                    <div class="a7">
                        <button type="submit" id="search_button" name="search_button">Search</button>
                    </div>
                </div>
            </form>

            @if($books->count() === 0)
                <div style="grid-column: 1 / -1; text-align: center; padding: 2rem;">
                    <p>No books found. Try adjusting your filters.</p>
                </div>
            @else
                @foreach($books as $book)
                    @php
                        $gridClass = 'b' . (($loop->index % 6) + 1);
                    @endphp
                    <div class="{{ $gridClass }}">
                        <a href="{{ route('books.show', $book) }}" class="card-link">
                            <div class="card">
                                @if($book->cover_image_path)
                                    <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Book Cover"/>
                                @else
                                    <img src="{{ asset('images/book1.webp') }}" alt="Book Cover"/>
                                @endif
                                <div class="card-content">
                                    <h2>{{ $book->title }}</h2>
                                    <p>Price: ${{ $book->price_dollars }}</p>
                                    <p>{{ $book->course_code ?? 'No course code' }} </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        
        </main>
    </body>
</html>
