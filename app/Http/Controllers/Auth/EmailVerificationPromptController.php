<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {

        if (! setting('email_verification', 'permission')) {
            return redirect()->route('user.dashboard');
        }

        // If user already has verified email, redirect to dashboard
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Redirect to Email OTP verification page
        return redirect()->route('email.otp.verify');
    }
}
