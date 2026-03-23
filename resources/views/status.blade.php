@extends('layouts.app')

{{-- Set the page title that the shared layout can show in the browser/tab. --}}
@section('title','System Status')

{{-- Start of the main page content section injected into layouts.app. --}}
@section('content')
{{-- Main heading for the status page so users know this page shows system health checks. --}}
<h1>System Status</h1>

{{-- Overall website status card so the monitoring page clearly shows online/offline first. --}}
@php($allChecksOk = collect($checks)->every(fn($check) => !empty($check['ok'])))
<div class="card">
    <strong>Website:</strong>
    @if($allChecksOk)
        <span class="badge ok">ONLINE</span>
    @else
        <span class="badge bad">OFFLINE</span>
    @endif
    <div><small>Overall result based on the simple service checks below.</small></div>
</div>


{{-- Loop through every status check passed from the controller.
     $name is the label of the check, and $c stores that check's result data. --}}
@foreach($checks as $name => $c)
    {{-- Card container for one single system check result. --}}
    <div class="card">
        {{-- Show the check name, like database or storage, before its result badge. --}}
        <strong>{{ $name }}</strong>:

        {{-- If this check says ok=true, show the success badge. --}}
        @if($c['ok'])
            {{-- Green/positive style badge for a passed check. --}}
            <span class="badge ok">OK</span>
        @else
            {{-- Otherwise show the failed status badge. --}}
            <span class="badge bad">FAIL</span>
        @endif

        {{-- Show the extra message for this check, usually explaining what passed or failed. --}}
        <div><small>{{ $c['message'] }}</small></div>
    </div>
@endforeach
{{-- End of the content section for this Blade view. --}}
@endsection

