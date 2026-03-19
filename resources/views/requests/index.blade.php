<!-- php file that allows users to view their requests  -->

@extends('layouts.app')

@section('title', 'My Requests')

<!-- set the styling to books.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<!-- header and new request button --> 
<div class="a1">
    <h1 class="listings-label">My Requests</h1><a class="button" href="{{ route('requests.create') }}">+ New Request</a>
    <!-- appropriate message if requests not found -->
    @if($requests->count() === 0)
    <p>No requests yet.</p>
</div>
    @else
    <!-- renders the user's request in grid format  -->
    <div class="books-grid">
        @foreach($requests as $r)
            <!-- content for individual request -->
            <div class="card">
                <strong>{{ $r->subject }}</strong>
                <div><small>Status: {{ $r->status }}</small></div>
                <p>{{ $r->message }}</p>
                @if($r->admin_response)
                    <div class="flash info"><strong>Admin response:</strong> {{ $r->admin_response }}</div>
                @endif
            </div>
        @endforeach
    </div>

    {{ $requests->links() }}
@endif
@endsection
