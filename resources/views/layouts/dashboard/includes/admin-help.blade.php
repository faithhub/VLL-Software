<script>
    getFile = function() {
        $('#inputFile').attr('accept', '.jpg, .png');
        $('#inputFile').show();
        $('#inputFile').focus();
        $('#inputFile').click();
        $('#inputFile').hide();
    }
      $('#inputFile').change(function(e) {
            try {
                var user_id = $('#user_id').val();
                if ($('#inputFile')[0].files.length === 0 || user_id == '') {
                    console.log("No files selected.");
                    return false;
                }
                e.preventDefault();
                var form = new FormData();
                form.append('save_file', $('#inputFile')[0].files[0]);
                form.append('_token', "{{ csrf_token() }}");
                    form.append('user_id', user_id);

                $.ajax({
                    url: "{{ route('admin.send_msg') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    type: "POST",
                    enctype: 'multipart/form-data',
                    data: form,
                    success: function(response) {
                        console.log(response);
                        $("#ChatBody").load( window.location.href + " #ChatBody")
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });

            } catch (error) {
                console.log(error);
            }
            // $('#submitFileForm').submit();
        });

     $(function() {
            $('#ChatBody').stop().animate({
                scrollTop: $('#ChatBody')[0].scrollHeight
            }, 800);

        })

    function getMessage(data) {
        var userId = data.getAttribute('data-user-id');
        console.log(userId);
        if (userId != "") {
            $.ajax({
                url: "{{ route('admin.current_msg_user') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    current_msg_user_new: userId,
                },
                success: function(response) {
                    console.log(response);
                    $("#main_img_user").load(window.location.href + " #main_img_user")
                    $("#main_chat_msg_name").load(window.location.href + " #main_chat_msg_name")
                    $("#content_inner").load(window.location.href + " #content_inner")
                },
                error: function(e) {
                    console.log(e);
                }
            });

        }

    }

        $('#msg_btn').click(function(e) {
            try {
                var msg = $('#msg_value').val();
                var user_id = $('#user_id').val();
                if (msg != '' && user_id != '') {
                    e.preventDefault();
                    var form = new FormData();
                    form.append('_token', "{{ csrf_token() }}");
                    form.append('msg', msg);
                    form.append('user_id', user_id);

                    $.ajax({
                        url: "{{ route('admin.send_msg') }}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        type: "POST",
                        data: form,
                        success: function(response) {
                            console.log(response);
                            $('#msg_value').val('')
                            $("#ChatBody").load(window.location.href + " #ChatBody");
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }

            } catch (error) {
                console.log(error);
            }
        });
</script>
