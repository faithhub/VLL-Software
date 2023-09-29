  <script>
        var viewerContainer = document.getElementById('pdfviewer')
        // var license = "{{ config('PDFVIEWERAPI') }}"; // your license key
        var license = "<4H,V4,VIEWWEB,DGA6S99DV8P1DKA7HSS0K9C>"; // your license key
        // use default options
        // const options = {}
        var options = {
            viewer: {
                general: {
                    user: 'Jane Average',
                    language: 'en',
                    annotationBarPosition: 'left',
                    promptOnUnsavedChange: true,
                    searchMatchColor: '#3ABCFF',
                    textSelectionColor: '#006395',
                    viewOnly: true,
                    pageLayoutModes: [
                        PdfTools.PdfPageLayoutMode.ONE_COLUMN,
                        PdfTools.PdfPageLayoutMode.SINGLE_PAGE,
                        PdfTools.PdfPageLayoutMode.TWO_COLUMN_LEFT,
                        PdfTools.PdfPageLayoutMode.TWO_COLUMN_RIGHT,
                        PdfTools.PdfPageLayoutMode.TWO_PAGE_LEFT,
                        PdfTools.PdfPageLayoutMode.TWO_PAGE_RIGHT,
                    ],
                },
                permissions: {
                    allowFileDrop: false,
                    allowOpenFile: false,
                    allowSaveFile: false,
                    enableSearch: true,
                    allowPrinting: false,
                    allowCopyText: false
                },
                sidebar: {
                    annotationNavigation: true,
                    outlineNavigation: true,
                    thumbnailNavigation: true,
                },
                callbacks: {
                    /*****
                     * EXAMPLE: Custom event handlers for open and save.
                     *****/
                    // onOpenFileButtonClicked: () => {
                    //   alert('open file button clicked')
                    //   viewer.open()
                    // },
                    // onSaveFileButtonClicked: () => {
                    //   alert('close file button clicked')
                    //   viewer.save().then( res => console.log(res))
                    // },
                },
            },
            shortcuts: {
                print: {
                    key: 'p',
                    ctrlKey: false
                },
                copy: {
                    key: 'c',
                    ctrlKey: false
                },
                print: {
                    key: 'p',
                    ctrlKey: false
                }
            },
            annotation: {
                colors: {
                    highlightColors: ['#2ADB1A', '#FFEA02', '#FF7F1F', '#FF2882', '#008AD1'],
                    foregroundColors: ['#323232', '#FFFFFF', '#FFEA02', '#2ADB1A', '#0066CC', '#D82F32'],
                    backgroundColors: [
                        'transparent',
                        '#FFFFFF',
                        '#FCF5E2',
                        '#323232',
                        '#FFEA02',
                        '#D82F32',
                        '#0066CC',
                        '#ff000055',
                    ],
                    defaultHighlightColor: '#FFEA02',
                    defaultBackgroundColor: '#FCF5E2',
                    defaultForegroundColor: '#323232',
                },
                stamps: [
                    // { text: 'APPROVED', color: PdfTools.StampAnnotationColor.GREEN },
                    // { text: 'NOT APPROVED', color: PdfTools.StampAnnotationColor.RED },
                    // { text: 'DRAFT', color: PdfTools.StampAnnotationColor.BLUE },
                    // { text: 'FINAL', color: PdfTools.StampAnnotationColor.GREEN },
                    // { text: 'COMPLETED', color: PdfTools.StampAnnotationColor.GREEN },
                    // { text: 'CONFIDENTIAL', color: PdfTools.StampAnnotationColor.BLUE },
                    // { text: 'FOR PUBLIC RELEASE', color: PdfTools.StampAnnotationColor.BLUE },
                    // { text: 'NOT FOR PUBLIC RELEASE', color: PdfTools.StampAnnotationColor.BLUE },
                    // { text: 'VOID', color: PdfTools.StampAnnotationColor.RED },
                    // { text: 'FOR COMMENT', color: PdfTools.StampAnnotationColor.BLUE },
                    // { text: 'PRELIMINARY RESULTS', color: PdfTools.StampAnnotationColor.BLUE },
                    // { text: 'INFORMATION ONLY', color: PdfTools.StampAnnotationColor.BLUE },
                ],
                selectedStamp: 0,
                highlightOpacity: 0.5,
                defaultBorderWidth: 1.0,
                fonts: {
                    fontFamilies: ['Helvetica', 'Times', 'Courier', 'Symbol', 'ZapfDingbats'],
                    fontSizes: [9, 10, 12, 14, 16, 18, 20, 24],
                    defaultFontSize: 12,
                    defaultFontFamily: 'Helvetica',
                },
                strokeWidths: [0, 1, 2, 3, 5, 8, 13, 21],
                defaultStampWidth: 120,
                hideOnDelete: false,
                trackHistory: false,
                onlyAuthorCanEdit: true,
            },
            modules: [
                PdfTools.PopupModule,
                PdfTools.TextAnnotationModule,
                PdfTools.InkAnnotationModule,
                PdfTools.FreetextAnnotationModule,
                PdfTools.HighlightAnnotationModule,
                PdfTools.StampAnnotationModule,
                PdfTools.ShapeAnnotationModule,
                PdfTools.ImageAnnotationModule,
            ],
        }

        var viewer = new PdfTools.PdfWebViewer(viewerContainer, license, options)

        viewer.addEventListener('appLoaded', function() {
            /*****
             * EXAMPLE: Open PDF document from a URL.
             *****/
            viewer.open({
                uri: '{{ asset($material->file->url) }}'
            })
            /*****
             * EXAMPLE: using Fetch.
             *****/
            // fetch('http://url/to/a/pdf/sample.pdf').then( data => {
            //   data.blob().then( blob => {
            //     viewer.open({data: blob})
            //   })
            // }).catch( error => {
            //   console.log(error.target.status)
            // })
        })


        //   viewer.addEventListener('documentLoaded', (file) => {
        //     console.log('*** document loaded ***')
        //     console.log('version       : ' + viewer.getProductVersion())
        //     console.log('name          : ' + file.name)
        //     console.log('size          : ' + Math.floor(file.size / 1024) + 'kb')
        //     console.log('last modified : ' + file.lastModified)
        //     console.log('type          : ' + file.type)
        //   })
    </script>