@extends('layouts.app')

@section('title', $book->title)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}" />
@endsection

@section('content')
<a href="{{ route('books.index') }}">&larr; Back</a>

<div class="single-card">
    @if($book->cover_image_path)
        <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Cover">
    @else
        <img src="{{ asset('images/book1.webp') }}" alt="Cover">
    @endif
    
    <div>
        <h1>{{ $book->title }}</h1>
        <p><strong>Price:</strong> ${{ $book->price_dollars }}</p>
        <p><strong>Course:</strong> {{ $book->course_code ?? '—' }}</p>
        <p><strong>Author:</strong> {{ $book->author ?? '—' }}</p>
        <p><strong>Description:</strong> {{ $book->description }}</p>
        <p><strong>ISBN:</strong> {{ $book->isbn ?? '—' }}</p>
        <p><strong>Condition:</strong> {{ $book->condition }}</p>
        <p><strong>Format:</strong> {{ $book->format }}</p>

        <h3>Contact</h3>
        <div class="admin-buttons">
        <a href="mailto:{{ $book->user->email }}">Email</a>

        <!-- add if since phone is optional contact method -->
        @if($book->user?->phone)
            <a href="tel:{{ $book->user->phone }}">Phone</a>
        @endif
</div>
    </div>
</div>
@endsection