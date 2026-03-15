@extends('layouts.app')

@section('title','Admin Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<div class="a1">
<h1 class="listings-label">Admin Dashboard</h1>
</div>

<div class="books-grid">
    <div class="card"><strong>Total users:</strong> {{ $users }}</div>
    <div class="card"><strong>Active listings:</strong> {{ $activeListings }}</div>
    <div class="card"><strong>Open requests:</strong> {{ $openRequests }}</div>
</div>

<div class="a1 admin-buttons">
<div class="row">
    <a href="{{ route('admin.users.index') }}">Manage Users</a>
    <a href="{{ route('admin.books.index') }}">Manage Listings</a>
    <a href="{{ route('admin.requests.index') }}">Manage Requests</a>
    <a href="{{ route('admin.settings.theme') }}">Theme Settings</a>
</div>
</div>
@endsection
