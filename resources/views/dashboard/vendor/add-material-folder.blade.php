<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        <form class="validate-form" method="POST" action="{{ route('vendor.add_folder') }}">
            @csrf
            <input type="hidden" name="material_type_id" value="{{ $material_type_id ?? null }}">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="form-label">Folder Name</label>
                        <input type="text" class="form-control" placeholder="Folder Name"
                            value="{{ old('name') }}" name="name" required=""
                            data-parsley-required-message="Folder name is required">
                        @error('name')
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
$(function () {
  $('.validate-form').parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
});
</script>