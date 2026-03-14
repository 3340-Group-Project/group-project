@extends('layouts.app')

@section('title', 'About')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@section('content')

<div class="hero">
    <div class="shape-mid"></div>
    <div class="shape-bottom"></div>

    <div class="hero-content" id="about-content">
        <h1 class="hero-title">About CampusShelf</h1>

        <p class="hero-subtitle" style="color:#2b333a">
            CampusShelf is a UWindsor student marketplace where students can list and browse used textbooks and study materials.
            Users register with an <strong>@uwindsor.ca</strong> email, then can post listings, search by course code,
            and submit requests for help or study notes.
        </p>

        <h3 style="margin-bottom: 15px;">What you can do:</h3>
        
        <div class="hero-features">
            <div class="feature">
                <span class="feature-icon">📚</span> 
                <span>Browse and search used textbook listings.</span>
            </div>
            <div class="feature">
                <span class="feature-icon">💰</span>
                <span>Create your own listings with photos and pricing.</span>
            </div>
            <div class="feature">
                <span class="feature-icon">📝</span>
                <span>Submit service requests (e.g., study notes) and track responses.</span>
            </div>
        </div>

        <div class="hero-buttons" style="margin-top: 30px;">
            <a href="#" class="btn btn-solid">Get Started</a>
        </div>
    </div>
</div>

@endsection
