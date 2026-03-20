{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

@extends('layouts.app')

{{-- Admin Users page: toggle admin + toggle disabled. If DB columns don't exist, uses file fallback. --}}

@section('title','Admin - Users')

@section('content')
<h1>Users</h1>

@foreach($users as $u)
    <div class="card">
        <strong>{{ $u->name }}</strong> ({{ $u->email }})
        <div class="row">
            <span class="badge">{{ $u->is_admin ? 'Admin' : 'User' }}</span>
            <span class="badge">{{ $u->is_disabled ? 'Disabled' : 'Active' }}</span>
        </div>
        <div class="row">

{{-- NOTE: Form submits to the backend route in action=... --}}
            <form method="POST" action="{{ route('admin.users.toggleDisabled', $u) }}">
                @csrf
                <button type="submit">{{ $u->is_disabled ? 'Enable' : 'Disable' }}</button>
            </form>

{{-- NOTE: Form submits to the backend route in action=... --}}
            <form method="POST" action="{{ route('admin.users.toggleAdmin', $u) }}">
                @csrf
                <button type="submit">{{ $u->is_admin ? 'Remove Admin' : 'Make Admin' }}</button>
            </form>
        </div>
    </div>
@endforeach

{{ $users->links() }}
@endsection
