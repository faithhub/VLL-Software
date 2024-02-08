<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    {{-- <link rel="stylesheet" href="styles.css"> --}}
    <style>
        /* styles.css */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    <div id="adobe-dc-view"></div>
    <script src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>
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

        document.addEventListener("adobe_dc_view_sdk.ready", function() {
            var adobeDCView = new AdobeDC.View({
                clientId: "6dfef512955e46eca21b5e9545cd9ce5",
                divId: "adobe-dc-view"
            });
            var previewFilePromise = adobeDCView.previewFile({
                content: {
                    location: {
                        url: "https://virtuallawlibrary.com/storage/materials/files/MaterialFile1707398646.pdf"
                    }
                },
                metaData: {
                    fileName: "Bodea Brochure.pdf"
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
    </script>

    {{-- <script src="script.js"></script> --}}
    <script>
        // script.js
        document.getElementById("login-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission

            // Perform your login logic here, e.g., validate credentials, make API calls, etc.

            // For demonstration purposes, let's just log the entered username and password
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            console.log("Username:", username);
            console.log("Password:", password);
        });
    </script>
</body>

</html>
