<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        @isset($mode)
            @if ($mode == 'edit')
                <form class="validate-form" method="POST" enctype="multipart/form-data"
                    action="{{ route('admin.edit_folder', $folder->id) }}">
                    @csrf
                    <input type="hidden" name="material_type_id" value="{{ $folder->material_type_id ?? null }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-row mb-3">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                                    <label class="form-label">Folder Name</label>
                                    <input type="text" class="form-control" placeholder="Folder Name"
                                        value="{{ $folder->name }}" name="name" required=""
                                        data-parsley-required-message="Folder name is required">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                                    <label class="form-label">Name of Author <span>*<span></label>
                                    <input type="text" class="form-control" name="name_of_author"
                                        value="{{ $folder->name_of_author }}" requiredd=""
                                        data-parsley-required-message="Name of Author is required" placeholder="">
                                    @error('name_of_author')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-lg-6 col-md-12 mb-2 col-sm-12 col-xl-6">
                                <label class="form-label">Version <span>*<span></label>
                                <input type="text" class="form-control" placeholder="2nd Version" name="version"
                                    value="{{ $folder->version }}" requiredd=""
                                    data-parsley-required-message="Version is required">
                                @error('version')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
                                <label class="form-label">Country of Publication
                                    <span>*<span></label>
                                <select onchange="" class="form-control select" name="country_id"
                                    id="country_of_publication" requiredd=""
                                    data-parsley-errors-container="#country_of_publication-error"
                                    data-parsley-required-message="Country of Publication is required">
                                    <option value="">Select Country</option>
                                    @isset($countries)
                                        @foreach ($countries as $item)
                                            <option value="{{ $item->id }}" @selected($folder->country_id == $item->id)>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                                <span class="invalid-feedback" id="country_of_publication-error" role="alert">
                                    @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 mb-2">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" placeholder="Folder Annual Amount"
                                    value="{{ $folder->amount }}" name="amount" required=""
                                    data-parsley-required-message="Folder Amount is required">
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
                                <label class="form-label">Publishers <span>*<span></label>
                                <input type="text" class="form-control" name="publisher"
                                    value="{{ $folder->publisher }}" requiredd=""
                                    data-parsley-required-message="Title of Material is required" placeholder="">
                                @error('publisher')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label class="form-label">Tags <span>*<span></label>
                                <input type="" data-role="tagsinput" class="form-control tm-input tm-input-inf"
                                    placeholder="Input material tags" requiredd=""
                                    value="@isset($folder->tags)
                                        @foreach ($folder->tags as $tag) 
                                    {{ $tag }} @endforeach
                                    @endisset"
                                    name="tags" id="tags_input"
                                    data-parsley-required-message="Title of Material is required">
                                <div class="col-auto">
                                    <span id="passwordHelpInline" class="form-text">
                                        Input words to aid search in Bookstore (Law, Legal)
                                    </span>
                                </div>
                                @error('tags')
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
                                        name="folder_cover_id" data-parsley-errors-container="#material-cover2-error"
                                        data-parsley-required-message="Folder cover is required" />
                                    <i class="fa fa-upload">&nbsp</i>
                                    <span id="cover_text"> Upload Folder Cover</span>
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
                        <button class="btn btn-primary p-2" type="submit" style="font-size: 15px">Update</button>
                    </div>
                </form>
            @else
                <form class="validate-form" method="POST" enctype="multipart/form-data"
                    action="{{ route('admin.add_folder') }}">
                    @csrf
                    <input type="hidden" name="material_type_id" value="{{ $material_type_id ?? null }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label class="form-label">Material Type</label>
                                <select class="form-control select2" name="material_type_id" required
                                    data-parsley-required-message="Material Type is required">
                                    <option value="">Select Material</option>
                                    @isset($material_types)
                                        @foreach ($material_types as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('material_type_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                                @error('material_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-row mb-3">
                                <div class="col">
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
                                <div class="col">
                                    <label class="form-label">Name of Author <span>*<span></label>
                                    <input type="text" class="form-control" name="name_of_author"
                                        value="{{ old('name_of_author') }}" requiredd=""
                                        data-parsley-required-message="Name of Author is required" placeholder="">
                                    @error('name_of_author')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12">
                            <div class="form-row mb-3">
                                <div class="col">
                                    <label class="form-label">Version <span>*<span></label>
                                    <input type="text" class="form-control" placeholder="2nd Version" name="version"
                                        value="{{ old('version') }}" requiredd=""
                                        data-parsley-required-message="Version is required">
                                    @error('version')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label">Country of Publication
                                        <span>*<span></label>
                                    <select onchange="" class="form-control select" name="country_id"
                                        id="country_of_publication" requiredd=""
                                        data-parsley-errors-container="#country_of_publication-error"
                                        data-parsley-required-message="Country of Publication is required">
                                        <option value="">Select Country</option>
                                        @isset($countries)
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->id }}" @selected(old('country_id') == $item->id)>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    <span class="invalid-feedback" id="country_of_publication-error" role="alert">
                                        @error('country_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label class="form-label">Publishers <span>*<span></label>
                                    <input type="text" class="form-control" name="publisher"
                                        value="{{ old('publisher') }}" requiredd=""
                                        data-parsley-required-message="Title of Material is required" placeholder="">
                                    @error('publisher')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label">Tags <span>*<span></label>
                                    <input type="" data-role="tagsinput"
                                        class="form-control tm-input tm-input-inf" placeholder="Input material tags"
                                        requiredd="" name="tags" value="{{ old('tags') }}"
                                        data-parsley-required-message="Title of Material is required">
                                    <div class="col-auto">
                                        <span id="passwordHelpInline" class="form-text">
                                            Input words to aid search in Bookstore (Law, Legal)
                                        </span>
                                    </div>
                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" placeholder="Folder Annual Amount"
                                    value="{{ old('amount') }}" name="amount" required=""
                                    data-parsley-required-message="Folder Amount is required">
                                @error('amount')
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
                                        data-parsley-errors-container="#material-cover2-error"
                                        data-parsley-required-message="Folder cover is required" />
                                    <i class="fa fa-upload">&nbsp</i>
                                    <span id="cover_text"> Upload Folder Cover</span>
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
            @endif
        @endisset
    </div>
</div>

@include('layouts.dashboard.includes.folder')