@extends('layouts.app')

@section('title','Admin - Request')

@section('content')
<h1>{{ $request->subject }}</h1>
<p><small>From: {{ $request->user->email }} | Status: {{ $request->status }}</small></p>
<div class="card">
    <p>{{ $request->message }}</p>
    @if($request->attachment_path)
        <p><a href="{{ asset('storage/'.$request->attachment_path) }}" target="_blank">Download attachment</a></p>
    @endif
</div>

<form method="POST" action="{{ route('admin.requests.respond', $request) }}" class="card">
    @csrf
    <label>Status</label>
    <select name="status">
        @foreach(['open','in_progress','closed'] as $s)
            <option value="{{ $s }}" @selected($request->status===$s)>{{ $s }}</option>
        @endforeach
    </select>

    <label>Response</label>
    <textarea name="admin_response" rows="6">{{ old('admin_response', $request->admin_response) }}</textarea>

    <button type="submit">Save</button>
</form>
@endsection
