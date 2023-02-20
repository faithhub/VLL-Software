<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<!--Favicon -->
<link rel="icon" href="" type="image/x-icon" />
<!--Bootstrap css -->
<link href="{{ asset('assets/dashboard/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Style css -->
<link href="{{ asset('assets/dashboard/css/style.css') }}" rel="stylesheet" /> <!-- Plugin css -->
<link href="{{ asset('assets/dashboard/css/plugins.css') }}" rel="stylesheet" /> <!-- Animate css -->
<link href="{{ asset('assets/dashboard/css/animated.css') }}" rel="stylesheet" />
<!---Icons css-->
<link href="{{ asset('assets/dashboard/css/icons.css') }}" rel="stylesheet" /> <!-- INTERNAL Switcher css -->
<link href="{{ asset('assets/dashboard/switcher/css/switcher.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/dashboard/switcher/demo.css') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<!-- Theme included stylesheets -->

{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<style type="text/css">
    .form-check-input:checked {
        background-color: var(--primary-bg-color);
        border-color: var(--primary-bg-color);
    }

    .parsley-required {
        color: red !important;
        letter-spacing: 2px !important;
        display: block !important;
        font-weight: 800 !important;
    }

    input,
    textarea {
        -webkit-touch-callout: default;
        -webkit-user-select: auto;
        -khtml-user-select: auto;
        -moz-user-select: text;
        -ms-user-select: text;
        user-select: text
    }

    * {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: -moz-none;
        -ms-user-select: none;
        user-select: none
    }

    .field-icon {
        float: right;
        margin-right: 10px !important;
        margin-top: -35px;
        position: relative;
        cursor: pointer;
        z-index: 2;
    }

    .fa-fw {
        text-align: center;
        width: 1.25em;
        font-size: 18px;
        color: black;
    }

    .image_big_div {
        height: 250px;
    }
    

    .card-note {
        box-shadow: 0 0.76rem 1.52rem rgb(18 38 63 / 16%);
    }

    .search-text {
        background-color: #1d355747 !important;
    }

    /* #image_big_div {
        background-color: green;
        padding: 2px;
        width: 100px;
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        transform: rotate(-45deg);
        position: absolute;
        top: 15px;
        left: -25px;

        font-size: 12px;
        text-align: center;
    } */
    #image_big_div {
        position: fixed;
        inset: 0 auto auto 0;
        background: #08769b;
        transform-origin: 100% 0;
        /* or top left */
        transform: translate(-29.3%) rotate(-45deg);
    }

    .ribbon-holder {
        overflow: hidden;
        position: relative
    }

    .ribbon {
        font-weight: 800;
        font-family: system-ui;
        position: absolute;
        text-transform: uppercase;
        transform: rotate(-45deg);
        text-align: center;
        top: 25px;
        left: -32px;
        width: 145px;
    }

    .ribbon-rented {
        background: red;
        color: white;
    }

    .ribbon-bought {
        background: #457B9D;
        color: white;
    }

    .ribbon-free {
        background: #457B9D;
        color: white;
    }
</style>
