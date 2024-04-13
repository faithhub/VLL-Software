<script src="{{ asset('assets/dashboard/plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/sidemenu/sidemenu.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/p-scrollbar/p-scroll1.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/p-scrollbar/p-scroll.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/dashboard.sampledata.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/chart.flot.sampledata.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/chart/chart.bundle.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/chart/utils.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/apexcharts.js') }}"></script>
<!--INTERNAL Moment js-->
<script src="{{ asset('assets/dashboard/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/DataTables/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/DataTables/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/Responsive/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/select2.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/uploads/upload.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/rounded-barchart.js') }}"></script>
<!--INTERNAL Index js-->
<script src="{{ asset('assets/dashboard/js/index1.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/themeColors.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/custom.js') }}"></script>
<script src="{{ asset('assets/dashboard/switcher/js/switcher.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/shi.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/quill/quill.min.js') }}"></script> --}}

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script src="https://parsleyjs.org/dist/parsley.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<!-- Main Quill library -->
<script src='https://www.google.com/recaptcha/api.js'></script>
{{-- <script src="//cdn.quilljs.com/1.0.0/quill.js"></script> --}}
<script src="//cdn.quilljs.com/1.0.0/quill.min.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<script type="text/javascript">
    window.addEventListener('keydown', function(e) {

        if (e.ctrlKey == true && (e.which == '80')) {
            e.preventDefault();
            alert('You can\'t print W');
        }
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            alert('You can\'t print M');
        }
    });
</script>
<script>

    if (location.hash) {
        $('a[href=\'' + location.hash + '\']').tab('show');
    }
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('a[href="' + activeTab + '"]').tab('show');
    }

    $('body').on('click', 'a[data-toggle=\'tab\']', function(e) {
        e.preventDefault()
        var tab_name = this.getAttribute('href')
        if (history.pushState) {
            history.pushState(null, null, tab_name)
        } else {
            location.hash = tab_name
        }
        localStorage.setItem('activeTab', tab_name)

        $(this).tab('show');
        return false;
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        if (location.hash) {
            $("a[href='" + location.hash + "']").tab("show");
        }
        $(document.body).on("click", "a[data-toggle='tab']", function(event) {
            location.hash = this.getAttribute("href");
        });

    });

    $(window).on("popstate", function() {
        var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
        $("a[href='" + anchor + "']").tab("show");
    });


    $(function() {
        'use strict'
        const ps = new PerfectScrollbar('#ChatList', {
            useBothWheelAxes: false,
            suppressScrollX: false,
        });
        const ps2 = new PerfectScrollbar('#ChatList2', {
            useBothWheelAxes: false,
            suppressScrollX: false,
        });
        const ps1 = new PerfectScrollbar('#ChatBody', {
            useBothWheelAxes: false,
            suppressScrollX: false,
        });

        $('[data-bs-toggle="tooltip"]').tooltip();

    });


    $(document).ready(function() {
        $(".select").select2({});
    });




    $(function() {
        $('.validate-form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        // .on('form:submit', function() {
        //     return false; // Don't submit form for this demo
        // });
    });
</script>
