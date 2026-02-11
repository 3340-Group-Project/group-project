@extends('layouts.app')

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
