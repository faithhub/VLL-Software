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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --}}
<script type="text/javascript">
    window.addEventListener('keydown', function(e) {

        if (e.ctrlKey == true && (e.which == '80')) {
            e.preventDefault();
            alert('You can\'t print Windows 1');
        }
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            alert('You can\'t print Mac');
        }
        if (e.keyCode === 80 && e.shiftKey && (e.ctrlKey || e.metaKey)) {
            // Pre browser print dialog
            e.preventDefault();
            alert('You can\'t print Windows 2');
            // Prevent dev tools command palette from opening
            e.stopPropagation();
        }
    });
</script>
<script>
    // $(document).bind("contextmenu", function(e) {
    //     e.preventDefault();
    // });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single-n').select2({
            placeholder: function() {
                $(this).data('placeholder');
            }
        });

        $('.js-example-basic-single-uni').select2({
            placeholder: function() {
                $(this).data('Select your Country');
            }
        });
        $('.js-example-basic-single-v-uni').select2({
            placeholder: function() {
                $(this).data('Select your Country');
            }
        });
        $('.js-example-basic-single-v-n').select2({
            placeholder: function() {
                $(this).data('Select your Country');
            }
        });

        $("#country").change(function() {
            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#universities option').clone());
            }
            var id = $(this).val();
            console.log($(this).data('options'));
            var options = $(this).data('options').filter('[data-value=' + id + ']');
            console.log(options, id)
            $('#universities').html(options);
        });

        $("#v-country").change(function() {
            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#v-universities option').clone());
            }
            var id = $(this).val();
            var options = $(this).data('options').filter('[data-value=' + id + ']');
            console.log(options, id)
            $('#v-universities').html(options);
        });
    });


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


    function viewPassword(data) {
        try {
            var p = $(data).closest("div.mb-3").find("input[name=password]");
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

            if (v[0].name == "password" || v[0].name == "password_confirmation") {
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
