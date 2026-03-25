@extends('layouts.app')

@section('title', 'CampusShelf Wiki')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/wiki.css') }}">
@endsection

@section('content')
<div class="wiki-layout">
    <aside class="wiki-sidebar">
        <div class="wiki-sidebar-section">
            <h3>Information</h3>
            <ul>
                <li><button class="wiki-nav-link active" data-page="overview">📘 Overview</button></li>
                <li><button class="wiki-nav-link" data-page="getting-started">✨ Getting Started</button></li>
                <li><button class="wiki-nav-link" data-page="posting-listings">📦 Posting Listings</button></li>
                <li><button class="wiki-nav-link" data-page="safety-tips">🛡️ Safety Tips</button></li>
                <li><button class="wiki-nav-link" data-page="admin-guide">⚙️ Admin Guide</button></li>
            </ul>
        </div>

        <div class="wiki-sidebar-section">
            <h3>Basics</h3>
            <ul>
                <li><button class="wiki-nav-link" data-page="browse-listings">🔍 Browse Listings</button></li>
                <li><button class="wiki-nav-link" data-page="contacting-sellers">💬 Contacting Sellers</button></li>
                <li><button class="wiki-nav-link" data-page="account-help">👤 Account Help</button></li>
                <!-- Video Guides navigation entry -> opens the dedicated Video Guides section on this page -->
                <li><button class="wiki-nav-link" data-page="video-guides">🎬 Video Guides</button></li>
            </ul>
        </div>
    </aside>

    <main class="wiki-main">
        <section class="wiki-page active" id="overview">
            <div class="wiki-header">
                <h1>📚 CampusShelf Wiki</h1>
                <p>Welcome to the CampusShelf Wiki! Here you’ll find helpful guides on how to use the platform, browse listings, post items, and stay safe while buying and selling.</p>
            </div>

            <section class="wiki-content-section">
                <h2>Overview</h2>
                <div class="wiki-card">
                    <h3>What is CampusShelf?</h3>
                    <p>CampusShelf is a platform for students to browse, post, and manage listings for textbooks, notes, and other campus-related items.</p>
                </div>
                <div class="wiki-card">
                    <h3>Who is it for?</h3>
                    <p>CampusShelf is designed for students who want an easier and safer way to buy and sell within their campus community.</p>
                </div>
            </section>

            {{-- Add Video Guides here so they are visible on the index/overview by default --}}
            @include('wiki.partials.video-guides')

        </section>

        <section class="wiki-page" id="getting-started">
            <div class="wiki-header">
                <h1>✨ Getting Started</h1>
                <p>Everything you need to begin using CampusShelf.</p>
            </div>

            <section class="wiki-content-section">
                <div class="wiki-card">
                    <h3>Create an Account</h3>
                    <p>Sign up using your student email and complete your profile to get started.</p>
                </div>
                <div class="wiki-card">
                    <h3>Log In</h3>
                    <p>Once registered, log in to access listings, messaging, and posting features.</p>
                </div>
            </section>
        </section>

        <section class="wiki-page" id="posting-listings">
            <div class="wiki-header">
                <h1>📦 Posting Listings</h1>
                <p>Learn how to make clear and effective listings.</p>
            </div>

            <section class="wiki-content-section">
                <div class="wiki-card">
                    <h3>Create a Listing</h3>
                    <p>Add a title, price, category, and description so students know what you are offering.</p>
                </div>
                <div class="wiki-card">
                    <h3>Add Good Photos</h3>
                    <p>Use clear, bright images that show the condition of your item.</p>
                </div>
            </section>
        </section>

        <section class="wiki-page" id="safety-tips">
            <div class="wiki-header">
                <h1>🛡️ Safety Tips</h1>
                <p>Best practices for safe buying and selling.</p>
            </div>

            <section class="wiki-content-section">
                <div class="wiki-card">
                    <h3>Meet in Public</h3>
                    <p>Choose safe, public places on or near campus when meeting buyers or sellers.</p>
                </div>
                <div class="wiki-card">
                    <h3>Inspect Before Paying</h3>
                    <p>Always verify the item matches the listing before completing payment.</p>
                </div>
            </section>
        </section>

        <section class="wiki-page" id="admin-guide">
            <div class="wiki-header">
                <h1>⚙️ Admin Guide</h1>
                <p>Admin-specific tools and moderation information.</p>
            </div>

            <section class="wiki-content-section">
                <div class="wiki-card">
                    <h3>Moderating Listings</h3>
                    <p>Admins can review flagged listings, remove inappropriate posts, and manage users.</p>
                </div>
            </section>
        </section>

        <section class="wiki-page" id="browse-listings">
            <div class="wiki-header">
                <h1>🔍 Browse Listings</h1>
                <p>How to search and filter available items.</p>
            </div>

            <section class="wiki-content-section">
                <div class="wiki-card">
                    <h3>Use Filters</h3>
                    <p>Browse by category, price, or keyword to quickly find what you need.</p>
                </div>
            </section>
        </section>

        <section class="wiki-page" id="contacting-sellers">
            <div class="wiki-header">
                <h1>💬 Contacting Sellers</h1>
                <p>How to message and communicate effectively.</p>
            </div>

            <section class="wiki-content-section">
                <div class="wiki-card">
                    <h3>Send a Message</h3>
                    <p>Use the platform messaging system to ask questions and arrange pickup details.</p>
                </div>
            </section>
        </section>

        <section class="wiki-page" id="account-help">
            <div class="wiki-header">
                <h1>👤 Account Help</h1>
                <p>Manage your profile and account settings.</p>
            </div>

            <section class="wiki-content-section">
                <div class="wiki-card">
                    <h3>Profile Settings</h3>
                    <p>Update your personal details, password, and preferences from your account page.</p>
                </div>
            </section>
        </section>

        <!-- Dedicated Video Guides page (includes the video partial) -->
        <section class="wiki-page" id="video-guides">
            @include('wiki.partials.video-guides')
        </section>

    </main>

    <aside class="wiki-toc">
        <h3>On this page</h3>
        <ul id="wiki-toc-list">
            <li>Choose a section</li>
        </ul>
    </aside>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.wiki-nav-link');
        const pages = document.querySelectorAll('.wiki-page');
        const tocList = document.getElementById('wiki-toc-list');

        function updateToc(activePage) {
            const headings = activePage.querySelectorAll('h2, h3');
            tocList.innerHTML = '';

            headings.forEach((heading, index) => {
                if (!heading.id) {
                    heading.id = activePage.id + '-heading-' + index;
                }

                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = '#' + heading.id;
                a.textContent = heading.textContent;
                li.appendChild(a);
                tocList.appendChild(li);
            });

            if (!headings.length) {
                tocList.innerHTML = '<li>No sub-sections</li>';
            }
        }

        function showPage(pageId) {
            pages.forEach(page => {
                page.classList.remove('active');
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
            });

            const activePage = document.getElementById(pageId);
            const activeLink = document.querySelector(`.wiki-nav-link[data-page="${pageId}"]`);

            if (activePage) activePage.classList.add('active');
            if (activeLink) activeLink.classList.add('active');
            if (activePage) updateToc(activePage);
        }

        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                const pageId = this.dataset.page;
                showPage(pageId);
            });
        });

        showPage('overview');
    });
</script>
@endsection
