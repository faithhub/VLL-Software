@extends('layouts/web/app')
@section('content')
    <style>
        p {
            font-size: 18px
        }

        body {
            overflow: auto;
            height: 100%;
        }

        html {
            overflow: hidden;
            height: 100%;
        }

        .section_padding_130 {
            padding-top: 130px;
            padding-bottom: 130px;
        }

        .faq_area {
            position: relative;
            z-index: 1;
            background-color: #f5f5ff;
        }

        .faq-accordian {
            position: relative;
            z-index: 1;
        }

        .faq-accordian .card {
            position: relative;
            z-index: 1;
            margin-bottom: 1.5rem;
        }

        .faq-accordian .card:last-child {
            margin-bottom: 0;
        }

        .faq-accordian .card .card-header {
            background-color: #ffffff;
            padding: 0;
            border-bottom-color: #ebebeb;
        }

        .faq-accordian .card .card-header h6 {
            cursor: pointer;
            padding: 1.75rem 2rem;
            /* color: #3f43fd; */
            font-weight: 800;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -ms-grid-row-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .faq-accordian .card .card-header h6 span {
            font-size: 1.5rem;
        }

        .faq-accordian .card .card-header h6.collapsed {
            color: #070a57;
        }

        .faq-accordian .card .card-header h6.collapsed span {
            -webkit-transform: rotate(-180deg);
            transform: rotate(-180deg);
        }

        .faq-accordian .card .card-body {
            padding: 1.75rem 2rem;
        }

        .faq-accordian .card .card-body p:last-child {
            margin-bottom: 0;
        }

        @media only screen and (max-width: 575px) {
            .support-button p {
                font-size: 14px;
            }
        }

        .support-button i {
            color: #3f43fd;
            font-size: 1.25rem;
        }

        @media only screen and (max-width: 575px) {
            .support-button i {
                font-size: 1rem;
            }
        }

        .support-button a {
            font-weight:800;
            text-transform: capitalize;
            color: #3b566e;
        }

        @media only screen and (max-width: 575px) {
            .support-button a {
                font-size: 13px;
            }
        }
    </style>
    
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Start Boxes Area -->
    <section class="home ptb-50 privacy" style="min-height: 99vh">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title">
                        <h2 class="single-box-h2" style="margin-bottom: 5px">FAQ</h2>
                    </div>

                    <div class="who-we-are-text">

                        <div class="row">
                            <!-- FAQ Area-->
                            <div class="col-12 col-sm-12 col-lg-12">
                                <div class="accordion faq-accordian" id="faqAccordion">
                                @isset($faqs)
                                    @foreach ($faqs as $faq)
                                    <div class="card border-0 wow fadeInUp" data-wow-delay="0.{{$sec++}}s"
                                        style="visibility: visible; animation-delay: 0.{{$sec++}}s; animation-name: fadeInUp;">
                                        <div class="card-header" id="heading{{$faq->id}}">
                                            <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse{{$faq->id}}"
                                                aria-expanded="true" aria-controls="collapse{{$faq->id}}">{{$faq->question}}<span class="lni-chevron-up"></span></h6>
                                        </div>
                                        <div class="collapse" id="collapse{{$faq->id}}" aria-labelledby="heading{{$faq->id}}"
                                            data-parent="#faqAccordion">
                                            <div class="card-body">
                                               {!!$faq->answer!!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endisset
                                </div>
                                <!-- Support Button-->
                                <div class="support-button text-center d-flex align-items-center justify-content-center mt-4 wow fadeInUp"
                                    data-wow-delay="0.5s"
                                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                    <i class="lni-emoji-sad"></i>
                                    <p class="mb-0 px-2">Can't find your answers?</p>
                                    <a href="{{ route('contact') }}"> Contact us</a>
                                </div>
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
@endsection