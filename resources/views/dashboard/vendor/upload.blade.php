@extends('layouts/dashboard/app')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    <style>
        #img-2 {
            position: absolute;
            justify-content: center;
            width: 10%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

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

        .select_folder {
            width: 700px !important
        }

        .select2-container {
            width: 100% !important;
        }
        .select2-container .select2-selection--single{
            height: 55px;
        }



        .bootstrap-tagsinput .tag {
            /* margin-right: 2px; */
            color: #ffffff;
            background: var(--primary-bg-color);
            /* padding: 3px 7px;
                                                                                                    border-radius: 3px; */
        }

        .bootstrap-tagsinput {
            height: 55px;
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
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-1">
                        <h6 class="mb-1 mt-1 font-weight-bold h6">
                            <a href="{{ route('vendor.index') }}">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <h6 class="mb-1 mt-1 font-weight-bold h4">
                            Upload Material Information
                        </h6>
                        <form method="POST" action="{{ route('vendor.upload') }}" class="validate-form"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="material_type_value" value="" id="material_type_value">
                            <div class="row mt-5 mb-5 settings">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="form-label">Title of Material
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
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
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
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group settings">
                                        <label class="form-label">Price <span>*<span></label>
                                        <select requiredd="" class="form-control select2"
                                            data-parsley-errors-container="#price-error" id="bookPriceSelect" name="price"
                                            data-parsley-required-message="Price is required"
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="paidDiv" style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Amount <span>*<span></label>
                                        <input type="number" class="form-control" placeholder="5000" min="1"
                                            name="amount" value="{{ old('amount') }}" requiredd=""
                                            data-parsley-required-message="Title of Material is required">
                                        @error('amount')
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="folder_div">
                                    <div class="form-group">
                                        <label class="form-label">Folder <span>*<span></label>
                                        <div class="d-flex">
                                            <select class="form-control select" name="folder_id"
                                                data-parsley-required-message="Subject is required" requiredd=""
                                                data-parsley-errors-container="#folder-error"
                                                data-placeholder="Select folder">
                                                <option value="">Select folder</option>
                                                @isset($folders)
                                                    @foreach ($folders as $item)
                                                        <option value="{{ $item->id }}" @selected(old('folder_id') == $item->id)>
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
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" id="TAA-data-no2">
                                    <div class="form-group">
                                        <label class="form-label">Country of Publication
                                            <span>*<span></label>
                                        <select onchange="" class="form-control select" name="country_id"
                                            id="" requiredd=""
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="TAA-data1" style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Country of University
                                            <span>*<span></label>
                                        <select class="form-control select" name="test_country_id" id="test_country_id"
                                            requiredd="" data-parsley-errors-container="#text-country-error"
                                            data-parsley-required-message="Country of Publication is required" disabled>
                                            <option value="">Select Country</option>
                                            @isset($countries)
                                                @foreach ($countries as $item)
                                                    <option  value="{{ $item->id }}" @selected(Auth::user()->country_id == $item->id)>
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="TAA-data2" style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Universities
                                            <span>*<span></label>
                                        <select class="form-control select" name="university_id" id="university_id"
                                            requiredd="" data-parsley-errors-container="#university-error"
                                            data-parsley-required-message="University is required" disabled>
                                            <option value="">Select Univerty</option>
                                            @isset($universities)
                                                @foreach ($universities as $item)
                                                    <option value="{{ $item->id }}" @selected(Auth::user()->university_id == $item->id)>
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Tags <span>*<span></label>
                                        <input type="text" data-role="tagsinput"
                                            class="form-control tm-input tm-input-inf" placeholder="Input material tags"
                                            requiredd="" name="tags" value="{{ old('tags') }}"
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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3" id="privacy_div"
                                    style="display: none">
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
                                        <textarea class="form-control" data-parsley-required-message="Material Description is required" requiredd=""
                                            name="material_desc" rows="8">{{ old('material_desc') }}</textarea>
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
                                <form class="ff_fileupload_hidden" action="" method="post"
                                    enctype="multipart/form-data"><input type="hidden" name="action"
                                        value="fileuploader"><input type="file" name="files" multiple=""
                                        accept=".jpg, .png, image/jpeg, image/png"></form>
                                <div class="col-lg-12 col-xl-12 text-center">
                                    <button type="submit" class="btn btn-primary p-3 pt-3 pt-2"
                                        style="font-size: 18px">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#material_type_select").change(function() {

                if ($(this).data('options') === undefined) {
                    /*Taking an array of all options-2 and kind of embedding it on the select1*/
                    $(this).data('options', $('#subject_select option').clone());
                }
                var id = $(this).val();
                var text = $(this).find(':selected').attr('data-text');
                var matId = $(this).find(':selected').attr('data-matId');
                var uniqueId = matId.substring(0, 3);
                document.getElementById("material_type_value").value = uniqueId

                if (uniqueId == "TXT") {
                    console.log(id, text);
                    document.getElementById('subject_div').style.display = 'block';
                    document.getElementById('subject_div').style.display = 'block';
                } else {
                    document.getElementById('subject_div').style.display = 'none';
                    document.getElementById('subject_div').style.display = 'none';
                }

                if (uniqueId == "TAA") {
                    document.getElementById('privacy_div').style.display = 'block';
                    document.getElementById('TAA-data1').style.display = 'block';
                    document.getElementById('TAA-data2').style.display = 'block';
                    document.getElementById('TAA-data-no1').style.display = 'none';
                    document.getElementById('TAA-data-no2').style.display = 'none';
                } else {
                    document.getElementById('TAA-data-no2').style.display = 'block';
                    document.getElementById('TAA-data-no1').style.display = 'block';
                    document.getElementById('privacy_div').style.display = 'none';
                    document.getElementById('TAA-data2').style.display = 'none';
                    document.getElementById('TAA-data1').style.display = 'none';
                }

                if (uniqueId == "CSL") {
                    console.log(id, text);
                    document.getElementById('folder_div').style.display = 'block';
                } else {
                    document.getElementById('folder_div').style.display = 'none';
                }

                if (uniqueId == "VAA") {
                    $("#material_file_text").text("Video/Audio");
                    $("#file_text").text("Upload Material in Video or Audio format");
                    $('#material_file').attr("accept", ".mp4,.mp3");
                } else {
                    $('#material_file').attr("accept", ".pdf");
                    $("#material_file_text").text("PDF");
                    $("#file_text").text("Upload Material in PDF");
                }

                var options = $(this).data('options').filter('[data-value=' + id + ']');
                $('#subject_select').html(options);
            }).change();

        });


        $(document).ready(function() {
            $("#test_country_id").change(function() {
                if ($(this).data('options') === undefined) {
                    /*Taking an array of all options-2 and kind of embedding it on the select1*/
                    $(this).data('options', $('#university_id option').clone());
                }
                var id = $(this).val();
                var options = $(this).data('options').filter('[data-value=' + id + ']');
                console.log(options, id)
                $('#university_id').html(options);
            });
        });

        $(document).ready(function() {
            $("#bookPriceSelect").change(function() {
                var value = $(this).val()
                switch (value) {
                    case "Paid":
                        document.getElementById('paidDiv').style.display = 'block';
                        break;
                    case "Free":
                        document.getElementById('paidDiv').style.display = 'none';
                        break;
                    default:
                        document.getElementById('paidDiv').style.display = 'none';
                        break;
                }
            }).change();
        });




        // function materialType(id) {
        //     if (id == '2') {
        //         document.getElementById('citation').style.display = 'block';
        //     } else {
        //         document.getElementById('citation').style.display = 'none';
        //     }
        //     switch (id) {
        //         case "5":
        //             document.getElementById('videoUpload').style.display = 'block';
        //             document.getElementById('pdfUpload').style.display = 'none';
        //             break;
        //         default:
        //             document.getElementById('videoUpload').style.display = 'none';
        //             document.getElementById('pdfUpload').style.display = 'block';
        //             break;
        //     }
        // }

        // function coverType(id) {
        //     switch (id) {
        //         case "Book Cover":
        //             document.getElementById('bookCover').style.display = 'block';
        //             document.getElementById('videoCover').style.display = 'none';
        //             break;
        //         case "Video Cover":
        //             document.getElementById('videoCover').style.display = 'block';
        //             document.getElementById('bookCover').style.display = 'none';
        //             break;
        //         default:
        //             document.getElementById('videoCover').style.display = 'none';
        //             document.getElementById('bookCover').style.display = 'none';
        //             break;
        //     }
        // }

        // document.onreadystatechange = function() {
        //     bookPriceValue = document.getElementById('bookPrice').value
        //     bookPrice(bookPriceValue)

        // materialTypeID = document.getElementById('materialTypeID').value
        // materialType(materialTypeID)
        // coverTypeID = document.getElementById('coverTypeID').value
        // coverType(coverTypeID)
        // bookPriceID = document.getElementById('bookPriceID').value
        // bookPrice(bookPriceID)
        // }
    </script>
@endsection
