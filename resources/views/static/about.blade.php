@extends('layouts.app')

@section('title', 'About')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('content')
<div class="about-container">

    <!-- main header for the page -->
    <section class="page-header">
        <h1>About CampusShelf</h1>
        <p class="subtitle">
            Built by students, for students.
        </p>
    </section>

    <!-- intro section explaining why the site exists -->
    <section class="about-story">
        <div class="story-text">
            <h2>Why We Built This</h2>

            <!-- quick background on the problem -->
            <p>
                We’re University of Windsor students who were tired of scrolling through
                endless group chats and random marketplace posts just to find a textbook.
                Buying and selling books should be simple, organized, and student-focused.
            </p>

            <!-- what campusshelf is trying to solve -->
            <p>
                CampusShelf was created to make that process easier — a centralized,
                campus-only platform where students can buy, sell, and share academic
                resources without the noise.
            </p>

            <!-- note about restricting access to uwindsor emails -->
            <p>
                Every account requires a <strong>@uwindsor.ca</strong> email to keep the
                platform safe, relevant, and built strictly for the UWindsor community.
            </p>

            <!-- button to team page -->
            <a href="{{ url('/team') }}" class="team-button">
                Meet the Team
            </a>
        </div>

        <!-- small icon highlights to break up the page visually -->
        <div class="story-icons">
            <div class="icon-box">
                <i class="fa-solid fa-book-open"></i>
                <span>Smarter Textbook Exchange</span>
            </div>

            <div class="icon-box">
                <i class="fa-solid fa-users"></i>
                <span>Built by UWindsor Students</span>
            </div>

            <div class="icon-box">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Verified Campus Access</span>
            </div>
        </div>
    </section>

    <!-- features section showing what users can actually do -->
    <section class="features">
        <h2>What You Can Do</h2>

        <div class="feature-grid">
            <div class="feature-card">
                <i class="fa-solid fa-magnifying-glass"></i>
                <h3>Browse Listings</h3>
                <p>Search by course code or keyword and quickly find the materials you need.</p>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-plus"></i>
                <h3>Create Listings</h3>
                <p>Post textbooks with photos, condition, and pricing in just a few clicks.</p>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-handshake"></i>
                <h3>Request Study Help</h3>
                <p>Submit requests for study notes or materials and connect with classmates.</p>
            </div>
        </div>
    </section>

</div>
@endsection
