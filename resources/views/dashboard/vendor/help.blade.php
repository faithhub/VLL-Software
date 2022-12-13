@extends('layouts/dashboard/app')
@section('content')
    <style>
        .help-email-div {
            border: 1px solid;
            padding: 10px 5px 5px 15px;
            border-radius: 10px
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-4">
                        <h6 class="mb-1 mt-1 font-weight-bold h4">Help</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12 help-email-div">
                                <h6 class="mb-1 mt-1 font-weight-bold h6">Email Us</h6>
                                <p>{{ $email ?? "virtuallawlibrary@gmail.com" }}</p>
                            </div>
                        </div>
                        <div class="messages-mode">
                            <div class="tile tile-alt mb-0" id="messages-main" style="background: #F0F4F9 !important;">
                                <div class="ms-body">
                                    <div class="action-header clearfix">
                                        <div class="float-start hidden-xs d-flex ms-0 chat-user">
                                            <div class="align-items-center mt-1">
                                                <p class="font-weight-bold mb-0 fs-16">Chat With Us</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-body-style ps ps--active-y" id="ChatBody">
                                        <div class="message-feed media mt-0">
                                            <div class="float-startpe-2"> <img src="{{ asset('assets/dashboard/images/photos/22.jpg') }}"
                                                    alt="" class="avatar avatar-md brround"> </div>
                                            <div class="media-body">
                                                <div class="mf-content"> Quisque consequat arcu eget odio cursus, ut tempor
                                                    arcu
                                                    vestibulum. Etiam ex arcu, porta a urna non, lacinia pellentesque orci.
                                                    Proin semper
                                                    sagittis erat, eget condimentum sapien viverra et. </div> <small
                                                    class="mf-date"><i class="fa fa-clock-o"></i> 20/05/2021 at
                                                    09:00</small>
                                            </div>
                                        </div>
                                        <div class="message-feed right">
                                            <div class="float-end ps-2"> <img src="{{ asset('assets/dashboard/images/photos/thumb3.jpg') }}"
                                                    alt="" class="avatar avatar-md brround"> </div>
                                            <div class="media-body">
                                                <div class="mf-content"> Etiam nec facilisis lacus. Nulla imperdiet augue
                                                    ullamcorper
                                                    dui ullamcorper, eu laoreet sem consectetur. Aenean et ligula risus.
                                                    Praesent sed
                                                    posuere sem. Cum sociis natoque penatibus et magnis dis parturient
                                                    montes, <div class="row mt-2"> </div>
                                                </div> <small class="mf-date"><i class="fa fa-clock-o"></i> 20/05/2021 at
                                                    10:10</small>
                                            </div>
                                        </div>
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; height: 500px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 391px;"></div>
                                        </div>
                                    </div>
                                    <div class="msb-reply">
                                        <textarea placeholder="What's on your mind..."></textarea> <button class="btn br-7"><i
                                                class="fa fa-paper-plane-o text-muted"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        </div>
    </div>
@endsection
