<?php
namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

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
            $seconds = RateLimiter::availableIn($key);

            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in $seconds seconds.",
            ])->with('cooldown', $seconds);
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

    public function forgotPassword()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-forgot-password-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validate user input
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function displayResetPassword($token)
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-reset-password-basic', ['pageConfigs' => $pageConfigs, 'token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth-login-basic')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
