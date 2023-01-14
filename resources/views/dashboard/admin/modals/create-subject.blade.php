<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        <form class="validate-form" method="POST" action="{{ route('admin.add_subject') }}" data-parsley-validate="">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="form-label">Material Type</label>
                        <select class="form-control select2" name="material_type" required
                            data-parsley-required-message="Material Type is required">
                            <option value="">Select Material</option>
                            @isset($material_types_sub)
                                @foreach ($material_types_sub as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('material_type') == $item->id ? 'selected' : '' }}>{{ $item->name }}
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
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="form-label">Subject Type</label>
                        <input type="text" name="name" class="form-control" placeholder="Subject Type"
                            value="{{ old('name') }}" required=""
                            data-parsley-required-message="Subject Type is required">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" name="description" class="form-control" required=""
                            data-parsley-required-message="Description is required" rows="5">{{ old('description') }}</textarea>
                        @error('email')
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
</script>
