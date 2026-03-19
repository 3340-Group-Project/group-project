{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

@extends('layouts.app')

@section('title','Admin - Theme')

@section('content')
<h1>Theme Settings</h1>

{{-- NOTE: Form submits to the backend route in action=... --}}

<form method="POST" action="{{ route('admin.settings.theme.update') }}" class="card">
    @csrf
    <label>Site Theme</label>
    <select name="theme">
        @foreach($themes as $t)
            <option value="{{ $t }}" @selected($current===$t)>{{ $t }}</option>
        @endforeach
    </select>
    <button type="submit">Update Theme</button>
</form>

<p>Current: <strong>{{ $current }}</strong></p>
@endsection
