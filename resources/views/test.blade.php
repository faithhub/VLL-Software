<!DOCTYPE html>
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

</html>
