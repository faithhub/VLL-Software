@extends('layouts/dashboard/app')
@section('content')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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

        .tabs-menu-body {
            border: 0px
        }

        .richText .richText-editor {
            height: 55vh;
        }

        .richText .richText-editor:focus {
            border: 0 none #FFF !important;
            overflow: hidden !important;
            outline: none !important;
        }

        .slow .toggle-group {
            transition: left 0.7s;
            -webkit-transition: left 0.7s;
        }

        .fast .toggle-group {
            transition: left 0.1s;
            -webkit-transition: left 0.1s;
        }

        .quick .toggle-group {
            transition: none;
            -webkit-transition: none;
        }

        .toggle.btn {
            min-width: 5.2rem;
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title">Tabs Style 3</h3>
                </div> --}}
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class=" tab-menu-heading p-0 bg-white">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class=""><a href="#general"
                                            class="{{ empty(old('tabName')) || old('tabName') == 'general' ? 'active' : '' }}">General</a>
                                    </li>
                                    <li><a href="#privacy"
                                            class="{{ !empty(old('tabName')) && old('tabName') == 'privacy' ? 'active' : '' }}">Privacy</a>
                                    </li>
                                    <li><a href="#materialType"
                                            class="{{ !empty(old('tabName')) && old('tabName') == 'materialType' ? 'active' : '' }}">Material
                                            Type {{ old('tabName') ?? '' }}</a></li>
                                    <li><a href="#subjects"
                                            class="{{ !empty(old('tabName')) && old('tabName') == 'subjects' ? 'active' : '' }}">Subjects</a>
                                    </li>
                                    <li><a href="#subscriptions"
                                            class="{{ !empty(old('tabName')) && old('tabName') == 'subscriptions' ? 'active' : '' }}">Subscriptions</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="panel-body tabs-menu-body"> --}}
                        <div class="tab-content">
                            <div class="tab-pane {{ empty(old('tabName')) || old('tabName') == 'general' ? 'active' : '' }}"
                                id="general">
                                <div class="row pt-4 mt-3">
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
                                        <form>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Email
                                                            address</label>
                                                        <input type="email" class="form-control" placeholder="Email"
                                                            value="patrennaschell@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Phone
                                                            Number</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="+234 905 678 234 " value="+(63-4567-890)">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Aiternate Email
                                                            Address</label>
                                                        <input type="email" class="form-control" placeholder="Email"
                                                            value="patrennaschell@gmail.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <h4 class="font-weight-semibold mb-4">Social Media</h4>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Instagram</label>
                                                        <input type="text" class="form-control" placeholder="Instagram"
                                                            value="Instagram">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Linkedin</label>
                                                        <input type="text" class="form-control" placeholder="Linkedin"
                                                            value="Linkedin">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Facebook</label>
                                                        <input type="text" class="form-control" placeholder="Facebook"
                                                            value="Facebook">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Twitter</label>
                                                        <input type="text" class="form-control" placeholder="Twitter"
                                                            value="Twitter">
                                                    </div>
                                                </div>
                                                {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Bank Namee</label>
                                                        <select class="form-control" name="bank" id="search"
                                                            data-parsley-required-message="The Bank is required"
                                                            data-placeholder="Select your Bank">
                                                            @isset($banks)
                                                                @foreach ($banks as $bank)
                                                                    <option data-value="{{ $bank->id }}"
                                                                        value="{{ $bank->id }}"
                                                                        @if (old('form_type') == 'vendor') {{ old('bank') == $bank->id ? 'selected' : '' }} @endif>
                                                                        {{ $bank->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endisset
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Bank Account
                                                            Number</label>
                                                        <input type="number" class="form-control" placeholder=""
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Bank Account
                                                            Name</label>
                                                        <input type="" class="form-control" placeholder=""
                                                            value="">
                                                    </div>
                                                </div> --}}
                                            </div>

                                            <div class="row mt-4">
                                                <h4 class="font-weight-semibold mb-4">Payment Integration</h4>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Paystack Public
                                                            Key</label>
                                                        <input type="text" class="form-control" placeholder="Public KEy"
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">USD Rate in Naira</label>
                                                        <input type="number" class="form-control" placeholder="₦500"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-12 text-center mt-4">
                                                <button class="btn btn-primary p-3 pt-2 pt-2" style="font-size: 18px">Save
                                                    Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'privacy' ? 'active' : '' }}"
                                id="privacy">
                             <div class="mt-5 pt-4">
                                   <textarea class="content richText-initial" name="example" style="display: none;"></textarea>
                                <div class="col-lg-12 col-xl-12 text-center mt-4">
                                    <button class="btn btn-primary p-3 pt-2 pt-2" style="font-size: 18px">Save
                                        Changes</button>
                                </div>
                             </div>
                            </div>
                            <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'materialType' ? 'active' : '' }}"
                                id="materialType">
                                <div class="card border-0" style="box-shadow:none">
                                    <div class="card-header border-bottom-0">
                                        <div class="card-options" style="margin-right:2.5%">
                                            <button class="btn btn-primary m-b-15 font-weight-bold" type="button"
                                                onclick="shiNew(event)" data-type="dark" data-size="m"
                                                data-title="Add New Material" href="{{ route('admin.add_material') }}">+
                                                Add New Material</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <div id="datatable_wrapper"
                                                class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table
                                                            class="table table-bordere card-table table-vcenter dataTable no-footer materialTypeTable"
                                                            id="" role="grid">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting sorting_asc font-weight-bold"
                                                                        style="width:20%">
                                                                        Type of Material</th>
                                                                    <th scope="row" class="sorting font-weight-bold"
                                                                        style="width:50%">
                                                                        Description</th>
                                                                    <th class="sorting font-weight-bold" tabindex="0"
                                                                        style="width:5%">
                                                                        Status</th>
                                                                    <th class="sorting font-weight-bold" tabindex="0"
                                                                        style="width:15%">
                                                                        Role</th>
                                                                    <th class="sorting font-weight-bold" tabindex="0"
                                                                        style="width:10%">
                                                                        Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                </tr>
                                                                @isset($material_types)
                                                                    @foreach ($material_types as $material_type)
                                                                        <tr>
                                                                            <td class="sorting_1">{{ $material_type->name }}
                                                                            </td>
                                                                            <td>{{ $material_type->description }}</td>
                                                                            <td>
                                                                                @if ($material_type->status == 'active')
                                                                                    <span
                                                                                        class="badge rounded-pill bg-success text-capitalize mt-2 font-weight-bold">{{ $material_type->status }}</span>
                                                                                @else
                                                                                    <span
                                                                                        class="badge rounded-pill bg-danger text-capitalize mt-2 font-weight-bold">{{ $material_type->status }}</span>
                                                                                @endif
                                                                                {{-- <div class="updateStatus"
                                                                                    data-id="{{ $material_type->id }}">
                                                                                    <input type="checkbox" data-style="slow"
                                                                                        class="messageCheckbox{{ $material_type->id }}"
                                                                                        @if ($material_type->status == 'active') checked @endif
                                                                                        data-toggle="toggle" data-on="Active"
                                                                                        data-off="Disabled">
                                                                                </div> --}}
                                                                            </td>
                                                                            <td>
                                                                                @foreach ($material_type->role as $role)
                                                                                    <span
                                                                                        class="badge bg-primary mt-2 p-1 text-capitalize font-weight-bold">{{ $role }}</span>
                                                                                @endforeach
                                                                            </td>
                                                                            <td class="align-middle">
                                                                                <button class="btn btn-sm btn-secondary"
                                                                                    type="button" data-type="dark"
                                                                                    data-size="m" onclick="shiNew(event)"
                                                                                    data-title="Edit Material Type"
                                                                                    href="{{ route('admin.view_material', $material_type->id) }}">Edit</button>
                                                                                <a onclick="return confirm('Do you want to delete this Material Type?')"
                                                                                    href="{{ route('admin.delete_material', $material_type->id) }}"
                                                                                    class="btn btn-sm btn-danger">
                                                                                    <i class="fe fe-trash-2"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endisset
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'subjects' ? 'active' : '' }}"
                                id="subjects">
                                <div class="card border-0" style="box-shadow:none">
                                    <div class="card-header border-bottom-0">
                                        <div class="card-options" style="margin-right:2.5%">
                                            <button class="btn btn-primary m-b-15 p-2 font-weight-bold" type="button"
                                                onclick="shiNew(event)" data-type="dark" data-size="m"
                                                data-title="Add New Subject Type"
                                                href="{{ route('admin.add_subject') }}">+
                                                Add New Subject Type</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <div id="datatable_wrapper"
                                                class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table
                                                            class="table table-bordere card-table table-vcenter dataTable no-footer subjectTypeTable"
                                                            id="" role="grid">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting font-weight-bold sorting_asc"
                                                                        style="wwidth:15%">
                                                                        Type of Subject</th>
                                                                    <th class="sorting font-weight-bold" tabindex="0"
                                                                        style="wwidth:15%">
                                                                        Material</th>
                                                                    <th scope="row" class="sorting font-weight-bold"
                                                                        style="wwidth:45%">
                                                                        Description</th>
                                                                    <th class="sorting font-weight-bold" tabindex="0"
                                                                        style="wwidth:15%">
                                                                        Status</th>
                                                                    <th class="sorting font-weight-bold" tabindex="0"
                                                                        style="wwidth:10%">
                                                                        Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @isset($subjects)
                                                                    @foreach ($subjects as $subject_type)
                                                                        <tr>
                                                                            <td class="sorting_1">{{ $subject_type->name }}
                                                                            </td>
                                                                            <td>{{ $subject_type->material->name }}</td>
                                                                            <td>{{ $subject_type->description }}</td>
                                                                            <td>
                                                                                @if ($subject_type->status == 'active')
                                                                                    <span
                                                                                        class="badge rounded-pill bg-success text-capitalize mt-2 font-weight-bold">{{ $subject_type->status }}</span>
                                                                                @else
                                                                                    <span
                                                                                        class="badge rounded-pill bg-danger mt-2 font-weight-bold">{{ $subject_type->status }}</span>
                                                                                @endif
                                                                                {{-- <div class="updateStatus"
                                                                                    data-id="{{ $subject_type->id }}">
                                                                                    <input type="checkbox" data-style="slow"
                                                                                        class="messageCheckbox{{ $subject_type->id }}"
                                                                                        @if ($subject_type->status == 'active') checked @endif
                                                                                        data-toggle="toggle" data-on="Active"
                                                                                        data-off="Disabled">
                                                                                </div> --}}
                                                                            </td>
                                                                            <td class="align-middle">

                                                                                <button class="btn btn-sm btn-secondary"
                                                                                    type="button" data-type="dark"
                                                                                    data-size="m" onclick="shiNew(event)"
                                                                                    data-title="Edit Subject Type"
                                                                                    href="{{ route('admin.view_subject', $subject_type->id) }}">Edit</button>

                                                                                {{-- <button
                                                                                    class="btn btn-sm btn-secondary editDetails"
                                                                                    type="submit"
                                                                                    data-id="{{ $subject_type->id }}">Edit</button> --}}

                                                                                <a onclick="return confirm('Do you want to delete this Subject Type?')"
                                                                                    href="{{ route('admin.delete_subject', $subject_type->id) }}"
                                                                                    class="btn btn-sm btn-danger">
                                                                                    <i class="fe fe-trash-2"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endisset
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'subscriptions' ? 'active' : '' }}"
                                id="subscriptions">
                                <div class="card border-0" style="box-shadow:none">
                                    <div class="card-header border-bottom-0">
                                        <div class="card-options" style="margin-right:2.5%">
                                            {{-- <button class="btn btn-primary m-b-15 p-2 font-weight-bold" type="button"
                                                onclick="shiNew(event)" data-type="dark" data-size="m"
                                                data-title="Add New Subscription"
                                                href="{{ route('admin.add_subscription') }}">+
                                                Add New Subscription</button> --}}
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row mb-4">
                                                    <h5 class="font-weight-bold">Student Subscription</h5>
                                                    @isset($subs)
                                                        @foreach ($subs as $sub)
                                                            @if ($sub->type == 'student')
                                                                <div class="col-sm-6 col-xl-3">
                                                                    <div class="panel price panel-color bg-white">
                                                                        <div
                                                                            class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                                                            <div class="bg-primary-transparent pricing-svg">
                                                                                <i class="fa fa-user"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="panel-heading p-0 pb-0 text-center">
                                                                            <h4 class="font-weight-bold">Student {{ $sub->name }}</h4>
                                                                        </div>
                                                                        <div class="panel-body text-center">
                                                                        </div>
                                                                        <ul class="text-center">
                                                                            <li class="mb-4">

                                                                                @isset($sub->session)
                                                                                    <strong class="font-weight-bold">₦{{ number_format($sub->session, 2) }}
                                                                                    </strong>/ {{ $sub->name }}
                                                                                @endisset

                                                                            </li>
                                                                            <li class="mb-4">

                                                                                @isset($sub->system)
                                                                                    <strong class="font-weight-bold">₦{{ number_format($sub->system, 2) }}
                                                                                    </strong>/ {{ $sub->name }}
                                                                                @endisset
                                                                            </li>
                                                                            <li class="mb-4">
                                                                                @isset($sub->session)
                                                                                    <strong>{{ $sub->session_duration }} months</strong>
                                                                                @endisset
                                                                                @isset($sub->system)
                                                                                    <strong>{{ $sub->system_duration }} months</strong>
                                                                                @endisset
                                                                            </li>
                                                                        </ul>
                                                                        <div
                                                                            class="panel-footer text-center border-top-0 mb-4">
                                                                            <a class="btn btn-lg btn-primary"
                                                                                onclick="shiNew(event)" data-type="dark"
                                                                                data-size="m"
                                                                                data-title="Edit Student {{ $sub->name }}"
                                                                                href="{{ route('admin.edit_subscription', $sub->id) }}">Edit</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                </div>

                                                <div class="row">
                                                    <h5 class="font-weight-bold">Professional Subscription</h5>
                                                    @isset($subs)
                                                        @foreach ($subs as $sub)
                                                            @if ($sub->type == 'professional')
                                                                <div class="col-sm-6 col-xl-3">
                                                                    <div class="panel price panel-color bg-white">
                                                                        <div
                                                                            class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                                                            <div class="bg-primary-transparent pricing-svg">
                                                                                <i class="fa fa-user"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="panel-heading p-0 pb-0 text-center">
                                                                            <h4 class="font-weight-bold">
                                                                                {{ $sub->name }}</h4>
                                                                        </div>
                                                                        {{-- <div class="panel-body text-center mb-6">
                                                                                    <p class="lead text-primary">
                                                                                    </p>
                                                                                </div> --}}
                                                                        <ul class="text-center">
                                                                            <li class="mb-4">
                                                                                @isset($sub->annual)
                                                                                    <strong class="font-weight-bold">₦{{ number_format($sub->annual, 2) }}
                                                                                    </strong>/ annual
                                                                                @endisset
                                                                            </li>
                                                                            <li class="mb-4">
                                                                                @isset($sub->weekly)
                                                                                    <strong class="font-weight-bold">₦{{ number_format($sub->weekly, 2) }}
                                                                                    </strong>/ weekly
                                                                                @endisset
                                                                            </li>
                                                                            <li class="mb-4">
                                                                                @isset($sub->quarterly)
                                                                                    <strong class="font-weight-bold">₦{{ number_format($sub->quarterly, 2) }}
                                                                                    </strong>/ quarterly
                                                                                @endisset
                                                                            </li>
                                                                            <li class="mb-4">
                                                                                @isset($sub->monthly)
                                                                                    <strong class="font-weight-bold">₦{{ number_format($sub->monthly, 2) }}
                                                                                    </strong>/ monthly
                                                                                @endisset
                                                                            </li>
                                                                            <li class="mb-4">
                                                                                @isset($sub->weekly)
                                                                                    <strong class="font-weight-bold">₦{{ number_format($sub->weekly, 2) }}
                                                                                    </strong>/ weekly
                                                                                @endisset
                                                                            </li>
                                                                            <li class="mb-4">
                                                                                @isset($sub->max_teammate)
                                                                                    <strong>{{ $sub->max_teammate }}
                                                                                        Users</strong>
                                                                                @endisset
                                                                            </li>
                                                                        </ul>
                                                                        <div
                                                                            class="panel-footer   text-center border-top-0 mb-4">
                                                                            <a class="btn btn-lg btn-primary"
                                                                                onclick="shiNew(event)" data-type="dark"
                                                                                data-size="m"
                                                                                data-title="Edit {{ $sub->name }}"
                                                                                href="{{ route('admin.edit_subscription', $sub->id) }}">Edit</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endisset
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
