@extends('layouts.app')

@section('title', 'Create Listing')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@push('scripts')
    <script src="{{ asset('js/create-book-val.js') }}"></script>
@endpush

@section('content')
<div id="create-listing-page">
<h1>Create Listing</h1>

<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="user-form-card">
    @csrf

    <!-- todo: figure out why form is not being properly styled -->
    @include('books.partials.form', ['book' => null])
    <button type="submit">Create</button>
</form>
</div>
@endsection
