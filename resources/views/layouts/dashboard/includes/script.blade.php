<script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js"
    integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.slim.js"
    integrity="sha512-M3zrhxXOYQaeBJYLBv7DsKg2BWwSubf6htVyjSkjc9kPqx7Se98+q1oYyBJn2JZXzMaZvUkB8QzKAmeVfzj9ug=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.slim.min.js"
    integrity="sha512-jxwTCbLJmXPnV277CvAjAcWAjURzpephk0f0nO2lwsvcoDMqBdy1rh1jEwWWTabX1+Grdmj9GFAgtN22zrV0KQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{ asset('assets/dashboard/plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/sidemenu/sidemenu.js') }}"></script>
{{-- <script src="{{ asset('assets/dashboard/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/p-scrollbar/p-scroll1.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/p-scrollbar/p-scroll.js') }}"></script> --}}
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
{{-- <script src="https://spruko.com/demo/azea/Azea/assets/js/form-editor2.js"></script>
<script src="https://spruko.com/demo/azea/Azea/assets/js/form-editor.js"></script>
<script src="https://spruko.com/demo/azea/Azea/assets/plugins/wysiwyag/jquery.richtext.js"></script> --}}

<script src="https://parsleyjs.org/dist/parsley.min.js"></script>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
<!-- Main Quill library -->
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
    // $(document).bind("contextmenu", function(e) {
    //     e.preventDefault();
    // });

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

        $(".tm-input").tagsManager({
            tagsContainer: '.tags-show',
        });
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

    function viewPassword(data) {
        try {
            var cpp = $(data).closest("div.mb-3").find("input[name=current_password]");
            var p = $(data).closest("div.mb-3").find("input[name=new_password]");
            var cp = $(data).closest("div.mb-3").find("input[name=confirm_new_password]");
            var v = null;
            console.log(p, cp, v);
            if (p.length > 0) {
                v = p;
            } else if (cp.length > 0) {
                v = cp;
            } else if (cpp.length > 0) {
                v = cpp;
            } else {
                return false
            }

            if (v[0].name == "current_password" || v[0].name == "new_password" || v[0].name == "confirm_new_password") {
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
        $('.validate-form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        // .on('form:submit', function() {
        //     return false; // Don't submit form for this demo
        // });
    });

    $(document).ready(function() {
        $('.materialTypeTable').on('click', '.updateStatus', function() {
            var empid = $(this).attr('data-id');
            var value = "disabled";
            if (document.querySelector('.messageCheckbox' + empid).checked) {
                value = "disabled";
            } else {
                value = "active";
            }

            // AJAX request
            var url = "";
            url = url.replace(':empid', empid);
            url = url.replace(':value', value);
            $.ajax({
                url: url,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.value) {
                        toastr.success("Material Status Activated", "Success");
                    } else if (!response.value) {
                        toastr.success("Material Status Disbled", "Success");

                    }
                }
            });
        });

        $('.subjectTypeTable').on('click', '.updateStatus', function() {
            var empid = $(this).attr('data-id');
            var value = "disabled";
            if (document.querySelector('.messageCheckbox' + empid).checked) {
                value = "disabled";
            } else {
                value = "active";
            }

            // AJAX request
            var url = "";
            url = url.replace(':empid', empid);
            url = url.replace(':value', value);
            $.ajax({
                url: url,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.value) {
                        toastr.success("Subject Type Status Activated", "Success");
                    } else if (!response.value) {
                        toastr.success("Subject Type Status Disbled", "Success");

                    }
                }
            });
        });


        $('.materialTypeTable').on('click', '.editDetails', function() {
            var empid = $(this).attr('data-id');

            if (empid > 0) {

                // AJAX request
                var url = "{{ route('admin.view_material', [':empid']) }}";
                url = url.replace(':empid', empid);

                // Empty modal data
                //  $('#tblempinfo tbody').empty();
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == false) {
                            alert("No record found");
                        }

                        console.log(response.material_type, response.material_type.role);
                        // Add employee details


                        function checkStatus(data, param) {
                            if (data == param) {
                                return "checked";
                            }
                        }

                        function checkBox(data, param) {
                            if (data.includes(param)) {
                                return "checked";
                            }
                        }
                        $('.formViewMat').html(`         
                                @csrf <div
                                    class='row'>
                                    <input type="hidden" value="${response.material_type.id}" name="id">
                                    <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                                        <div class='form-group'> <label class='form-label'>Material Type</label> <input type='text'
                                                class='form-control' placeholder='Material Type' value='${response.material_type.name}' name='name'
                                                required='' data-parsley-required-message='Material Type is required'>
                                        </div>
                                    </div>
                                    <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                                        <div class='form-group'> <label class='form-label'>Description</label>
                                            <textarea name='description' class='form-control' rows='5' required=''
                                                data-parsley-required-message='Description is required'>${response.material_type.description}</textarea>
                                        </div>
                                    </div>
                                    <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'> <label class='form-label'>User role</label>
                                        <div class='d-flex' style='margin-bottom:-10px'>
                                            <div class='form-check form-check-inline'> <input class='form-check-input' name='role[]'
                                                   ${checkBox(response.material_type.role, 'admin')} type='checkbox' id='inlineCheckbox1'
                                                    value='admin' required='' data-parsley-errors-container='#role-error'
                                                    data-parsley-required-message='User role is required'> <label class='form-check-label'
                                                    for='inlineCheckbox1'>Admin</label> </div>
                                            <div class='form-check form-check-inline'> <input class='form-check-input' name='role[]'
                                                    ${checkBox(response.material_type.role, 'vendor')} type='checkbox' id='inlineCheckbox2'
                                                    value='vendor'> <label class='form-check-label' for='inlineCheckbox2'>Vendor</label> </div>
                                        </div>
                                        <span class='invalid-feedback' id='role-error' role='alert'> </span>
                                    </div>
                                </div>
                                <div class='col-lg-12 col-xl-12 text-center mt-1'> <button class='btn btn-primary'
                                        style='font-size: 15px'>Update</button> </div>
                         `);

                        // $('.formViewMat').html("<h2>hgjsv</h2>")
                        //  // Display Modal
                        $('#editMaterial').modal('show');
                    }
                });
            }
        });

    });
</script>
