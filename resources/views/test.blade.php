{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Testing 1 2</h1>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>
    <p>If you want to prevent others from stealing content off your website, you can do so to an extent with the help of
        CSS, JavaScript, and jQuery. In this article, you'll learn how to disable text selection, cut, copy, paste, and
        right-click on a web page.</p>

    <textarea>

    </textarea>

</body>
<script>
    // document.addEventListener("visibilitychange", function() {
    //     if (document.hidden) {
    //         //do whatever you want
    //         console.log("New Tab");
    //         copyText()
    //         // navigator.clipboard.readText()
    //         //     .then(text2 => {
    //         //         console.log(text2, "New Tab");
    //         //         // text2 = null
    //         //         // console.log(text2);
    //         //     }).catch(err => {
    //         //         console.log(err)
    //         //     })
    //     } else {
    //         //do whatever you want
    //         console.log("Current Tab");
    //         copyText()
    //         // navigator.clipboard.readText()
    //         //     .then(text => {
    //         //         console.log(text, "Current Tab");
    //         //     }).catch(err => {
    //         //         console.log(err)
    //         //     })
    //     }
    // });

    function getSelectionText() {
        var selectedText = ""
        if (window.getSelection) { // all modern browsers and IE9+
            selectedText = window.getSelection().toString()
        }
        return selectedText
    }

    document.addEventListener('mouseup', function() {
        var thetext = getSelectionText()
        if (thetext.length > 0) { // check there's some text selected
            console.log(thetext) // logs whatever textual content the user has selected on the page
        }
    }, false)

    async function copyText() {
        var url = "prompt()";
        var data = await navigator.clipboard.readText()
        console.log(url, data)



    }
</script>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <script type="text/javascript">
        /*
            path to the directory containing the PDF Web Viewer scripts, webassemblies and translations.
            The path can be absolute or relative to the current document and must be defined before the viewer is loaded
          */
        window.PDFTOOLS_FOURHEIGHTS_PDFVIEWING_BASEURL = "/pdfwebviewer/"
    </script>

    <!-- stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('pdfwebviewer/pdf-web-viewer.css') }}" />

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style>

    <!-- pdf viewer script, for development you can  -->
    <script src="{{ asset('pdfwebviewer/pdf-web-viewer.min.js') }}"></script>

    <title>PDF Web Viewer</title>
</head>

<body>
    <!--
      HTM element containing the PdfWebViewer.
      The viewer has the same size as the parent html element
    -->
    <div id="pdfviewer" style="height: 100vh; width: 100vw"></div>

  @include('layouts.dashboard.includes.pdf-tool-reader')
</body>

</html>
