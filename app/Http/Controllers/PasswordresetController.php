<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{
    // -------------------------------------------------------------------------
    // Step 1 – Show "Forgot Password" form
    // -------------------------------------------------------------------------
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // -------------------------------------------------------------------------
    // Step 2 – Send reset link email
    // Rate-limited to 3 attempts per minute per IP to prevent email flooding.
    // -------------------------------------------------------------------------
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Rate limit: 3 link requests per minute per IP
        $throttleKey = 'password-reset|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Too many requests. Please wait {$seconds} seconds before trying again.",
            ]);
        }

        RateLimiter::hit($throttleKey, 60);

        // Password::sendResetLink handles:
        //   - Checking that the email exists (silently succeeds if not, to prevent email enumeration)
        //   - Generating a signed token stored in password_resets table
        //   - Sending the Notification email with the link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'If that email is registered, a reset link has been sent.');
        }

        // Generic error – avoid leaking whether the email exists
        return back()->with('status', 'If that email is registered, a reset link has been sent.');
    }

    // -------------------------------------------------------------------------
    // Step 3 – Show "Reset Password" form (user arrives via signed email link)
    // -------------------------------------------------------------------------
    public function showResetForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    // -------------------------------------------------------------------------
    // Step 4 – Process the reset
    // Token is validated, one-time-use, and expires per config/auth.php (60 min).
    // -------------------------------------------------------------------------
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Update the password and rotate the remember_token so any
                // "remember me" sessions from the old password are invalidated.
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                // Fire the PasswordReset event (triggers session invalidation
                // on other devices via the DatabaseTokenRepository cleanup).
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect('/login')->with('success', 'Password reset successfully. Please log in.');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}