@extends('layouts/web/app')
@section('content')
<style>
    p{
        font-size: 18px
    }
    </style>
    <!-- Start Boxes Area -->
    <section class="home ptb-50 privacy" style="min-height: 99vh">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title">
                        <h2 class="single-box-h2" style="margin-bottom: 5px">Privacy policies</h2>
                    </div>

                    <div class="who-we-are-text">
                        <p>
                            {{ $contents ?? '' }}
                        </p>
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
@endsection
