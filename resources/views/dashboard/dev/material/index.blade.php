
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
                clientId: "{{ getenv('ADOBECLIENTIDNEW') }}",
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
