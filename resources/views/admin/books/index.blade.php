@extends('layouts.app')

@section('title','Admin - Listings')

@section('content')
<h1>Admin: Book Listings</h1>

@if(session('status'))
    <div class="alert">{{ session('status') }}</div>
@endif

<form method="GET" action="{{ route('admin.books.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin: 1rem 0;">
    <input name="q" value="{{ request('q') }}" placeholder="Search title/course/author/isbn" style="min-width:260px;" />

    <select name="status">
        <option value="" @selected(request('status')==='')>All</option>
        <option value="active" @selected(request('status')==='active')>Active</option>
        <option value="sold" @selected(request('status')==='sold')>Sold</option>
    </select>

    <button type="submit">Filter</button>
</form>

@foreach($books as $b)
    <div class="card" style="margin-bottom: 1rem;">
        <div style="display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap;">
            <div>
                <strong>{{ $b->title }}</strong>
                <div><small>{{ $b->course_code ?? 'No course code' }} • ${{ $b->price_dollars }}</small></div>
                <div><small>Owner user_id: {{ $b->user_id }}</small></div>
                <div style="margin-top:6px;">
                    <span class="badge">{{ $b->is_sold ? 'Sold' : 'Active' }}</span>
                    <a href="{{ route('books.show', $b) }}" style="margin-left:10px;">View public page</a>
                </div>
            </div>

            <div style="display:flex; gap:10px; align-items:center;">
                <form method="POST" action="{{ route('admin.books.toggleSold', $b) }}">
                    @csrf
                    <button type="submit">Toggle Sold</button>
                </form>

                <form method="POST" action="{{ route('admin.books.destroy', $b) }}" onsubmit="return confirm('Delete this listing?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{ $books->links() }}
@endsection
