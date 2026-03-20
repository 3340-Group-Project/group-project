{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')
<h1>Admin Dashboard</h1>

<div class="grid">
    <div class="card"><strong>Total users:</strong> {{ $users }}</div>
    <div class="card"><strong>Active listings:</strong> {{ $activeListings }}</div>
    <div class="card"><strong>Open requests:</strong> {{ $openRequests }}</div>
</div>

<p class="row">
    <a href="{{ route('admin.users.index') }}">Manage Users</a>
    <a href="{{ route('admin.books.index') }}">Manage Listings</a>
    <a href="{{ route('admin.requests.index') }}">Manage Requests</a>
    <a href="{{ route('admin.settings.theme') }}">Theme Settings</a>
</p>
@endsection
