@extends('layouts/dashboard/app')
@section('content')
    <style>
        .help-email-div {
            border: 1px solid;
            padding: 10px 5px 5px 15px;
            border-radius: 10px
        }

        .messages-mode {
            background-color: #fff !important
        }

        #messages-main {
            background-color: #fff !important
        }

        .ms-body {
            background-color: #fff !important
        }

        .main-chat-list {
            /* overflow: visible !important; */
        }

        .main-chat-body {
            /* max-height: 100px; */
        }

        @media (min-width: 992px) {
            #messages-main .ms-body {
                padding-left: 500px;
            }
        }

        .main-chat-body {
            max-height: 100vh
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="card">
            <div class="row g-0">
                <div class="col-lg-5 col-xl-4">
                    <div class="overflow-hidden mb-0 mb-lg-0">
                        <div class="card-body p-0">
                            <div class="main-content-left main-content-left-chat">
                                <div class="p-4 pb-0 border-bottom">
                                    <h6 class="mb-1 mt-1 font-weight-bold h3 mb-5">Messages(2)</h6>
                                    <div class="input-group"> <input type="text" class="form-control"
                                            placeholder="Search Friends..."> <button type="button"
                                            class="btn btn-primary "> <i class="fa fa-search"></i> </button> </div>
                                </div>
                                <div class="main-chat-list ps ps--active-y" id="ChatList">
                                    <a href="javascript:void(0);">
                                        <div class="media new">
                                            <div class="main-img-user"> <img alt=""
                                                    src="{{ asset('assets/dashboard/images/photos/22.jpg') }}"
                                                    class="avatar avatar-md brround"><span>2</span> </div>
                                            <div class="media-body">
                                                <div class="media-contact-name">
                                                    <span>Emeka Noah</span>
                                                    <span>2 hours</span>
                                                </div>
                                                <p>I have an issue with my books</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);">
                                        <div class="media new">
                                            <div class="main-img-user"> <img alt=""
                                                    src="{{ asset('assets/dashboard/images/photos/22.jpg') }}"
                                                    class="avatar avatar-md brround"><span>1</span> </div>
                                            <div class="media-body">
                                                <div class="media-contact-name"> <span>Ola</span> <span>3
                                                        hours</span> </div>
                                                <p>Et harum quidem rerum facilis est</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; height: 500px; right: 0px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 293px;"></div>
                                    </div>
                                </div><!-- main-chat-list -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-8">
                    <div class="border-start">
                        <div class="main-content-body main-content-body-chat">
                            <div class="main-chat-header">
                                <div class="main-img-user">
                                    <img alt="" src="../assets/images/users/2.jpg" class="avatar avatar-md brround">
                                </div>
                                <div class="main-chat-msg-name">
                                    <h6>Emeka Noah</h6><small>emekanoah@gmail.com</small>
                                </div>
                                <nav class="nav">
                                    {{-- <a class="nav-link" href=""><i
                                            class="fe fe-more-vertical"></i></a> <a class="nav-link d-none d-sm-block"
                                        data-bs-toggle="tooltip" href="" title=""
                                        data-bs-original-title="Call" aria-label="Call"><i
                                            class="fe fe-phone text-muted"></i></a> <a class="nav-link d-none d-sm-block"
                                        data-bs-toggle="tooltip" href="" title=""
                                        data-bs-original-title="Archive" aria-label="Archive"><i
                                            class="fe fe-folder-plus text-muted"></i></a> <a
                                        class="nav-link d-none d-sm-block" data-bs-toggle="tooltip" href=""
                                        title="" data-bs-original-title="Trash" aria-label="Trash"><i
                                            class="fe fe-trash-2 text-muted"></i></a> --}}
                                    <a class="nav-link d-none d-sm-block" data-bs-toggle="tooltip" href=""
                                        title="" data-bs-original-title="View Info" aria-label="View Info"><i
                                            class="fe fe-alert-octagon text-muted"></i></a>
                                </nav>
                            </div><!-- main-chat-header -->
                            <div class="main-chat-body ps ps--active-y" id="ChatBody">
                                <div class="content-inner">
                                    <label class="main-chat-time">
                                        <span class="bg-primary-transparent">3 days ago</span>
                                    </label>
                                    <div class="media flex-row-reverse">
                                        <div class="main-img-user online">
                                            <img alt="" src="../assets/images/users/2.jpg"
                                                class="avatar avatar-md brround">
                                        </div>
                                        <div class="media-body">
                                            <div class="main-msg-wrapper"> Ut enim ad minima veniam, quis nostrum
                                                exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea
                                                commodi
                                            </div>
                                            <div class="main-msg-wrapper"> sed quia non numquam eius modi tempora incidunt
                                                ut labore
                                            </div>
                                            <div class="main-msg-wrapper">
                                                sed quia non numquam eius modi tempora incidunt
                                                ut labore
                                            </div>
                                            <div>
                                                <span>9:48 am</span>
                                                <a href="">
                                                    <i class="icon ion-android-more-horizontal"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="main-img-user online"><img alt=""
                                                src="../assets/images/users/14.jpg" class="avatar avatar-md brround">
                                        </div>
                                        <div class="media-body">
                                            <div class="main-msg-wrapper"> Nor again is there anyone who loves or pursues
                                                or desires to obtain pain of itself </div>
                                            <div class="main-msg-wrapper"> pursues or desires to obtain pain of itself
                                            </div>
                                            <div class="main-msg-wrapper"> who loves or pursues or Nor again is there
                                                anyone </div>
                                            <div> <span>9:32 am</span> <a href=""><i
                                                        class="icon ion-android-more-horizontal"></i></a> </div>
                                        </div>
                                    </div>
                                    <div class="media flex-row-reverse">
                                        <div class="main-img-user online">
                                            <img alt="" src="../assets/images/users/2.jpg"
                                                class="avatar avatar-md brround">
                                        </div>
                                        <div class="media-body">
                                            <div class="main-msg-wrapper"> Nullam dictum felis eu pede mollis pretium
                                            </div>
                                            <div> <span>11:22 am</span> <a href=""><i
                                                        class="icon ion-android-more-horizontal"></i></a> </div>
                                        </div>
                                    </div>
                                    <label class="main-chat-time">
                                        <span class="bg-primary-transparent">Yesterday</span>
                                    </label>
                                    <div class="media">
                                        <div class="main-img-user online"><img alt=""
                                                src="../assets/images/users/14.jpg" class="avatar avatar-md brround">
                                        </div>
                                        <div class="media-body">
                                            <div class="main-msg-wrapper"> Lorem ipsum dolor sit amet, consectetuer
                                                adipiscing elit. Aenean commodo ligula eget dolor. </div>
                                            <div> <span>9:32 am</span> <a href=""><i
                                                        class="icon ion-android-more-horizontal"></i></a> </div>
                                        </div>
                                    </div>
                                    <div class="media flex-row-reverse">
                                        <div class="main-img-user online"><img alt=""
                                                src="../assets/images/users/2.jpg" class="avatar avatar-md brround"></div>
                                        <div class="media-body">
                                            <div class="main-msg-wrapper"> To take a trivial example, which of us ever
                                                undertakes laborious physical exercise, except to obtain some advantage
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media flex-row-reverse mt-1">
                                        <div class="main-img-user online"><img alt=""
                                                src="../assets/images/users/2.jpg" class="avatar avatar-md brround"></div>
                                        <div class="media-body">
                                            <div class="main-msg-wrapper"> Et harum quidem rerum facilis est et expedita
                                                distinctio </div>
                                            <div> <span>9:48 am</span> <a href=""><i
                                                        class="icon ion-android-more-horizontal"></i></a> </div>
                                        </div>
                                    </div> <label class="main-chat-time"><span
                                            class="bg-primary-transparent">Today</span></label>
                                    <div class="media">
                                        <div class="main-img-user online"><img alt=""
                                                src="../assets/images/users/14.jpg" class="avatar avatar-md brround">
                                        </div>
                                        <div class="media-body">
                                            <div class="main-msg-wrapper"> Et harum quidem rerum facilis est et expedita
                                                distinctio </div>
                                            <div class="main-msg-wrapper"> To take a trivial example, which of us ever
                                                undertakes laborious physical exercise, except to obtain some advantage
                                            </div>
                                            <div> <span>10:12 am</span> <a href=""><i
                                                        class="icon ion-android-more-horizontal"></i></a> </div>
                                        </div>
                                    </div>
                                    <div class="media flex-row-reverse">
                                        <div class="main-img-user online"><img alt=""
                                                src="../assets/images/users/2.jpg" class="avatar avatar-md brround"></div>
                                        <div class="media-body">
                                            <div class="main-msg-wrapper"> Et harum quidem rerum facilis est et expedita
                                                distinctio </div>
                                            <div> <span>09:40 am</span> <a href=""><i
                                                        class="icon ion-android-more-horizontal"></i></a> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; height: 555px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 327px;"></div>
                                </div>
                            </div>
                            <div class="main-chat-footer">
                                <nav class="nav">
                                    {{-- <a href="javascript:void(0)" class="nav-link" data-bs-toggle="tooltip"
                                        title="" data-original-title="Camera" data-bs-original-title="">
                                        <i class="fe fe-camera fs-20 text-muted"></i></a>
                                    <a href="javascript:void(0)" class="nav-link" data-bs-toggle="tooltip"
                                        title="" data-original-title="Emoji" data-bs-original-title="">
                                        <i class="fa fa-smile-o fs-20 text-muted"></i>
                                    </a> --}}
                                    <a href="javascript:void(0)" class="nav-link" data-bs-toggle="tooltip"
                                        title="" data-original-title="Attach" data-bs-original-title="">
                                        <i class="fe fe-paperclip fs-20 text-muted"></i>
                                    </a>
                                </nav>
                                <input class="form-control" placeholder="Type your message here..." type="text">
                                <button class="main-msg-send btn btn-primary">
                                    <i class="fa fa-paper-plane-o text-muted"></i>&nbsp;&nbsp;&nbsp;
                                    Send
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <div class="card border-10 pt-0">
                    <div class="card-header border-bottom-0">
                        <div class="d-flex">
                            <div class="media mt-2 mb-2">
                                <div class="media-body">
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Messages(10)</h6>
                                    <small class="h5"></small>
                                </div>
                            </div>
                        </div>
                        <div class="card-options">
                            <div class="float-startpe-2">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="row">
                            <div class="col-sm-2">
                                <img src="{{ asset('assets/dashboard/images/photos/22.jpg') }}" alt=""
                                    class="user-chat-img">
                            </div>
                            <div class="col-sm-10">
                                <h5 class="font-weight-bold">Emeka Noah</h5>
                                <h5>emekanoah@gmail.com</h5>
                                <p class="user-text09800">I have an issue with my books bdjh jbhhjba basjhbj absjhb
                                    jas
                                    j</p>
                                <div class="user-details">
                                </div>
                            </div>
                        </div>
                        <div class="inbox-chat">
                            <div class="user-chat">
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('assets/dashboard/images/photos/22.jpg') }}" alt=""
                                    class="img-fluid">
                            </div>
                            <div class="col-12">
                                <h6 class="mb-1 mt-1 font-weight-bold h6">Dara</h6>
                                <small class="h5">Ola@gmail.com</small>
                                <div class="d-flex">
                                    <div class="media mt-2 mb-2">
                                        <div class="media-body">
                                            <h6 class="mb-1 mt-1 font-weight-bold h6">Dara</h6>
                                            <small class="h5">Ola@gmail.com</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                <div class="card border-10 pt-0">
                    <div class="card-header border-bottom-0 text-white" style="background: var(--primary-bg-color);">
                        <div class="d-flex">
                            <div class="media mt-2 mb-2">
                                <div class="media-body">
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Emeka Noah</h6>
                                    <small class="h5">emekanoah@gmail.com</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-options" style="margin-right:2.5%">
                            <div class="float-startpe-2">
                                <img src="{{ asset('assets/dashboard/images/photos/22.jpg') }}" alt=""
                                    class="avatar avatar-md brround">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="messages-mode">
                            <div class="tile tile-alt mb-0" id="messages-main">
                                <div class="ms-body">
                                    <div class="chat-body-style ps ps--active-y" id="ChatBody">
                                        <div class="message-feed media mt-0">
                                            <div class="float-startpe-2"> <img
                                                    src="{{ asset('assets/dashboard/images/photos/22.jpg') }}"
                                                    alt="" class="avatar avatar-md brround"> </div>
                                            <div class="media-body">
                                                <div class="mf-content"> Quisque consequat arcu eget odio cursus, ut
                                                    tempor
                                                    arcu
                                                    vestibulum. Etiam ex arcu, porta a urna non, lacinia
                                                    pellentesque orci.
                                                    Proin semper
                                                    sagittis erat, eget condimentum sapien viverra et. </div> <small
                                                    class="mf-date"><i class="fa fa-clock-o"></i> 20/05/2021 at
                                                    09:00</small>
                                            </div>
                                        </div>
                                        <div class="message-feed right">
                                            <div class="float-end ps-2"> <img
                                                    src="{{ asset('assets/dashboard/images/photos/thumb3.jpg') }}"
                                                    alt="" class="avatar avatar-md brround"> </div>
                                            <div class="media-body">
                                                <div class="mf-content"> Etiam nec facilisis lacus. Nulla imperdiet
                                                    augue
                                                    ullamcorper
                                                    dui ullamcorper, eu laoreet sem consectetur. Aenean et ligula
                                                    risus.
                                                    Praesent sed
                                                    posuere sem. Cum sociis natoque penatibus et magnis dis
                                                    parturient
                                                    montes, <div class="row mt-2"> </div>
                                                </div> <small class="mf-date"><i class="fa fa-clock-o"></i>
                                                    20/05/2021 at
                                                    10:10</small>
                                            </div>
                                        </div>
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                                            </div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; height: 500px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 391px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="msb-reply" style="background-color: #fff !important">
                                        <textarea placeholder="What's on your mind..." style="background-color: #fff !important"></textarea>
                                        <button class="btn br-7"><i class="fa fa-paper-plane-o text-muted"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    </div>
@endsection
