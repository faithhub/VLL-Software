@extends('layouts/dashboard/app')
@section('content')
    <style>
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        .sub-btn {
            margin-top: 3rem;
        }

        .sub-card {
            background-color: #F0F4F9
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-4">
                        <h6 class="mb-1 mt-1 font-weight-bold h4">General Settings</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <form class="validate-form" action="{{ route('vendor.settings') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12 col-xl-12">
                                    <div class="box-widget widget-user">
                                        <div class="widget-user-image1 d-xl-flex d-block">
                                            <img alt="User Avatar" class="avatar brround p-0"
                                                src="{{ asset(Auth::user()->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}">
                                            <div style="display: table">
                                                <div class="mt-1 ms-xl-5 add-new-member">
                                                    <label class="btn btn-sm btn-primary m-3">
                                                        <input name="avatar" accept="image/*"
                                                            type="file" />Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5 settings">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div class="form-group">
                                                <label class="form-label">Full Name</label>
                                                <input name="name" type="text" class="form-control" required=""
                                                    data-parsley-required-message="Full name is required"
                                                    placeholder="First Name" value="{{ Auth::user()->name }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div class="form-group">
                                                <label class="form-label">Email address</label>
                                                <input name="email" type="email" class="form-control"
                                                    placeholder="Email" required=""
                                                    data-parsley-required-message="Email is required"
                                                    value="{{ Auth::user()->email }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div class="form-group">
                                                <label class="form-label">Phone Number</label>
                                                <input name="phone" type="number" class="form-control"
                                                    placeholder="+234 905 678 234 " value="{{ Auth::user()->phone }}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                                            <label class='form-label'>Gender</label>
                                            <div class='d-flex' style='margin-bottom:-10px'>
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' name='gender' type='radio'
                                                        id='inlineCheckbox1' value='male' required=''
                                                        {{ Auth::user()->gender == 'male' ? 'checked' : '' }}
                                                        data-parsley-errors-container='#gender-error'
                                                        data-parsley-required-message='Status is required'>
                                                    <label class='form-check-label' for='inlineCheckbox1'>Male</label>
                                                </div>
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input'
                                                        {{ Auth::user()->gender == 'female' ? 'checked' : '' }}
                                                        name='gender' type='radio' id='inlineCheckbox2' value='female'>
                                                    <label class='form-check-label' for='inlineCheckbox2'>Female</label>
                                                </div>
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input'
                                                        {{ Auth::user()->gender == 'entity' ? 'checked' : '' }}
                                                        name='gender' type='radio' id='inlineCheckbox3' value='entity'>
                                                    <label class='form-check-label' for='inlineCheckbox3'>Entity</label>
                                                </div>
                                            </div>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span class='invalid-feedback' id='gender-error' role='alert'></span>
                                        </div>

                                        {{-- <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Subscriptions</label>
                                                <button onclick="shiNew(event)" data-type="dark" data-size="l"
                                                    data-title="Subscriptions" href="{{ route('vendor.subscriptions') }}"
                                                    class="sub-link btn btn-sm btn-primary">Change</button>
                                                @isset($sub)
                                                    <div class="mat-title pl-3 mt-3">
                                                        <h6><b class="font-weight-bold">Plan: {{ $sub->sub->name }} </b></h6>
                                                        <h6><b class="font-weight-bold">Subscribed On:
                                                            </b>{{ $sub->start_date }}</h6>
                                                        <h6><b class="font-weight-bold">Expired On:
                                                            </b>{{ $sub->expired_date }}</h6>
                                                        <h6><b class="font-weight-bold">Status: </b><span
                                                                class="badge badge-gradient-success">Active</span></h6>
                                                    </div>
                                                @endisset
                                            </div>
                                        </div> --}}

                                    </div>
                                    <div class="col-lg-12 col-xl-12 text-center">
                                        <button type="submit" class="btn btn-primary p-3 pt-2 pt-2"
                                            style="font-size: 18px">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="card border-10 p-4">
                            <div class="card-header border-bottom-0 mb-0">
                                <h6 class="mb-1 mt-1 font-weight-bold h4">
                                    <img src="{{ asset('assets/dashboard/images/flags/NGN.png') }}"
                                        alt="USD" class="mb-1 country-settings">
                                        Naira (NGN) Account</h6>
                            </div>
                            <div class="row mt-5 settings">
                                <div class="col-lg-12 col-md-12 col-xl-12">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Name</label>
                                            <select class="form-control select" name="bank_id" id="bank_id"
                                                data-parsley-required-message="The Bank is required"
                                                data-placeholder="Select your Bank"
                                                @if (Auth::user()->acc_verified) disabled @endif>
                                                <option value="">Select your Bank</option>
                                                @isset($banks)
                                                    @foreach ($banks as $bank)
                                                        <option data-code="{{ $bank->code }}"
                                                            data-value="{{ $bank->id }}" value="{{ $bank->id }}"
                                                            {{ Auth::user()->bank_id == $bank->id ? 'selected' : '' }}>
                                                            {{ $bank->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Account Number</label>
                                            <div class="d-flex">
                                                <input type="number" name="acc_number" class="form-control"
                                                    id="acc_number" placeholder=""
                                                    @if (Auth::user()->acc_verified) disabled @endif
                                                    value="{{ Auth::user()->acc_number }}">
                                                @if (Auth::user()->acc_verified)
                                                    <button type="button" class="btn btn-primary" disabled>
                                                        <i class="fa fa-lock"></i>
                                                        <b class="verify-btn">Verified</b>
                                                    </button>
                                                @else
                                                    <button type="button" id="verify-me" class="btn btn-primary"
                                                        onclick="verifyAccount()">
                                                        <i class="" id="spinner"></i>
                                                        <b id="verify-btn">Verify</b>
                                                    </button>
                                                @endif
                                            </div>
                                            @error('acc_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Account Name</label>
                                            <input type="text" name="acc_name" id="acc_name" readonly
                                                class="form-control" placeholder=""
                                                @if (Auth::user()->acc_verified) disabled @endif
                                                value="{{ Auth::user()->acc_name }}">
                                            @error('acc_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="card border-10 p-4">
                            <div class="card-header border-bottom-0 mb-0">
                                <h6 class="mb-1 mt-1 font-weight-bold h4">
                                    <img src="{{ asset('assets/dashboard/images/flags/USD.png') }}"
                                        alt="USD" class="mb-1 country-settings">
                                    Dollar (USD) Account
                                </h6>
                            </div>
                            <div class="row mt-5 settings">
                                <div class="col-lg-12 col-md-12 col-xl-12">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Name</label>
                                            <select class="form-control select" name="dom_bank_id" id="dom_bank_id"
                                                data-parsley-required-message="The Bank is required"
                                                data-placeholder="Select your Bank"
                                                @if (Auth::user()->dom_acc_verified) disabled @endif>
                                                <option value="">Select your Bank</option>
                                                @isset($banks)
                                                    @foreach ($banks as $bank)
                                                        <option data-code="{{ $bank->code }}"
                                                            data-value="{{ $bank->id }}" value="{{ $bank->id }}"
                                                            {{ Auth::user()->dom_bank_id == $bank->id ? 'selected' : '' }}>
                                                            {{ $bank->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Account Number</label>
                                            <div class="d-flex">
                                                <input type="number" name="dom_acc_number" class="form-control"
                                                    id="dom_acc_number" placeholder=""
                                                    @if (Auth::user()->dom_acc_verified) disabled @endif
                                                    value="{{ Auth::user()->dom_acc_number }}">
                                                @if (Auth::user()->dom_acc_verified)
                                                    <button type="button" class="btn btn-primary" disabled>
                                                        <i class="fa fa-lock"></i>
                                                        <b class="dom_verify-btn">Verified</b>
                                                    </button>
                                                @else
                                                    <button type="button" id="dom_verify-me" class="btn btn-primary"
                                                        onclick="verifyDomAccount()">
                                                        <i class="" id="dom_spinner"></i>
                                                        <b id="dom_verify-btn">Verify</b>
                                                    </button>
                                                @endif
                                            </div>
                                            @error('dom_acc_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Account Name</label>
                                            <input type="text" name="dom_acc_name" id="dom_acc_name" readonly
                                                class="form-control" placeholder=""
                                                @if (Auth::user()->dom_acc_verified) disabled @endif
                                                value="{{ Auth::user()->dom_acc_name }}">
                                            @error('dom_acc_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
    @include('layouts.dashboard.includes.vendor-verify-acc')
@endsection
