@extends('layouts.app')

@section('title', $book->title)

@section('content')
<a href="{{ route('books.index') }}">&larr; Back</a>

<div class="card">
    <h1>{{ $book->title }}</h1>
    <p><strong>Price:</strong> ${{ $book->price_dollars }}</p>
    <p><strong>Course:</strong> {{ $book->course_code ?? '—' }}</p>
    <p><strong>Author:</strong> {{ $book->author ?? '—' }}</p>
    <p><strong>ISBN:</strong> {{ $book->isbn ?? '—' }}</p>
    <p><strong>Condition:</strong> {{ $book->condition }}</p>
    <p><strong>Format:</strong> {{ $book->format }}</p>

    @if($book->cover_image_path)
        <img style="max-width:300px" src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Cover">
    @endif

    <p>{{ $book->description }}</p>
</div>
@endsection
