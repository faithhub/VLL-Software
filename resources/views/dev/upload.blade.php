<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
    <title>Upload PDF File</title>
</head>

    <script type="text/javascript">
        /*
                            path to the directory containing the PDF Web Viewer scripts, webassemblies and translations.
                            The path can be absolute or relative to the current document and must be defined before the viewer is loaded
                          */
        window.PDFTOOLS_FOURHEIGHTS_PDFVIEWING_BASEURL = "/pdfwebviewer/"
    </script>

    <!-- stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('pdfwebviewer/pdf-web-viewer.css') }}" />

    <script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
<body>

    <h2>Upload PDF File</h2>

    <form action="{{ route('uploadPdf') }}" method="post" enctype="multipart/form-data">

        <div mbsc-page class="demo-single-select">
            <div style="height:100%">
                <label>
                    Date
                    <input id="demo-single-select-date" mbsc-input data-input-style="box" data-label-style="stacked"
                        placeholder="Please Select..." />
                </label>
                <label>
                    Date & time
                    <input id="demo-single-select-datetime" mbsc-input data-input-style="box" data-label-style="stacked"
                        placeholder="Please Select..." />
                </label>
                <label>
                    Date & timegrid
                    <input id="demo-single-select-timegrid" mbsc-input data-input-style="box" data-label-style="stacked"
                        placeholder="Please Select..." />
                </label>
            </div>
        </div>
        @csrf
        <input type="text" name="name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <br>
        <hr>
        <input type="file" name="pdfFile" accept=".pdf">
        @error('pdfFile')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <br>
        <hr>

        <div class="checkbox mb-3">
            <!-- The following line controls and configures the Turnstile widget. -->
            <div class="cf-turnstile" data-sitekey="{{ getenv('TURNSTILE_SITE_KEY') }}" data-theme="light"></div>
            <!-- end. -->
        </div>
        <input type="submit" value="Upload PDF">
    </form>
    {{-- <div id="pspdfkit" style="height: 100vh"></div> --}}
    <script src="{{ asset('assets/pspdfkit.js') }}"></script>
    <script>
        const objjj = [{
            type: 'sidebar-thumbnails'
        }, {
            type: 'sidebar-document-outline'
        }, {
            type: 'sidebar-annotations'
        }, {
            type: 'sidebar-bookmarks'
        }, {
            type: 'sidebar-signatures'
        }, {
            type: 'sidebar-layers'
        }, {
            type: 'pager'
        }, {
            type: 'multi-annotations-selection'
        }, {
            type: 'pan'
        }, {
            type: 'zoom-out'
        }, {
            type: 'zoom-in'
        }, {
            type: 'zoom-mode'
        }, {
            type: 'spacer'
        }, {
            type: 'annotate'
        }, {
            type: 'ink'
        }, {
            type: 'highlighter'
        }, {
            type: 'text-highlighter'
        }, {
            type: 'ink-eraser'
        }, {
            type: 'signature'
        }, {
            type: 'image'
        }, {
            type: 'stamp'
        }, {
            type: 'note'
        }, {
            type: 'text'
        }, {
            type: 'callout'
        }, {
            type: 'line'
        }, {
            type: 'link'
        }, {
            type: 'arrow'
        }, {
            type: 'rectangle'
        }, {
            type: 'ellipse'
        }, {
            type: 'polygon'
        }, {
            type: 'cloudy-polygon'
        }, {
            type: 'polyline'
        }, {
            type: 'document-editor'
        }, {
            type: 'document-crop'
        }, {
            type: 'search'
        }, {
            type: 'export-pdf'
        }, {
            type: 'debug'
        }, {
            type: 'custom'
        }];
        // const instance = await PSPDFKit.load(configuration);
        // const annotations = instance.getAnnotations(0);
        // const annotation = annotations.first();
        // const editedAnnotation = annotation.set("noPrint", true);
        // const updatedAnnotation = await instance.update(editedAnnotation);

        // editedAnnotation === updatedAnnotation; // => true
        const toolbarItems = PSPDFKit.defaultToolbarItems;

        var arr2 = [{
            type: 'sidebar-thumbnails'
        }, {
            type: 'pager'
        }, {
            type: 'search'
        }, {
            type: 'zoom-out'
        }, {
            type: 'zoom-in'
        }, {
            type: 'zoom-mode'
        }, {
            type: 'spacer'
        }, ];

        // PSPDFKit.load({
        //         container: "#pspdfkit",
        //         // document: "{{ asset('filename.pdf') }}", // Add the path to your document here.
        //         document: "{{ asset('materials/mat.pdf') }}", // Add the path to your document here.
        //         // document: "https://virtuallawlibrary.com/storage/materials/files/MaterialFile1690612426.pdf", // Add the path to your document here.
        //         toolbarItems: arr2
        //     })
        //     .then(function(instance) {
        //         instance.setViewState((state) => state.set("allowPrinting", false));
        //         instance.setViewState(viewState => viewState.set('disablePointSnapping', false))
        //         instance.addEventListener("viewState.change", (viewState) => {
        //             console.log(viewState.resolvedLayoutMode);
        //         });
        //         console.log("PSPDFKit loaded", instance);
        //     })
        //     .catch(function(error) {
        //         console.error(error.message);
        //     });
    </script>
    {{-- <iframe src="{{ asset('filename.pdf') }}" width='100%' height='100%' allowfullscreen webkitallowfullscreen></iframe> --}}
    <div id="adobe-dc-view" class="noprint" style="height: 80vh"></div>
