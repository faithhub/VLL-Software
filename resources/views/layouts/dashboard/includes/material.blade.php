<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
<style>
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

        $("#material_type_select").change(function() {

            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#subject_select option').clone());
            }
            var id = $(this).val();
            var text = $(this).find(':selected').attr('data-text');
            var matId = $(this).find(':selected').attr('data-matId');
            var uniqueId = matId.substring(0, 3);
            document.getElementById("material_type_value").value = uniqueId

            // if (uniqueId == "TXT" || uniqueId == "CSL" ||  uniqueId == "LAW") {
            if (uniqueId == "TXT") {
                console.log(id, uniqueId);
                document.getElementById('subject_div').style.display = 'block';
            } else {
                document.getElementById('subject_div').style.display = 'none';
            }

            // if (uniqueId == "CSL" ||  uniqueId == "LAW") {
            //     document.getElementById('folder_div').style.display = 'block';
            // } else {
            //     document.getElementById('folder_div').style.display = 'none';
            // }

            if (uniqueId == "TAA") {
                document.getElementById("version").classList.remove('col-md-6', 'col-lg-6', 'col-xl-6');
                document.getElementById("version").classList.add('col-md-12', 'col-lg-12', 'col-xl-12');
                document.getElementById("priceDiv").classList.remove('col-md-6', 'col-lg-6',
                    'col-xl-6');
                document.getElementById("priceDiv").classList.add('col-md-6', 'col-lg-6',
                    'col-xl-6');
                document.getElementById('privacy_div').style.display = 'block';
                document.getElementById('TAA-data1').style.display = 'block';
                document.getElementById('TAA-data2').style.display = 'block';
                document.getElementById('TAA-data-no1').style.display = 'none';
                document.getElementById('TAA-data-no2').style.display = 'none';
                document.getElementById('publishers').style.display = 'none';
            } else {
                document.getElementById("version").classList.remove('col-md-12', 'col-lg-12',
                    'col-xl-12');
                document.getElementById("version").classList.add('col-md-6', 'col-lg-6', 'col-xl-6');
                document.getElementById("priceDiv").classList.remove('col-md-12', 'col-lg-12',
                    'col-xl-12');
                document.getElementById("priceDiv").classList.add('col-md-6', 'col-lg-6', 'col-xl-6');
                document.getElementById('TAA-data-no2').style.display = 'block';
                document.getElementById('TAA-data-no1').style.display = 'block';
                document.getElementById('publishers').style.display = 'block';
                document.getElementById('privacy_div').style.display = 'none';
                document.getElementById('TAA-data2').style.display = 'none';
                document.getElementById('TAA-data1').style.display = 'none';
            }

            // if (uniqueId == "CSL" ||  uniqueId == "LAW") {
            if (uniqueId == "LAW" || uniqueId == "CSL") {
                document.getElementById('folder_div').style.display = 'block';
                document.getElementById('material_cover_id').style.display = 'none';
                document.getElementById('material_desc_id').style.display = 'none';
                document.getElementById('TAA-data-no1').style.display = 'none';
                document.getElementById('priceDiv').style.display = 'none';
                // document.getElementById('name_of_party').style.display = 'block';
                // document.getElementById('name_of_court').style.display = 'block';
                // document.getElementById('version').style.display = 'none';
                // document.getElementById('publishers').style.display = 'none';
                // document.getElementById('citation').style.display = 'block';
            } else {
                document.getElementById('folder_div').style.display = 'none';
                document.getElementById('material_cover_id').style.display = 'block';
                document.getElementById('material_desc_id').style.display = 'block';
                document.getElementById('TAA-data-no1').style.display = 'block';
                document.getElementById('priceDiv').style.display = 'block';
                // document.getElementById('citation').style.display = 'none';
                // document.getElementById('name_of_court').style.display = 'none';
                // document.getElementById('name_of_party').style.display = 'none';
                // document.getElementById('publishers').style.display = 'block';
                // document.getElementById('version').style.display = 'block';
            }

            if (uniqueId == "CSL") {
                document.getElementById('name_of_party').style.display = 'block';
                document.getElementById('name_of_court').style.display = 'block';
                document.getElementById('name_of_author').style.display = 'none';
                document.getElementById('version').style.display = 'none';
                document.getElementById('publishers').style.display = 'none';
                document.getElementById('citation').style.display = 'block';
            } else {
                document.getElementById('citation').style.display = 'none';
                document.getElementById('name_of_court').style.display = 'none';
                document.getElementById('name_of_party').style.display = 'none';
                document.getElementById('name_of_author').style.display = 'block';
                document.getElementById('publishers').style.display = 'block';
                document.getElementById('version').style.display = 'block';
            }

            if (uniqueId == "VAA") {
                $("#material_file_text").text("Video/Audio");
                $("#file_text").text("Upload Material in Video or Audio format");
                $('#material_file').attr("accept", ".mp4,.mp3");
            } else {
                $('#material_file').attr("accept", ".pdf");
                $("#material_file_text").text("PDF");
                $("#file_text").text("Upload Material in PDF");
            }

            var options = $(this).data('options').filter('[data-value=' + id + ']');
            $('#subject_select').html(options);
        }).change();

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
        $("#material_type_select").change(function() {
            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#folder_select_id option').clone());
            }
            var id = $(this).val();
            var options = $(this).data('options').filter('[data-value=' + id + ']');
            console.log(options, id)
            $('#folder_select_id').html(options);
        });
    });


    $(document).ready(function() {
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
