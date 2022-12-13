@extends('layouts/web/app')
@section('content')


    <!-- Start Why Choose Us Area -->
    @isset($materials)
        <section id="about" class="why-choose-us ptb-0 mtb-20 bg-f9faff">
            <div class="container">
                <div class="row">
                    @foreach ($materials as $material)
                        <div class="col-lg-4 col-md-4 mb-2 justify-content-center">
                            <div class="image">
                                <a href="{{ $material->link }}">
                                    <img src="{{ $material->img }}" alt="{{ $material->title }}">
                                </a>
                            </div>
                            <div class="mat-title">
                                <a href="{{ $material->link }}">
                                    <h4>{{ $material->title }}</h4>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endisset
    <!-- End Why Choose Us Area -->


    <!-- Start Boxes Area -->
    <section class="home ptb-0 mtb-20">
        <div class="container">
            <div class="row align-items-center vll-wel-sec">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title">
                        <h2 class="single-box-h2">Welcome To The Virtual Library</h2>
                        <h2 class="single-box-h2-sub">Subscribe And Get Access To The Virtual Library</h2>
                    </div>

                    <div class="who-we-are-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar in eu feugiat consequat tellus
                            adipiscing morbi ultrices. Venenatis, sed nec fermentum, odio volutpat bibendum. Augue dictum
                            duis nam faucibus nunc vel etiam. Lacus, nunc maecenas arcu morbi mauris eu purus amet. Nisi
                            habitasse in cursus sit. Amet sem senectus adipiscing ac.
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
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh nulla risus, egestas maecenas
                                ullamcorper aliquam. Vitae, sedrutrum nisi et massa. Integer porttitor sollicitudin quam
                                urna,
                                etiam ac tempor cum. Aliquam faucibus gravida pulvinar quis. Velit sollicitudin vitae
                                imperdiet
                                ipsum. Quis id turpis porta nec viverra nibh egestas cras condimentum. Odio est eu elit ut
                                cursus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row about-image">
                        <div class="col-12 col-lg-12 col-md-6">
                            <div class="image" style="max-height: 300px">
                                <img src="{{ asset('assets/web/img/book.png') }}" alt="about" style="max-height: inherit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Us Area -->

    <!-- Start Why Choose Us Area -->
    <section id="about" class="why-choose-us ptb-0 bg-f9faff mtb-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="row about-image">
                        <div class="col-12 col-lg-12 col-md-6">
                            <div class="image" style="max-height: 300px">
                                <img src="{{ asset('assets/web/img/books.png') }}"  class="img-fluid" alt="about" style="max-height: inherit">
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
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh nulla risus, egestas maecenas
                                ullamcorper aliquam. Vitae, sedrutrum nisi et massa. Integer porttitor sollicitudin quam
                                urna, etiam ac tempor cum. Aliquam faucibus gravida pulvinar quis. Velit sollicitudin vitae
                                imperdiet ipsum. Quis id turpis porta nec viverra nibh egestas cras condimentum. Odio est eu
                                elit ut cursus.</p>
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
                            <a href="#" class="sub-btn">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Fun Facts Area -->
@endsection
