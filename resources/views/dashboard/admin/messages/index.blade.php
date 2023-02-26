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
            max-height: 75vh
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
                                    <h6 class="mb-1 mt-1 font-weight-bold h3 mb-5">Messages({{ $messages_count }})</h6>
                                    <div class="input-group"> <input type="text" class="form-control"
                                            placeholder="Search Friends..."> <button type="button"
                                            class="btn btn-primary "> <i class="fa fa-search"></i> </button> </div>
                                </div>
                                <div class="main-chat-list ps ps--active-y" id="ChatList">
                                    @isset($messages)
                                        @foreach ($messages as $user_message)
                                            <a href="javascript:void(0);" onclick="getMessage(this)"
                                                data-user-id="{{ $user_message->message->user->id }}">
                                                <div class="media new">
                                                    <div class="main-img-user"> <img alt=""
                                                            src="{{ asset($user_message->message->user->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}"
                                                            class="avatar avatar-md brround">
                                                            <span>{{ $user_message->msg_count }}</span>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="media-contact-name">
                                                            <span>{{ $user_message->message->user->name }} <b class="text-capitalize" style="font-size:10px">({{ $user_message->message->user->user_type}})</b></span>
                                                            <span>{{ $user_message->message->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <p>{{ $user_message->msg }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endisset
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
                                <div class="main-img-user" id="main_img_user">
                                    <div id="main_img_user">
                                        @isset($current_user)
                                            <img alt=""
                                                src="{{ asset($current_user->user->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}"
                                                class="avatar avatar-md brround">
                                        @endisset
                                    </div>
                                </div>
                                <div class="main-chat-msg-name" id="main_chat_msg_name">
                                    <div id="main_chat_msg_name">
                                        @isset($current_user)
                                        <input class="form-control" id="user_id" type="hidden"
                                            value="{{ $current_user->user->id }}">
                                            {{-- @dump($current_user) --}}
                                            <h6>{{ $current_user->user->name }}</h6>
                                            <small>{{ $current_user->user->email }}</small>
                                        @endisset
                                    </div>
                                </div>
                                <nav class="nav">
                                    {{-- <a class="nav-link d-none d-sm-block" data-bs-toggle="tooltip" href="#"
                                        title="" data-bs-original-title="View Info" aria-label="View Info"><i
                                            class="fe fe-alert-octagon text-muted"></i></a> --}}
                                </nav>
                            </div>
                        </div>
                        <div class="main-chat-body ps--active-y" id="ChatBody">
                            <div class="content-inner">
                                <div id="content_inner">
                                    @isset($current_user_messages)
                                        @foreach ($current_user_messages as $message)
                                            @if ($message->type == "admin")
                                                <div class="media flex-row-reverse mt-1">
                                                    <div class="main-img-user online">
                                                        <img alt=""src="{{ asset($message->admin->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}"
                                                            class="avatar avatar-md brround">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="main-msg-wrapper">
                                                            @if ($message->msg)
                                                                {{ $message->msg }}
                                                            @endif
                                                            @if ($message->media_id)
                                                                <div class="main-chat-header">
                                                                    <a href="{{ asset($message->file->url) }}" target="blank">
                                                                        <div class="main-img-user">
                                                                            <img alt="{{ $message->file_name }}"
                                                                                class="avatar avatar-md"
                                                                                src="{{ asset($message->file->url) }}">
                                                                        </div>
                                                                    </a>
                                                                    <div class="main-chat-msg-name">
                                                                        <h6 id="material_cover_name" style="color: white">
                                                                            {{ $message->file_name }}
                                                                        </h6>
                                                                        <small id="material_cover_size"></small>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <span> {{ $message->created_at->format('D, M j, Y h:i a') }}</span>
                                                            <a href="">
                                                                <i class="icon ion-android-more-horizontal"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($message->type == "user")
                                                <div class="media mb-5">
                                                    <div class="main-img-user online">
                                                        <img alt=""
                                                            src="{{ asset($message->user->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}"
                                                            class="avatar avatar-md brround">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="main-msg-wrapper">
                                                            @if ($message->msg)
                                                                {{ $message->msg }}
                                                            @endif

                                                            @if ($message->media_id)
                                                                <div class="main-chat-header">
                                                                    <a href="{{ asset($message->file->url) }}" target="blank">
                                                                        <div class="main-img-user">
                                                                            <img alt="{{ $message->file_name }}"
                                                                                class="avatar avatar-md"
                                                                                src="{{ asset($message->file->url) }}">
                                                                        </div>
                                                                    </a>
                                                                    <div class="main-chat-msg-name">
                                                                        <h6 id="material_cover_name" style="color: black">
                                                                            {{ $message->file_name }}
                                                                        </h6>
                                                                        <small id="material_cover_size"
                                                                            style="color: white"></small>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <span>{{ $message->created_at->format('D, M j, Y h:i a') }}</span>
                                                            <a href="">
                                                                <i class="icon ion-android-more-horizontal"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endisset
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
                                <a href="javascript:void(0)" onclick="getFile()" class="nav-link"
                                    data-bs-toggle="tooltip" title="" data-original-title="Attach"
                                    data-bs-original-title="">
                                    <i class="fe fe-paperclip fs-20 text-muted"></i>
                                </a>
                            </nav>
                            <input class="form-control" id="msg_value" placeholder="Type your message here..."
                                type="text">
                            <button id="msg_btn" class="main-msg-send btn btn-primary">
                                <i class="fa fa-paper-plane-o text-muted"></i>&nbsp;&nbsp;&nbsp;
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" id="submitFileForm" action="{{ route('admin.send_msg') }}" enctype="multipart/form-data">
        @csrf
        <input id="inputFile" type="file" name="save_file" style="display: none">
    </form>
    @include('layouts.dashboard.includes.admin-help')
@endsection
