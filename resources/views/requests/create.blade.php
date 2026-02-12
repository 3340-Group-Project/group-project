@extends('layouts.app')

@section('title', 'New Request')

@section('content')
<h1>Submit a Request</h1>

<form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data" class="card">
    @csrf
    <label>Subject</label>
    <input name="subject" value="{{ old('subject') }}" required>

    <label>Message</label>
    <textarea name="message" rows="6" required>{{ old('message') }}</textarea>

    <label>Attachment (optional)</label>
    <input type="file" name="attachment">

    <button type="submit">Submit</button>
</form>
@endsection
