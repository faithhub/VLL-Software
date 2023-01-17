<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        <form class="validate-form" method="POST" enctype="multipart/form-data" action="{{ route('vendor.add_folder') }}">
            @csrf
            <input type="hidden" name="material_type_id" value="{{ $material_type_id ?? null }}">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="form-label">Folder Name</label>
                        <input type="text" class="form-control" placeholder="Folder Name" value="{{ old('name') }}"
                            name="name" required="" data-parsley-required-message="Folder name is required">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="form-label">Folder Cover <span>*<span></label>
                        <label class="btn btn-primary btn-block custom-file-upload">
                            <input type="file" accept=".jpg, .png, image/jpeg, image/png" id="folder_cover2"
                                name="folder_cover_id" required=""
                                data-parsley-errors-container="#material-cover2-error" data-parsley-required-message="Folder cover is required" />
                            <i class="fa fa-upload">&nbsp</i>
                            <span id="cover_text"> Upload Folder Cover(
                                PNG, and
                                JPEG)</span>
                        </label>
                        <div id="folder_cover2_preview" style="display: none">
                            <div class="main-chat-header">
                                <div class="main-img-user">
                                    <img alt="" id="folder_cover2_img" class="avatar avatar-md">
                                </div>
                                <div class="main-chat-msg-name">
                                    <h6 id="folder_cover2_name"></h6>
                                    <small id="folder_cover2_size"></small>
                                </div>
                            </div>
                        </div>
                        <span class="invalid-feedback" id="material-cover2-error" role="alert">
                            @error('folder_cover_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 text-center mt-1">
                <button class="btn btn-primary p-2" type="submit" style="font-size: 15px">Add New</button>
            </div>
        </form>
    </div>
</div>
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
</script>
