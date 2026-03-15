<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\SiteSettings;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
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
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function toggleDisabled(User $user)
    {
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
