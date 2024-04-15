@extends('layouts/dashboard/app')
@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    {{-- <link href="{{ asset('date-time/css/mobiscroll.jquery.min.css') }}" rel="stylesheet" /> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            Setup Master Class
                        </h6>
                        <form method="POST" action="{{ route('vendor.setup_master_class') }}" class="validate-form"
                            enctype="multipart/form-data">
                            <input type="hiddenn" name="timezone" id="timezone">
                            @csrf
                            <div class="row mt-5 mb-5 settings">
                                <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 new_law_div_tag text-field taa-field vaa-field loj-field material_upload_fields"
                                    id="mat_title_div">
                                    <div class="form-group">
                                        <label class="form-label">Master Class Title</span>
                                            <span class="imp">*<span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title') }}" requiredd=""
                                            data-parsley-required-message="Master Class Title is required" placeholder="">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Duration <span class="imp">*<span></label>
                                        <select class="form-control select2" name="duration" id="folder-duration" requiredd
                                            data-parsley-required-message="Duration is required">
                                            <option value="">Select Duration</option>
                                            <option value="1" @selected(old('duration') == '1')>1 Month</option>
                                            <option value="3" @selected(old('duration') == '3')>3 Months</option>
                                            <option value="6" @selected(old('duration') == '6')>6 Months</option>
                                        </select>
                                        @error('duration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Interval <span class="imp">*<span></label>
                                        <select class="form-control select2" name="interval" id="" requiredd
                                            data-parsley-required-message="Interval is required">
                                            <option value="">Select Interval</option>
                                            <option value="weekly" @selected(old('interval') == 'weekly')>Weekly</option>
                                            <option value="bi-weekly" @selected(old('interval') == 'bi-weekly')>Bi-Weekly</option>
                                            <option value="monthly" @selected(old('interval') == 'monthly')>Monthly</option>
                                        </select>
                                        @error('interval')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Dates <span class="imp">*<span></label>
                                        <input id="dateRangeNow" name="dates" value="{{ old('dates') }}"
                                            class="form-control" placeholder="Select class dates" style="width: 100%">
                                    </div>
                                </div>

                                <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Time: <span class="imp">*<span></label>
                                        <input type="text" id="" class="form-control timepicker" placeholder="Select Time"
                                            value="{{ old('time') }}" name="time" requiredd=""
                                            data-parsley-required-message="Time is required">

                                        @error('time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12 text-field"
                                    id="priceDiv">
                                    <div class="form-group settings">
                                        <label class="form-label">Price <span class="imp">*<span></label>
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
                                        <label class="form-label">Amount <span class="imp">*<span></label>
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
                                <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Instructor Name <span class="imp">*<span></label>
                                        <input type="text" class="form-control" name="instructor_name"
                                            value="{{ old('instructor_name') }}" requiredd=""
                                            data-parsley-required-message="Title of Material is required" placeholder="">
                                        @error('instructor_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Special Guest <span class="imp">*<span></label>
                                        <input type="text" class="form-control" name="special_guest"
                                            value="{{ old('special_guest') }}" requiredd=""
                                            data-parsley-required-message="Year of Publication is required"
                                            placeholder="">
                                        @error('special_guest')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="upload-form-fields col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Master Class Cover <span class="imp">*<span></label>
                                        <label class="btn btn-primary btn-block custom-file-upload">
                                            <input type="file" accept=".jpg, .png, image/jpeg, image/png"
                                                id="master_class" name="master_class_id" requiredd=""
                                                data-parsley-errors-container="#material-cover-error" onchange="" />
                                            <i class="fa fa-upload">&nbsp</i>
                                            <span id="cover_text"> Upload Master Class Cover(
                                                PNG, and
                                                JPEG)</span>
                                        </label>
                                        <div id="master_class_preview" style="display: none">
                                            <div class="main-chat-header">
                                                <div class="main-img-user">
                                                    <img alt="" id="master_class_img" class="avatar avatar-md">
                                                </div>
                                                <div class="main-chat-msg-name">
                                                    <h6 id="master_class_name"></h6>
                                                    <small id="master_class_size"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="invalid-feedback" id="material-cover-error" role="alert">
                                            @error('master_class_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Description <span class="imp">*<span></label>
                                        <textarea class="form-control textarea" data-parsley-required-message="Description is required" requiredd=""
                                            name="desc" rows="3">{{ old('desc') }}</textarea>
                                        @error('desc')
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.dashboard.includes.master-class')
    {{-- 
       <div mbsc-page class="demo-single-select">
                            <div style="height:100%">
                                <label>
                                    Date
                                    <input id="demo-single-select-date" mbsc-input data-input-style="box"
                                        data-label-style="stacked" placeholder="Please Select..." />
                                </label>
                                <label>
                                    Date & time
                                    <input id="demo-multiple-select-datetime" mbsc-input data-input-style="box"
                                        data-label-style="stacked" placeholder="Please Select..." />
                                </label>
                                <label>
                                    Date & timegrid
                                    <input id="demo-single-select-timegrid" mbsc-input data-input-style="box"
                                        data-label-style="stacked" placeholder="Please Select..." />
                                </label>
                            </div>
                        </div> --}}
@endsection
2
