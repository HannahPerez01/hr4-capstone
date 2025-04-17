@extends('layouts/layoutMaster')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('page-script')
    @vite(['resources/assets/js/pages-auth.js'])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="justify-content-center">
                            <img src="{{ asset('assets/img/icons.jpg') }}" class="w-25"
                                style="display: block; margin-left: auto; margin-right: auto;">
                        </div>
                        <p class="app-brand-text demo text-body fw-bold ms-1" style="text-align:center;">LOGIN</p>

                        @if ($errors->any() && !session('lockout_time'))
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <span id="login-error">{{ $error }}</span>
                                @endforeach
                            </div>
                        @elseif (session('lockout_time'))
                            <div class="alert alert-danger">
                                <span>Too many login attempts. Please try again in <span
                                        id="countdown">{{ session('lockout_time') }}</span> seconds.</span>
                            </div>
                        @endif

                        <!-- /Logo -->
                        <form action="{{ url('/') }}" id="formAuthentication" class="mb-3" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email or username"
                                    @if (session('lockout_time')) disabled @endif autofocus>

                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="{{ url('auth/forgot-password') }}">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Enter you password" @if (session('cooldown')) disabled @endif
                                        aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me">
                                    <label class="form-check-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let countdownElement = document.getElementById("countdown");
            if (!countdownElement) return;

            let seconds = parseInt(countdownElement.innerText);

            function updateCountdown() {
                if (seconds <= 0) {
                    location.reload();
                    return;
                }
                countdownElement.innerText = seconds;
                seconds--;
                setTimeout(updateCountdown, 1000);
            }

            updateCountdown();
        });
    </script>
@endsection
