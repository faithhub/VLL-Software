<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
<style>
    label>span.imp {
        color: red;
    }

    #custom-options {
        display: none;
    }

    #custom-select {
        /* width: 200px; */
        /* height: 30px; */
        /* border: 1px solid #ccc; */
        padding: 5px 10px;
        /* border-radius: 5px; */
        font-size: 16px;
        cursor: pointer;
    }

    #custom-options {
        list-style: none;
        margin: 0;
        padding: 0;
        /* border: 1px solid #ccc; */
        border-top: none;
        /* border-radius: 0 0 5px 5px; */
        position: absolute;
        width: 100%;
        z-index: 1;
        background-color: #fff;
        overflow-y: scroll;
        /* max-height: 150px; */
    }

    #custom-options li {
        padding: 5px 10px;
        cursor: pointer;
    }

    #custom-options li:hover {
        background-color: #f2f2f2;
    }

    #img-2 {
        position: absolute;
        justify-content: center;
        width: 10%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%)
    }

    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #eee;
        display: inline-block;
        height: 50px;
        cursor: pointer;
        color: #3b566e !important;
        font-weight: 700 !important;
        background-color: #f0f4f9 !important;
        padding: 12px 12px
    }

    .custom-file-upload:hover {
        color: #3b566e !important;
        font-weight: 700 !important;
        background-color: transparent !important
    }

    .select_folder {
        width: 700px !important
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        height: 55px !important;
    }



    .bootstrap-tagsinput .tag {
        /* margin-right: 2px; */
        color: #ffffff;
        background: var(--primary-bg-color);
        /* margin-bottom: 108px; */
        /* padding: 3px 7px; */
        border-radius: 3px;
        */
    }

    .bootstrap-tagsinput {
        height: 55px;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        color: gray !important;
        font-weight: 600;
        background-color: #f0f4f9;
        border: 1px solid #eee;
        border-radius: 3px;
    }

    .avatar-md {
        width: 5rem;
        height: 5rem;
    }

    .textarea {
        min-height: auto !important;
    }
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"
    integrity="sha512-lzilC+JFd6YV8+vQRNRtU7DOqv5Sa9Ek53lXt/k91HZTJpytHS1L6l1mMKR9K6VVoDt4LiEXaa6XBrYk1YhGTQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"
    integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
<script>
    $(document).ready(function() {
        $('.timepicker').timepicker({
            // timeFormat: 'h:mm p',
            // interval: 15,
            // minTime: '01',
            // maxTime: '12:00pm',
            // defaultTime: '1',
            // startTime: '10:00',
            // dynamic: true,
            // dropdown: true,
            // scrollbar: true
        });
    });
</script>
<script type="text/javascript">
    // var timezone = moment.tz.guess();
    const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $('#timezone').val(timezone);
    console.log(timezone, Intl.DateTimeFormat().resolvedOptions());

    $('#dateRangeNow').datepicker({
        multidateSeparator: ", ",
        todayHighlight: true,
        multidate: true,
        // controls: ['calendar', 'time'],
        format: 'dd-mm-yyyy'
    });


    $("#testing_select").bind('change', function() {
        var select = "";
        $("#testing_select option:selected").each(function() {
            select += "," + $(this).text();
        });
        if (select != "") {
            select = select.substr(1);
        }
        $("#testing_select").text(select);
    });

    $('#folder_cover2').bind('change', function() {
        if (this.files[0]) {
            var fileName = this.files[0].name;
            var fileSize = this.files[0].size;
            var size = parseFloat(fileSize / 1000).toFixed(0);
            document.getElementById('folder_cover2_img').src = window.URL.createObjectURL(this
                .files[0])
            $("#folder_cover2_name").text(fileName);
            $("#folder_cover2_size").text(`${size} KB`);
            document.getElementById('folder_cover2_preview').style.display = 'block';
        } else {
            document.getElementById('folder_cover2_preview').style.display = 'none';
        }
    });

    $('#master_class').bind('change', function() {
        if (this.files[0]) {
            var fileName = this.files[0].name;
            var fileSize = this.files[0].size;
            var size = parseFloat(fileSize / 1000).toFixed(0);
            document.getElementById('master_class_img').src = window.URL.createObjectURL(this
                .files[0])
            $("#master_class_name").text(fileName);
            $("#master_class_size").text(`${size} KB`);
            document.getElementById('master_class_preview').style.display = 'block';
        } else {
            document.getElementById('master_class_preview').style.display = 'none';
        }
    });


    $(document).ready(function() {
        // var otherDivE = document.getElementById("durationDiv");
        // var otherDivValue = otherDivE.options[otherDivE.selectedIndex].value;
        // console.log(otherDivValue, "jghvjgvjhv");
        // showfield();
        $("#durationDiv").change(function() {

            var value = $(this).val()
            console.log(value, "Myealuheruygjhvejhb");

            if (value == 'others') document.getElementById('otherDiv').style.display = 'block';
            else
                document.getElementById('otherDiv').style.display = 'none';
        }).change();

        $("#bookPriceSelect").change(function() {

            var value = $(this).val()

            switch (value) {
                case "Paid":
                    document.getElementById('paidDiv').style.display = 'block';
                    break;
                case "Free":
                    document.getElementById('paidDiv').style.display = 'none';
                    break;
                default:
                    document.getElementById('paidDiv').style.display = 'none';
                    break;
            }
        }).change();
    });

    // mobiscroll.setOptions({
    //     locale: mobiscroll.localeFr,
    //     theme: 'ios',
    //     themeVariant: 'light'
    // });



    // mobiscroll.momentTimezone.moment = moment;

    // $(function() {
    //     $('#demo-single-select-date')
    //         .mobiscroll()
    //         .datepicker({
    //             controls: ['calendar'],
    //             selectMultiple: false,
    //         });

    //     $('#demo-multiple-select-datetime')
    //         .mobiscroll()
    //         .datepicker({
    //             locale: mobiscroll.localeEn,
    //             controls: ['calendar'],
    //             dateFormat: 'YYYY-MM-DD',
    //             selectMultiple: true,
    //             selectMin: 1,
    //             selectCounter: true
    //         });

    //     // mobiscroll.momentTimezone.moment = moment;
    //     // $('#demo-single-select-time')
    //     //     .mobiscroll()
    //     //     .datepicker({
    //     //         controls: ['time'],
    //     //         dataTimezone: 'utc',
    //     //         displayTimezone: 'utc',
    //     //         // timezonePlugin: mobiscroll.momentTimezone,
    //     //     });
    // });
    $('.numericValue').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // function showfield(name) {
    //     console.log(name);
    //     if (name == 'others') document.getElementById('otherDiv').style.display = 'block';
    //     else
    //         document.getElementById('otherDiv').style.display = 'none';
    // }
</script>
<script src="http://parsleyjs.org/dist/parsley.js"></script>
<script>
    // var $selector = $('#signupForm'),
    //     form = $selector.parsley();

    // form.subscribe('parsley:form:success', function(e) {

    // });

    // $selector.find('button').click(function() {
    //     form.validate();
    // });
</script>
