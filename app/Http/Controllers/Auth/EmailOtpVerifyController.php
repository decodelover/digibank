<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\NotifyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmailOtpVerifyController extends Controller
{
    use NotifyTrait;

    public function index()
    {
        $user = Auth::user();
        
        // Send OTP if not already sent or expired
        if (!session()->has('email_otp_sent') || session('email_otp_sent')->addMinutes(5)->isPast()) {
            $this->sendOtp($user);
        }
        
        return view('frontend::auth.verify-email-otp');
    }

    public function sendOtp($user)
    {
        $otp = random_int(100000, 999999);
        
        $user->update([
            'otp' => $otp,
        ]);

        // Send OTP via email
        $shortcodes = [
            '[[otp_code]]' => $otp,
            '[[full_name]]' => $user->full_name,
            '[[site_title]]' => setting('site_title', 'global'),
            '[[site_url]]' => route('home'),
        ];
        
        $this->mailNotify($user->email, 'email_otp', $shortcodes);
        
        session(['email_otp_sent' => now()]);
    }

    public function resend()
    {
        $user = Auth::user();
        $this->sendOtp($user);

        return redirect()->back()->with('success', __('OTP has been sent to your email'));
    }

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|array',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back()->with('error', __('OTP must be numeric!'));
        }

        $otp = (int) implode('', $request->otp);
        $user = Auth::user();

        if ($user->otp == $otp) {
            $user->email_verified_at = now();
            $user->otp = null;
            $user->save();
            
            session()->forget('email_otp_sent');
            notify()->success(__('Email verified successfully!'), 'Success');

            return redirect()->route('user.dashboard');
        }

        return redirect()->back()->with('error', __('Invalid OTP. Please try again.'));
    }
}
