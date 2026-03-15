@extends('layouts.app')

@section('title','Admin - Theme')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@section('content')
<div id="themes-page">
<h1>Theme Settings</h1>
<form method="POST" action="{{ route('admin.settings.theme.update') }}" class="user-form-card">
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
</div>
@endsection
