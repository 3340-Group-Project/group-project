@extends('layouts.app')

@section('title', 'Browse Books')

@section('content')
<h1>Search for Books</h1>

<form method="GET" action="{{ route('books.index') }}" class="card">
    <div class="grid">
        <div>
            <label>Search</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Title, course, author, ISBN">
        </div>
        <div>
            <label>Course</label>
            <input type="text" name="course" value="{{ request('course') }}" placeholder="COMP 3340">
        </div>
        <div>
            <label>Min Price</label>
            <input type="number" name="min_price" value="{{ request('min_price') }}" step="1" min="0">
        </div>
        <div>
            <label>Max Price</label>
            <input type="number" name="max_price" value="{{ request('max_price') }}" step="1" min="0">
        </div>
        <div>
            <label>Condition</label>
            <select name="condition">
                <option value="">Any</option>
                @foreach(['New','Like New','Good','Fair','Poor'] as $c)
                    <option value="{{ $c }}" @selected(request('condition')===$c)>{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Format</label>
            <select name="format">
                <option value="">Any</option>
                @foreach(['Paperback','Hardcover','Loose-leaf','eBook'] as $f)
                    <option value="{{ $f }}" @selected(request('format')===$f)>{{ $f }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit">Filter</button>
</form>

@if($books->count() === 0)
    <p>No listings found.</p>
@else
    <div class="cards">
        @foreach($books as $book)
            <a class="card" href="{{ route('books.show', $book) }}">
                <div class="thumb">
                    @if($book->cover_image_path)
                        <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Cover">
                    @else
                        <div class="placeholder">No image</div>
                    @endif
                </div>
                <div>
                    <strong>{{ $book->title }}</strong><br>
                    <small>{{ $book->course_code }}</small><br>
                    <span>${{ $book->price_dollars }}</span>
                </div>
            </a>
        @endforeach
    </div>

    {{ $books->links() }}
@endif
@endsection
