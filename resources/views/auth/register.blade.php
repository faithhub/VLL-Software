@extends('layouts.web.app')

@section('content')
    <style>
        .navbar.navbar-two {
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
                <div class="col-lg-6 col-md-12 d-none d-lg-block">
                    <div class="row about-image">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="image">
                                <img src="{{ asset('assets/web/img/login.png') }}" alt="about">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="legal-article">
                        <div class="section-title mb-4">
                            <h3 class="single-box-h2">Let’s Get Started</h3>
                            <h6>Sign up as User or Vendor</h6>
                        </div>
                        <!-- Tabs content -->
                        <div class="d-flex mb-4">
                            <div class="col-6 text-center outerdiv-active" id="user-form-tab" onclick="switchForm('user')">
                                <a class="nav-tab-btn" type="button">User</a>
                            </div>
                            <div class="col-6 text-center outerdiv" id="vendor-form-tab" onclick="switchForm('vendor')">
                                <a class="nav-tab-btn" type="button">Vendor</a>
                            </div>
                        </div>
                        <div id="user-form">
                            <form id="user_signup_form" data-parsley-valide="" method="POST"
                                action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" value="user" name="form_type">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="name" placeholder="Full Name"
                                        aria-describedby="" requiredd=""
                                        data-parsley-required-message="The Full Name is required"
                                        @if (old('form_type') == 'user') value="{{ old('name') }}" @endif>
                                    @if (old('form_type') == 'user')
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="email"
                                        @if (old('form_type') == 'user') value="{{ old('email') }}" @endif
                                        placeholder="Email Address" autocomplete="false" autofocus="false" requiredd=""
                                        data-parsley-required-message="The Email Address is required"
                                        data-parsley-type-message="The Email must be a valid email"
                                        data-parsley-type="emal">
                                    @if (old('form_type') == 'user')
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                    {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" id="password789767868" class="form-control"
                                        placeholder="Enter Password" requiredd=""
                                        data-parsley-required-message="The Password is required"
                                        data-parsley-length="[3, 20]">
                                    <span toggle="#password-field" onclick="viewPassword(this)"
                                        class="fa fa-fw fa-eye field-icon"></span>
                                    @if (old('form_type') == 'user')
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Confirm Password" requiredd=""
                                        data-parsley-required-message="The Confirm Password is required"
                                        data-parsley-equalto="#password" id="password_confirmation7678568686"
                                        data-parsley-equalto-message="The Confirm Password didn't match">
                                    <span toggle="#password-field" onclick="viewPassword(this)"
                                        class="fa fa-fw fa-eye field-icon"></span>
                                    @if (old('form_type') == 'user')
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-4">What Best Describes you?</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" onclick="checkUniversities(this)"
                                            name="type" id="inlineRadio1" value="student"
                                            @if (old('form_type') == 'user') {{ old('type') == 'student' ? 'checked' : '' }} @endif
                                            data-parsley-required-message="Please select what's best describe you">
                                        <label class="form-check-label" for="inlineRadio1">Student</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type"
                                            @if (old('form_type') == 'user') {{ old('type') == 'professionals' ? 'checked' : '' }} @endif
                                            onclick="checkUniversities(this)" id="inlineRadio2" value="professionals"
                                            requiredd="">
                                        <label class="form-check-label" for="inlineRadio2">Professionals</label>
                                    </div>
                                    @if (old('form_type') == 'user')
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3" id="country_div">
                                    <select class="form-control js-example-basic-single-n" name="country" id="country"
                                        data-parsley-required-message="The Country is required"
                                        data-placeholder="Select your Country">
                                        <option value=""></option>
                                        @isset($countries)
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @if (old('form_type') == 'user') {{ old('country') == $country->id ? 'selected' : '' }} @endif>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="mb-3" id="universities_id">
                                    <select class="form-control js-example-basic-single-uni" name="universities"
                                        id="universities" data-parsley-required-message="The University is required"
                                        data-placeholder="Select your University">
                                        <option value=""></option>
                                        @isset($universities)
                                            @foreach ($universities as $university)
                                                <option data-value="{{ $university->country_id }}"
                                                    value="{{ $university->id }}"
                                                    @if (old('form_type') == 'user') {{ old('university') == $university->id ? 'selected' : '' }} @endif>
                                                    {{ $university->name }}
                                                </option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @if (old('form_type') == 'user')
                                        @error('universities')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="sign-up-form-btn mb-2" type="submit">Sign up</button>
                                    {{-- <a href="{{ route('google.login') }}" class="sign-up-google-form-btn">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/web/img/fa-google.png') }}"> Sign up with
                                            Google
                                        </div>
                                    </a> --}}
                                </div>
                                <div class="mb-3 mt-2">
                                    <p class="text-center">Already have an account? <a
                                            href="{{ route('login') }}">Login</a></p>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input">
                                    <label class="form-check-label user-form-text" for="">
                                        I have read and I agree with the <a class="user-form-a"
                                            href="{{ route('privacy') }}">Terms and
                                            Conditions and Privacy
                                            Policy</a> of Virtual Law
                                        Library
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div id="vendor-form" style="display: none">
                            <form id="vendor_signup_form" data-parsley-validate="" method="POST"
                                action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" value="vendor" name="form_type">
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" onclick="checkVendorType(this)"
                                            name="type" id="inlineRadio001" value="entity" checked
                                            @if (old('form_type') == 'vendor' && old('type') == 'entity') checked @endif
                                            data-parsley-required-message="Please select what's best describe you">
                                        <label class="form-check-label" for="inlineRadio001">Individual</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type"
                                            onclick="checkVendorType(this)" id="inlineRadio002" value="company"
                                            @if (old('form_type') == 'vendor' && old('type') == 'company') checked @endif requiredd="">
                                        <label class="form-check-label" for="inlineRadio002">Company</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type"
                                            onclick="checkVendorType(this)" id="inlineRadio003" value="institution"
                                            @if (old('form_type') == 'vendor' && old('type') == 'institution') checked @endif requiredd="">
                                        <label class="form-check-label" for="inlineRadio003">Institution</label>
                                    </div>
                                    @if (old('form_type') == 'vendor')
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div id="v-in-name" style="display: none">
                                    <div class="mb-3" id="v-country_div">
                                        <select class="form-control js-example-basic-single-v-n" name="v-country"
                                            id="v-country" data-parsley-required-message="The Country is required"
                                            data-placeholder="Select your Country" style="width: 100%">
                                            <option value=""></option>
                                            @isset($countries)
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        @if (old('form_type') == 'user') {{ old('v-country') == $country->id ? 'selected' : '' }} @endif>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div class="mb-3" id="v-universities_id">
                                        <select class="form-control js-example-basic-single-v-uni" name="v-universities"
                                            id="v-universities" data-parsley-required-message="The University is required"
                                            data-placeholder="Select your University" style="width: 100%">
                                            <option value=""></option>
                                            @isset($universities)
                                                @foreach ($universities as $university)
                                                    <option data-value="{{ $university->country_id }}"
                                                        value="{{ $university->id }}"
                                                        @if (old('form_type') == 'user') {{ old('v-university') == $university->id ? 'selected' : '' }} @endif>
                                                        {{ $university->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        @if (old('form_type') == 'user')
                                            @error('v-universities')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3" id="v-name">
                                    <input type="text" class="form-control" name="name" id="vendor_name"
                                        placeholder="Full Name" aria-describedby="" requiredd=""
                                        @if (old('form_type') == 'vendor') value="{{ old('name') }}" @endif
                                        data-parsley-required-message="The Full Name is required">
                                    @if (old('form_type') == 'vendor')
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <input type="emaill" class="form-control" name="email"
                                        placeholder="Email Address"
                                        @if (old('form_type') == 'vendor') value="{{ old('email') }}" @endif
                                        requiredd="" data-parsley-required-message="The Email Address is required"
                                        data-parsley-type-message="The Email must be a valid email"
                                        data-parsley-type="emaill">
                                    @if (old('form_type') == 'vendor')
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" id="password67868686868" class="form-control"
                                        placeholder="Enter Password" requiredd=""
                                        data-parsley-required-message="The Password is required"
                                        data-parsley-length="[3, 20]">
                                    <span toggle="#password-field" onclick="viewPassword(this)"
                                        class="fa fa-fw fa-eye field-icon"></span>
                                    @if (old('form_type') == 'vendor')
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Confirm Password" requiredd=""
                                        data-parsley-required-message="The Confirm Password is required"
                                        data-parsley-equalto="#password" id="password_confirmation68768969u989"
                                        data-parsley-equalto-message="The Confirm Password didn't match">
                                    <span toggle="#password-field" onclick="viewPassword(this)"
                                        class="fa fa-fw fa-eye field-icon"></span>
                                    @if (old('form_type') == 'vendor')
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="sign-up-form-btn mb-2" type="submit">Sign up</button>
                                    {{-- <a href="{{ route('google.login') }}" class="sign-up-google-form-btn">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/web/img/fa-google.png') }}"> Sign up with
                                            Google
                                        </div>
                                    </a> --}}
                                </div>
                                <div class="mb-3 mt-2">
                                    <p class="text-center">Already have an account? <a href="">Login</a></p>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input">
                                    <label class="form-check-label user-form-text" for="">
                                        I have read and I agree with the <a class="user-form-a"
                                            href="{{ route('privacy') }}">Terms and
                                            Conditions and Privacy
                                            Policy</a> of Virtual Law
                                        Library
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Us Area -->
    <div class="container">
        {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
