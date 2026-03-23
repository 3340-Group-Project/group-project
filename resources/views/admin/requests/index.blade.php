<!-- php file for admin to manage sent requests from users -->

@extends('layouts.app')

@section('title','Admin - Requests')

<!-- set the styling to books.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<!-- header -->
<div class="a1">
<h1 class="listings-label">Requests</h1>
</div>

<!-- renders request entries in grid format -->
<div class="books-grid">
@foreach($requests as $r)
    <div class="card">
        <strong>{{ $r->subject }}</strong>
        <div><small>Status: {{ $r->status }} | From: {{ $r->user->email }}</small></div>
        <p>{{ $r->message }}</p>
        <!-- full page content info about request --> 
        <a href="{{ route('admin.requests.show', $r) }}">Open</a>
    </div>
@endforeach

{{ $requests->links() }}
</div>
@endsection
