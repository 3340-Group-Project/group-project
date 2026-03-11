@extends('layouts.app')

@section('title', 'Edit Listing')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@push('scripts')
    <script src="{{ asset('js/create-book-val.js') }}"></script>
@endpush

@section('content')
<div id="edit-listing-page">
<h1>Edit Listing</h1>
<form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data" class="user-form-card">
    @csrf
    @method('PUT')
    @include('books.partials.form', ['book' => $book])
    <button type="submit">Save</button>
</form>
</div>
@endsection
