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
                <div class="card text-card">
                    <div class="card-header border-bottom-0 mt-3">
                        <h3 class="card-title font-weight-bold h2 text-white">Note</h3>
                        <div class="card-options">
                            <a href="#" id="save_note_btn" class="btn btn-sm btn-white text-black font-weight-bold"
                                style="margin-right: 7px">Save
                                Note</a>
                            <a href="{{ route('user.send_note', $material->id) }}" onclick="shiNew(event)" data-type="dark" data-size="s"
                                data-title="Send Note" class="btn btn-sm btn-white text-black font-weight-bold">Send
                                Note</a>
                        </div>
                    </div>
                    <div class="card-body p-0 card-margin">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom-0 pb-1">
                                    {{-- <h4 class="card-title font-weight-bold h2" style="text-transform:initial;">Note One</h4> --}}
                                    <div class="card-options">
                                        <a href="javascript:void(0);"
                                            class="btn btn-sm font-weight-bold">{{ date('d M, Y') }}</a>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    {{-- <h4 class="font-weight-bold h5">The Introduction to Business Law</h4> --}}
                                    {{-- <div class="editable editable-title h5 font-weight-bold" contenteditable="true"
                                        placeholder="Note Title...." id="note-title"></div>
                                    <div class="editable" contenteditable="true" id="note-content"
                                        placeholder="Write note...."></div> --}}
                                    <form class="validate-form" id="save_note_form" method="POST" action="">
                                        @csrf
                                        <input type="text" class="note-input" id="note-title" value="{{ $note->title ?? null }}" name="title"
                                            placeholder="Note Title...." required>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        <textarea class="note-textarea" required id="note-content" name="content" placeholder="Write note....">{{ $note->content ?? null }}</textarea>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {{ asset($material->file->url) }} --}}
        <script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
        <script type="text/javascript">
            const previewConfig = {
                showAnnotationTools: false,
                showDownloadPDF: false,
                showPrintPDF: false,
                enableSearchAPIs: true,
                // hasReadOnlyAccess: true
            }
            const allowTextSelection = false;

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

            function saveNote(params) {
                const content = sessionStorage.getItem('note-content');
                const title = sessionStorage.getItem('note-title');
                console.log(content, title);
            }


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

            var noteForm = document.getElementById("save_note_form");
            document.getElementById("save_note_btn").addEventListener("click", function() {
                noteForm.submit();
            });

            $(function() {
                $('.validate-form').parsley().on('field:validated', function() {
                    var ok = $('.parsley-error').length === 0;
                    $('.bs-callout-info').toggleClass('hidden', !ok);
                    $('.bs-callout-warning').toggleClass('hidden', ok);
                })
            });
        </script>
    @endsection
