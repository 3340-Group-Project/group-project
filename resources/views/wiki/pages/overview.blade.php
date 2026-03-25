@extends('wiki.layout')

@section('title', 'Wiki — Overview')

@section('page')
<section class="wiki-header">
    <h1>📘 Overview</h1>
    <p>Welcome to the CampusShelf Wiki. This site provides short, practical guides for browsing and posting book listings, staying safe during transactions, and administering the platform.</p>
</section>

<section class="wiki-content-section">
    <div class="wiki-card">
        <h3>What is CampusShelf?</h3>
        <p>CampusShelf is a lightweight marketplace focused on connecting students on the same campus so they can buy, sell, and share course materials. The site supports listing creation, browsing with filters, and basic administration tools.</p>
    </div>

    <div class="wiki-card">
        <h3>Quick links</h3>
        <ul>
            <li><a href="{{ route('wiki.getting-started') }}">Getting started</a> — sign up, log in, and basic navigation.</li>
            <li><a href="{{ route('wiki.posting-listings') }}">Posting listings</a> — how to craft a good listing and upload photos.</li>
            <li><a href="{{ route('wiki.browse-listings') }}">Browse listings</a> — searching, filtering and sorting.</li>
            <li><a href="{{ route('wiki.safety-tips') }}">Safety tips</a> — meeting and payment best practices.</li>
            <li><a href="{{ route('wiki.admin-guide') }}">Admin guide</a> — tools available to administrators.</li>
        </ul>
    </div>
</section>

{{-- Include video guides so they appear on the wiki overview page served at /wiki --}}
@include('wiki.partials.video-guides')

@endsection
