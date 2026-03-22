@extends('layouts.app')

@section('title', 'Meet the Team')

@section('content')

<!-- styles for this page -->
<link rel="stylesheet" href="{{ asset('css/meetteam.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="team-container">

    <!-- page title -->
    <h1>Meet the Team</h1>

    <!-- grid layout for team members -->
    <div class="team-grid">

        <!-- kat -->
        <div class="team-card">
            <div class="team-avatar">
                <!-- placeholder icon for now -->
                <img src="{{ asset('images/KatTeamPhoto.png') }}" alt="Katarina Mantay" class="team-avatar-img">
            </div>
            <div class="team-name">Katarina Mantay</div>
            <div class="team-role">3rd Year Computer Science</div>
            <div class="team-bio">
                Contributed heavily to the frontend of the project, created all static pages, and developed the wiki system.
            </div>
        </div>

        <!-- kulsum -->
        <div class="team-card">
            <div class="team-avatar">
                <img src="{{ asset('images/KulsumTeamPhoto.png') }}" alt="Kulsum Khan" class="team-avatar-img">
            </div>
            <div class="team-name">Kulsum Khan</div>
            <div class="team-role">3rd Year Computer Science</div>
            <div class="team-bio">
                Worked on the backend functionality for book listings and helped develop the admin tools for managing the platform.
            </div>
        </div>

        <!-- rocio -->
        <div class="team-card">
            <div class="team-avatar">
                <img src="{{ asset('images/RocioTeamPhoto.png') }}" alt="Rocio Rueda" class="team-avatar-img">
            </div>
            <div class="team-name">Rocio Rueda</div>
            <div class="team-role">4th Year Computer Science</div>
            <div class="team-bio">
                Contributed to backend development and played a major role in building the admin features and book management system.
            </div>
        </div>

        <!-- jin -->
        <div class="team-card">
            <div class="team-avatar">
                <img src="{{ asset('images/JinTeamPhoto.png') }}" alt="Jin Cai" class="team-avatar-img">
            </div>
            <div class="team-name">Jin Cai</div>
            <div class="team-role">4th Year Computer Science</div>
            <div class="team-bio">
                Focused on database design and implementation to support user accounts, listings, and platform data.
            </div>
        </div>

    </div>

</div>

@endsection
