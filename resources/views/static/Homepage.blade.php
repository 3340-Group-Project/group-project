{-- JIN-NOTES: Blade view (UI template). Comments only, no logic change.
     - This file renders part of the UI and connects to routes/controllers.
     - Search '@section' and form actions to see what backend endpoint it hits. --}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusShelf</title>
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<body>

<!-- NAVBAR -->
@include('navbar')

<!-- HERO -->
<section class="hero">
    <div class="shape-mid"></div>
    <div class="shape-bottom"></div>
    <div class="yellow-circle"></div>

    <div class="hero-content">
        <h1 class="hero-title">A better way to get<br>your textbooks</h1>

        <!-- Only visible on mobile, sits directly under the title -->
        <div class="yellow-circle-mobile"></div>

        <p class="hero-subtitle">
            Purchase textbooks from other students who have<br>
            already taken your classes at your home university!
        </p>

        <div class="hero-buttons">
            <a href="#" class="btn btn-solid">Get Started</a>
            <a href="{{ route('about') }}" class="btn btn-solid">About us</a>
        </div>

        <div class="hero-features">
            <div class="feature">
                <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    <line x1="8" y1="20" x2="16" y2="20"/>
                </svg>
                <span>Built by students,<br>for students</span>
            </div>
            <div class="feature">
                <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                    <circle cx="12" cy="9" r="2.5"/>
                </svg>
                <span>Meet with others on campus<br>to trade textbooks!</span>
            </div>
        </div>
    </div>

    <!-- CARDS — inside hero but outside hero-content so they span full width -->
    <div class="cards-section">
        <div class="card"></div>
        <div class="card"></div>
        <div class="card"></div>
    </div>

</section>

</body>
</html>
