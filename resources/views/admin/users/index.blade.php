<!-- php file that allows to manage the users -->

@extends('layouts.app')

@section('title','Admin - Users')

<!-- set the styling to books.css -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
@endsection

@section('content')
<!-- header --> 
<div class="a1">
<h1 class="listings-label">Users</h1>

<!-- iterate through user entries -->
@foreach($users as $u)
    <!-- individual user content -->
    <div class="card">
        <strong>{{ $u->name }}</strong> ({{ $u->email }})
        <div class="row">
            <span class="badge">{{ $u->is_admin ? 'Admin' : 'User' }}</span>
            <span class="badge">{{ $u->is_disabled ? 'Disabled' : 'Active' }}</span>
        </div>
        <div class="row">
            <!-- disable user -->
            <form method="POST" action="{{ route('admin.users.toggleDisabled', $u) }}">
                @csrf
                <button type="submit">{{ $u->is_disabled ? 'Enable' : 'Disable' }}</button>
            </form>
            <!-- remove or enable admin access-->
            <form method="POST" action="{{ route('admin.users.toggleAdmin', $u) }}">
                @csrf
                <button type="submit">{{ $u->is_admin ? 'Remove Admin' : 'Make Admin' }}</button>
            </form>
        </div>
    </div>
@endforeach
</div>
{{ $users->links() }}
@endsection
