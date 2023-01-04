<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        <form class="validate-form" method="POST" action="{{ route('admin.add_subject') }}">
            @csrf
            <div class='row'>
                <input type="hidden" value="{{ $subject_type->id }}" name="id">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="form-label">Material Type</label>
                        <select class="form-control" name="material_type" required
                            data-parsley-required-message="Material Type is required">
                            <option value="">Select Material</option>
                            @isset($material_types_sub)
                                @foreach ($material_types_sub as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $subject_type->material->id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('material_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                    <div class='form-group'>
                        <label class='form-label'>Suject Type</label>
                        <input type='text' class='form-control' placeholder='Subject Type' value='{{ $subject_type->name }}'
                            name='name' required='' data-parsley-required-message='Subject Type is required'>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                    <div class='form-group'>
                        <label class='form-label'>Description</label>
                        <textarea name='description' class='form-control' rows='5' required=''
                            data-parsley-required-message='Description is required'>{{ $subject_type->description }}</textarea>
                    </div>
                </div>
                <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                    <label class='form-label'>Status</label>
                    <div class='d-flex' style='margin-bottom:-10px'>
                        <div class='form-check form-check-inline'>
                            <input class='form-check-input' name='status' type='radio' id='inlineCheckbox1'
                                value='active' required='' {{ $subject_type->status == 'active' ? "checked" : '' }} data-parsley-errors-container='#status-error'
                                data-parsley-required-message='Status is required'>
                                <label class='form-check-label'
                                for='inlineCheckbox1'>Active</label> </div>
                        <div class='form-check form-check-inline'>
                            <input class='form-check-input' {{ $subject_type->status == 'disabled' ? "checked" : '' }} name='status' type='radio' id='inlineCheckbox2'
                                value='disabled'>
                                <label class='form-check-label' for='inlineCheckbox2'>Disabled</label>
                        </div>
                    </div>
                    <span class='invalid-feedback' id='status-error' role='alert'></span>
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
