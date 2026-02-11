@extends('layouts.app')

@section('title', 'Create Listing')

@section('content')
<h1>Create Listing</h1>

<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="card">
    @csrf
    @include('books.partials.form', ['book' => null])
    <button type="submit">Create</button>
</form>
@endsection
