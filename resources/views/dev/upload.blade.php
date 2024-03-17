<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF File</title>
</head>

<body>
{{-- 
    <h2>Upload PDF File</h2>

    <form action="{{ route('uploadPdf') }}" method="post" enctype="multipart/form-data">
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
        <input type="submit" value="Upload PDF">
    </form> --}}
    <div id="pspdfkit" style="height: 100vh"></div>
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

        PSPDFKit.load({
                container: "#pspdfkit",
                // document: "{{ asset('filename.pdf') }}", // Add the path to your document here.
                document: "{{ asset('storage/materials/files/MaterialFile1686685969.pdf') }}", // Add the path to your document here.
                // document: "https://virtuallawlibrary.com/storage/materials/files/MaterialFile1690612426.pdf", // Add the path to your document here.
                toolbarItems: arr2
            })
            .then(function(instance) {
                instance.setViewState((state) => state.set("allowPrinting", false));
                instance.setViewState(viewState => viewState.set('disablePointSnapping', false))
                instance.addEventListener("viewState.change", (viewState) => {
                    console.log(viewState.resolvedLayoutMode);
                });
                console.log("PSPDFKit loaded", instance);
            })
            .catch(function(error) {
                console.error(error.message);
            });
    </script>
    {{-- <iframe src="{{ asset('filename.pdf') }}" width='100%' height='100%' allowfullscreen webkitallowfullscreen></iframe> --}}

</body>

</html>
