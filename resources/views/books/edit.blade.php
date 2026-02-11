@extends('layouts.app')

@section('title', 'Edit Listing')

@section('content')
<h1>Edit Listing</h1>

<form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data" class="card">
    @csrf
    @method('PUT')
    @include('books.partials.form', ['book' => $book])
    <button type="submit">Save</button>
</form>
@endsection
