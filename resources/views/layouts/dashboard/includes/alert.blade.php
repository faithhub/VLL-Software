<div class="flash-container">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script>
        @if (Session::has('info'))
            toastr.info("{{ session('error') }}");
        @elseif (Session::has('success'))
            toastr.success("{{ session('success') }}", "Success");
        @elseif (Session::has('error'))
            toastr.error("{{ session('error') }}", "Something Went Wrong!");
        @elseif (Session::has('warning'))
            toastr.warning("{{ session('warning') }}", "Try Again!");
        @elseif (Session::has('status'))
            toastr.success("{{ session('status') }}", "Success");
        @elseif (Session::has('permission_warning'))
            toastr.warning("{{ session('permission_warning') }}", "Warning!");
        @endif
    </script>
</div>
