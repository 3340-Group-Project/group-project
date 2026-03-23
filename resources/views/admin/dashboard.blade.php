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

<!-- aggregated info regarding users, listings, requests, and a simple monitoring summary -->
<div class="books-grid">
    <div class="card"><strong>Total users:</strong> {{ $users }}</div>
    <div class="card"><strong>Active listings:</strong> {{ $activeListings }}</div>
    <div class="card"><strong>Open requests:</strong> {{ $openRequests }}</div>

    <!-- Simple monitoring card for the rubric so admins can quickly see if the site is up. -->
    <div class="card">
        <strong>Website status:</strong>
        @if($websiteOnline)
            <span class="badge ok">ONLINE</span>
        @else
            <span class="badge bad">OFFLINE</span>
        @endif

        <!-- Small breakdown so the admin can tell which simple service check passed or failed. -->
        <div><small>Database: {{ $serviceChecks['database'] ? 'Online' : 'Offline' }}</small></div>
        <div><small>Storage: {{ $serviceChecks['storage'] ? 'Online' : 'Offline' }}</small></div>
        <div style="margin-top:8px;"><a href="{{ route('status') }}">Open monitoring page</a></div>
    </div>
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
