<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginBasic extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function loginpost(Request $request)
    {
        // Validate the login request
        $key          = 'login_attempts_' . $request->ip(); // Unique key based on IP
        $maxAttempts  = 3;                                  // Maximum login attempts
        $decaySeconds = 60;                                 // Lockout time in seconds (1 minute)

        // Check if the user is blocked
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return back()->withErrors([
                'email' => 'Too many login attempts. Please try again in ' . RateLimiter::availableIn($key) . ' seconds.',
            ]);
        }

        // Validate user input
        $data = $request->validate([
            'email'    => 'required',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($data)) {
            // Reset the rate limiter after successful login
            RateLimiter::clear($key);

            $request->session()->regenerate();
            return redirect()->intended(route('dashboard-crm'))->with('success', 'Successfully logged in');
        }

        // Increment failed attempts
        RateLimiter::hit($key, $decaySeconds);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
