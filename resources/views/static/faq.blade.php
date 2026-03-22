@extends('layouts.app')

@section('title', 'FAQ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/faq.css') }}">
@endsection

@section('content')
<div class="faq-container">

    <!-- page header -->
    <section class="faq-header">
        <h1>Frequently Asked Questions</h1>
        <p>Common questions about CampusShelf! We are here to help!</p>
    </section>

    <!-- list of faq items -->
    <section class="faq-list">

        <!-- who can use -->
        <div class="faq-card">
            <h3>Who can use CampusShelf?</h3>
            <p>CampusShelf is intended for University of Windsor students. You must sign in with a valid account to list and request items.</p>
        </div>

        <!-- listing books -->
        <div class="faq-card">
            <h3>How do I list a book for sale?</h3>
            <p>After signing in, go to <strong>My Listings</strong> and create a new listing with the book details and price.</p>
        </div>

        <!-- support/contact -->
        <div class="faq-card">
            <h3>How do I contact support?</h3>
            <p>Use the Contact page to send us a message. We aim to respond within 24–48 hours.</p>
        </div>

        <!-- safety info -->
        <div class="faq-card">
            <h3>How is user safety handled?</h3>
            <p>We recommend meeting in public spaces and following university guidelines. Report any concerns to support@campusshelf.ca.</p>
        </div>

    </section>
</div>
@endsection
