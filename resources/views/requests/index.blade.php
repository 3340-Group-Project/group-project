@extends('layouts.app')

@section('title', 'My Requests')

@section('content')
<h1>My Requests</h1>
<p><a class="button" href="{{ route('requests.create') }}">+ New Request</a></p>

@if($requests->count() === 0)
    <p>No requests yet.</p>
@else
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
    {{ $requests->links() }}
@endif
@endsection
