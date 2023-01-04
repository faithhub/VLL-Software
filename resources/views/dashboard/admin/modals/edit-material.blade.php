<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        <form class="validate-form" method="POST" action="{{ route('admin.add_material') }}">
            @csrf
            <div class='row'>
                <input type="hidden" value="{{ $material_type->id }}" name="id">
                <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                    <div class='form-group'> <label class='form-label'>Material Type</label> <input type='text'
                            class='form-control' placeholder='Material Type' value='{{ $material_type->name }}'
                            name='name' required='' data-parsley-required-message='Material Type is required'>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                    <div class='form-group'> <label class='form-label'>Description</label>
                        <textarea name='description' class='form-control' rows='5' required=''
                            data-parsley-required-message='Description is required'>{{ $material_type->description }}</textarea>
                    </div>
                </div>
                <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'> <label class='form-label'>Status</label>
                    <div class='d-flex' style='margin-bottom:-10px'>
                        <div class='form-check form-check-inline'>
                            <input class='form-check-input' name='status' type='radio' id='inlineCheckbox1'
                                value='active' required='' {{ $material_type->status == 'active' ? "checked" : '' }} data-parsley-errors-container='#status-error'
                                data-parsley-required-message='Status is required'>
                                <label class='form-check-label'
                                for='inlineCheckbox1'>Active</label> </div>
                        <div class='form-check form-check-inline'>
                            <input class='form-check-input' {{ $material_type->status == 'disabled' ? "checked" : '' }} name='status' type='radio' id='inlineCheckbox2'
                                value='disabled'>
                                <label class='form-check-label' for='inlineCheckbox2'>Disabled</label>
                        </div>
                    </div>
                    <span class='invalid-feedback' id='status-error' role='alert'></span>
                </div>
                <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'> <label class='form-label'>User role</label>
                    <div class='d-flex' style='margin-bottom:-10px'>
                        <div class='form-check form-check-inline'> <input class='form-check-input' name='role[]'
                                @if (in_array('admin', $material_type->role)) checked @endif type='checkbox' id='inlineCheckbox1'
                                value='admin' required='' data-parsley-errors-container='#role-error'
                                data-parsley-required-message='User role is required'> <label class='form-check-label'
                                for='inlineCheckbox1'>Admin</label> </div>
                        <div class='form-check form-check-inline'> <input class='form-check-input' name='role[]'
                                @if (in_array('vendor', $material_type->role)) checked @endif type='checkbox' id='inlineCheckbox2'
                                value='vendor'> <label class='form-check-label' for='inlineCheckbox2'>Vendor</label>
                        </div>
                    </div>
                    <span class='invalid-feedback' id='role-error' role='alert'></span>
                </div>
            </div>
            <div class='col-lg-12 col-xl-12 text-center mt-1'> <button class='btn btn-primary'
                    style='font-size: 15px'>Update</button> </div>
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
</script>
