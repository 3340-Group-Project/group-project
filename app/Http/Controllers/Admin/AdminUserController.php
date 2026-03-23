<?php

// NOTE: Controller methods usually validate input, query models, then return a view/redirect.

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // NOTE: index() loads the admin users page and keeps the search term in pagination.
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $users = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(20)
            ->withQueryString(); // NOTE: keeps current filters in pagination links.

        return view('admin.users.index', compact('users'));
    }

    // NOTE: toggleDisabled() flips the DB flag so the UI and middleware use the same source of truth.
    public function toggleDisabled(User $user)
    {
        // NOTE: do not allow an admin account to be disabled from this action.
        if ($user->isAdmin()) {
            return back()->withErrors(['user' => 'Cannot disable an admin account.']);
        }

        $user->is_disabled = ! $user->isDisabled();
        $user->save();

        return back()->with('status', 'User updated.');
    }

    // NOTE: toggleAdmin() flips the DB admin flag instead of using a file fallback.
    public function toggleAdmin(User $user)
    {
        // NOTE: if a user is currently disabled, keep them disabled but still allow role changes.
        $user->is_admin = ! $user->isAdmin();
        $user->save();

        return back()->with('status', 'User updated.');
    }
}
