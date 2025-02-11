<script type="text/javascript">
function checkUniversities(data) {
    if (data.name == "type" && data.value == "student") {
        // document.getElementById("universities_id").style.display = "block"
        document.getElementById("universities").required = true;
        document.getElementById("country").required = true;
        document.getElementById("universities").removeAttribute("disabled");
        document.getElementById("country").removeAttribute("disabled");
        document.getElementById("country_div").style.display = "block";
        document.getElementById("universities_id").style.display = "block";
    } else if (data.name == "type" && data.value == "professionals") {
        reset = document.getElementById("universities");
        reset.selectedIndex = -1;
        document.getElementById("universities").required = false;

        resetCountry = document.getElementById("country");
        resetCountry.selectedIndex = -1;
        document.getElementById("country").required = false;

        document
            .getElementById("universities")
            .setAttribute("disabled", "disabled");
        document.getElementById("country").setAttribute("disabled", "disabled");
        document.getElementById("country_div").style.display = "none";
        document.getElementById("universities_id").style.display = "none";
    } else {
        document.getElementById("universities").required = false;
        document.getElementById("country").required = false;
        // document.getElementById("universities_id").style.display = "none"
        document
            .getElementById("universities")
            .setAttribute("disabled", "disabled");
        document.getElementById("country").setAttribute("disabled", "disabled");
    }
}
var e = document.querySelector('input[name="type"]:checked').value;
var n = document.querySelector('input[name="type"]:checked').name;
var nn = {
    name:n,
    value:e
}
checkUniversities(nn)

// Update from User, Vendor, and Admin dashboard

var type = "{{ old('form_type') }}";
switchForm(type);

function switchForm(type) {
    console.log(type);
    switch (type) {
        case "user":
            document
                .getElementById("vendor-form-tab")
                .classList.remove("outerdiv-active");

            document
                .getElementById("teacher-form-tab")
                .classList.remove("outerdiv-active");

            document
                .getElementById("user-form-tab")
                .classList.add("outerdiv-active");

            document
                .getElementById("vendor-form-tab")
                .classList.add("outerdiv");

            document
                .getElementById("teacher-form-tab")
                .classList.remove("outerdiv");

            document
                .getElementById("user-form-tab")
                .classList.remove("outerdiv");

            document.getElementById("vendor-form").style.display = "none";
            document.getElementById("teacher-form").style.display = "none";
            document.getElementById("user-form").style.display = "block";
            break;

        case "vendor":
            document
                .getElementById("user-form-tab")
                .classList.remove("outerdiv-active");

            document
                .getElementById("teacher-form-tab")
                .classList.remove("outerdiv-active");

            document.getElementById("user-form-tab").classList.add("outerdiv");
            document.getElementById("teacher-form-tab").classList.add("outerdiv");

            document
                .getElementById("vendor-form-tab")
                .classList.remove("outerdiv");

            document
                .getElementById("vendor-form-tab")
                .classList.add("outerdiv-active");

            document.getElementById("user-form").style.display = "none";
            document.getElementById("teacher-form").style.display = "none";
            document.getElementById("vendor-form").style.display = "block";
            break;

        case "teacher":
            document
                .getElementById("user-form-tab")
                .classList.remove("outerdiv-active");

            document
                .getElementById("vendor-form-tab")
                .classList.remove("outerdiv-active");

            document
                .getElementById("teacher-form-tab")
                .classList.remove("outerdiv");

            document.getElementById("user-form-tab").classList.add("outerdiv");
            document.getElementById("vendor-form-tab").classList.add("outerdiv");

            document
                .getElementById("teacher-form-tab")
                .classList.add("outerdiv-active");

            document.getElementById("user-form").style.display = "none";
            document.getElementById("vendor-form").style.display = "none";
            document.getElementById("teacher-form").style.display = "block";

            break;

        default:
            break;
    }
}

checkVendorTypeOnLoad();
checkTeacherTypeOnLoad();

function checkVendorTypeOnLoad() {
    if (document.getElementById("inlineRadio001").checked) {
        document.getElementById("vendor_name").placeholder = "Full Name";
        document.getElementById("v-in-name").style.display = "none"; //hide
    } else if (document.getElementById("inlineRadio002").checked) {
        document.getElementById("vendor_name").placeholder = "Company's Name";
        document.getElementById("v-in-name").style.display = "none"; //hide
    } else if (document.getElementById("inlineRadio003").checked) {
        document.getElementById("v-in-name").style.display = "block"; //hide
        document.getElementById("v-name").style.display = "none"; //hide
    } else {
        document.getElementById("vendor_name").placeholder = "Full Name";
        document.getElementById("v-in-name").style.display = "none";
    }
}

function checkTeacherTypeOnLoad() {
    if (document.getElementById("inlineRadio0001").checked) {
        document.getElementById("teacher_name").placeholder = "Full Name";
        document.getElementById("t-in-name").style.display = "none"; //hide
    } else if (document.getElementById("inlineRadio0002").checked) {
        document.getElementById("teacher_name").placeholder = "Company's Name";
        document.getElementById("t-in-name").style.display = "none"; //hide
    } else if (document.getElementById("inlineRadio0003").checked) {
        document.getElementById("t-in-name").style.display = "block"; //hide
        document.getElementById("t-name").style.display = "none"; //hide
    } else {
        document.getElementById("teacher_name").placeholder = "Full Name";
        document.getElementById("t-in-name").style.display = "none";
    }
}


function checkVendorType(type) {
    console.log(type.value);
    switch (type.value) {
        case "entity":
            document.getElementById("v-in-name").style.display = "none";
            document.getElementById("v-name").style.display = "block";
            document.getElementById("vendor_name").placeholder = "Full Name";
            break;
        case "company":
            document.getElementById("v-in-name").style.display = "none";
            document.getElementById("v-name").style.display = "block";
            document.getElementById("vendor_name").placeholder =
                "Company's Name";
            break;
        case "institution":
            document.getElementById("v-in-name").style.display = "block"; //hide
            document.getElementById("v-name").style.display = "none"; //hide
            break;
        default:
            document.getElementById("v-in-name").style.display = "none";
            document.getElementById("v-name").style.display = "block";
            document.getElementById("vendor_name").placeholder = "Full Name";
            break;
    }
}

function checkTeacherType(type) {
    console.log(type.value);
    switch (type.value) {
        case "entity":
            document.getElementById("t-in-name").style.display = "none";
            document.getElementById("t-name").style.display = "block";
            document.getElementById("teacher_name").placeholder = "Full Name";
            break;
        case "company":
            document.getElementById("t-in-name").style.display = "none";
            document.getElementById("t-name").style.display = "block";
            document.getElementById("teacher_name").placeholder = "Company's Name";
            break;
        case "institution":
            document.getElementById("t-in-name").style.display = "block"; //hide
            document.getElementById("t-name").style.display = "none"; //hide
            break;
        default:
            document.getElementById("t-in-name").style.display = "none";
            document.getElementById("t-name").style.display = "block";
            document.getElementById("teacher_name").placeholder = "Full Name";
            break;
    }
}

// $('#password6786868686867866').on('change input keyup', function() {
//     if (this.value) {
//       $('#password_confirmation68768969u989786786').prop('required', true).parsley().validate();
//     } else {
//       $('#password_confirmation68768969u989786786').prop('required', false).parsley().validate();
//     }
//   });
</script>