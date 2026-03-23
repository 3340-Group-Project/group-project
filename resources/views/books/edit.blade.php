<!-- php file that will set content for editing a book listing -->

@extends('layouts.app')

@section('title', 'Edit Listing')

<!-- set the styling to form.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

<!-- ensure proper form validation is integrated -->
@push('scripts')
    <script src="{{ asset('js/create-book-val.js') }}"></script>
@endpush

@section('content')
<div id="edit-listing-page">
<h1>Edit Listing</h1>
<form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data" class="user-form-card">
    @csrf
    <!-- enable PUT method to enable replacing existing resoruces in book listing -->
    @method('PUT')
    <!-- retrieve data from partials/form.blade.php -->
    @include('books.partials.form', ['book' => $book])
    <button type="submit">Save</button>
</form>
</div>
@endsection
