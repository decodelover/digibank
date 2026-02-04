@extends('frontend::layouts.auth')
@section('title')
    {{ __('Verify Email') }}
@endsection
@section('content')
    <!-- Email OTP Verify Section -->
    <div class="half-authpage">
        <div class="authOne">
            <div class="auth-contents">
                @php
                    $height = setting('site_logo_height','global') == 'auto' ? 'auto' : setting('site_logo_height','global').'px';
                    $width = setting('site_logo_width','global') == 'auto' ? 'auto' : setting('site_logo_width','global').'px';
                @endphp
                <div class="logo">
                    <a href="{{ route('home')}}"><img src="{{ asset(setting('site_logo','global')) }}" style="height:{{ $height }};width:{{ $width }};max-width:none" alt=""></a>
                    <div class="no-user-header">
                        @if(setting('language_switcher'))
                            <div class="language-switcher">
                                <select class="langu-swit small" name="language" id=""
                                        onchange="window.location.href=this.options[this.selectedIndex].value;">
                                    @foreach(\App\Models\Language::where('status',true)->get() as $lang)
                                        <option
                                            value="{{ route('language-update',['name'=> $lang->locale]) }}" @selected( app()->getLocale() == $lang->locale )>{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="color-switcher">
                            <img class="light-icon" src="{{ asset('front/images/icons/sun.png') }}" alt="">
                            <img class="dark-icon" src="{{ asset('front/images/icons/moon.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="contents">
                    <div class="content">
                        <h3>{{ __('Email Verification') }}</h3>
                        @if(session('error'))
                            <div class="error-message">
                                <p>{{ session('error') }}</p>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="success-message">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif
                        <div class="success-message">
                            <p>{{ __('Enter the 6-digit OTP code sent to') }} <strong>{{ auth()->user()->email }}</strong></p>
                        </div>

                        <form action="{{ route('email.otp.verify.post') }}" method="POST">
                            @csrf
                            <div class="inputs">
                                <div class="input-otp">
                                    <input class="inputotp" name="otp[]" type="number"/>
                                    <input class="inputotp" name="otp[]" type="number" disabled/>
                                    <input class="inputotp" name="otp[]" type="number" disabled/>
                                    <input class="inputotp" name="otp[]" type="number" disabled/>
                                    <input class="inputotp" name="otp[]" type="number" disabled/>
                                    <input class="inputotp" name="otp[]" type="number" disabled/>
                                </div>
                            </div>
                            <div class="inputs">
                                <button type="submit"
                                        class="otpbtn site-btn primary-btn w-100 centered">{{ __('Verify & Proceed') }}</button>
                            </div>
                        </form>
                        <p>{{ __('Didn\'t receive the code?') }} <a href="{{ route('email.otp.resend') }}">{{ __('Resend OTP') }}</a></p>
                        <p>{{ __('Already have an account?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="authOne">
            <div class="auth-banner"
                 style="background: url('{{ asset(getPageSetting('breadcrumb')) }}') no-repeat;"></div>
        </div>
    </div>
    <!-- Email OTP Verify Section End -->
@endsection
@section('script')
    <script>
        'use strict';
        // OTP js code
        const inputs = document.querySelectorAll("input.inputotp"),
            button = document.querySelector("button");

        //focus the first input which index is 0 on window load
        window.addEventListener("load", () => inputs[0].focus());

        // iterate over all inputs
        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                const currentInput = input,
                    nextInput = input.nextElementSibling,
                    prevInput = input.previousElementSibling;

                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }
                if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }
                if (e.key === "Backspace") {
                    inputs.forEach((input, index2) => {
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                }
                if (!inputs[5].disabled && inputs[5].value !== "") {
                    button.classList.add("active");
                    return;
                }
                button.classList.remove("active");
            });
        });

        // Prevent non-numeric input
        inputs.forEach((input) => {
            input.addEventListener("input", (e) => {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endsection
