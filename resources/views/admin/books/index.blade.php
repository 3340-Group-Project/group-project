{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

@extends('layouts.app')

{{-- Admin Books page: delete listing + mark sold/active. Search/filter is GET so URL keeps filters. --}}

@section('content')
<div style="max-width: 1100px; margin: 0 auto; padding: 16px;">
  <h1>Admin - Book Listings</h1>

@foreach($books as $b)
    <div class="card">
        <strong>{{ $b->title }}</strong> — ${{ $b->price_dollars }}
        <div><small>Owner user_id: {{ $b->user_id }}</small></div>
        <div class="row">
            <span class="badge">{{ $b->is_sold ? 'Sold' : 'Active' }}</span>
        </div>

        <div class="row">

{{-- NOTE: Form submits to the backend route in action=... --}}
            <form method="POST" action="{{ route('admin.books.toggleSold', $b) }}">
                @csrf
                <button type="submit">Toggle Sold</button>
            </form>

{{-- NOTE: Form submits to the backend route in action=... --}}
            <form method="POST" action="{{ route('admin.books.destroy', $b) }}">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Delete listing?')">Delete</button>
            </form>
        </div>
    </div>
@endforeach

{{ $books->links() }}
@endsection
