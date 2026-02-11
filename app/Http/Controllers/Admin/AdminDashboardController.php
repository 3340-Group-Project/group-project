<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\ServiceRequest;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'users' => User::count(),
            'activeListings' => Book::where('is_sold', false)->count(),
            'openRequests' => ServiceRequest::where('status', 'open')->count(),
        ]);
    }
}
