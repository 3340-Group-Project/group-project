<!-- php file will allow user to manage their listings they have created -->

@extends('layouts.app')
@section('title', 'My Listings')
@section('body-attributes', 'id="book"')

<!-- set the styling to books.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<!-- header and button to create listing -->
<div class="a1">
    <h1 class="listings-label">My Listings</h1><a class="button" href="{{ route('books.create') }}">+ Create Listing</a>
    <!-- appropriate message if there is no listings -->
    @if($books->count() === 0)
    <p>You have no listings yet.</p>
</div>

@else
    <!-- renders the book listings-->
    <div class="books-grid">
        @foreach($books as $book)
            <div class="card">
                @if($book->cover_image_path)
                    <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="{{ $book->title }} cover"/>
                @else
                    <img src="{{ asset('images/book' . (($loop->index % 6) + 1) . '.webp') }}" alt="Default book cover"/>
                @endif
                <strong>{{ $book->title }}</strong> — ${{ $book->price_dollars }}
                @if($book->is_sold) <span class="badge">Sold</span> @endif
                <div class="row">
                    <!-- additional content for book listing like edit, mark sold, and delete button -->
                    <a href="{{ route('books.edit', $book) }}">Edit</a>
                    <form method="POST" action="{{ route('books.sold', $book) }}">
                        @csrf
                        <button type="submit">Mark Sold</button>
                    </form>
                    <form method="POST" action="{{ route('books.destroy', $book) }}">
                        @csrf @method('DELETE')
                        <!-- appropriate confirmation message before deleting listing -->
                        <button type="submit" onclick="return confirm('Delete listing?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    {{ $books->links() }}
@endif
@endsection
