@extends('layouts.app')

@section('title','Admin - Listings')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<div style="max-width: 1100px; margin: 0 auto; padding: 16px;">
<div class="a1">  
<h1 class="listings-label">Admin - Book Listings</h1>
</div>

@foreach($books as $b)
<div class="books-grid">
    <div class="card">
        <strong>{{ $b->title }}</strong> — ${{ $b->price_dollars }}
        <div><small>Owner user_id: {{ $b->user_id }}</small></div>
        <div class="row">
            <span class="badge">{{ $b->is_sold ? 'Sold' : 'Active' }}</span>
        </div>

        <div class="row">
            <form method="POST" action="{{ route('admin.books.toggleSold', $b) }}">
                @csrf
                <button type="submit">Toggle Sold</button>
            </form>
            <form method="POST" action="{{ route('admin.books.destroy', $b) }}">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Delete listing?')">Delete</button>
            </form>
        </div>
    </div>
@endforeach
</div>

{{ $books->links() }}
@endsection
