{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

@extends('layouts.app')

@section('title','Admin - Requests')

@section('content')
<h1>Requests</h1>

@foreach($requests as $r)
    <div class="card">
        <strong>{{ $r->subject }}</strong>
        <div><small>Status: {{ $r->status }} | From: {{ $r->user->email }}</small></div>
        <p>{{ $r->message }}</p>
        <a href="{{ route('admin.requests.show', $r) }}">Open</a>
    </div>
@endforeach

{{ $requests->links() }}
@endsection
