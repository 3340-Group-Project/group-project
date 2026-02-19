@extends('layouts.app')

@section('title', $book->title)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}" />
@endsection

@section('content')
<a href="{{ route('books.index') }}">&larr; Back</a>

<div class="single-card">
    <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Cover">
    
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
        <a href="mailto:example@gmail.com">Email</a>
        <a href="tel:+1234567890">Phone</a>
    </div>
</div>
@endsection