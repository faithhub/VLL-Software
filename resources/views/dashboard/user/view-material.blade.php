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
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-4">
                        <h6 class="mb-1 mt-1 font-weight-bold h6">
                           <a href="{{ route('user.library') }}">
                             <i class="fa fa-arrow-left"></i>&nbsp&nbsp
                            Back
                           </a>
                        </h6>
                        <div class="card-options" style="margin-right:2.5%">
                            {{-- <a href="javascript:void(0);" class="btn btn-sm btn-primary">View All</a> --}}
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @isset($materials)
                                @foreach (array_slice($materials, 0, 4) as $material)
                                    <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                        <div class="image">
                                            <a href="{{ $material->link }}">
                                                <img src="{{ $material->img }}" alt="{{ $material->title }}">
                                            </a>
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                            </div>
                                            <a href="{{ $material->link }}" class="book-title">
                                                <h4>{{ $material->title }} ({{ $material->year }})</h4>
                                                <h5>{{ $material->author }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card text-card">
                    <div class="card-header border-bottom-0 mt-3 text-white">
                        <h3 class="card-title font-weight-bold h2">Note</h3>
                        <div class="card-options">
                            {{-- <a href="javascript:void(0);" class="btn btn-sm font-weight-bold text-white">View All</a> --}}
                        </div>
                    </div>
                    <div class="card-body p-0 card-margin">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom-0 pb-1">
                                    {{-- <h4 class="card-title font-weight-bold h2" style="text-transform:initial;">Note One</h4> --}}
                                    <div class="card-options">
                                        <a href="javascript:void(0);" class="btn btn-sm font-weight-bold">{{ date('d M, Y') }}</a>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    {{-- <h4 class="font-weight-bold h5">The Introduction to Business Law</h4> --}}
                                    <div class="editable editable-title" contenteditable="true" placeholder="Note Title here...."></div>
                                    <div class="editable" contenteditable="true" placeholder="Write note here...."></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>
@endsection
