{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

@extends('layouts.app')

@section('title', 'My Requests')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<div class="a1">
    <h1 class="listings-label">My Requests</h1><a class="button" href="{{ route('requests.create') }}">+ New Request</a>
    @if($requests->count() === 0)
    <p>No requests yet.</p>
</div>

@else
    <div class="books-grid">
        @foreach($requests as $r)
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
