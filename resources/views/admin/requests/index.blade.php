@extends('layouts.app')

@section('title','Admin - Requests')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<div class="a1">
<h1 class="listings-label">Requests</h1>
</div>

<div class="books-grid">
@foreach($requests as $r)
    <div class="card">
        <strong>{{ $r->subject }}</strong>
        <div><small>Status: {{ $r->status }} | From: {{ $r->user->email }}</small></div>
        <p>{{ $r->message }}</p>
        <a href="{{ route('admin.requests.show', $r) }}">Open</a>
    </div>
@endforeach

{{ $requests->links() }}
</div>
@endsection
