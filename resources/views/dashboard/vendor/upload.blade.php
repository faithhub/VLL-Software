@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-1">
                        <h6 class="mb-1 mt-1 font-weight-bold h6">
                            <a href="{{ route('admin.library') }}">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        @php
                            $new_folder = Session::get('new_folder');
                            $mat_type = Session::get('mat_type');
                            $mat_unique = Session::get('mat_unique');
                        @endphp
                        @isset($new_folder, $mat_type)
                            @if ($mat_unique == 'CSL')
                                <h6 class="mb-1 mt-1 font-weight-bold h4">
                                    Upload Case Law Material
                                </h6>
                                <div id="case_law_upload">
                                    <form method="POST" action="{{ route('vendor.upload') }}" class="validate-form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="material_type_value"
                                            value="{{ Session::get('mat_unique') }}" id="material_type_value">
                                        {{-- <input type="hidden" name="folder_id" value="{{ Session::get('new_folder')->id }}"> --}}
                                        <div class="row mt-5 mb-5 settings">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Folder<span>*<span></label>
                                                    <select class="form-control select" name="folder_id"
                                                        data-parsley-required-message="Subject is required" requiredd=""
                                                        data-parsley-errors-container="#folder-error"
                                                        data-placeholder="Select folder">
                                                        <option value="">Select folder</option>
                                                        @isset($ff_csl_arr)
                                                            @foreach ($ff_csl_arr as $item)
                                                                <option data-value="{{ $item->material_type_id ?? '' }}"
                                                                    @selected(Session::get('new_folder')->id == $item->id)
                                                                    value="{{ $item->id }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    <span class="invalid-feedback" id="folder-error" role="alert">
                                                        @error('folder_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Name of Party <span>*<span></label>
                                                    <input type="text" class="form-control" id="custom-select"
                                                        name="name_of_party" value="{{ old('name_of_party') }}" requiredd=""
                                                        data-parsley-required-message="Name of Party is required" placeholder=""
                                                        autocomplete="off">
                                                    <ul id="custom-options">
                                                        <li>Plaintiff</li>
                                                        <li>Prosecutor</li>
                                                        <li>Appellant</li>
                                                        <li>Defendant</li>
                                                        <li>Respondent</li>
                                                    </ul>
                                                    @error('name_of_party')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Citation <span>*<span></label>
                                                    <input type="text" class="form-control" name="citation"
                                                        value="{{ old('citation') }}" requiredd=""
                                                        data-parsley-required-message="Name of Author is required"
                                                        placeholder="">
                                                    @error('citation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Name of Court <span>*<span></label>
                                                    <select class="form-control select" name="name_of_court"
                                                        data-parsley-required-message="Name of Court is required" requiredd=""
                                                        data-parsley-errors-container="#court-name-error"
                                                        id="select_name_of_court" data-placeholder="Select Court">
                                                        <option data-value="153" value="">Select Court</option>
                                                        <option data-value="153" value="Supreme Court"
                                                            @selected(old('name_of_court') == 'Supreme Court')>
                                                            Supreme Court</option>
                                                        <option data-value="153" value="Court of Appeal"
                                                            @selected(old('name_of_court') == 'Court of Appeal')>
                                                            Court of Appeal</option>
                                                        <option data-value="153" value="Federal High Court"
                                                            @selected(old('name_of_court') == 'Federal High Court')>Federal High Court</option>
                                                        <option data-value="153" value="National Industrial Court"
                                                            @selected(old('name_of_court') == 'National Industrial Court')>National Industrial Court</option>
                                                        <option data-value="153" value="State High Court"
                                                            @selected(old('name_of_court') == 'State High Court')>State High Court</option>
                                                        <option data-value="153" value="Tax Tribunal/ Tax Appeal Tribunal"
                                                            @selected(old('name_of_court') == 'Tax Tribunal/ Tax Appeal Tribunal')>Tax Tribunal/ Tax Appeal Tribunal
                                                        </option>
                                                        <option data-value="153" value="Election Tribunal"
                                                            @selected(old('name_of_court') == 'Election Tribunal')>Election Tribunal</option>
                                                    </select>
                                                    <span class="invalid-feedback" id="court-name-error" role="alert">
                                                        @error('name_of_court')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Tags <span>*<span></label>
                                                    <input type="" data-role="tagsinput"
                                                        class="form-control tm-input tm-input-inf"
                                                        placeholder="Input material tags" requiredd="" name="tags"
                                                        value="{{ old('tags') }}"
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
                                                    <label class="form-label">Upload Material <span
                                                            id="material_file_text2">PDF</span>
                                                        <span>*<span></label>
                                                    <label class="btn btn-primary btn-block custom-file-upload">
                                                        <input requiredd="" accept="application/pdf"
                                                            name="material_file_id" id="material_file2"
                                                            data-parsley-errors-container="#material-file-error"
                                                            type="file" />
                                                        <i class="fa fa-upload">&nbsp</i>
                                                        <span id="file_text2">Upload Material
                                                            in
                                                            PDF</span>
                                                    </label>
                                                    <div id="material_file_preview2" style="display: none">
                                                        <div class="main-chat-header">
                                                            <div class="main-chat-msg-name">
                                                                <h6 id="material_file_name2"></h6>
                                                                <small id="material_file_size2"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="invalid-feedback" id="material-file-error" role="alert">
                                                        @error('material_file_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label class="custom-control custom-checkbox">
                                                    <input requiredd="" type="checkbox"
                                                        data-parsley-required-message="Terms and Conditions is required"
                                                        class="custom-control-input"
                                                        {{ old('terms') == 'agreed' ? 'checked' : '' }} name="terms"
                                                        value="agreed">
                                                    <span class="custom-control-label">I have read and I agree with the <a
                                                            href="" target="blank"><b style="font-weight: 900">Terms
                                                                and
                                                                Conditions</b></a> of
                                                        Virtual Law Library</span>
                                                </label>
                                                @error('terms')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12 col-xl-12 text-center">
                                                <button type="submit" class="btn btn-primary p-3 pt-3 pt-2"
                                                    style="font-size: 18px">Submit</button>
                                                <a href="{{ route('vendor.cancel.library') }}"
                                                    onclick="return confirm('Are you sure you want to cancel?')"
                                                    class="btn btn-danger m-3 p-3 pt-3 pt-2"
                                                    style="font-size: 18px">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @else
                            <h6 class="mb-1 mt-1 font-weight-bold h4">
                                Upload Material Information
                            </h6>
                            <form method="POST" action="{{ route('vendor.upload') }}" class="validate-form"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="material_type_value" value="" id="material_type_value">
                                <div class="row mt-5 mb-5 settings">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Type of Material <span>*<span></label>
                                            <select onchange="" class="form-control select" name="material_type_id"
                                                id="material_type_select"
                                                data-parsley-required-message="Type of Material is required" requiredd=""
                                                data-parsley-errors-container="#material_type-error"
                                                data-placeholder="Select type of material">
                                                <option value="">Select Type of Material</option>
                                                @isset($material_types)
                                                    @foreach ($material_types as $item)
                                                        <option data-matId="{{ $item->mat_unique_id }}"
                                                            data-text="{{ $item->name }}" value="{{ $item->id }}"
                                                            @selected(old('material_type_id') == $item->id)>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <span class="invalid-feedback" id="material_type-error" role="alert">
                                                @error('material_type_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields new_law_div_tag col-sm-12 col-md-12 col-lg-12 col-xl-12 new-folder new_csl_div_tag law-field"
                                        id="folder_div" style="display:none">
                                        <div class="form-group">
                                            <label class="form-label">Folder<span>*<span></label>
                                            <select class="form-control select" name="folder_id" id="folder_select_id"
                                                data-parsley-required-message="Folder is required" requiredd=""
                                                data-parsley-errors-container="#folder-error"
                                                data-placeholder="Select folder">
                                                <option value="">Select folder</option>
                                                <option value="new">Create folder</option>
                                                <option value="">Create folder Mew</option>
                                                @isset($folders)
                                                    @foreach ($folders as $item)
                                                        <option data-value="{{ $item->material_type_id ?? '' }}"
                                                            @selected(old('folder_id') == 'new_folder') @selected(old('folder_id') == $item->id)
                                                            value="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            {{-- <button type="button" onclick="shiNew(event)" data-type="dark"
                                                data-size="s" data-title="Add New Folder"
                                                href="{{ route('admin.add_folder') }}" class="btn btn-primary">Add
                                                New</button> --}}
                                            {{-- </div> --}}
                                            <span class="invalid-feedback" id="folder-error" role="alert">
                                                @error('folder_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 new_csl_div_tag"
                                        style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Name of Party <span>*<span></label>
                                            <input type="text" class="form-control" id="custom-select"
                                                name="name_of_party" value="{{ old('name_of_party') }}" requiredd=""
                                                data-parsley-required-message="Name of Party is required" placeholder=""
                                                autocomplete="off">
                                            <ul id="custom-options">
                                                <li>Plaintiff</li>
                                                <li>Prosecutor</li>
                                                <li>Appellant</li>
                                                <li>Defendant</li>
                                                <li>Respondent</li>
                                            </ul>
                                            @error('name_of_party')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 new_csl_div_tag"
                                        style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Citation <span>*<span></label>
                                            <input type="text" class="form-control" name="citation"
                                                value="{{ old('citation') }}" requiredd=""
                                                data-parsley-required-message="Name of Author is required" placeholder="">
                                            @error('citation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 new_csl_div_tag"
                                        style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Name of Court <span>*<span></label>
                                            <select class="form-control select" name="name_of_court"
                                                data-parsley-required-message="Name of Court is required" requiredd=""
                                                data-parsley-errors-container="#court-name-error" id="select_name_of_court"
                                                data-placeholder="Select Court">
                                                <option data-value="153" value="">Select Court</option>
                                                <option data-value="153" value="Supreme Court" @selected(old('name_of_court') == 'Supreme Court')>
                                                    Supreme Court</option>
                                                <option data-value="153" value="Court of Appeal"
                                                    @selected(old('name_of_court') == 'Court of Appeal')>
                                                    Court of Appeal</option>
                                                <option data-value="153" value="Federal High Court"
                                                    @selected(old('name_of_court') == 'Federal High Court')>Federal High Court</option>
                                                <option data-value="153" value="National Industrial Court"
                                                    @selected(old('name_of_court') == 'National Industrial Court')>National Industrial Court</option>
                                                <option data-value="153" value="State High Court"
                                                    @selected(old('name_of_court') == 'State High Court')>State High Court</option>
                                                <option data-value="153" value="Tax Tribunal/ Tax Appeal Tribunal"
                                                    @selected(old('name_of_court') == 'Tax Tribunal/ Tax Appeal Tribunal')>Tax Tribunal/ Tax Appeal Tribunal
                                                </option>
                                                <option data-value="153" value="Election Tribunal"
                                                    @selected(old('name_of_court') == 'Election Tribunal')>Election Tribunal</option>
                                            </select>
                                            <span class="invalid-feedback" id="court-name-error" role="alert">
                                                @error('name_of_court')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-6 col-lg-6 col-xl-6 new_law_div_tag text-field taa-field vaa-field loj-field material_upload_fields"
                                        id="mat_title_div">
                                        <div class="form-group">
                                            <label class="form-label">Title of <span id="title_of_material">Material</span>
                                                <span>*<span></label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ old('title') }}" requiredd=""
                                                data-parsley-required-message="Title of Material is required" placeholder="">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 new_law_div_tag"
                                        style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Year of Enactment <span>*<span></label>
                                            <input type="text" class="form-control" name="year_of_enactmen"
                                                value="{{ old('year_of_enactmen') }}" requiredd=""
                                                data-parsley-required-message="Title of Material is required" placeholder="">
                                            @error('year_of_enactmen')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 new_law_div_tag"
                                        style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Upload Material <span
                                                    id="material_file_text5">PDF</span>
                                                <span>*<span></label>
                                            <label class="btn btn-primary btn-block custom-file-upload">
                                                <input requiredd="" accept="application/pdf" name="material_file_id"
                                                    id="material_file5" data-parsley-errors-container="#material-file-error"
                                                    type="file" />
                                                <i class="fa fa-upload">&nbsp</i>
                                                <span id="file_text5">Upload Material
                                                    in
                                                    PDF</span>
                                            </label>
                                            <div id="material_file_preview5" style="display: none">
                                                <div class="main-chat-header">
                                                    <div class="main-chat-msg-name">
                                                        <h6 id="material_file_name5"></h6>
                                                        <small id="material_file_size5"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback" id="material-file-error" role="alert">
                                                @error('material_file_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div> --}}
                                    <div class="upload-form-fields col-sm-12 col-md-6 col-lg-6 col-xl-6 new-folder material_upload_fields"
                                        id="folder_name_div" style="display:none">
                                        <div class="form-group">
                                            <label class="form-label">Folder Name <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="Folder Name"
                                                value="{{ old('folder_name') }}" name="folder_name" requiredd=""
                                                data-parsley-required-message="Folder name is required">
                                            @error('folder_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-6 col-lg-6 col-xl-6 text-field new-folder taa-field vaa-field loj-field material_upload_fields"
                                        id="name_of_author">
                                        <div class="form-group">
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
                                    <div class="upload-form-fields col-sm-12 col-md-6 col-lg-6 col-xl-6 text-field taa-field new-folder vaa-field loj-field material_upload_fields"
                                        id="version">
                                        <div class="form-group">
                                            <label class="form-label">Version <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="2nd Version"
                                                name="version" value="{{ old('version') }}" requiredd=""
                                                data-parsley-required-message="Version is required">
                                            @error('version')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-6 col-lg-6 col-xl-6 text-field new-folder vaa-field loj-field material_upload_fields"
                                        id="TAA-data-no2">
                                        <div class="form-group">
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
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 text-field new-folder taa-field vaa-field loj-field material_upload_fields"
                                        id="priceDiv">
                                        <div class="form-group settings">
                                            <label class="form-label">Price <span>*<span></label>
                                            <select requiredd="" class="form-control select2"
                                                data-parsley-errors-container="#price-error" id="bookPriceSelect"
                                                name="price" data-parsley-required-message="Price is required"
                                                data-placeholder="Select Price">
                                                <option value=""></option>
                                                <option value="Paid" @selected(old('price') == 'Paid')>Paid
                                                </option>
                                                <option value="Free" @selected(old('price') == 'Free')>Free
                                                </option>
                                            </select>
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span class="invalid-feedback" id="price-error" role="alert">
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 material_upload_fields"
                                        id="paidDiv" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Amount <span>*<span></label>
                                            <div class="d-flex">
                                                <select class="form-control" name="currency_id" id="currency_id"
                                                    style="width: fit-content !important">
                                                    @isset($app_currencies)
                                                        @foreach ($app_currencies as $app_currency)
                                                            <option value="{{ $app_currency->id }}" @selected(Auth::user()->currency->id == $app_currency->id)
                                                                style="background-image:url('{{ asset($app_currency->flag) }}');">
                                                                {{ $app_currency->name }} ({{ $app_currency->symbol }})
                                                            </option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                                <input type="number" class="form-control" placeholder="5000" min="1"
                                                    name="amount" value="{{ old('amount') }}" requiredd=""
                                                    data-parsley-required-message="Title of Material is required">
                                            </div>
                                            @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="paidDiv2" class="new_law_div_tag new-folder upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Folder Duration <span>*<span></label>
                                            <select class="form-control select2" name="duration" id="folder-duration" requiredd
                                                data-parsley-required-message="Duration is required">
                                                <option value="">Select duration</option>
                                                <option value="annual" @selected(old('duration') == 'annual')>Annual</option>
                                                <option value="quarterly" @selected(old('duration') == 'quarterly')>Quarterly</option>
                                                <option value="monthly" @selected(old('duration') == 'monthly')>Monthly</option>
                                            </select>
                                            @error('duration')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 taa-field material_upload_fields"
                                        id="TAA-data1" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Country of University
                                                <span>*<span></label>
                                            <select class="form-control select" name="test_country_id" id="test_country_id"
                                                requiredd="" data-parsley-errors-container="#text-country-error"
                                                data-parsley-required-message="Country of Publication is required">
                                                <option value="">Select Country</option>
                                                @isset($countries)
                                                    @foreach ($countries as $item)
                                                        <option value="{{ $item->id }}" @selected(Auth::user()->country_id ?? old('test_country_id') == $item->id)>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <span class="invalid-feedback" id="text-country-error" role="alert">
                                                @error('test_country_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 taa-field material_upload_fields"
                                        id="TAA-data2" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Universities
                                                <span>*<span></label>
                                            <select class="form-control select" name="university_id" id="university_id"
                                                requiredd="" data-parsley-errors-container="#university-error"
                                                data-parsley-required-message="University is required">
                                                <option value="">Select Univerty</option>
                                                @isset($universities)
                                                    @foreach ($universities as $item)
                                                        <option data-value="{{ $item->country_id }}" value="{{ $item->id }}"
                                                            @selected(Auth::user()->university_id ?? old('university_id') == $item->id)>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <span class="invalid-feedback" id="university-error" role="alert">
                                                @error('university_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 text-field taa-field new-folder vaa-field loj-field material_upload_fields"
                                        id="publishers">
                                        <div class="form-group">
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
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 text-field taa-field vaa-field loj-field material_upload_fields"
                                        id="year_of_publication">
                                        <div class="form-group">
                                            <label class="form-label">Year of Publication <span>*<span></label>
                                            <input type="number" class="form-control" name="year_of_publication"
                                                value="{{ old('year_of_publication') }}" requiredd=""
                                                data-parsley-required-message="Year of Publication is required"
                                                placeholder="">
                                            @error('year_of_publication')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div
                                        class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 text-field new_law_div_tag new_csl_div_tag new-folder taa-field vaa-field loj-field material_upload_fields">
                                        <div class="form-group">
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
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 text-field material_upload_fields"
                                        id="subject_div" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Subject <span><span></label>
                                            <select onchange="" class="form-control select" name="subject_id"
                                                id="subject_select" data-parsley-required-message="Subject is required"
                                                requiredd="" data-parsley-errors-container="#subject-error"
                                                data-placeholder="Select subject of material">
                                                <option value="">Select Subject</option>
                                                @isset($subjects)
                                                    @foreach ($subjects as $item)
                                                        <option data-value="{{ $item->material_type_id }}"
                                                            value="{{ $item->id }}" @selected(old('subject_id') == $item->id)>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <span class="invalid-feedback" id="subject-error" role="alert">
                                                @error('subject_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 taa-field material_upload_fields mb-3"
                                        id="privacy_div" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Privacy Code <span>*<span></label>
                                            <input type="password" id="password789767868" class="form-control"
                                                placeholder="*****" name="privacy_code" value="{{ old('privacy_code') }}"
                                                requiredd="">
                                            <span toggle="#password-field" onclick="viewPassword(this)"
                                                class="fa fa-fw fa-eye field-icon"></span>
                                            <div class="col-auto">
                                                <span id="passwordHelpInline" class="form-text">
                                                    *Privacy codes are required for institution only.
                                                </span>
                                            </div>
                                            @error('privacy_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 new_csl_div_tag text-field taa-field new_law_div_tag vaa-field loj-field material_upload_fields"
                                        id="material_upload_id">
                                        <div class="form-group">
                                            <label class="form-label">Material <span id="material_file_text">PDF</span>
                                                <span>*<span></label>
                                            <label class="btn btn-primary btn-block custom-file-upload">
                                                <input requiredd="" accept="application/pdf" name="material_file_id"
                                                    id="material_file" data-parsley-errors-container="#material-file-error"
                                                    type="file" />
                                                <i class="fa fa-upload">&nbsp</i>
                                                <span id="file_text">Upload Material
                                                    in
                                                    PDF</span>
                                            </label>
                                            <div id="material_file_preview" style="display: none">
                                                <div class="main-chat-header">
                                                    <div class="main-chat-msg-name">
                                                        <h6 id="material_file_name"></h6>
                                                        <small id="material_file_size"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback" id="material-file-error" role="alert">
                                                @error('material_file_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 new-folder material_upload_fields"
                                        id="folder_cover_div" style="display:none">
                                        <div class="form-group">
                                            <label class="form-label">Folder Cover <span>*<span></label>
                                            <label class="btn btn-primary btn-block custom-file-upload">
                                                <input type="file" accept=".jpg, .png, image/jpeg, image/png"
                                                    id="folder_cover2" name="folder_cover_id" requiredd=""
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
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 text-field taa-field vaa-field loj-field material_upload_fields"
                                        id="material_cover_id">
                                        <div class="form-group">
                                            <label class="form-label">Material Cover <span>*<span></label>
                                            <label class="btn btn-primary btn-block custom-file-upload">
                                                <input type="file" accept=".jpg, .png, image/jpeg, image/png"
                                                    id="material_cover" name="material_cover_id" requiredd=""
                                                    data-parsley-errors-container="#material-cover-error" onchange="" />
                                                <i class="fa fa-upload">&nbsp</i>
                                                <span id="cover_text"> Upload Material Cover(
                                                    PNG, and
                                                    JPEG)</span>
                                            </label>
                                            <div id="material_cover_preview" style="display: none">
                                                <div class="main-chat-header">
                                                    <div class="main-img-user">
                                                        <img alt="" id="material_cover_img" class="avatar avatar-md">
                                                    </div>
                                                    <div class="main-chat-msg-name">
                                                        <h6 id="material_cover_name"></h6>
                                                        <small id="material_cover_size"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback" id="material-cover-error" role="alert">
                                                @error('material_cover_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 text-field taa-field vaa-field loj-field material_upload_fields"
                                        id="material_desc_id">
                                        <div class="form-group">
                                            <label class="form-label">Material Description <span>*<span></label>
                                            <textarea class="form-control textarea" data-parsley-required-message="Material Description is required"
                                                requiredd="" name="material_desc" rows="10">{{ old('material_desc') }}</textarea>
                                            @error('material_desc')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label class="custom-control custom-checkbox">
                                            <input requiredd="" type="checkbox"
                                                data-parsley-required-message="Terms and Conditions is required"
                                                class="custom-control-input" {{ old('terms') == 'agreed' ? 'checked' : '' }}
                                                name="terms" value="agreed">
                                            <span class="custom-control-label">I have read and I agree with the <a
                                                    href="" target="blank"><b style="font-weight: 900">Terms and
                                                        Conditions</b></a> of
                                                Virtual Law Library</span>
                                        </label>
                                        @error('terms')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-xl-12 text-center">
                                        <button type="submit" class="btn btn-primary p-3 pt-3 pt-2"
                                            style="font-size: 18px">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.dashboard.includes.material')
@endsection
