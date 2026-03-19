<!-- php file for admin portal -->

@extends('layouts.app')

@section('title','Admin Dashboard')

<!-- set the styling to books.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<!-- header -->
<div class="a1">
<h1 class="listings-label">Admin Dashboard</h1>
</div>

<!-- aggregated info regarding users, listings and requests -->
<div class="books-grid">
    <div class="card"><strong>Total users:</strong> {{ $users }}</div>
    <div class="card"><strong>Active listings:</strong> {{ $activeListings }}</div>
    <div class="card"><strong>Open requests:</strong> {{ $openRequests }}</div>
</div>

<!-- buttons to redirect to different admin pages -->
<div class="a1 admin-buttons">
<div class="row">
    <a href="{{ route('admin.users.index') }}">Manage Users</a>
    <a href="{{ route('admin.books.index') }}">Manage Listings</a>
    <a href="{{ route('admin.requests.index') }}">Manage Requests</a>
    <a href="{{ route('admin.settings.theme') }}">Theme Settings</a>
</div>
</div>
@endsection
