<!-- php file that will set content for creating a book listing -->

@extends('layouts.app')

@section('title', 'Create Listing')

<!-- set the styling to form.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

<!-- ensure proper form validation is integrated -->
@push('scripts')
    <script src="{{ asset('js/create-book-val.js') }}"></script>
@endpush

@section('content')
<div id="create-listing-page">
<h1>Create Listing</h1>

<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="user-form-card">
    @csrf
    <!-- retrieve data from partials/form.blade.php -->
    @include('books.partials.form', ['book' => null])
    <button type="submit">Create</button>
</form>
</div>
@endsection