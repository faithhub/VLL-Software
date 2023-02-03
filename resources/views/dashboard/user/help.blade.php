@extends('layouts/dashboard/app')
@section('content')
    <style>
        .help-email-div {
            border: 1px solid;
            padding: 10px 5px 5px 15px;
            border-radius: 10px
        }

        .main-chat-footer {
            padding: 0px;
        }

        .main-chat-footer .form-control {
            margin: 0px;
            height: 50px;
        }

        .main-chat-footer .main-msg-send {
            height: 50px;
        }

        .main-chat-header {
            padding: 0px;
        }

        .main-chat-header {
            border-bottom: 0px;
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
                                <p>{{ $settings['email'] ?? 'virtuallawlibrary@gmail.com' }}</p>
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
                                    <div class="chat-body-style ps--active-y my_new_div_now" id="ChatBody">
                                        @isset($messages)
                                            @foreach ($messages as $message)
                                                @if ($message->admin)
                                                    <div class="message-feed media mt-0">
                                                        <div class="float-startpe-2"> <img
                                                                src="{{ asset($message->admin->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}"
                                                                alt="" class="avatar avatar-md brround"> </div>
                                                        <div class="media-body">
                                                            <div class="mf-content">
                                                                @if ($message->msg)
                                                                    {{ $message->msg }}
                                                                @endif
                                                                @if ($message->media_id)
                                                                    <div class="main-chat-header">
                                                                        <a href="{{ asset($message->file->url) }}"
                                                                            target="blank">
                                                                            <div class="main-img-user">
                                                                                <img alt="{{ $message->file_name }}"
                                                                                    class="avatar avatar-md"
                                                                                    src="{{ asset($message->file->url) }}">
                                                                            </div>
                                                                        </a>
                                                                        <div class="main-chat-msg-name">
                                                                            <h6 id="material_cover_name">
                                                                                {{ $message->file_name }}
                                                                            </h6>
                                                                            <small id="material_cover_size"></small>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <small class="mf-date"><i class="fa fa-clock-o"></i>
                                                                {{ $message->created_at->format('D, M j, Y h:i a') }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($message->user)
                                                    <div class="message-feed right">
                                                        <div class="float-end ps-2">
                                                            <img src="{{ asset(Auth::user()->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}"
                                                                alt="" class="avatar avatar-md brround">
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="mf-content">
                                                                @if ($message->msg)
                                                                    {{ $message->msg }}
                                                                @endif
                                                                @if ($message->media_id)
                                                                    <div class="main-chat-header">
                                                                        <a href="{{ asset($message->file->url) }}"
                                                                            target="blank">
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
                                                                            <small id="material_cover_size"
                                                                                style="color: white"></small>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <small class="mf-date"><i class="fa fa-clock-o"></i>
                                                                {{ $message->created_at->format('D, M j, Y h:i a') }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endisset
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; height: 500px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 391px;"></div>
                                        </div>
                                    </div>
                                    <div class="main-chat-footer">
                                        <button type="button" onclick="getFile()" class="main-msg-send btn btn-primary">
                                            <i class="fa fa-file text-muted"></i>&nbsp;
                                            Send File
                                        </button>
                                        <input id="msg_value" class="form-control" placeholder="Type your message here..."
                                            type="text">
                                        <button id="msg_btn" class="main-msg-send btn btn-primary">
                                            <i class="fa fa-paper-plane-o text-muted"></i>&nbsp;&nbsp;&nbsp;
                                            Send
                                        </button>
                                    </div>
                                    {{-- <div class="msb-reply">
                                        <textarea placeholder="What's on your mind..."></textarea> <button class="btn br-7"><i
                                                class="fa fa-paper-plane-o text-muted"></i></button>
                                    </div> --}}
                                    <form method="POST" id="submitFileForm" action="" enctype="multipart/form-data">
                                        @csrf
                                        <input id="inputFile" type="file" name="save_file" style="display: none">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <button onclick="updateDiv()">Click Me</button> --}}
    </div>
    <script>
        // $("#ChatBody").scrollTop($("#ChatBody")[0].scrollHeight);

        $('#inputFile').change(function(e) {
            try {
                console.log($('#inputFile')[0].files.length);
                if ($('#inputFile')[0].files.length === 0) {
                    console.log("No files selected.");
                    return false;
                }
                e.preventDefault();
                console.log("outside");

                var form = new FormData();
                form.append('save_file', $('#inputFile')[0].files[0]);
                form.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: "{{ route('user.help') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    type: "POST",
                    enctype: 'multipart/form-data',
                    data: form,
                    success: function(response) {
                        console.log(response);
                        $("#ChatBody").load( window.location.href + " #ChatBody")
                        // $("#ChatBody").load( window.location.href + " #ChatBody",
                        //     () => {
                        //         $('#ChatBody').stop().animate({
                        //             scrollTop: $('#ChatBody')[0].scrollHeight
                        //         }, 800);
                        //     });
                        // $('html, body').animate({
                        //     scrollTop: $('.my_new_div_now').height()
                        // }, 'slow');
                        // $('#ChatBody').stop().animate({
                        //     scrollTop: $('#ChatBody')[0].scrollHeight
                        // }, 800);
                        // $("#form").trigger("reset"); // to reset form input fields
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });

            } catch (error) {
                console.log(error);
            }
            // $('#submitFileForm').submit();
        });

        $('#msg_btn').click(function(e) {
            try {
                var msg = $('#msg_value').val();
                if (msg != '') {
                    e.preventDefault();
                    var form = new FormData();
                    form.append('msg', msg);
                    form.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        url: "{{ route('user.help') }}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        type: "POST",
                        data: form,
                        success: function(response) {
                            console.log(response);
                            $('#msg_value').val('')
                            $("#ChatBody").load(window.location.href + " #ChatBody");
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }

            } catch (error) {
                console.log(error);
            }
        });

        getFile = function() {
            $('#inputFile').attr('accept', '.jpg, .png');
            $('#inputFile').show();
            $('#inputFile').focus();
            $('#inputFile').click();
            $('#inputFile').hide();
        }


        $(function() {
            $('#ChatBody').stop().animate({
                scrollTop: $('#ChatBody')[0].scrollHeight
            }, 800);

        })

        // function updateDiv() {
        //     $("#ChatBody").load(window.location.href + " #ChatBody");

        //     $('.ChatBody').stop().animate({
        //         scrollTop: $('.ChatBody')[0].scrollHeight
        //     }, 800);
        // }
    </script>
@endsection
