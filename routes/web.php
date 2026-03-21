<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Admin\AdminSettingsController;

// Simple static page route for the About page.
Route::view('/about', 'static.about')->name('about');

// Home page route that directly returns the homepage view.
Route::view('/', 'static.Homepage')->name('home');

// Static contact page shown before the form is submitted.
Route::view('/contact', 'static.contactus')->name('contact');

// Static Meet the Team page route.
Route::view('/meet-team', 'static.meetteam')->name('meet-team');

// Handle contact form submission.
Route::post('/contact', function (Request $request) {
    // Validate the incoming contact form fields before using them.
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // Send the user back to the contact page with a success message.
    return redirect()->route('contact')->with('status', 'Thanks, your message was sent.');
})->name('contact.submit');

// Guest-only routes so logged-in users cannot access login/signup pages again.
Route::middleware('guest')->group(function () {
    // Show login form and submit login request.
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Show signup form and submit registration request.
    Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/signup', [AuthController::class, 'register'])->name('register.post');
});

// Logout requires the user to already be authenticated.
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Public book pages anyone can browse.
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Authenticated user area.
// 'not_disabled' adds an extra check so disabled accounts are blocked here.
Route::middleware(['auth', 'not_disabled'])->group(function () {
    // Routes for managing the current user's own book listings.
    Route::get('/my/listings', [BookController::class, 'myListings'])->name('books.my');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

    // Same show page, but this copy forces the {book} value to be numeric.
    Route::get('/books/{book}', [BookController::class, 'show'])->whereNumber('book')->name('books.show'); /** added book route */

    // Create, edit, update, mark sold, and delete book listings.
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::post('/books/{book}/sold', [BookController::class, 'markSold'])->name('books.sold'); /* admin as well? */
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy'); /* todo: figure out what this does */

    // Service request pages for things like study notes/help requests.
    Route::get('/requests', [ServiceRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [ServiceRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [ServiceRequestController::class, 'store'])->name('requests.store');
});

// Admin-only area.
// Prefix means every route here starts with /admin.
Route::prefix('admin')->middleware(['auth', 'not_disabled', 'admin'])->group(function () {
    // Main dashboard page for admins.
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Admin routes for viewing users and changing their account state.
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{user}/toggle-disabled', [AdminUserController::class, 'toggleDisabled'])->name('admin.users.toggleDisabled');
    Route::post('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('admin.users.toggleAdmin');

    // Admin routes for viewing all books and moderating them.
    Route::get('/books', [AdminBookController::class, 'index'])->name('admin.books.index');
    Route::post('/books/{book}/toggle-sold', [AdminBookController::class, 'toggleSold'])->name('admin.books.toggleSold');
    Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');

    // Admin routes for viewing and responding to user service requests.
    Route::get('/requests', [AdminRequestController::class, 'index'])->name('admin.requests.index');
    Route::get('/requests/{requestModel}', [AdminRequestController::class, 'show'])->name('admin.requests.show');
    Route::post('/requests/{requestModel}/respond', [AdminRequestController::class, 'respond'])->name('admin.requests.respond');

    // Admin settings routes for viewing and saving theme settings.
    Route::get('/settings/theme', [AdminSettingsController::class, 'editTheme'])->name('admin.settings.theme');
    Route::post('/settings/theme', [AdminSettingsController::class, 'updateTheme'])->name('admin.settings.theme.update');
});

// Simple status/monitoring page route.
Route::get('/status', [StatusController::class, 'index'])->name('status');
