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
                    <h3 class="card-title font-weight-bold">{{ $material->title }}</h3>
                </div> --}}
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class=" tab-menu-heading p-0 bg-white">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class=""><a href="#general"
                                            class="{{ empty(old('tabName')) || old('tabName') == 'general' ? 'active' : '' }}">Material
                                            Details</a>
                                    </li>
                                    <li><a href="#privacy"
                                            class="{{ !empty(old('tabName')) && old('tabName') == 'privacy' ? 'active' : '' }}">Vendor's
                                            Details</a>
                                    </li>
                                    <li><a href="#materialType"
                                            class="{{ !empty(old('tabName')) && old('tabName') == 'materialType' ? 'active' : '' }}">Transaction
                                            Type {{ old('tabName') ?? '' }}</a></li>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="panel-body tabs-menu-body"> --}}
                        <div class="tab-content">
                            <div class="tab-pane {{ empty(old('tabName')) || old('tabName') == 'general' ? 'active' : '' }}"
                                id="general">
                                <div class="row pt-4 mt-3">
                                    <div class="row mt-5 settings">
                                        <div class="row">
                                            <div class="image mb-5">
                                                <a href="#">
                                                    <img src="{{ asset($material->cover->url) }}"
                                                        alt="{{ $material->title }}">
                                                </a>
                                            </div>
                                            <div class="mat-title">
                                                <h5><b class="font-weight-bold">Title: </b>{{ $material->title }}</h5>
                                                <h5><b class="font-weight-bold">Material Type:
                                                    </b>{{ $material->type->name }}</h5>
                                                @isset($material->subject_id)
                                                    <h5><b class="font-weight-bold">Subject:
                                                        </b>{{ $material->subject->name ?? '' }}</h5>
                                                @endisset
                                                @if (substr($material->type->mat_unique_id, 0, 3) == 'CSL')
                                                    <h5><b class="font-weight-bold">Name of Court:
                                                        </b>{{ $material->name_of_court ?? '' }}</h5>
                                                    <h5><b class="font-weight-bold">Name of Party:
                                                        </b>{{ $material->name_of_party ?? '' }}</h5>
                                                    <h5><b class="font-weight-bold">Citation:
                                                        </b>{{ $material->citation ?? '' }}</h5>
                                                @endif
                                                @isset($material->name_of_author)
                                                    <h5><b class="font-weight-bold">Author:
                                                        </b>{{ $material->name_of_author ?? '' }}</h5>
                                                @endisset
                                                @isset($material->year_of_publication)
                                                    <h5><b class="font-weight-bold">Year Of Publication:
                                                        </b>{{ $material->year_of_publication }}
                                                    </h5>
                                                @endisset
                                                @isset($material->country)
                                                    <h5><b class="font-weight-bold">Country Of Publication:
                                                        </b>{{ $material->country->name }}</h5>
                                                @endisset
                                                @isset($material->test_country_id)
                                                    <h5><b class="font-weight-bold">Country:
                                                        </b>{{ $material->test_country->name }}</h5>
                                                @endisset
                                                @isset($material->university_id)
                                                    <h5><b class="font-weight-bold">University:
                                                        </b>{{ $material->university->name }}</h5>
                                                @endisset
                                                <h5><b class="font-weight-bold">Price:</b>
                                                    @if ($material->price == 'Paid')
                                                        ₦{{ number_format($material->amount, 2) }}
                                                    @else
                                                        Free
                                                    @endif
                                                </h5>
                                                <h5><b class="font-weight-bold">Pages: </b>{{ $pageCount ?? 0 }}</h5>
                                                <h5><b class="font-weight-bold">Total Rented: </b>{{ $totalRented ?? 0 }}
                                                </h5>
                                                <h5><b class="font-weight-bold">Total Bought: </b>{{ $totalBought ?? 0 }}
                                                </h5>
                                                <h5><b class="font-weight-bold">Summary: </b></h5>
                                                <p>
                                                    {{ $material->material_desc }}
                                                </p>
                                                <a href="{{ route('vendor.edit', $material->id) }}"
                                                    class="btn btn-primary p-3 m-2">
                                                    <i class="fa fa-pencil"></i>&nbsp&nbspEdit
                                                </a>
                                                <a href="{{ route('vendor.delete', $material->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this meterial?')"
                                                    class="btn btn-dark p-3 btn-outline-primary">
                                                    <i class="fa fa-trash"></i>&nbsp&nbspDelete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'privacy' ? 'active' : '' }}"
                                id="privacy">
                                <div class="mt-5 pt-4">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="box-widget widget-user">
                                            <div class="widget-user-image1 d-xl-flex d-block">
                                                <img alt="User Avatar" class="avatar brround p-0"
                                                    src="{{ asset(Auth::user()->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5 settings">
                                        <div class="col-lg-12 col-xl-12">
                                            <h5><b class="font-weight-bold mb-5">Name: </b>{{ $material->vendor->name }}
                                            </h5>
                                            <h5><b class="font-weight-bold mb-5">Email: </b>{{ $material->vendor->email }}
                                            </h5>
                                            <h5><b class="font-weight-bold mb-5">Gender:
                                                </b>{{ $material->vendor->gender }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'materialType' ? 'active' : '' }}"
                                id="materialType">
                                <div class="card border-0" style="box-shadow:none">
                                    {{-- <div class="card-header border-bottom-0">
                                        <div class="card-options" style="margin-right:2.5%">
                                            <button class="btn btn-primary m-b-15 font-weight-bold" type="button"
                                                onclick="shiNew(event)" data-type="dark" data-size="m"
                                                data-title="Add New Material" href="{{ route('admin.add_material') }}">+
                                                Add New Material</button>
                                        </div>
                                    </div> --}}
                                    <div class="card-body pt-10">
                                        <div class="table-responsive">
                                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table
                                                            class="table card-table table-vcenter  text-nowrap dataTable no-footer"
                                                            id="" role="grid">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting sorting_asc" style="">No</th>
                                                                    <th class="sorting sorting_asc" style="">Invoice
                                                                        No</th>
                                                                    <th scope="row" class="sorting" style="">Date &
                                                                        Time</th>
                                                                    <th class="sorting" tabindex="0" style="">User
                                                                        name</th>
                                                                    <th class="sorting" tabindex="0" style="">Email
                                                                        Address</th>
                                                                    <th class="sorting" tabindex="0" style="">Amount
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">Type
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                </tr>
                                                                @isset($histories)
                                                                    @foreach ($histories as $history)
                                                                        <tr>
                                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                                    href="">{{ $history->trans->invoice_id }}</a>
                                                                            </td>
                                                                            <td>{{ $history->created_at->format('D, M j, Y H:i:s') ?? '' }}
                                                                            </td>
                                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                                    href="">{{ $history->user->name }}</a>
                                                                            </td>
                                                                            <td>{{ $history->user->email }}</td>
                                                                            <td>₦{{ number_format($history->trans->amount, 2) }}
                                                                            </td>
                                                                            <td><b
                                                                                    class="text-capitalize">{{ $history->type }}</b>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
