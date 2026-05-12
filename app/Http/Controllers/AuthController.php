<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    // -------------------------------------------------------------------------
    // Show Login Page
    // -------------------------------------------------------------------------
    public function showLogin()
    {
        return view('auth.login');
    }

    // -------------------------------------------------------------------------
    // Handle Login
    // Rate-limited to 5 attempts per minute per email+IP combination.
    // Regenerates session on success to prevent session fixation.
    // Supports "remember me" persistent cookie (90 days).
    // -------------------------------------------------------------------------
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Build a unique throttle key per email + IP
        $throttleKey = $this->throttleKey($request);

        // Check if the user has been locked out
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ])->withInput($request->only('email'));
        }

        $remember = $request->boolean('remember');

        if (Auth::attempt(
            ['email' => $request->email, 'password' => $request->password],
            $remember
        )) {
            // Clear failed attempt counter on success
            RateLimiter::clear($throttleKey);

            // Regenerate session ID to prevent session fixation attacks
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        // Increment failed attempt counter
        RateLimiter::hit($throttleKey, 60); // decay 60 seconds

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput($request->only('email'));
    }

    // -------------------------------------------------------------------------
    // Show Register Page
    // -------------------------------------------------------------------------
    public function showRegister()
    {
        return view('auth.register');
    }

    // -------------------------------------------------------------------------
    // Handle Register
    // -------------------------------------------------------------------------
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:2|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:buyer,seller',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        Auth::login($user);

        // Regenerate session after registration
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Account created successfully!');
    }

    // -------------------------------------------------------------------------
    // Logout
    // Invalidates the session and regenerates the CSRF token.
    // -------------------------------------------------------------------------
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session data and regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Build a unique throttle key combining the lowercased email and the
     * client's IP address so different IPs don't share the same counter.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }
}