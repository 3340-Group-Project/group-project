@extends('wiki.layout')

@section('title', 'Wiki — Account Help')

@section('page')
<section class="wiki-header">
    <h1>👤 Account Help</h1>
    <p>Manage your account, profile, and settings on CampusShelf.</p>
</section>

<section class="wiki-content-section">
    <h2>Profile & settings</h2>
    <div class="wiki-card">
        <h3>Updating your profile</h3>
        <p>Go to your account page and update your display name, profile photo, and contact details. A complete profile increases trust and responses to your listings.</p>
    </div>

    <h2>Password & security</h2>
    <div class="wiki-card">
        <h3>Change password</h3>
        <p>To change your password, use the account settings page. Choose a strong, unique password and do not reuse it across other sites.</p>
        <h3>Forgot password</h3>
        <p>Use the "Forgot password" link on the login page to request a password reset email. Follow the link in the email to set a new password.</p>
    </div>

    <h2>Notifications</h2>
    <div class="wiki-card">
        <h3>Email notifications</h3>
        <p>Select which notifications you want to receive (e.g., messages, listing activity) from your account settings. If you stop receiving emails, check spam folders and verify your email address.</p>
    </div>

    <h2>Deleting or deactivating your account</h2>
    <div class="wiki-card">
        <h3>Temporary deactivation</h3>
        <p>If you want a break, disable notifications or temporarily stop using the account. Contact support if you need help deactivating.</p>
        <h3>Permanently delete</h3>
        <p>To permanently delete your account, contact support or use the delete account option in settings if available. Deleting will typically remove your profile and listings from public view.</p>
    </div>

    <h2>Privacy and data</h2>
    <div class="wiki-card">
        <h3>What data is stored</h3>
        <p>CampusShelf stores basic profile info, listings, and messages to support the service. Sensitive payment information is not stored on this platform by default—use safe, external payment methods.</p>
    </div>
</section>
@endsection

