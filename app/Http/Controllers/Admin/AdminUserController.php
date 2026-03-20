<?php
// NOTE: File-level comments describe purpose only (no logic change).

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\SiteSettings;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // index(): controller/middleware handler.
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
    // toggleDisabled(): controller/middleware handler.
    public function toggleDisabled(User $user)
    {
        // If DB columns exist, we toggle is_disabled in DB.
        // If not, we fall back to file-based list (storage/app/site-settings.json).

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
    // toggleAdmin(): controller/middleware handler.
    public function toggleAdmin(User $user)
    {
        // Same idea as toggleDisabled, but for admin permissions.

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