<!-- php file for admin to change theme of web page  -->

@extends('layouts.app')

@section('title','Admin - Theme')

<!-- set the styling to form.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@section('content')
<div id="themes-page">
<!-- header -->
<h1>Theme Settings</h1>
<!-- POST method update theme data -->
<form method="POST" action="{{ route('admin.settings.theme.update') }}" class="user-form-card">
    @csrf
    <label>Site Theme</label>
    <select name="theme">
        <!-- dropdown listing the available themes -->
        @foreach($themes as $t)
            <option value="{{ $t }}" @selected($current===$t)>{{ $t }}</option>
        @endforeach
    </select>
    <button type="submit">Update Theme</button>
</form>

<!-- shows the current theme -->
<p>Current: <strong>{{ $current }}</strong></p>
</div>
@endsection
