<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Admin\AdminSettingsController;

Route::view('/about', 'static.about')->name('about');

// Home -> catalogue
Route::view('/', 'static.Homepage')->name('home');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/signup', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Public book pages
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Authenticated area (blocked if disabled)
Route::middleware(['auth', 'not_disabled'])->group(function () {
    Route::get('/my/listings', [BookController::class, 'myListings'])->name('books.my');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::post('/books/{book}/sold', [BookController::class, 'markSold'])->name('books.sold');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // Service requests (study notes / help tickets)
    Route::get('/requests', [ServiceRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [ServiceRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [ServiceRequestController::class, 'store'])->name('requests.store');
});

// Admin area
Route::prefix('admin')->middleware(['auth', 'not_disabled', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{user}/toggle-disabled', [AdminUserController::class, 'toggleDisabled'])->name('admin.users.toggleDisabled');
    Route::post('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('admin.users.toggleAdmin');

    Route::get('/books', [AdminBookController::class, 'index'])->name('admin.books.index');
    Route::post('/books/{book}/toggle-sold', [AdminBookController::class, 'toggleSold'])->name('admin.books.toggleSold');
    Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');

    Route::get('/requests', [AdminRequestController::class, 'index'])->name('admin.requests.index');
    Route::get('/requests/{requestModel}', [AdminRequestController::class, 'show'])->name('admin.requests.show');
    Route::post('/requests/{requestModel}/respond', [AdminRequestController::class, 'respond'])->name('admin.requests.respond');

    Route::get('/settings/theme', [AdminSettingsController::class, 'editTheme'])->name('admin.settings.theme');
    Route::post('/settings/theme', [AdminSettingsController::class, 'updateTheme'])->name('admin.settings.theme.update');
});

// Monitoring page (could restrict to admin if you want)
Route::get('/status', [StatusController::class, 'index'])->name('status');
