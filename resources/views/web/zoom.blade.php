<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Virtual Law Library Dashboard" name="description">
    <meta content="" name="author">
    <meta name="keywords" content="Virtual Law Library dashboard">
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.10.1/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.10.1/css/react-select.css" />
    <link rel="icon" type="image/png" href="{{ asset('assets/web/logo/vll-b.png') }}">
    <!-- Link of CSS files -->
    <style>
        #zoom-container {
            width: 600px;
            height: 600px;
        }
    </style>
    <title>Virtual Law Library - {{ $title ?? '' }}</title>
</head>

<body class="ReactModal__Body--open">

    <!-- added on import -->
    <div id="zmmtg-root"></div>
    <div id="aria-notify-area"></div>

    <!-- added on meeting init -->
    <div class="ReactModalPortal"></div>
    <div class="ReactModalPortal"></div>
    <div class="ReactModalPortal"></div>
    <div class="ReactModalPortal"></div>
    <div class="global-pop-up-box"></div>
    <div class="sharer-controlbar-container sharer-controlbar-container--hidden"></div>

    <script src="https://source.zoom.us/2.10.1/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.10.1/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.10.1/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.10.1/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.10.1/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-2.10.1.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-embedded-2.10.1.min.js"></script>

    <script>
        ZoomMtg.setZoomJSLib('https://dmogdx0jrul3u.cloudfront.net/2.10.1/lib', '/av');
        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareJssdk();

        const zoomMeeting = {
            meetingNumber: '{{$meeting->MTID}}',
            userName: '{{Auth::user()->name ?? Auth::user()->email}}',
            passWord: '{{$meeting->password}}',
            leaveUrl: '{{url("/")}}',
            role: 0, // 0 for attendee, 1 for host
        };

        const signature = ZoomMtg.generateSDKSignature({
            meetingNumber: zoomMeeting.meetingNumber,
            sdkKey: "{{$settings['zoom_client_id']}}",
            sdkSecret: "{{$settings['zoom_client_secret']}}", // replace with your Zoom API secret
            role: zoomMeeting.role,
            success: function(res) {
                console.log('Signature:', res.result);
            },
            error: function(res) {
                console.error('Error signature meeting:', res);
            },
        });

        ZoomMtg.init({
            leaveUrl: zoomMeeting.leaveUrl,
            isSupportAV: true,
            success: function() {
                ZoomMtg.join({
                    meetingNumber: zoomMeeting.meetingNumber,
                    userName: zoomMeeting.userName,
                    sdkKey: "{{$settings['zoom_client_id']}}",
                    userEmail: '{{Auth::user()->email}}',
                    passWord: zoomMeeting.passWord,
                    signature: signature,
                    success: function(res) {
                        console.log('Meeting joined successfully:', res);
                    },
                    error: function(res) {
                        console.error('Error joining meeting:', res);
                    },
                });
            },
            error: function(res) {
                console.error('Zoom initialization error:', res);
            },
        });
    </script>
</body>
</html>