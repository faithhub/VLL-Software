<script src="{{ asset('assets/web/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/web/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/web/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/web/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/web/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/web/js/jquery.mixitup.min.js') }}"></script>
<script src="{{ asset('assets/web/js/form-validator.min.js') }}"></script>
<script src="{{ asset('assets/web/js/contact-form-script.js') }}"></script>
<script src="{{ asset('assets/web/js/main.js') }}"></script>
<script src="https://parsleyjs.org/dist/parsley.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --}}

<script type="text/javascript">
    // $('.selectpicker').selectpicker('val', 'Mustard');
    // $('.selectpicker').selectpicker();
    // $('.selectpicker').selectpicker('val', 'All');
    // $(function() {
    //     $('select').selectpicker();
    // });
    window.Parsley.addValidator("requiredIf", {
        validateString: function(value, requirement) {
            if (jQuery(requirement).val()) {
                console.log(requirement.val(), value);
                return !!value;
            }

            return true;
        },
        priority: 33
    })

    function checkUniversities(data) {
        if (data.name == "type" && data.value == "student") {
            // document.getElementById("universities_id").style.display = "block"
            document.getElementById("universities").required = true;
            document.getElementById("universities").removeAttribute("disabled");
        } else if (data.name == "type" && data.value == "professionals") {
            document.getElementById("universities").required = false;
            // document.getElementById("universities_id").style.display = "none"
            document.getElementById("universities").setAttribute("disabled", "disabled");
        } else {
            document.getElementById("universities").required = false;
            // document.getElementById("universities_id").style.display = "none"
            document.getElementById("universities").setAttribute("disabled", "disabled");

        }
    }

    var type = "{{ old('form_type') }}";
    switchForm(type);

    function switchForm(type) {
        console.log(type)
        switch (type) {
            case "user":
                document.getElementById("user-form-tab").classList.add('outerdiv-active');
                document.getElementById("vendor-form-tab").classList.add('outerdiv');
                document.getElementById("user-form-tab").classList.remove('outerdiv');
                document.getElementById("vendor-form-tab").classList.remove('outerdiv-active');
                document.getElementById("vendor-form").style.display = "none"
                document.getElementById("user-form").style.display = "block"
                break;
            case "vendor":
                document.getElementById("user-form-tab").classList.remove('outerdiv-active');
                document.getElementById("vendor-form-tab").classList.remove('outerdiv');
                document.getElementById("user-form-tab").classList.add('outerdiv');
                document.getElementById("vendor-form-tab").classList.add('outerdiv-active');
                document.getElementById("user-form").style.display = "none"
                document.getElementById("vendor-form").style.display = "block"

                break;

            default:
                break;
        }
    }

    checkVendorTypeOnLoad()

    function checkVendorTypeOnLoad() {
        if (document.getElementById('inlineRadio001').checked) {
            document.getElementById("vendor_name").placeholder = "Full Name";
        } else if (document.getElementById('inlineRadio002').checked) {
            document.getElementById("vendor_name").placeholder = "Company's Name";
        } else {
            document.getElementById("vendor_name").placeholder = "Full Name";

        }
    }

    function checkVendorType(type) {
        console.log(type.value)
        switch (type.value) {
            case "entity":
                document.getElementById("vendor_name").placeholder = "Full Name";
                break;
            case "company":
                document.getElementById("vendor_name").placeholder = "Company's Name";
                break;
            default:
                document.getElementById("vendor_name").placeholder = "Full Name";
                break;
        }
    }

    $(function() {
        $('#user_signup_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            console.log($('.parsley-error').length)
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        // .on('form:submit', function() {
        //     return false; // Don't submit form for this demo
        // });

        $('#vendor_signup_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        // .on('form:submit', function() {
        //     return false; // Don't submit form for this demo
        // });

        $('#login_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        // .on('form:submit', function() {
        //     return false; // Don't submit form for this demo
        // });
    });
</script>
