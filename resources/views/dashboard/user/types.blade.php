@extends('layouts/dashboard/app')
@section('content')
    <style>
        #img-2 {
            position: absolute;
            justify-content: center;
            width: 10%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

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
                    <div class="card-header border-bottom-0 mb-4">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Textboooks</h6>
                        <div class="card-options" style="margin-right:2.5%"> <a href="javascript:void(0);"
                                class="btn btn-sm btn-primary">View All</a> </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @isset($materials)
                                @foreach ($materials as $material)
                                    <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                        <div class="image">
                                            <a onclick="shiNew(event)" data-type="dark" data-size="l"
                                                data-title="{{ $material->title }}"
                                                href="{{ route('vendor.view_material', $material->id) }}">
                                                <img src="{{ asset($material->cover->url ??  "images/new-meeting.png") }}" alt="{{ $material->title }}">
                                            </a>
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                            </div>
                                            <a onclick="shiNew(event)" data-type="dark" data-size="l"
                                                data-title="{{ $material->title }}"
                                                href="{{ route('vendor.view_material', $material->id) }}" class="book-title">
                                                {{-- <a href="{{ route('user.summary', $material->id) }}" class="book-title"> --}}
                                                <h4>{{ $material->title }} ({{ $material->year_of_publication }})</h4>
                                                <h5>{{ $material->name_of_author }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
