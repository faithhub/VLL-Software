@extends('layouts/web/app')
@section('content')
    <style>
        p {
            font-size: 18px;
        }

        #video-bookstore-cover {
            position: absolute;
            justify-content: center;
            width: 20%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

        .mat_img {
            float: left;
            width: auto;
            height: 300px;
            /* object-fit: cover; */
        }

        .flapImage {
            margin: 0 auto;
            text-align: center;
            top: 0;
            left: 0;
            background-color: black;
        }

        .my_cat {
            display: inherit;

        }

        .container-img {
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Black_cat_eyes.jpg/277px-Black_cat_eyes.jpg');
            background-size: cover;
            /* width: 100%;
                        height: 100vh; */
            position: relative;
            float: left;
            width: 350px;
            height: 350px;
        }

        .center-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

    <!-- Start Why Choose Us Area -->
    @isset($materials)
        <section id="about" class="why-choose-us ptb-0 mtb-20 bg-f9faff">
            <div class="container">
                <div class="row">
                    @foreach ($materials as $material)
                        @if (substr($material->type->at_unique_id, 0, 3) != 'TAA')
                            <div class="col-lg-4 col-md-4 mb-5 p-2 justify-content-center text-center">


                                <a href="{{ route('user.index') }}">
                                    <div class="container-img"
                                        style="background-image: url('{{ asset($material->cover->url ?? '') }}')">
                                        @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                            <img src="{{ asset('materials/icon/v-play.png') }}" alt="{{ $material->title }}"
                                                width="20%" class="center-image">
                                                @endif
                                    </div>
                                    {{-- </div> --}}
                                </a>
                                {{-- <div class="image">
                                </div> --}}
                                <div class="mat-title">
                                    <a href="{{ route('user.index') }}">
                                        <h4>{{ $material->title }}</h4>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endisset
    <!-- End Why Choose Us Area -->

    <!-- Start Boxes Area -->
    <section class="home ptb-0 mtb-10">
        <div class="container">
            <div class="row align-items-center vll-wel-sec">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title">
                        <h2 class="single-box-h2">Welcome To The Virtual Library</h2>
                        <h2 class="single-box-h2-sub">Subscribe And Get Access To The Virtual Library</h2>
                    </div>

                    <div class="who-we-are-text">
                        <p>
                            The Virtual Law Library provides easy access to Laws, Case Law, Journals, Textbooks, Videos,
                            Audio and Legal Opinion. With our law library, you will enjoy seamless connectivity to
                            any and everything in the industry from service delivery, efficient access to research
                            resources and speedy accessibility to new laws as they are passed by the legislature.
                            It is simple to use, feel free to explore Virtual Law Library. Sign-up is free.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Boxes Area -->

    <!-- Start Why Choose Us Area -->
    <section id="about" class="why-choose-us ptb-0 mtb-20 bg-f9faff">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="legal-article">
                        <div class="section-title">
                            <h3 class="single-box-h2">Get The Newest Legal Articles In The Library</h3>
                        </div>
                        <div class="why-choose-us-text">
                            <p>
                                Our Library is updated regularly to bring you updates on new publications and changes
                                to court decisions. We have partnered with the best in the Legal Industry to bring you
                                the latest Legal information, giving you an edge in your persuasion journey. At Virtual
                                Law Library, we inspire confidence through our wide range of subjects, leaving you in
                                control of conversations and documentation after all law is not about what you know
                                but what you can prove.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row about-image">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="image text-center">
                                <img src="{{ asset('assets/web/img/bg-book004.jpg') }}" alt="about">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="why-choose-us ptb-0 bg-f9faff mtb-20 pb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="row about-image">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="image text-center">
                                <img src="{{ asset('assets/web/img/book002.jpg') }}" class="img-fluid" alt="about">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="legal-article">
                        <div class="section-title">
                            <h3 class="single-box-h2">Become A Vendor And Buy Books From The Virtual Bookstore</h3>
                        </div>
                        <div class="why-choose-us-text">
                            <p>
                                It is all about that one simple step to better marketing, sales and returns on intellectual
                                investment. With our low commission rate and zero hidden charges, you stand to
                                benefit from world-class services.
                                Our bookstore offers a simple, yet expansive coverage of Categories from Case Law,
                                Journals, and textbooks to Videos and Audio.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Us Area -->
    <!-- Start Fun Facts Area -->
    <section class="fun-facts-area ptb-1"
        style="background-image: linear-gradient(rgba(57, 81, 133, 0.04) 0.28%, #395185 99.67%), url('{{ asset('assets/web/img/team.png') }}')">
        <div class="team-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="middle-div">
                            <h2 class="team-text-h2">Add Professional Members to Use Library with One<br>
                                Subscription.</h2>
                            <a href="{{ route('login') }}" class="sub-btn">Add Members</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Fun Facts Area -->
@endsection
