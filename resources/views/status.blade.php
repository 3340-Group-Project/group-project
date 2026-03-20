{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

@extends('layouts.app')

{{-- Status page explanation (Jin): shows basic health checks (DB, storage, theme setting). --}}

@section('title','System Status')

@section('content')
<h1>System Status</h1>

@foreach($checks as $name => $c)
    <div class="card">
        <strong>{{ $name }}</strong>:
        @if($c['ok'])
            <span class="badge ok">OK</span>
        @else
            <span class="badge bad">FAIL</span>
        @endif
        <div><small>{{ $c['message'] }}</small></div>
    </div>
@endforeach
@endsection
