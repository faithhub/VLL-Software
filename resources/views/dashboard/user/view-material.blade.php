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

        .note-textarea {
            border: 0px;
            min-height: 150px;
            border-radius: 2px;
            width: 100%;
            /* background-color: #f0f4f9 */
        }

        .note-input {
            border: 0px;
            /* padding: 5px; */
            border-radius: 2px;
            width: 100%;
            margin-bottom: 5px;
            height: 35px;
            /* background-color: #f0f4f9 */
        }

        .scroll {
            overflow-y: scroll;
        }

        @media print {

            html,
            body {
                display: none;
                /* hide whole page */
            }
        }

        .modal.open {
            opacity: 1;
            visibility: visible;
        }

        .modal.open .content {
            transform: scale(1);
        }


        .container.blur {
            filter: blur(5px);
        }

        .modal-open .main-container {
            -webkit-filter: blur(5px) grayscale(90%);
            filter: blur(5px) grayscale(90%);
        }

        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            display: none;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>

    <script type="text/javascript">
        /*
                        path to the directory containing the PDF Web Viewer scripts, webassemblies and translations.
                        The path can be absolute or relative to the current document and must be defined before the viewer is loaded
                      */
        window.PDFTOOLS_FOURHEIGHTS_PDFVIEWING_BASEURL = "/pdfwebviewer/"
    </script>

    <!-- stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('pdfwebviewer/pdf-web-viewer.css') }}" />

    {{-- <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style> --}}

    <!-- pdf viewer script, for development you can  -->
    <script src="{{ asset('pdfwebviewer/pdf-web-viewer.min.js') }}"></script>

    <meta http-equiv="Expires" content="-1">
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
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
                    @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                        <div class="card-body pt-0">
                            <div class="row">
                                <video width="100%" height="auto" controls controlsList="nodownload">
                                    <source src="{{ asset($material->file->url) }}">
                                </video>
                                {{-- <div id="adobe-dc-view" style="height: 80vh"></div> --}}
                            </div>
                        </div>
                    @else
                        <div class="card-body pt-0">
                            <div class="row">
                                {{-- <iframe src="https://docs.google.com/gview?url={{ asset($material->file->url) }}&embedded=true" style="width:100%; height:80vh;" frameborder="0"></iframe> --}}
                                {{-- <div id="pdfviewer" style="height: 80vh; width:inherit"></div> --}}
                                <div id="adobe-dc-view" style="height: 80vh"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- @dump($note) --}}
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card" id="note_div_section">
                    <div class="card-body">
                        <div class="tab-menu-heading p-0 bg-white">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class=""><a href="#myProfile" id="profile_tab_note"
                                            class="{{ empty(old('tabName')) || old('tabName') == 'myProfile' ? 'active' : '' }}">New
                                            Note</a>
                                    </li>
                                    <li><a href="#general"
                                            class="{{ !empty(old('tabName')) && old('tabName') == 'general' ? 'active' : '' }}">My
                                            Notes</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane {{ empty(old('tabName')) || old('tabName') == 'myProfile' ? 'active' : '' }}"
                                id="myProfile">
                                <div class="row pt-4 text-card">
                                    <div class="card text-card">
                                        <div class="card-header border-bottom-0">
                                            <div class="card-options">
                                                <a href="#" onclick="viewNote({{ $note->id ?? 0 }}, 'new')"
                                                    class="btn btn-sm btn-white text-black font-weight-bold"
                                                    style="margin-right: 7px">New Note</a>
                                                <a href="#" id="save_note_btn" onclick="saveNote()"
                                                    class="btn btn-sm btn-white text-black font-weight-bold"
                                                    style="margin-right: 7px">Save Note</a>
                                                <a href="#" onclick="checkNote('{{ Session::get('current_note') }}')"
                                                    class="btn btn-sm btn-white text-black font-weight-bold">Send
                                                    Note</a>
                                                <a href="{{ route('user.send_note', $note->id ?? 0) }}"
                                                    onclick="shiNew(event)" data-type="dark" data-size="s"
                                                    data-title="Send Note" id="send_note"></a>
                                            </div>
                                        </div>
                                        <div class="card-body p-0 card-margin">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header border-bottom-0 pb-1">
                                                        <div class="card-options">
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-sm font-weight-bold">{{ date('d M, Y') }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body pt-2">
                                                        <form class="validate-form" id="save_note_form" method="POST"
                                                            action="">
                                                            @csrf
                                                            <input type="text" class="note-input" id="note-title"
                                                                value="{{ $note->title ?? null }}" name="title"
                                                                placeholder="Note Title...." required
                                                                data-parsley-required-message="Note title is required">
                                                            @error('title')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <textarea class="note-textarea" required id="note-content" name="content" placeholder="Write note...."
                                                                data-parsley-required-message="Note content is required">{{ $note->content ?? null }}</textarea>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'general' ? 'active' : '' }}"
                                id="general">
                                <div class="row mt-5 settings"
                                    style="max-height:90vh; overflow-y: scroll; overflow-x: hidden;">
                                    <div class="card-body p-0 card-margin">
                                        <div class="scroll">
                                            @isset($notes)
                                                @if ($notes->count() > 0)
                                                    @foreach ($notes as $note)
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="card-header border-bottom-0">
                                                                    <h4 class="card-title font-weight-bold h2"
                                                                        style="text-transform:initial;">
                                                                    </h4>
                                                                    <div class="card-options">
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm font-weight-bold">{{ $note->created_at->format('D j, Y') }}</a>
                                                                        <a href="javascript:void(0);"
                                                                            onclick="deleteNote({{ $note->id }})"
                                                                            class="btn btn-sm btn-danger font-weight-bold">Delete</a>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <h4 onclick="viewNote({{ $note->id ?? 0 }}, 'view')"
                                                                        class="font-weight-bold h5" style="cursor: pointer">
                                                                        {{ $note->title ?? '' }}
                                                                    </h4>
                                                                    <p>
                                                                        {{ mb_strimwidth($note->content ?? '', 0, 50, '...') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="text-center pb-2 text-black">
                                                        <h4>No notes available yet</h4>
                                                    </div>
                                                @endif
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="myModal" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Unlock Test</h5>
                </div>
                <div class="modal-body">
                    <form class="m-5" method="post" action="{{ route('user.unlock_test') }}"
                        id="privacy_code_form">
                        @csrf
                        <input type="hidden" name="material_id" value="{{ $material->id }}">
                        <div class="form-group">
                            <label>Privacy Code</label>
                            <input type="password" onkeyup="checkCode()" id="privacy_code" name="code"
                                class="form-control" placeholder="Enter Code">
                            <span class="parsley-required" id="privacy_code_error"></span>
                        </div>
                        <button type="button" id="unlock_btn" onclick="unlock_submit()"
                            class="btn btn-primary">Unluck</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="loading" id="loading">Loading&#8230;</div>

    @if (substr($material->type->mat_unique_id, 0, 3) == 'TAA')
        @if (Auth::user()->user_type == 'student')
            @if (!in_array($material->id, $unlocked_tests))
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#myModal').modal({
                            keyboard: false,
                            backdrop: 'static'
                        })
                        $("#myModal").modal('show');
                    });
                </script>
            @endif
        @endif
    @endif

    {{-- @include('layouts.dashboard.includes.pdf-tool-reader') --}}
    <script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
    <script type="text/javascript">
        $(document).on("keydown", "form", function(event) {
            return event.key != "Enter";
        });

        function checkCode() {
            document.getElementById("privacy_code_error").textContent = "";
            if (document.getElementById("privacy_code").value === "") {
                document.getElementById('unlock_btn').disabled = true;
            } else {
                document.getElementById('unlock_btn').disabled = false;
            }
        }

        function unlock_submit() {
            console.log(document.getElementById("privacy_code").value);
            if (document.getElementById("privacy_code").value === "") {
                document.getElementById("privacy_code_error").textContent = "Enter privacy code";
                return toastr.error("{{ session('error') }}", "Enter privacy code");
                return false;
            }

            document.getElementById("privacy_code_error").textContent = "";
            var form = $('#privacy_code_form');
            var actionUrl = form.attr('action');
            $.ajax({
                type: 'POST',
                url: actionUrl,
                data: form.serialize(),
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        document.getElementById("privacy_code_error").textContent = "";
                        $(document).ready(function() {
                            $("#myModal").modal('hide');
                        });
                        return toastr.success("{{ session('success') }}", "Test unlocked");
                    } else {
                        document.getElementById("privacy_code_error").textContent =
                            "Incorrect privacy code";
                        return toastr.error("{{ session('error') }}", "Incorrect privacy code");
                    }
                },
                error: function(err) {
                    return toastr.error("{{ session('error') }}", "Test not unlocked");
                }
            });
        }

        function checkNote(id) {
            if (!id) {
                alert("Select a note to send an try again");
                return false;
            }
            // const current_note_id = "{{ Session::get('current_note') }}";
            // const current_note_data = "{{ \App\Models\Note::where(['id' => Session::get('current_note')])->pluck('id')->first() }}";
            // console.log(current_note_id, current_note_data, "yo man");
            // return false;
            document.getElementById("send_note").click();
        }

        function viewNote(id, type) {
            document.getElementById('loading').style.display = 'block';
            var url = "{{ route('user.set.current.note') }}";
            if (type == 'new') {
                document.getElementById('note-title').value = '';
                document.getElementById('note-content').value = '';
            }
            $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        note_id: id,
                        type: type,
                    },
                    success: function(response) {
                        // console.log(response, response.note.title);
                        console.log(response.current_note);
                        if (response.current_note != null) {
                            document.getElementById('note-title').value = response.note.title;
                            document.getElementById('note-content').value = response.note.content;
                            document.getElementById("profile_tab_note").click();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                }),

                setTimeout(function() {
                    document.getElementById('loading').style.display = 'none';
                }, 2000);
            // $("#note_div_section").load(window.location.href + " #note_div_section");
        }

        const previewConfig = {
            showAnnotationTools: false,
            showDownloadPDF: false,
            showPrintPDF: false,
            enableSearchAPIs: true,
            // defaultViewMode: (isMobile ? "SINGLE_PAGE" : "FIT_PAGE"),
            // hasReadOnlyAccess: true
        }
        const allowTextSelection = false;

        try {
            document.addEventListener("adobe_dc_view_sdk.ready", function() {
                var adobeDCView = new AdobeDC.View({
                    clientId: "6dfef512955e46eca21b5e9545cd9ce5",
                    // clientId: "6dfef512955e46eca21b5e9545cd9ce5",
                    // clientId: "361dd918518a4899a875ef8455d503fa",
                    divId: "adobe-dc-view"
                });

                var previewFilePromise = adobeDCView.previewFile({
                    content: {
                        location: {
                            url: "{{ asset($material->file->url) }}"
                        }
                    },
                    metaData: {
                        fileName: "{{ $material->title }}"
                    }
                }, previewConfig);



                previewFilePromise.then(adobeViewer => {
                    adobeViewer.getAPIs().then(apis => {
                        apis.enableTextSelection(allowTextSelection)
                            .then(() => console.log("Success"))
                            .catch(error => console.log(error, "error"));
                    });
                });

            });
        } catch (error) {
            console.log(error, "err 888");
        }

        function saveNote(params) {
            const content = sessionStorage.getItem('note-content');
            const title = sessionStorage.getItem('note-title');
            console.log(content, title);
        }


        window.onload = function() {
            const content = sessionStorage.getItem('note-content');
            const title = sessionStorage.getItem('note-title');
            if (content) {
                document.getElementById("note-content").value = content;
            }
            if (title) {
                document.getElementById("note-title").value = title;
            }
        }

        window.onbeforeunload = function() {
            sessionStorage.setItem("note-content", document.getElementById("note-content").value);
            sessionStorage.setItem("note-title", document.getElementById("note-title").value);
        }

        function saveNote() {
            if (!($('#save_note_form').parsley().validate())) {
                return false;
            }
            console.log("save note");

            var form = $('#save_note_form');
            var actionUrl = form.attr('action');
            $.ajax({
                type: 'POST',
                url: actionUrl,
                data: form.serialize(),
                success: function(response) {
                    console.log(response);
                    $("#note_div_section").load(window.location.href + " #note_div_section");
                    return toastr.success("{{ session('success') }}", "Note Saved Successfully");
                },
                error: function(err) {
                    console.log(err);
                    return toastr.error("{{ session('error') }}", "Note not saved");
                }
            });
        }

        function deleteNote(id) {
            var confirmNote = confirm('Do you want to delete this note?');
            if (confirmNote === true) {
                console.log("delete note");
                $.ajax({
                    type: 'post',
                    url: "{{ route('user.delete_note') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        note_id: id,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            $("#note_div_section").load(window.location.href + " #note_div_section");
                            return toastr.success("{{ session('success') }}", "Note Delete");
                        } else {
                            return toastr.error("{{ session('error') }}", "Note did not delete");
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        return toastr.error("{{ session('error') }}", "Note did not delete");
                    }
                });
            } else {
                console.log("delete note bad");
            }
        }

        // $(function() {

        // });
    </script>
@endsection
