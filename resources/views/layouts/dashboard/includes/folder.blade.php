<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
<style>
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
        /* height: 55px; */
        height: auto !important;
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
    $(function() {
        $('.validate-form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })

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

    $(document).ready(function() {
        document.getElementById('tags_input').addEventListener('keypress', function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
            }
        });

        $(".tm-input").tagsManager({
            tagsContainer: '.tags-show',
        });
    });
</script>
