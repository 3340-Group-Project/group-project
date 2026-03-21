<?php

// NOTE: Controller methods usually validate input, query models, then return a view/redirect.


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\SiteSettings;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // NOTE: index() handles this route/action.
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

    // NOTE: toggleDisabled() handles this route/action.
    public function toggleDisabled(User $user)
    {
                // Toggle uses DB columns if present, otherwise file-based list.
try {
            if (isset($user->is_admin) && (bool)$user->is_admin) {
                return back()->withErrors(['user' => 'Cannot disable an admin account.']);
            }

            if (isset($user->is_disabled)) {
                $user->is_disabled = !(bool)$user->is_disabled;
                $user->save();
                return back()->with('status', 'User updated.');
            }
        } catch (\Throwable $e) {
            // fall back
        }

        SiteSettings::toggleDisabledEmail((string)$user->email);
        return back()->with('status', 'User updated (file-based list).');
    }

    // NOTE: toggleAdmin() handles this route/action.
    public function toggleAdmin(User $user)
    {
        try {
            if (isset($user->is_admin)) {
                $user->is_admin = !(bool)$user->is_admin;
                $user->save();
                return back()->with('status', 'User updated.');
            }
        } catch (\Throwable $e) {
            // fall back
        }

        SiteSettings::toggleAdminEmail((string)$user->email);
        return back()->with('status', 'User updated (file-based list).');
    }
}