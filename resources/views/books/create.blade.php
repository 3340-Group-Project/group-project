@extends('layouts.app')

@section('title', 'Create Listing')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
@endsection

@push('scripts')
    <script src="{{ asset('js/create-book-val.js') }}"></script>
@endpush

@section('content')
<div id="login-page"> <!--todo: create a new name for this id -> add to login.css -->
<h1>Create Listing</h1>

<form id="create-listing-form" method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="user-form-card">
    @csrf

    <!-- todo: figure out why form is not being properly styled -->
    <!-- todo: figure out why image is not being saved when creating listing -->
     <!-- todo: update contact info in show.blade.php -->
    @include('books.partials.form', ['book' => null])
    <button type="submit">Create</button>
</form>
</div>
@endsection
