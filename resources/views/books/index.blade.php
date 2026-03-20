{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

@extends('layouts.app')
@section('title', 'Book Listings')
@section('body-attributes', 'id="book"')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<main>

{{-- NOTE: Form submits to the backend route in action=... --}}
    <form method="GET" action="{{ route('books.index') }}" class="container">
        <div class="a1">
            <label class="search-label" for="search">Search for Books</label>
            <input type="text" id="search_bar" name="search_bar" value="{{ request('search_bar') }}" placeholder="Search for Books">
            
        </div>
        <div class="searchSubmit">
            <button type="submit" id="search_button" name="search_button">Search</button>
        </div>
        <div class="filters">
            <div class="a2">
                {{-- Use canonical query param name "format" so backend filter works. (Backend also supports legacy "filter") --}}
                <select id="book_format" name="format">
                    <option value="">Format</option>
                    <option value="Paperback" @selected((request('format') ?? request('filter'))==='Paperback')>Paperback</option>
                    <option value="Hardcover" @selected((request('format') ?? request('filter'))==='Hardcover')>Hardcover</option>
                    <option value="Loose-leaf" @selected((request('format') ?? request('filter'))==='Loose-leaf')>Loose-leaf</option>
                    <option value="eBook" @selected((request('format') ?? request('filter'))==='eBook')>eBook</option>
                </select>
            </div>
            <div class="a3">
                <select id="condition" name="condition">
                    <option value="">Condition</option>
                    <option value="New" @selected(request('condition')==='New')>New</option>
                    <option value="Like New" @selected(request('condition')==='Like New')>Like New</option>
                    <option value="Good" @selected(request('condition')==='Good')>Good</option>
                    <option value="Fair" @selected(request('condition')==='Fair')>Fair</option>
                    <option value="Poor" @selected(request('condition')==='Poor')>Poor</option>
                </select>
            </div>
            <div class="a4">
                <input type="text" id="course" name="course" value="{{ request('course') }}" placeholder="Course Code" style="max-width: 120px;">
            </div>
            <div class="a5">
                <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price" step="1" min="0" style="max-width: 100px;">
            </div>
            <div class="a6">
                <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price" step="1" min="0" style="max-width: 100px;">
            </div>
            <!-- clear filters via query parameters (refreshes without filter parameters) -->
            <div class="a7">
                <a href="{{ route('books.index') }}" class="clear_filters">
                    Clear Filters
                </a>
            </div>
        </div>
    </form>

    @if($books->count() === 0)
        <div style="grid-column: 1 / -1; text-align: center; padding: 2rem;">
            <p>No books found. Try adjusting your filters.</p>
        </div>
    @else
        <section class="books-grid">
        @foreach($books as $book)
            <div>
                <a href="{{ route('books.show', $book) }}" class="card-link">
                    <div class="card">
                        @if($book->cover_image_path)
                            <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Book Cover"/>
                        @else
                            <img src="{{ asset('images/book' . (($loop->index % 6) + 1) . '.webp') }}" alt="Book Cover"/>
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
        </section>
    @endif
</main>
@endsection
