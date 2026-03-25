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
                <li><a class="wiki-nav-link {{ request()->routeIs('wiki.index') ? 'active' : '' }}" href="{{ route('wiki.index') }}">📘 Overview</a></li>
                <li><a class="wiki-nav-link {{ request()->routeIs('wiki.getting-started') ? 'active' : '' }}" href="{{ route('wiki.getting-started') }}">✨ Getting Started</a></li>
                <li><a class="wiki-nav-link {{ request()->routeIs('wiki.posting-listings') ? 'active' : '' }}" href="{{ route('wiki.posting-listings') }}">📦 Posting Listings</a></li>
                <li><a class="wiki-nav-link {{ request()->routeIs('wiki.safety-tips') ? 'active' : '' }}" href="{{ route('wiki.safety-tips') }}">🛡️ Safety Tips</a></li>
                <li><a class="wiki-nav-link {{ request()->routeIs('wiki.admin-guide') ? 'active' : '' }}" href="{{ route('wiki.admin-guide') }}">⚙️ Admin Guide</a></li>
            </ul>
        </div>

        <div class="wiki-sidebar-section">
            <h3>Basics</h3>
            <ul>
                <li><a class="wiki-nav-link {{ request()->is('wiki/browse-listings') ? 'active' : '' }}" href="{{ url('/wiki/browse-listings') }}">🔍 Browse Listings</a></li>
                <li><a class="wiki-nav-link {{ request()->is('wiki/contacting-sellers') ? 'active' : '' }}" href="{{ url('/wiki/contacting-sellers') }}">💬 Contacting Sellers</a></li>
                <li><a class="wiki-nav-link {{ request()->is('wiki/account-help') ? 'active' : '' }}" href="{{ url('/wiki/account-help') }}">👤 Account Help</a></li>
            </ul>
        </div>
    </aside>

    <main class="wiki-main">
        @yield('page')

        {{-- Video guides were previously included here (caused videos to show on every wiki page). Removed so they appear only on the dedicated Video Guides section. --}}
    </main>

    <aside class="wiki-toc">
        <h3>On this page</h3>
        <ul id="wiki-toc-list">
            <!-- TOC will be populated by JS based on headings in the current article -->
        </ul>
    </aside>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tocList = document.getElementById('wiki-toc-list');
    if (!tocList) return;

    // Find headings (h2/h3) inside the main page content area
    const content = document.querySelector('.wiki-main');
    if (!content) {
        tocList.innerHTML = '<li>No content</li>';
        return;
    }

    const headings = content.querySelectorAll('h2, h3');
    if (!headings.length) {
        tocList.innerHTML = '<li>No sub-sections</li>';
        return;
    }

    tocList.innerHTML = '';

    headings.forEach((heading) => {
        // Ensure heading has an ID so we can link to it
        if (!heading.id) {
            const base = heading.textContent.trim().toLowerCase().replace(/[^a-z0-9\s-]/g, '');
            heading.id = base.replace(/\s+/g, '-');
        }

        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = '#' + heading.id;
        a.textContent = heading.textContent.trim();
        li.appendChild(a);
        tocList.appendChild(li);
    });

    // Optionally scroll to hash on load
    if (location.hash) {
        const target = document.querySelector(location.hash);
        if (target) target.scrollIntoView();
    }
});
</script>

@endsection
