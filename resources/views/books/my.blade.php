@extends('layouts.app')

@section('title', 'My Listings')

@section('content')
<h1>My Listings</h1>
<p><a class="button" href="{{ route('books.create') }}">+ Create Listing</a></p>

@if($books->count() === 0)
    <p>You have no listings yet.</p>
@else
    <div class="cards">
        @foreach($books as $book)
            <div class="card">
                <strong>{{ $book->title }}</strong> — ${{ $book->price_dollars }}
                @if($book->is_sold) <span class="badge">Sold</span> @endif
                <div class="row">
                    <a href="{{ route('books.edit', $book) }}">Edit</a>
                    <form method="POST" action="{{ route('books.sold', $book) }}">
                        @csrf
                        <button type="submit">Mark Sold</button>
                    </form>
                    <form method="POST" action="{{ route('books.destroy', $book) }}">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete listing?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    {{ $books->links() }}
@endif
@endsection
