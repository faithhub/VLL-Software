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
                            <div class="col-lg-12 col-xl-12">
                                <div class="box-widget widget-user">
                                    <div class="widget-user-image1 d-xl-flex d-block">
                                        <img alt="User Avatar" class="avatar brround p-0"
                                            src="https://st4.depositphotos.com/14903220/22197/v/450/depositphotos_221970610-stock-illustration-abstract-sign-avatar-icon-profile.jpg">
                                        <div style="display: table">
                                            <div class="mt-1 ms-xl-5 add-new-member">
                                                <label class="btn btn-sm btn-primary m-3"><input
                                                        type="file" />Upload</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5 settings">
                                <div class="col-lg-6 col-xl-6">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group"> <label class="form-label">Full Name</label> <input
                                                type="text" class="form-control" placeholder="First Name"
                                                value="Patrenna">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group"> <label class="form-label">Email address</label> <input
                                                type="email" class="form-control" placeholder="Email"
                                                value="patrennaschell@gmail.com"> </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group"> <label class="form-label">Phone Number</label> <input
                                                type="number" class="form-control" placeholder="+234 905 678 234 "
                                                value="+(63-4567-890)"></div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label class="form-label">Gender</label>
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    value="option1">
                                                <label class="form-check-label" for="inlineCheckbox1">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                    value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                                    value="option3">
                                                <label class="form-check-label" for="inlineCheckbox3">Entity</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Subscriptions</label>
                                            <button onclick="shiNew(event)" data-type="dark" data-size="l"
                                                data-title="Subscriptions"
                                                href="{{ route('vendor.subscriptions') }}"
                                                class="sub-link btn btn-sm btn-primary">Change</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-xl-6">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Namee</label>
                                            <select class="form-control" name="bank"
                                                id="search" data-parsley-required-message="The Bank is required"
                                                data-placeholder="Select your Bank">
                                                @isset($banks)
                                                    @foreach ($banks as $bank)
                                                        <option data-value="{{ $bank->id }}" value="{{ $bank->id }}"
                                                            @if (old('form_type') == 'vendor') {{ old('bank') == $bank->id ? 'selected' : '' }} @endif>
                                                            {{ $bank->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group"> <label class="form-label">Bank Account Number</label>
                                            <input type="number" class="form-control" placeholder="" value=""> </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group"> <label class="form-label">Bank Account Name</label> <input
                                                type="" class="form-control" placeholder="" value=""></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12 text-center">
                                    <button class="btn btn-primary p-3 pt-2 pt-2" style="font-size: 18px">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade effect-scale" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1140px">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="card border-10 pt-2 card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 class="font-weight-bold">Subscription</h4>
                                        <h6 class="font-weight-bold">What plan would you like?</h6>
                                        <div class="row" style="margin-top: 2rem">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                <div class="card sub-card">
                                                    <div class="card-body">
                                                        <h5 class="font-weight-bold">Regular</h5>
                                                        <ul style="list-style-type:disc; margin-left:1.5rem">
                                                            <li>Access to All Free books</li>
                                                            <li>Access to view all books</li>
                                                            <li>Access to view all books</li>
                                                        </ul>
                                                        <div class="text-center sub-btn">
                                                            <button class="btn btn-primary" disabled>Active</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                <div class="card sub-card">
                                                    <div class="card-body">
                                                        <h5 class="font-weight-bold">Premium 1</h5>
                                                        <ul style="list-style-type:disc; margin-left:1.5rem">
                                                            <li>Access to All Free books</li>
                                                            <li>Access to view all books</li>
                                                            <li>Access to view all books</li>
                                                        </ul>
                                                        <div class="text-center sub-btn">
                                                            <button class="btn btn-primary">Upgrade</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                <div class="card sub-card">
                                                    <div class="card-body">
                                                        <h5 class="font-weight-bold">Premium 2</h5>
                                                        <ul style="list-style-type:disc; margin-left:1.5rem">
                                                            <li>Access to All Free books</li>
                                                            <li>Access to view all books</li>
                                                            <li>Access to view all books</li>
                                                        </ul>
                                                        <div class="text-center sub-btn">
                                                            <button class="btn btn-primary">Upgrade</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
