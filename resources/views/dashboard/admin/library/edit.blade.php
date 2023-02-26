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
                        <h6 class="mb-1 mt-1 font-weight-bold h4">
                            Edit Material Information
                        </h6>
                        <form method="POST" action="{{ route('admin.edit.library', $material['id']) }}" class="validate-form"
                            enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{ $material['id'] }}">
                            @csrf
                            <input type="hidden" name="material_type_value" value="" id="material_type_value">
                            <div class="row mt-5 mb-5 settings">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="form-label">Title of Material
                                            <span>*<span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ $material['title'] ?? '' }}" requiredd=""
                                            data-parsley-required-message="Title of Material is required" placeholder="">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6"  id="name_of_author">
                                    <div class="form-group">
                                        <label class="form-label">Name of Author <span>*<span></label>
                                        <input type="text" class="form-control" name="name_of_author"
                                            value="{{ $material['name_of_author'] ?? '' }}" requiredd=""
                                            data-parsley-required-message="Name of Author is required" placeholder="">
                                        @error('name_of_author')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" id="name_of_party" style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Name of Party <span>*<span></label>
                                        <input type="text" class="form-control" name="name_of_party"
                                            value="{{ $material['name_of_party'] }}" requiredd=""
                                            data-parsley-required-message="Name of Author is required" placeholder="">
                                        @error('name_of_party')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" id="citation" style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Citation <span>*<span></label>
                                        <input type="text" class="form-control" name="citation"
                                            value="{{ $material['citation'] }}" requiredd=""
                                            data-parsley-required-message="Name of Author is required" placeholder="">
                                        @error('citation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" id="version">
                                    <div class="form-group">
                                        <label class="form-label">Version <span>*<span></label>
                                        <input type="text" class="form-control" placeholder="2nd Version" name="version"
                                            value="{{ $material['version'] ?? '' }}" requiredd=""
                                            data-parsley-required-message="Version is required">
                                        @error('version')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" id="TAA-data-no2">
                                    <div class="form-group">
                                        <label class="form-label">Country of Publication
                                            <span>*<span></label>
                                        <select onchange="" class="form-control select" name="country_id"
                                            id="material_type" requiredd=""
                                            data-parsley-errors-container="#country_of_publication-error"
                                            data-parsley-required-message="Country of Publication is required">
                                            <option value="">Select Country</option>
                                            @isset($countries)
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $material['country_id'] == $item->id ? 'selected' : '' }}>
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="name_of_court"
                                    style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Name of Court <span>*<span></label>
                                        <select class="form-control select" name="name_of_court"
                                            data-parsley-required-message="Name of Court is required" requiredd=""
                                            data-parsley-errors-container="#court-name-error" id="select_name_of_court"
                                            data-placeholder="Select Court">
                                            <option data-value="153" value="">Select Court</option>
                                            <option data-value="153" value="Supreme Court" @selected($material['name_of_court'] == "Supreme Court" )>Supreme Court</option>
                                            <option data-value="153" value="Court of Appeal" @selected($material['name_of_court'] == "Court of Appeal" )>Court of Appeal</option>
                                            <option data-value="153" value="Federal High Court" @selected($material['name_of_court'] == "Federal High Court" )>Federal High Court</option>
                                            <option data-value="153" value="National Industrial Court" @selected($material['name_of_court'] == "National Industrial Court" )>National Industrial Court</option>
                                            <option data-value="153" value="State High Court" @selected($material['name_of_court'] == "State High Court" )>State High Court</option>
                                            <option data-value="153" value="Tax Tribunal/ Tax Appeal Tribunal" @selected($material['name_of_court'] == "Tax Tribunal/ Tax Appeal Tribunal" )>Tax Tribunal/ Tax Appeal Tribunal</option>
                                            <option data-value="153" value="Election Tribunal" @selected($material['name_of_court'] == "Election Tribunal" )>Election Tribunal</option>
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
                                                        {{ $material['material_type_id'] == $item->id ? 'selected' : '' }}>
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="folder_div">
                                    <div class="form-group">
                                        <label class="form-label">Folder <span>*<span></label>
                                        <div class="d-flex">
                                            <select class="form-control select2 select" name="folder_id"
                                                data-parsley-required-message="Subject is required" requiredd=""
                                                data-parsley-errors-container="#folder-error"
                                                data-placeholder="Select folder">
                                                <option value="">Select folder</option>
                                                @isset($folders)
                                                    @foreach ($folders as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $material['folder_id'] == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <button type="button" onclick="shiNew(event)" data-type="dark"
                                                data-size="m" data-title="Add New Folder"
                                                href="{{ route('vendor.add_folder') }}" class="btn btn-primary">Add
                                                New</button>
                                        </div>
                                        <span class="invalid-feedback" id="folder-error" role="alert">
                                            @error('folder_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" id="TAA-data-no1">
                                    <div class="form-group">
                                        <label class="form-label">Year of Publication
                                            <span>*<span></label>
                                        <input type="number" class="form-control" name="year_of_publication"
                                            value="{{ $material['year_of_publication'] }}" requiredd=""
                                            data-parsley-required-message="Year of Publication is required"
                                            placeholder="">
                                        @error('year_of_publication')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" id="priceDiv">
                                    <div class="form-group settings">
                                        <label class="form-label">Price <span>*<span></label>
                                        <select requiredd="" class="form-control select2"
                                            data-parsley-errors-container="#price-error" id="bookPriceSelect" name="price"
                                            data-parsley-required-message="Price is required"
                                            data-placeholder="Select Price">
                                            <option value=""></option>
                                            <option value="Paid"
                                                @selected($material['price'] == 'Paid')>Paid
                                            </option>
                                            <option value="Free"
                                                @selected($material['price'] == 'Free')>Free
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="paidDiv" style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Amount <span>*<span></label>
                                        <div class="d-flex">
                                            <select class="form-control" name="currency_id" id="currency_id"
                                                style="width: fit-content !important">
                                                @isset($app_currencies)
                                                    @foreach ($app_currencies as $app_currency)
                                                        <option value="{{ $app_currency->id }}" @selected($material['currency_id'] == $app_currency->id) 
                                                             style="background-image:url('{{ asset($app_currency->flag) }}');">
                                                             {{ $app_currency->name }} ({{ $app_currency->symbol }})
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <input type="number" class="form-control" placeholder="5000" min="1"
                                                name="amount" value="{{ $material['amount'] }}" requiredd=""
                                                data-parsley-required-message="Title of Material is required">
                                        </div>
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="TAA-data1"
                                    style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Country of University
                                            <span>*<span></label>
                                        <select class="form-control select" name="test_country_id" id="test_country_id"
                                            requiredd="" data-parsley-errors-container="#text-country-error"
                                            data-parsley-required-message="Country of Publication is required">
                                            <option value="">Select Country</option>
                                            @isset($countries)
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}" @selected(Auth::user()->country_id == $item->id)>
                                                        
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="TAA-data2"
                                    style="display: none">
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
                                                        @selected(Auth::user()->university_id == $item->id)>
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="publishers">
                                    <div class="form-group">
                                        <label class="form-label">Publishers <span>*<span></label>
                                        <input type="text" class="form-control" name="publisher"
                                            value="{{ $material['publisher'] }}" requiredd=""
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
                                        <input type="text" data-role="tagsinput"
                                            class="form-control tm-input tm-input-inf" placeholder="Input material tags"
                                            requiredd="" name="tags"
                                            value="
                                            @foreach ($material['tags'] as $tag)
                                                {{ $tag }} @endforeach
                                            "
                                            data-parsley-required-message="Title of Material is required" placeholder="">
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="subject_div">
                                    <div class="form-group">
                                        <label class="form-label">Subject <span>*<span></label>
                                        <select onchange="" class="form-control select" name="subject_id"
                                            id="subject_select" data-parsley-required-message="Subject is required"
                                            requiredd="" data-parsley-errors-container="#subject-error"
                                            data-placeholder="Select subject of material">
                                            <option value="">Select Type of Material</option>
                                            @isset($subjects)
                                                @foreach ($subjects as $item)
                                                    <option data-value="{{ $item->material_type_id }}"
                                                        value="{{ $item->id }}"
                                                        {{ $material['subject_id'] == $item->id ? 'selected' : '' }}>
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3" id="privacy_div"
                                    style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Privacy Code <span>*<span></label>
                                        <input type="password" id="password789767868" class="form-control"
                                            placeholder="*****" name="privacy_code"
                                            value="{{ $material['privacy_code'] }}" requiredd="">
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Material Description <span>*<span></label>
                                        <textarea class="form-control textarea" data-parsley-required-message="Material Description is required" requiredd=""
                                            name="material_desc" rows="10">{{ $material['material_desc'] }}</textarea>
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
                                            class="custom-control-input"
                                            {{ $material['terms'] == 'agreed' ? 'checked' : '' }} name="terms"
                                            value="agreed">
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
                                <form class="ff_fileupload_hidden" action="" method="post"
                                    enctype="multipart/form-data"><input type="hidden" name="action"
                                        value="fileuploader"><input type="file" name="files" multiple=""
                                        accept=".jpg, .png, image/jpeg, image/png"></form>
                                <div class="col-lg-12 col-xl-12 text-center">
                                    <button type="submit" class="btn btn-primary p-3 pt-3 pt-2"
                                        style="font-size: 18px">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.dashboard.includes.material')
@endsection
