<!-- php file showing user book listing information -->

@extends('layouts.app')

@section('title', $book->title)

<!-- set the styling to books.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}" />
@endsection

@section('content')
<a href="{{ route('books.index') }}">&larr; Back</a>

<div class="single-card">
    <!-- retrieves image from book listing (contains fallback image if not found) -->
    @if($book->cover_image_path)
        <img src="{{ $book->cover_image_url }}" alt="Cover">
    @endif

    <div>
        <!-- content about book listing -->
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

        <!-- add conditional if since phone is optional contact method -->
        @if($book->user?->phone)
            <a href="tel:{{ $book->user->phone }}">Phone</a>
        @endif
</div>
        <div style="margin-top:12px;">
            <small class="placeholder">Need help with contacting sellers or viewing similar books? </small>
            <a href="{{ route('wiki.contacting-sellers') }}">Contacting Sellers</a>
            &nbsp;|&nbsp;
            <a href="{{ route('wiki.browse-listings') }}">Browse Listings help</a>
        </div>
    </div>
</div>
@endsection
