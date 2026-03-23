@extends('layouts.app')

@section('title', 'Contact Us')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('content')
<div class="about-container">

    <!-- header section -->
    <section class="page-header">
        <h1>Contact CampusShelf</h1>
        <p class="subtitle">
            Have a question, suggestion, or issue? We'd love to hear from you.
        </p>
    </section>

    <!-- main contact layout -->
    <section class="contact-section">

        <!-- left side: basic contact info -->
        <div class="contact-info">
            <h2>Get in Touch</h2>

            <!-- email -->
            <div class="contact-item">
                <i class="fa-solid fa-envelope"></i>
                <span>support@campusshelf.ca</span>
            </div>

            <!-- who the platform is for -->
            <div class="contact-item">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>University of Windsor Students Only</span>
            </div>

            <!-- response time -->
            <div class="contact-item">
                <i class="fa-solid fa-clock"></i>
                <span>Response time: 24–48 hours</span>
            </div>

            <!-- small note about the team -->
            <p class="contact-note">
                CampusShelf is built and maintained by UWindsor students.
                We read every message and appreciate your feedback.
            </p>
        </div>

        <!-- right side: contact form -->
        <div class="contact-form-box">
            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf <!-- csrf protection for form -->

                <!-- name input -->
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" required>
                </div>

                <!-- email input -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <!-- message input -->
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" rows="5" required></textarea>
                </div>

                <!-- submit button -->
                <button type="submit" class="submit-button">
                    Send Message
                </button>
            </form>
        </div>

    </section>

</div>
@endsection
