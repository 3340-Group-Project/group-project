<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::query()->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function toggleDisabled(User $user)
    {
        if ($user->is_admin) {
            return back()->withErrors(['user' => 'Cannot disable an admin account.']);
        }

        $user->is_disabled = !$user->is_disabled;
        $user->save();

        return back()->with('status', 'User updated.');
    }

    public function toggleAdmin(User $user)
    {
        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('status', 'User updated.');
    }
}
