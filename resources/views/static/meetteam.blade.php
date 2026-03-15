@extends('layouts.app')

@section('title', 'Meet the Team')

@section('content')

<link rel="stylesheet" href="{{ asset('css/meetteam.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="team-container">

    <h1>Meet the Team</h1>

    <div class="team-grid">

        <div class="team-card">
            <div class="team-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="team-name">Katarina Mantay</div>
            <div class="team-role">3rd Year Computer Science</div>
            <div class="team-bio">
                Contributed heavily to the frontend of the project, created all static pages, and developed the wiki system.
            </div>
        </div>

        <div class="team-card">
            <div class="team-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="team-name">Kulsum Khan</div>
            <div class="team-role">3rd Year Computer Science</div>
            <div class="team-bio">
                Worked on the backend functionality for book listings and helped develop the admin tools for managing the platform.
            </div>
        </div>

        <div class="team-card">
            <div class="team-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="team-name">Rocio Rueda</div>
            <div class="team-role">4th Year Computer Science</div>
            <div class="team-bio">
                Contributed to backend development and played a major role in building the admin features and book management system.
            </div>
        </div>

        <div class="team-card">
            <div class="team-avatar">
                <i class="fa-solid fa-user"></i>
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
