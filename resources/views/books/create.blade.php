{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

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

{{-- NOTE: Form submits to the backend route in action=... --}}

<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="user-form-card">
    @csrf
    @include('books.partials.form', ['book' => null])
    <button type="submit">Create</button>
</form>
</div>
@endsection