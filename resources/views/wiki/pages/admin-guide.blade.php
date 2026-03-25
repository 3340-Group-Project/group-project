@extends('wiki.layout')

@section('title', 'Wiki — Admin Guide')

@section('page')
<section class="wiki-header">
    <h1>⚙️ Admin Guide</h1>
    <p>Information for site administrators on moderation and user management.</p>
</section>

<section class="wiki-content-section">
    <div class="wiki-card">
        <h3>Moderating Listings</h3>
        <p>Use the admin dashboard to review flagged listings, remove inappropriate content, and mark items sold.</p>
    </div>

    <div class="wiki-card">
        <h3>User Management</h3>
        <p>Admins can toggle suspended or admin status on user accounts from the admin users page.</p>
    </div>
</section>
@endsection

