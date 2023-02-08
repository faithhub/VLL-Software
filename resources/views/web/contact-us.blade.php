@extends('layouts/web/app')
@section('content')
    <style>
        .btn-primary {
            background-color: #203564 !important;
            color: #fff;
            border: 203564;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #203564 !important;
            color: #fff;
            border: 203564;
        }

        .bg-primary {
            background-color: #203564 !important;
        }

        p {
            font-size: 18px;
            color: #fff;
        }

        body {
            overflow: auto;
            height: 100%;
        }

        html {
            overflow: hidden;
            height: 100%;
        }

        .info-wrap .dbox {
            width: 100%;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 25px;
        }

        .info-wrap .dbox .icon {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .info-wrap .dbox .icon span {
            font-size: 20px;
            color: #fff;
        }

        .info-wrap .dbox .text {
            width: calc(100% - 50px);
        }
    </style>
    <!-- Start Boxes Area -->
    <section class="home ptb-50 privacy" style="min-height: 99vh">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title">
                        <h2 class="single-box-h2" style="margin-bottom: 5px">Contact Us</h2>
                    </div>
                    <div class="who-we-are-text">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-md-12">
                                <div class="wrapper">
                                    <div class="row no-gutters">
                                        <div class="col-md-7 d-flex align-items-stretch">
                                            <div class="contact-wrap w-100 p-md-5 p-4">
                                                <h3 class="mb-4">Get in touch</h3>
                                                <div id="form-message-warning" class="mb-4"></div>
                                                <div id="form-message-success" class="mb-4">
                                                    {{-- Your message was sent, thank you! --}}
                                                </div>
                                                <form method="POST" class="contact-us-for" name="contactForm"
                                                    action="">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" placeholder="Name" value="{{ old('name') }}" requiredd=""
                                                                    data-parsley-required-message="Name is required">
                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="emais" class="form-control" name="email"
                                                                    id="email" placeholder="Email" value="{{ old('email') }}" requiredd=""
                                                                    data-parsley-type-message="Please provide be a valid email address"
                                                                    data-parsley-type="email"
                                                                    data-parsley-required-message="Email is required">
                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="subject"
                                                                    id="subject" placeholder="Subject" value="{{ old('subject') }}" requiredd=""
                                                                    data-parsley-required-message="Subject is required">
                                                                @error('subject')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <textarea name="message" data-parsley-required-message="Message is required" requiredd="" class="form-control"
                                                                    id="message" cols="30" rows="7" placeholder="Message">{{ old('message') }}</textarea>
                                                                @error('message')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="submit" value="Send Message"
                                                                    class="btn btn-primary">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-5 d-flex align-items-stretch">
                                            <div class="info-wrap bg-primary w-100 p-lg-5 p-4">
                                                <h3 class="mb-4 mt-md-4"></h3>
                                                <div class="dbox w-100 d-flex align-items-start">
                                                    <div class="icon d-flex align-items-center justify-content-center">
                                                        <span class="fa fa-map-marker"></span>
                                                    </div>
                                                    <div class="text pl-3">
                                                        <p><span>Address:</span>{{ $settings['address'] ?? '--' }}</p>
                                                    </div>
                                                </div>
                                                <div class="dbox w-100 d-flex align-items-center">
                                                    <div class="icon d-flex align-items-center justify-content-center">
                                                        <span class="fa fa-phone"></span>
                                                    </div>
                                                    <div class="text pl-3">
                                                        <p><span>Phone:</span> <a
                                                                href="tel://{{ $settings['phone'] ?? '--' }}">{{ $settings['phone'] ?? '--' }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="dbox w-100 d-flex align-items-center">
                                                    <div class="icon d-flex align-items-center justify-content-center">
                                                        <span class="fa fa-paper-plane"></span>
                                                    </div>
                                                    <div class="text pl-3">
                                                        <p><span>Email:</span> <a
                                                                href="mailto:{{ $settings['email'] ?? '--' }}">{{ $settings['email'] ?? '--' }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="dbox w-100 d-flex align-items-center">
                                                    <div class="icon d-flex align-items-center justify-content-center">
                                                        <span class="fa fa-globe"></span>
                                                    </div>
                                                    <div class="text pl-3">
                                                        <p><span>Website:</span> <a
                                                                href="{{ URL::to('/') }}">{{ URL::to('/') }}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- FAQ Area-->
                            <div class="col-12 col-sm-12 col-lg-12">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Boxes Area -->

    <!-- Start Fun Facts Area -->
    {{-- <section class="fun-facts-area ptb-100"
        style="background-image: linear-gradient(rgba(57, 81, 133, 0.04) 0.28%, #395185 99.67%), url('{{ asset('assets/web/img/team.png') }}')">
        <div class="team-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="middle-div">
                            <h2 class="team-text-h2">Add Team Members to Use Library with One<br>
                                Subscription.</h2>
                            <a href="#" class="sub-btn">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Fun Facts Area -->

    <script type="text/javascript">
        $(function() {
            $('.contact-us-form').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
        });
    </script>
@endsection
