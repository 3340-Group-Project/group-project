<?php

// NOTE: Controller methods usually validate input, query models, then return a view/redirect.


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // NOTE: showLogin() handles this route/action.
    public function showLogin()
    {
        return view('auth.login');
    }

    // NOTE: login() handles this route/action.
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        // disabled check is handled by middleware on authenticated routes
        return redirect()->intended(route('home'));
    }

    // NOTE: showRegister() handles this route/action.
    public function showRegister()
    {
        return view('auth.register');
    }

    // NOTE: register() handles this route/action.
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
                // UWindsor email restriction:
                'regex:/@uwindsor\.ca$/i',
            ],
            'phone' => ['nullable', 'string', 'max:25', Rule::unique('users', 'phone')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.regex' => 'You must register using an @uwindsor.ca email address.',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'phone' => filled($data['phone'] ?? null) ? trim($data['phone']) : null,
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    // NOTE: logout() handles this route/action.
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}