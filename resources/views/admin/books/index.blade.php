<!-- php file for admin to manage book listings -->

@extends('layouts.app')

@section('title','Admin - Listings')

<!-- set the styling to books.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<div style="max-width: 1100px; margin: 0 auto; padding: 16px;">

<!-- header -->
<div class="a1">  
<h1 class="listings-label">Admin - Book Listings</h1>
</div>


@if($books->count() === 0)
    <div style="grid-column: 1 / -1; text-align: center; padding: 2rem;">
        <p>No books found.</p>
    </div>
@else
    <!-- renders each book listing in grid format -->
    <div class="books-grid">
        @foreach($books as $b)
            <div>
                <div class="card" style="flex-direction: column; align-items: flex-start;">
                    <strong>{{ $b->title }}</strong> — ${{ $b->price_dollars }}
                    <div><small>Owner user_id: {{ $b->user_id }}</small></div>
                    
                    <div class="row" style="margin-top: 1rem;">
                        <span class="badge" style="font-weight: bold; color: var(--accent-primary);">
                            Status: {{ $b->is_sold ? 'Sold' : 'Active' }}
                        </span>
                    </div>
                    
                    <div class="row" style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <form method="POST" action="{{ route('admin.books.toggleSold', $b) }}">
                            @csrf
                            <button class="admin-buttons" type="submit">Toggle Sold</button>
                        </form>
                        
                        <form method="POST" action="{{ route('admin.books.destroy', $b) }}">
                            @csrf @method('DELETE')
                            <button class="admin-buttons" type="submit" onclick="return confirm('Delete listing?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $books->links() }}
@endif
@endsection
