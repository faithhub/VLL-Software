<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
<style>
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
</style>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

<script type="text/javascript">
    var select = document.getElementById("custom-select");
    var options = document.getElementById("custom-options");

    select.addEventListener("click", function() {
        options.style.display = "block";
    });

    document.addEventListener("click", function(e) {
        if (e.target !== select) {
            options.style.display = "none";
        }
    });

    options.addEventListener("click", function(e) {
        if (e.target.tagName === "LI") {
            select.value = e.target.innerText;
            options.style.display = "none";
        }
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

        $('#material_cover').bind('change', function() {
            if (this.files[0]) {
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;
                var size = parseFloat(fileSize / 1000).toFixed(0);
                document.getElementById('material_cover_img').src = window.URL.createObjectURL(this
                    .files[0])
                $("#material_cover_name").text(fileName);
                $("#material_cover_size").text(`${size} KB`);
                document.getElementById('material_cover_preview').style.display = 'block';
            } else {
                document.getElementById('material_cover_preview').style.display = 'none';
            }
        });

        $('#material_file').bind('change', function() {
            if (this.files[0]) {
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;
                var size = parseFloat(fileSize / 1000).toFixed(0);
                $("#material_file_name").text(fileName);
                $("#material_file_size").text(`${size} KB`);
                document.getElementById('material_file_preview').style.display = 'block';
            } else {
                document.getElementById('material_file_preview').style.display = 'none';
            }
        });

        $('#material_file2').bind('change', function() {
            if (this.files[0]) {
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;
                var size = parseFloat(fileSize / 1000).toFixed(0);
                $("#material_file_name2").text(fileName);
                $("#material_file_size2").text(`${size} KB`);
                document.getElementById('material_file_preview2').style.display = 'block';
            } else {
                document.getElementById('material_file_preview2').style.display = 'none';
            }
        });
        $('#material_file3').bind('change', function() {
            if (this.files[0]) {
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;
                var size = parseFloat(fileSize / 1000).toFixed(0);
                $("#material_file_name3").text(fileName);
                $("#material_file_size3").text(`${size} KB`);
                document.getElementById('material_file_preview3').style.display = 'block';
            } else {
                document.getElementById('material_file_preview3').style.display = 'none';
            }
        });

        $('#material_file4').bind('change', function() {
            if (this.files[0]) {
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;
                var size = parseFloat(fileSize / 1000).toFixed(0);
                $("#material_file_name4").text(fileName);
                $("#material_file_size4").text(`${size} KB`);
                document.getElementById('material_file_preview4').style.display = 'block';
            } else {
                document.getElementById('material_file_preview4').style.display = 'none';
            }
        });

        $('#material_file5').bind('change', function() {
            if (this.files[0]) {
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;
                var size = parseFloat(fileSize / 1000).toFixed(0);
                $("#material_file_name5").text(fileName);
                $("#material_file_size5").text(`${size} KB`);
                document.getElementById('material_file_preview5').style.display = 'block';
            } else {
                document.getElementById('material_file_preview5').style.display = 'none';
            }
        });


        $("#material_type_select").change(function() {

            document.getElementById("publishers").classList.remove('col-md-6', 'col-lg-6',
                'col-xl-6');
            document.getElementById("publishers").classList.add('col-md-12', 'col-lg-12',
                'col-xl-12');

            document.getElementById("priceDiv").classList.remove('col-md-6', 'col-lg-6',
                'col-xl-6');
            document.getElementById("priceDiv").classList.add('col-md-12', 'col-lg-12',
                'col-xl-12');

            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#subject_select option').clone());
            }
            var id = $(this).val();
            var text = $(this).find(':selected').attr('data-text');
            var matId = $(this).find(':selected').attr('data-matId');
            var uniqueId = matId.substring(0, 3);
            var select = document.getElementById("folder_select_id");
            document.getElementById("material_type_value").value = uniqueId
            var option_new = select.options[select.selectedIndex]
            const folders = @json($folders);
            const mode = "{{ $mode }}";
            const old_folder_id = "{{ old('folder_id') }}";
            const edit_folder_id = "{{ $material->folder_id ?? '' }}";
            const firstFolder = {
                id: "new_folder",
                amount: 000,
                name: "Create Folder"
            };


            var csl_elems = document.getElementsByClassName('new_csl_div_tag');
            var law_elems = document.getElementsByClassName('new_law_div_tag');
            var new_folder_elems = document.getElementsByClassName('new-folder');
            var elems = document.getElementsByClassName('upload-form-fields');
            $("#title_of_material").text("Material");
            for (var i = 0; i < elems.length; i += 1) {
                elems[i].style.display = 'none';
            }

            var bookPriceSelectValue = $("#bookPriceSelect").val()
            if (uniqueId == "CSL" || uniqueId == "LAW") {
                switch (bookPriceSelectValue) {
                    case "Paid":
                        document.getElementById('paidDiv2').style.display = 'block';
                        break;
                    case "Free":
                        document.getElementById('paidDiv2').style.display = 'none';
                        break;
                    default:
                        document.getElementById('paidDiv2').style.display = 'none';
                        break;
                }
            } else {
                document.getElementById('paidDiv2').style.display = 'none';
            }

            switch (uniqueId) {
                case "TXT":
                    var txt_elems = document.getElementsByClassName('text-field');
                    for (var i = 0; i < txt_elems.length; i += 1) {
                        txt_elems[i].style.display = 'block';
                    }
                    break;
                case "LOJ":
                    var loj_elems = document.getElementsByClassName('loj-field');
                    for (var i = 0; i < loj_elems.length; i += 1) {
                        loj_elems[i].style.display = 'block';
                    }
                    break;
                case "TAA":
                    var taa_elems = document.getElementsByClassName('taa-field');
                    for (var i = 0; i < taa_elems.length; i += 1) {
                        taa_elems[i].style.display = 'block';
                    }
                    document.getElementById("priceDiv").classList.remove('col-md-12', 'col-lg-12',
                        'col-xl-12');
                    document.getElementById("priceDiv").classList.add('col-md-6', 'col-lg-6',
                        'col-xl-6');
                    break;
                case "CSL":
                    const folder_csl = "{{ $ff_csl }}";

                    let folders_new_csl = folders.filter(item => {
                        console.log(item.material_type_id, id);
                        // return item.material_type_id
                        if (mode === 'edit') {
                            return item.material_type_id
                        } else {
                            return item.material_type_id == id
                        }
                    })

                    console.log(old_folder_id, mode, 'old_folder_id', folder_csl, folders_new_csl);

                    if (uniqueId == "CSL") {
                        folders_new_csl.unshift(firstFolder)
                    }
                    // if (uniqueId == "CSL" && folder_csl != "1") {
                    //     folders_new_csl.unshift(firstFolder)
                    // }

                    if (mode == 'edit') {
                        select.innerHTML = folders_new_csl.reduce((options, {
                                id,
                                name
                            }) =>
                            options +=
                            `<option value="${id}" ${ edit_folder_id == id ? 'selected' : ''}>${name}</option>`,
                            '<option value="" selected></option>');
                    } else {
                        select.innerHTML = folders_new_csl.reduce((options, {
                                id,
                                name
                            }) =>
                            options +=
                            `<option value="${id}" ${ old_folder_id == 'new_folder' ? 'selected' : ''} ${ old_folder_id == id ? 'selected' : ''}>${name}</option>`,
                            '<option value="" selected></option>');
                    }


                    if (folder_csl == "1") {
                        for (var i = 0; i < csl_elems.length; i += 1) {
                            csl_elems[i].style.display = 'block';
                        }
                    } else {
                        for (var i = 0; i < new_folder_elems.length; i += 1) {
                            new_folder_elems[i].style.display = 'block';
                        }
                    }

                    break;
                case "LAW":
                    const folder_law = "{{ $ff_law }}";
                    let folders_new_law = folders.filter(item => {
                        if (mode == 'edit') {
                            return item.material_type_id
                        } else {
                            return item.material_type_id == id
                        }
                    })

                    // if (uniqueId == "LAW" && folder_law != "1") {
                    //     folders_new_law.unshift(firstFolder)
                    // }
                    if (uniqueId == "LAW") {
                        folders_new_law.unshift(firstFolder)
                    }

                    if (mode == 'edit') {
                        select.innerHTML = folders_new_law.reduce((options, {
                                id,
                                name
                            }) =>
                            options +=
                            `<option value="${id}" ${ edit_folder_id == id ? 'selected' : ''}>${name}</option>`,
                            '<option value="" selected></option>');
                    } else {
                        select.innerHTML = folders_new_law.reduce((options, {
                                id,
                                name
                            }) =>
                            options +=
                            `<option value="${id}" ${ old_folder_id == 'new_folder' ? 'selected' : ''} ${ old_folder_id == id ? 'selected' : ''}>${name}</option>`,
                            '<option value="" selected></option>');
                    }

                    if (folder_law == "1") {
                        document.getElementById("mat_title_div").classList.remove('col-md-6',
                            'col-lg-6',
                            'col-xl-6');
                        document.getElementById("mat_title_div").classList.add('col-md-12', 'col-lg-12',
                            'col-xl-12');
                        $("#title_of_material").text("Law");
                        for (var i = 0; i < law_elems.length; i += 1) {
                            law_elems[i].style.display = 'block';
                        }
                    } else {
                        for (var i = 0; i < new_folder_elems.length; i += 1) {
                            new_folder_elems[i].style.display = 'block';
                        }
                    }
                    break;
                case "VAA":
                    $("#material_file_text").text("Video/Audio");
                    $("#file_text").text("Upload Material in Video or Audio format");
                    $('#material_file').attr("accept", ".mp4,.mp3");
                    document.getElementById("publishers").classList.remove('col-md-6', 'col-lg-6',
                        'col-xl-6');
                    document.getElementById("publishers").classList.add('col-md-12', 'col-lg-12',
                        'col-xl-12');
                    document.getElementById("priceDiv").classList.remove('col-md-6', 'col-lg-6',
                        'col-xl-6');
                    document.getElementById("priceDiv").classList.add('col-md-12', 'col-lg-12',
                        'col-xl-12');
                    var vaa_elems = document.getElementsByClassName('vaa-field');
                    for (var i = 0; i < vaa_elems.length; i += 1) {
                        vaa_elems[i].style.display = 'block';
                    }
                    break;

                default:
                    $("#title_of_material").text("Material");
                    $('#material_file').attr("accept", ".pdf");
                    $("#material_file_text").text("PDF");
                    $("#file_text").text("Upload Material in PDF");
                    document.getElementById("mat_title_div").classList.remove('col-md-12', 'col-lg-12',
                        'col-xl-12');
                    document.getElementById("mat_title_div").classList.add('col-md-6',
                        'col-lg-6',
                        'col-xl-6');
                    document.getElementById("priceDiv").classList.remove('col-md-12', 'col-lg-12',
                        'col-xl-12');
                    document.getElementById("priceDiv").classList.add('col-md-6', 'col-lg-6',
                        'col-xl-6');
                    for (var i = 0; i < new_folder_elems.length; i += 1) {
                        new_folder_elems[i].style.display = 'none';
                    }
                    for (var i = 0; i < csl_elems.length; i += 1) {
                        csl_elems[i].style.display = 'none';
                    }
                    for (var i = 0; i < elems.length; i += 1) {
                        elems[i].style.display = 'block';
                    }
                    break;
            }

            var options = $(this).data('options').filter('[data-value=' + id + ']');
            $('#subject_select').html(options);
        }).change();

    });



    $(document).ready(function() {
        $("#folder_select_id").change(function() {
            var value = $(this).val();

            var text = $("#material_type_select").find(':selected').attr('data-text');
            var matId = $("#material_type_select").find(':selected').attr('data-matId');
            var uniqueId = matId.substring(0, 3);
            var law_elems = document.getElementsByClassName('new_law_div_tag');
            var csl_elems = document.getElementsByClassName('new_csl_div_tag');
            var new_folder_elems = document.getElementsByClassName('new-folder');
            var elems = document.getElementsByClassName('upload-form-fields');
            for (var i = 0; i < elems.length; i += 1) {
                elems[i].style.display = 'none';
            }
            console.log(uniqueId, "uuuu");
            switch (uniqueId) {
                case "CSL":
                    if (value == "new_folder") {
                        for (var i = 0; i < new_folder_elems.length; i += 1) {
                            new_folder_elems[i].style.display = 'block';
                        }
                        console.log(value, "new-folder");
                    } else {
                        console.log(value, "new_csl_div_tag");
                        for (var i = 0; i < csl_elems.length; i += 1) {
                            csl_elems[i].style.display = 'block';
                        }
                    }
                    break;
                case "LAW":
                    if (value == "new_folder") {
                        for (var i = 0; i < new_folder_elems.length; i += 1) {
                            new_folder_elems[i].style.display = 'block';
                        }
                    } else {
                        document.getElementById("mat_title_div").classList.remove('col-md-6',
                            'col-lg-6',
                            'col-xl-6');
                        document.getElementById("mat_title_div").classList.add('col-md-12', 'col-lg-12',
                            'col-xl-12');
                        $("#title_of_material").text("Law");
                        for (var i = 0; i < law_elems.length; i += 1) {
                            law_elems[i].style.display = 'block';
                        }
                    }
                    break;

                default:
                    break;
            }
            // new_csl_div_tag

        });
    });

    $(document).ready(function() {
        $("#test_country_id").change(function() {
            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#university_id option').clone());
            }
            var id = $(this).val();
            var options = $(this).data('options').filter('[data-value=' + id + ']');
            // console.log(options, id)
            $('#university_id').html(options);
        });
    });


    $(document).ready(function() {
        $("#bookPriceSelect").change(function() {

            var value = $(this).val()

            var e = document.getElementById("material_type_select");
            var matId = $("#material_type_select").find(':selected').attr('data-matId');
            var uniqueId = matId.substring(0, 3);
            var value2 = e.value;
            console.log(uniqueId);

            if (uniqueId == "CSL" || uniqueId == "LAW") {
                switch (value) {
                    case "Paid":
                        document.getElementById('paidDiv2').style.display = 'block';
                        break;
                    case "Free":
                        document.getElementById('paidDiv2').style.display = 'none';
                        break;
                    default:
                        document.getElementById('paidDiv2').style.display = 'none';
                        break;
                }
            } else {
                document.getElementById('paidDiv2').style.display = 'none';
            }

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


    $(document).ready(function() {
        $("#country_of_publication").change(function() {
            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#select_name_of_court option').clone());
            }
            var id = $(this).val();
            var options = $(this).data('options').filter('[data-value=' + id + ']');
            // console.log(options, id)
            $('#select_name_of_court').html(options);
        }).change();
    });
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
