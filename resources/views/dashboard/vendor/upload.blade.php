@extends('layouts/dashboard/app')
@section('content')
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
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-1">
                        <h6 class="mb-1 mt-1 font-weight-bold h6">
                            <a href="{{ route('vendor.library') }}">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <h6 class="mb-1 mt-1 font-weight-bold h4">
                            Upload Material Information
                        </h6>
                        <form method="POST" action="" class="validate-form" >
                            <div class="row mt-5 mb-5 settings">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="form-label">Title of Material
                                            <span>*<span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title') }}" required
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
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title') }}" required
                                            data-parsley-required-message="Name of Author is required" placeholder="">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="form-label">Version <span>*<span></label>
                                        <input type="email" class="form-control" placeholder="2nd Version" name="title"
                                            value="{{ old('title') }}" required
                                            data-parsley-required-message="Version is required">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group settings">
                                        <label class="form-label">Price <span>*<span></label>
                                        <select onchange="bookPrice(this.value)" required class="form-control" name="bank"
                                            id="search" data-parsley-required-message="Price is required"
                                            data-placeholder="Select Price">
                                            <option value=""></option>
                                            <option value="Paid">Paid</option>
                                            <option value="Free">Free</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="paidDiv" style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Amount <span>*<span></label>
                                        <input type="number" class="form-control" placeholder="5000" min="1"
                                            name="title" value="{{ old('title') }}"
                                            data-parsley-required-message="Title of Material is required">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Type of Material <span>*<span></label>
                                        <select onchange="" class="form-control" name="material_type" id="material_type"
                                            data-parsley-required-message="Type of Material is required" required
                                            data-placeholder="Select type of material">
                                            <option value="">Select Type of Material</option>
                                            @isset($material_types)
                                                @foreach ($material_types as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('material_type') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
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
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="form-label">Year of Publication
                                            <span>*<span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title') }}" required
                                            data-parsley-required-message="Year of Publication is required" placeholder="">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="form-label">Country of Publication
                                            <span>*<span></label>
                                        <select onchange="" class="form-control" name="country_of_publication"
                                            id="material_type" required
                                            data-parsley-required-message="Country of Publication is required">
                                            <option value="">Select Country</option>
                                            @isset($countries)
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('country_of_publication') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        @error('country_of_publication')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Publishers <span>*<span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title') }}"
                                            data-parsley-required-message="Title of Material is required" placeholder="">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Tags <span>*<span></label>
                                        <div class="tags-show"></div>
                                        <input type="text" multiple class="form-control tm-input tm-input-inf"
                                            placeholder="Input material tags" name="title" value="{{ old('title') }}"
                                            data-parsley-required-message="Title of Material is required" placeholder="">
                                        <div class="col-auto">
                                            <span id="passwordHelpInline" class="form-text">
                                                Input words to aid search in Bookstore (Law, Legal)
                                            </span>
                                        </div>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Subject <span>*<span></label>
                                        <select onchange="" class="form-control" name="subject" id="subject"
                                            data-parsley-required-message="Price is required"
                                            data-placeholder="Select subject of material">
                                            <option value="">Select Type of Material</option>
                                            @isset($subjects)
                                                @foreach ($subjects as $item)
                                                    <option data-value="{{ $item->material_type_id }}"
                                                        value="{{ $item->id }}"
                                                        {{ old('subject') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        @error('subject')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Privacy Code <span>*<span></label>
                                        <input type="password" id="password789767868" class="form-control"
                                            placeholder="*****" name="privacy_code" value="">
                                        <span toggle="#password-field" onclick="viewPassword(this)"
                                            class="fa fa-fw fa-eye field-icon"></span>
                                        <div class="col-auto">
                                            <span id="passwordHelpInline" class="form-text">
                                                *Privacy codes are required for institution only.
                                            </span>
                                        </div>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Material Pdf <span>*<span></label>
                                        <label class="btn btn-primary btn-block custom-file-upload">
                                            <input type="file" /><i class="fa fa-upload">&nbsp</i> Upload Material in
                                            PDF</label>
                                        @error('title')
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
                                            <input type="file" /><i class="fa fa-upload">&nbsp</i> Upload Book Cover(
                                            PNG,
                                            JPEG and PDF)</label>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Material Description <span>*<span></label>
                                        <textarea class="form-control" name="material_desc" rows="8">{{ old('material_desc') }}</textarea>
                                        @error('material_desc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="terms"
                                            value="option2">
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
                                    <button type="submit" class="btn btn-primary p-3 pt-3 pt-2" style="font-size: 18px">Submit</button>
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

    <script type="text/javascript">
        $("#material_type").change(function() {
            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#subject option').clone());
            }
            var id = $(this).val();
            var options = $(this).data('options').filter('[data-value=' + id + ']');
            $('#subject').html(options);
        });

        function bookPrice(value) {
            console.log(value);
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
        }

        function materialType(id) {
            if (id == '2') {
                document.getElementById('citation').style.display = 'block';
            } else {
                document.getElementById('citation').style.display = 'none';
            }
            switch (id) {
                case "5":
                    document.getElementById('videoUpload').style.display = 'block';
                    document.getElementById('pdfUpload').style.display = 'none';
                    break;
                default:
                    document.getElementById('videoUpload').style.display = 'none';
                    document.getElementById('pdfUpload').style.display = 'block';
                    break;
            }
        }

        function coverType(id) {
            switch (id) {
                case "Book Cover":
                    document.getElementById('bookCover').style.display = 'block';
                    document.getElementById('videoCover').style.display = 'none';
                    break;
                case "Video Cover":
                    document.getElementById('videoCover').style.display = 'block';
                    document.getElementById('bookCover').style.display = 'none';
                    break;
                default:
                    document.getElementById('videoCover').style.display = 'none';
                    document.getElementById('bookCover').style.display = 'none';
                    break;
            }
        }
        // document.onreadystatechange = function() {
        //     materialTypeID = document.getElementById('materialTypeID').value
        //     materialType(materialTypeID)
        //     coverTypeID = document.getElementById('coverTypeID').value
        //     coverType(coverTypeID)
        //     bookPriceID = document.getElementById('bookPriceID').value
        //     bookPrice(bookPriceID)
        // }
        // window.onload = coverType(id);
        // window.onload = materialType(id);
    </script>
@endsection