</body>
    <script src="{{ asset('pdfwebviewer/pdf-web-viewer.min.js') }}"></script>
{{-- {{ asset('materials/mat.pdf') }} --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('date-time/js/mobiscroll.jquery.min.js') }}"></script>

<script type="text/javascript">
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
                        url: "{{ asset('materials/mat.pdf') }}"
                    }
                },
                metaData: {
                    fileName: "Title"
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


    mobiscroll.setOptions({
        locale: mobiscroll.localeFr,
        theme: 'ios',
        themeVariant: 'light'
    });

    $(function() {
        $('#demo-single-select-date')
            .mobiscroll()
            .datepicker({
                controls: ['calendar'],
                selectMultiple: false,
            });

        $('#demo-single-select-datetime')
            .mobiscroll()
            .datepicker({
                controls: ['calendar', 'time'],
                selectMultiple: false,
            });

        $('#demo-single-select-timegrid')
            .mobiscroll()
            .datepicker({
                controls: ['calendar', 'timegrid'],
                selectMultiple: false,
            });
    });
</script>

</html>


{{-- <!DOCTYPE html>
<html lang="en">
<head>
<title>Turnstile &dash; Dummy Login Demo</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/css/bootstrap.min.css" integrity="sha512-siwe/oXMhSjGCwLn+scraPOWrJxHlUgMBMZXdPe2Tnk3I0x3ESCoLz7WZ5NTH6SZrywMY+PB1cjyqJ5jAluCOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" integrity="sha512-5PV92qsds/16vyYIJo3T/As4m2d8b6oWYfoqV+vtizRB6KhF1F9kYzWzQmsO6T3z3QG2Xdhrx7FQ+5R1LiQdUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
<style>
html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #fefefe;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
</head>
<body>
<main class="form-signin">
  <form method="POST" action="/handler">
    <h2 class="h3 mb-3 fw-normal">Turnstile &dash; Dummy Login Demo</h2>

    <div class="form-floating">
      <input type="text" id="user" class="form-control">
      <label for="user">User name</label>
    </div>
    <div class="form-floating">
      <input type="password" id="pass" class="form-control" autocomplete="off" readonly value="CorrectHorseBatteryStaple">
      <label for="pass">Password (dummy)</label>
    </div>

    <div class="checkbox mb-3">
      <!-- The following line controls and configures the Turnstile widget. -->
      <div class="cf-turnstile" data-sitekey="0x4AAAAAAAWC5X6-eE3pi7V0" data-theme="light"></div>
      <!-- end. -->
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted"><a href="https://github.com/cloudflare/turnstile-demo-workers"><i class="bi bi-github"></i> See code</a></p>
    <p class="mt-5 mb-3 text-muted">Go to the <a href="/explicit">explicit render demo</a></p>
  </form>
</main>
</body>
</html> --}}
