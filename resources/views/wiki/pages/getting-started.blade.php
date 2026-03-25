@extends('wiki.layout')

@section('title', 'Wiki — Getting Started')

@section('page')
<section class="wiki-header">
    <h1>✨ Getting Started</h1>
    <p>Everything you need to begin using CampusShelf: creating an account, signing in, and basic navigation.</p>
</section>

<section class="wiki-content-section">
    <h2>Create an account</h2>
    <div class="wiki-card">
        <h3>Step-by-step</h3>
        <ol>
            <li>Open the <a href="{{ route('register') }}">Sign Up</a> page.</li>
            <li>Use your university email address and choose a secure password.</li>
        </ol>
        <h3>Tips</h3>
        <ul>
            <li>Use a real display name so other students can trust your listings.</li>
            <li>Make sure to choose a strong password!.</li>
        </ul>
    </div>

    <h2>Sign in & password help</h2>
    <div class="wiki-card">
        <h3>Sign in</h3>
        <p>Visit the <a href="{{ route('login') }}">Sign In</a> page and enter your credentials.</p>
    </div>

    <h2>Navigation basics</h2>
    <div class="wiki-card">
        <h3>Main menu</h3>
        <p>The navbar includes links to: Home, About, Team, Wiki, Book Listings and Contact. The "Get Started" button on the homepage links to <a href="{{ route('books.index') }}">Book Listings</a>.</p>
        <h3>Your account menu</h3>
        <p>After signing in you'll see links to "My Listings" and "Requests". Use these to manage your own posts and view messages or service requests.</p>
    </div>

    <h2>Troubleshooting</h2>
    <div class="wiki-card">
        <h3>Can't register or login?</h3>
        <p>Check your email address spelling, disable any browser extensions that might block cookies, and ensure your database/seeds are up to date in development. Contact support at <a href="mailto:support@campusshelf.ca">support@campusshelf.ca</a> if problems persist.</p>
    </div>
</section>
@endsection
