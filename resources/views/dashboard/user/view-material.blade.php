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
            padding: 5px;
            border-radius: 2px;
            width: 100%;
            margin-bottom: 5px;
            height: 35px;
            /* background-color: #f0f4f9 */
        }

        @media print {

            html,
            body {
                display: none;
                /* hide whole page */
            }
        }
    </style>
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
                    <div class="card-body pt-0">
                        <div class="row">
                            <div id="adobe-dc-view" style="height: 80vh"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card" id="note_div_section">
                    <div class="card-body">
                        <div class="tab-menu-heading p-0 bg-white">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class=""><a href="#myProfile"
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
                                            {{-- <h3 class="card-title font-weight-bold h2 text-white">Note</h3> --}}
                                            <div class="card-options">
                                                <a href="#" onclick="viewNote({{ $note->id ?? 0 }}, 'new')"
                                                    class="btn btn-sm btn-white text-black font-weight-bold"
                                                    style="margin-right: 7px">New Note</a>
                                                <a href="#" id="save_note_btn" onclick="saveNote()"
                                                    class="btn btn-sm btn-white text-black font-weight-bold"
                                                    style="margin-right: 7px">Save
                                                    Note</a>
                                                <a href="{{ route('user.send_note', $material->id) }}"
                                                    onclick="shiNew(event)" data-type="dark" data-size="s"
                                                    data-title="Send Note"
                                                    class="btn btn-sm btn-white text-black font-weight-bold">Send
                                                    Note</a>
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
                                <div class="row mt-5 settings">
                                    <div class="card-body p-0 card-margin">
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
                                                                </div>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <h4 onclick="viewNote({{ $note->id ?? 0 }}, 'view')"
                                                                    class="font-weight-bold h5" style="cursor: pointer">
                                                                    {{ $note->title ?? '' }}
                                                                </h4>
                                                                <p>
                                                                    {{ $note->content ?? '' }}
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
        <script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
        <script type="text/javascript">
            function viewNote(id, type) {
                var url = "{{ route('user.set.current.note') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        note_id: id,
                        type: type,
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
                $("#note_div_section").load(window.location.href + " #note_div_section");
            }
            const previewConfig = {
                showAnnotationTools: false,
                showDownloadPDF: false,
                showPrintPDF: false,
                enableSearchAPIs: true,
                // hasReadOnlyAccess: true
            }
            const allowTextSelection = false;

            try {
                document.addEventListener("adobe_dc_view_sdk.ready", function() {
                    var adobeDCView = new AdobeDC.View({
                        clientId: "{{ env('ADOBECLIENTID') }}",
                        divId: "adobe-dc-view"
                    });

                    var previewFilePromise = adobeDCView.previewFile({
                        content: {
                            location: {
                                url: " {{ asset($material->file->url) }}"
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

            // function saveNote(params) {
            //     const content = sessionStorage.getItem('note-content');
            //     const title = sessionStorage.getItem('note-title');
            //     console.log(content, title);
            // }


            // window.onload = function() {
            //     const content = sessionStorage.getItem('note-content');
            //     const title = sessionStorage.getItem('note-title');
            //     if (content) {
            //         document.getElementById("note-content").value = content;
            //     }
            //     if (title) {
            //         document.getElementById("note-title").value = title;
            //     }
            // }

            // window.onbeforeunload = function() {
            //     sessionStorage.setItem("note-content", document.getElementById("note-content").value);
            //     sessionStorage.setItem("note-title", document.getElementById("note-title").value);
            // }

            function saveNote() {
                console.log("bad");
                if (!($('#save_note_form').parsley().validate())) {
                    return false;
                }
                console.log("good");

                var form = $('#save_note_form');
                var actionUrl = form.attr('action');
                $.ajax({
                    type: 'POST',
                    url: actionUrl,
                    data: form.serialize(),
                    success: function(response) {
                        console.log(response);
                        return toastr.success("{{ session('success') }}", "Note Saved Successfully");
                        $("#note_div_section").load(window.location.href + " #note_div_section");
                    },
                    error: function(err) {
                        console.log(err);
                        return toastr.error("{{ session('error') }}", "Note not saved");
                    }
                });
            }

            $(function() {

            });
        </script>
    @endsection
