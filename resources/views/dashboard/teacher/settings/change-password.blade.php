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
                        <h6 class="mb-1 mt-1 font-weight-bold h4">Change Password</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <form class="validate-form" action="{{ route('teacher.change-password') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-5 settings">
                                    <div class="col-lg-12 col-xl-12 mb-4">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Current Password</label>
                                                <input name="current_password" type="password" class="form-control"
                                                    required="" id="current_password89678638268"
                                                    data-parsley-required-message="Current Password is required"
                                                    placeholder="">
                                                <span toggle="#password-field" onclick="viewPassword(this)"
                                                    class="fa fa-fw fa-eye field-icon"></span>
                                                @error('current_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">New Password</label>
                                                <input name="new_password" type="password" class="form-control"
                                                    placeholder="" required="" id="new_password89679868523875"
                                                    data-parsley-required-message="New Password is required">
                                                <span toggle="#password-field" onclick="viewPassword(this)"
                                                    class="fa fa-fw fa-eye field-icon"></span>
                                                @error('new_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Confirm New Password</label>
                                                <input name="confirm_new_password" type="password" class="form-control"
                                                    placeholder="" id="confirm_new_password9686575">
                                                <span toggle="#password-field" onclick="viewPassword(this)"
                                                    class="fa fa-fw fa-eye field-icon"></span>
                                                @error('confirm_new_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-12 text-center">
                                        <button class="btn btn-primary p-3 pt-2 pt-2" style="font-size: 18px">Change
                                            Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
