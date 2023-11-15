@extends('layouts/dashboard/app')
@section('content')
    <style>
        #img-3 {
            position: absolute;
            justify-content: center;
            width: 5%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0">
                        <div class="d-flex">
                            <div class="media mt-4">
                                <div class="media-body">
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Welcome to the Bookstore</h6>
                                    <small class="h5">View all your Legal Related Textbooks, Articles and Videos</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <iframe src="https://meet.goto.com/946600437" frameborder="0"></iframe>
                        <embed src="https://google.com/" type=""> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
