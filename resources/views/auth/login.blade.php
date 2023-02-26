@extends('layouts.web.app')

@section('content')
<style>
    .navbar.navbar-two{
        background: #fff !important;

    }
.bg-f9faff {
    background: #fff !important;
}
    </style>
    <!-- Start Why Choose Us Area -->
    <section id="about" class="why-choose-us bg-f9faff">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="row about-image">
                        <div class="col-12 col-lg-12 col-md-12 d-none d-md-block">
                            <div class="image">
                                <img src="{{ asset('assets/web/img/bg-book003.jpg') }}" alt="about" style="max-height: 90vh">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 ptb-100">
                    <div class="legal-article">
                        <div class="section-title mb-4">
                            <h3 class="single-box-h2">Welcome Back</h3>
                            <h6>Kindly fill in your details</h6>
                        </div>

                        {{-- <form id="login_form" data-parsley-validate="" method="POST" action="{{ route('login') }}"> --}}
                        <form id="login_form" data-parsley-validate="" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Email Address" autocomplete="false" autofocus="false"
                                    value="" required=""
                                    data-parsley-required-message="The Email Address is required"
                                    data-parsley-type-message="The Email must be a valid email" data-parsley-type="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password757857857857"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter Password" required=""
                                    data-parsley-required-message="The Password is required">
                                <span toggle="#password-field" onclick="viewPassword(this)"
                                    class="fa fa-fw fa-eye field-icon"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 mt-1">
                                <p class="text-left">
                                    <a href="{{ route('password.request') }}"
                                        class="forget-password">{{ __('Forgot Your Password?') }}</a>
                                </p>
                            </div>
                            <div class="mb-3">
                            </div>
                            <div class="d-grid gap-2">
                                <button class="sign-up-form-btn mb-2" type="submit">Login</button>
                                {{-- <button class="sign-up-google-form-btn" type="button">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/web/img/fa-google.png') }}"> Login up with
                                        Google
                                    </div>
                                </button> --}}
                            </div>
                            <div class="mt-2">
                                <p class="text-center">I do not have an account? <a href="{{ route('register') }}">Sign
                                        Up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Us Area -->
@endsection
