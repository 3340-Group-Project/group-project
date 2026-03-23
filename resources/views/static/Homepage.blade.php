@extends('layouts.app')

@section('title', 'CampusShelf - Home')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('content')
<div class="homepage-layout">

    <!-- hero section (top of homepage) -->
    <section class="hero">

        <!-- background shapes -->
        <div class="shape-mid"></div>
        <div class="shape-bottom"></div>
        <div class="yellow-circle">
            <img src="{{ asset('images/CampusLogo.png') }}" alt="CampusShelf Logo" class="hero-logo-img">
        </div>

        <div class="hero-content">

            <!-- main headline -->
            <h1 class="hero-title">A better way to get<br>your textbooks</h1>

            <!-- mobile circle (only shows on smaller screens) -->
            <div class="yellow-circle-mobile">
                <img src="{{ asset('images/CampusLogo.png') }}" alt="CampusShelf Logo" class="hero-logo-img">
            </div>

            <!-- short description -->
            <p class="hero-subtitle">
                Purchase textbooks from other students who have<br>
                already taken your classes at your home university!
            </p>

            <!-- main buttons -->
            <div class="hero-buttons">
                <!-- might link this to signup later -->
                <a href="{{ route('books.index') }}" class="btn btn-solid">Get Started</a>

                <!-- about page -->
                <a href="{{ route('about') }}" class="btn btn-solid">About us</a>
            </div>

            <!-- small feature highlights -->
            <div class="hero-features">

                <!-- student-built -->
                <div class="feature">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                        <line x1="8" y1="20" x2="16" y2="20"/>
                    </svg>
                    <span>Built by students,<br>for students</span>
                </div>

                <!-- meetup/trading -->
                <div class="feature">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                        <circle cx="12" cy="9" r="2.5"/>
                    </svg>
                    <span>Meet with others on campus<br>to trade textbooks!</span>
                </div>
            </div>
        </div>

        <!-- feature cards explaining the platform -->
        <div class="cards-section">

            <div class="card">
                <i class="fa-solid fa-book card-icon"></i>
                <h3>Buy Textbooks</h3>
                <p>Browse listings from other UWindsor students and find the books you need for your classes.</p>
            </div>

            <div class="card">
                <i class="fa-solid fa-tag card-icon"></i>
                <h3>Sell Your Books</h3>
                <p>Post your used textbooks in a few clicks and connect with students looking for them.</p>
            </div>

            <div class="card">
                <i class="fa-solid fa-list card-icon"></i>
                <h3>Browse Listings</h3>
                <p>Explore available textbooks and study materials posted by other UWindsor students.</p>
            </div>

        </div>

    </section>
</div>
@endsection
