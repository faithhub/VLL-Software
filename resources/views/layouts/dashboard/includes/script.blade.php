<script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
<script type="text/javascript"></script> <!-- Bootstrap5 js-->
<script src="{{ asset('assets/dashboard/plugins/bootstrap/popper.min.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/sidemenu/sidemenu.js') }}"></script>
<script type="text/javascript"></script> <!-- P-scroll js-->
<script src="{{ asset('assets/dashboard/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/p-scrollbar/p-scroll1.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/p-scrollbar/p-scroll.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/flot/jquery.flot.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/flot/jquery.flot.pie.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/js/dashboard.sampledata.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/js/chart.flot.sampledata.js') }}"></script>
<script type="text/javascript"></script> <!-- INTERNAL Chart js -->
<script src="{{ asset('assets/dashboard/plugins/chart/chart.bundle.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/chart/utils.js') }}"></script>
<script type="text/javascript"></script> <!-- INTERNAL Apexchart js -->
<script src="{{ asset('assets/dashboard/js/apexcharts.js') }}"></script>
<script type="text/javascript"></script>
<!--INTERNAL Moment js-->
<script src="{{ asset('assets/dashboard/plugins/moment/moment.js') }}"></script>
<script type="text/javascript"></script> <!-- INTERNAL Data tables -->
<script src="{{ asset('assets/dashboard/plugins/datatables/DataTables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/DataTables/js/dataTables.bootstrap5.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/Responsive/js/responsive.bootstrap5.min.js') }}"></script>
<script type="text/javascript"></script> <!-- INTERNAL Select2 js -->
<script src="{{ asset('assets/dashboard/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/select2.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/rounded-barchart.js') }}"></script>
<!--INTERNAL Index js-->
<script src="{{ asset('assets/dashboard/js/index1.js') }}"></script>
<script type="text/javascript"></script> <!-- Color theme js -->
<script src="{{ asset('assets/dashboard/js/themeColors.js') }}"></script>
<script type="text/javascript"></script> <!-- Custom js-->
<script src="{{ asset('assets/dashboard/js/custom.js') }}"></script>
<script type="text/javascript"></script> <!-- Switcher js -->
<script src="{{ asset('assets/dashboard/switcher/js/switcher.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --}}

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $("select").select2({});

		$(".tm-input").tagsManager({
    tagsContainer: '.tags-show',});
    });


    function viewPassword(data) {
        try {
            var p = $(data).closest("div.mb-3").find("input[name=privacy_code]");
            var cp = $(data).closest("div.mb-3").find("input[name=password_confirmation]");
            var v = null;
            console.log(p, cp, v);
            if (p.length > 0) {
                v = p;
            } else if (cp.length > 0) {
                v = cp;
            } else {
                return false
            }

            if (v[0].name == "privacy_code" || v[0].name == "password_confirmation") {
                const password = document.querySelector('#' + v[0].id);
                const type = password.getAttribute('type');
                switch (type) {
                    case 'password':
                        $('#' + v[0].id).get(0).type = 'text';
                        $(data).addClass('fa-eye-slash');
                        break;
                    case 'text':
                        $('#' + v[0].id).get(0).type = 'password';
                        $(data).removeClass('fa-eye-slash');
                        break;
                    default:
                        break;
                }
            }
        } catch (error) {
            console.log(error);
        }
    }
    // });
</script>
