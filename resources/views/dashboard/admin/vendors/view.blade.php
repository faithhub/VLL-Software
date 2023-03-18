@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <!--Page header-->
        <div class="page-header">
            <div class="page-leftheader">
                <h4 class="page-title mb-0 text-primary">{{ $vendor->name }} Profile</h4>
            </div>
            <div class="page-rightheader">
                {{-- <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-pill dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-calendar me-2"></i>Search By Date
                    </button>
                    <div class="dropdown-menu"> <a class="dropdown-item" href="javascript:void(0);">Today</a> <a
                            class="dropdown-item" href="javascript:void(0);">Yesterday</a> <a class="dropdown-item active"
                            href="javascript:void(0);">Last 7 days</a> <a class="dropdown-item"
                            href="javascript:void(0);">Last 30 days</a> <a class="dropdown-item"
                            href="javascript:void(0);">Last Month</a> <a class="dropdown-item"
                            href="javascript:void(0);">Last 6 months</a> <a class="dropdown-item"
                            href="javascript:void(0);">Last year</a>
                    </div>
                </div> --}}
            </div>
        </div>
        <!--End Page header-->
        <div class="main-proifle border">
            <div class="row">
                <div class="col-lg-12 col-xl-7">
                    <div class="box-widget widget-user">
                        <div class="widget-user-image1 d-xl-flex d-block"> <img alt="User Avatar" class="avatar brround p-0"
                                src="{{ asset($vendor->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}">
                            <div class="mt-1 ms-xl-5">
                                <h4 class="pro-user-username mb-3 font-weight-bold">{{ $vendor->name }}
                                </h4>
                                <ul class="mb-0 pro-details">

                                    <li>
                                        <span class="profile-icon bg-success-transparent text-success">
                                            <i class="fe fe-mail"></i>
                                        </span>
                                        <span class="h6 mt-3">{{ $vendor->email }}</span>
                                    </li>
                                    <li>
                                        <span class="profile-icon bg-warning-transparent text-warning">
                                            <i class="fe fe-phone-call"></i></span>
                                        <span class="h6 mt-3">
                                            {{ $vendor->phone ?? '--' }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="profile-icon bg-danger-transparent text-danger">
                                            <i class="fe fe-users"></i></span>
                                        <span class="h6 mt-3 text-capitalize">
                                            {{ $vendor->gender ?? '--' }}
                                        </span>
                                    </li>
                                    <li><span class="profile-icon bg-info-transparent text-info"><i
                                                class="fe fe-flag"></i></span><span class="h6 mt-3">
                                            {{ $vendor->country->name ?? '--' }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-auto col-xl-5">
                    <div class="text-xl-right text-end btn-list mt-4 mt-lg-0">
                        {{-- <a href="javascript:void(0);" class="btn btn-outline-primary">Message</a>
                            <a href="" class="btn btn-primary">Edit Profile</a> --}}
                    </div>
                    <div class="mt-5">
                        <div class="main-profile-contact-list row">
                            <div class="media col-sm-4 mb-3">
                                <div class="media-icon bg-primary-transparent text-primary me-3 mt-1">
                                    <i class="ion-folder"></i>
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Uploaded Materials</small>
                                    <div class="font-weight-normal1">{{ $materials->count() }}</div>
                                </div>
                            </div>
                            {{-- <div class="media col-sm-4 mb-3">
                                <div class="media-icon bg-primary-transparent text-primary me-3 mt-1"> <i
                                        class="fa fa-comments fs-18"></i> </div>
                                <div class="media-body"> <small class="text-muted">Posts</small>
                                    <div class="font-weight-bold number-font"> 245 </div>
                                </div>
                            </div>
                            <div class="media col-sm-4 mb-3">
                                <div class="media-icon bg-primary-transparent text-primary me-3 mt-1"> <i
                                        class="fa fa-feed fs-18"></i> </div>
                                <div class="media-body"> <small class="text-muted">Following</small>
                                    <div class="font-weight-bold number-font"> 3,765 </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="card border-10 p-4">
                            <div class="text-right">
                                @if ($vendor->acc_verified)
                                    <a href="{{ route('admin.vendor.lock_unlock', ['id' => $vendor->id, 'type' => 'naira', 'mode' => 'unlock']) }}"
                                        onclick="return confirm('Are you sure you want to unlock this account?')"
                                        class="btn p-3 btn-primary">Unlock Naira account</a>
                                @else
                                    <a href="{{ route('admin.vendor.lock_unlock', ['id' => $vendor->id, 'type' => 'naira', 'mode' => 'lock']) }}"
                                        onclick="return confirm('Are you sure you want to lock this account?')"
                                        class="btn p-3 btn-primary">Lock Naira account</a>
                                @endif
                            </div>
                            <div class="card-header border-bottom-0 mb-0">
                                <h6 class="mb-1 mt-1 font-weight-bold h4">
                                    <img src="{{ asset('assets/dashboard/images/flags/NGN.png') }}" alt="USD"
                                        class="mb-1 country-settings">
                                    Naira (NGN) Account
                                </h6>
                            </div>
                            <div class="row mt-5 settings">
                                <div class="col-lg-12 col-md-12 col-xl-12">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Name</label>
                                            <input type="" name="dom_acc_number" class="form-control"
                                                id="dom_acc_number" placeholder="" disabled
                                                value="{{ $vendor->bank->name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Account Number</label>
                                            <div class="d-flex">
                                                <input type="number" name="acc_number" class="form-control" id="acc_number"
                                                    placeholder="" disabled value="{{ $vendor->acc_number ?? '' }}">
                                                @if ($vendor->acc_verified)
                                                    <button type="button" class="btn btn-primary" disabled>
                                                        <i class="fa fa-lock"></i>
                                                        <b class="verify-btn">Verified</b>
                                                    </button>
                                                @else
                                                    <button disabled type="button" id="verify-me" class="btn btn-primary"
                                                        onclick="verifyAccount()">
                                                        <i class="" id="spinner"></i>
                                                        <b id="verify-btn">Not Verify</b>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Account Name</label>
                                            <input type="text" name="acc_name" id="acc_name" readonly
                                                class="form-control" placeholder=""disabled
                                                value="{{ $vendor->acc_name ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="card border-10 p-4">
                            <div class="text-right">
                                @if ($vendor->dom_acc_verified)
                                    <a href="{{ route('admin.vendor.lock_unlock', ['id' => $vendor->id, 'type' => 'dom', 'mode' => 'unlock']) }}"
                                        onclick="return confirm('Are you sure you want to unlock this account?')"
                                        class="btn p-3 btn-primary">Unlock DOM account</a>
                                @else
                                    <a href="{{ route('admin.vendor.lock_unlock', ['id' => $vendor->id, 'type' => 'dom', 'mode' => 'lock']) }}"
                                        onclick="return confirm('Are you sure you want to lock this account?')"
                                        class="btn p-3 btn-primary">Lock DOM account</a>
                                @endif
                            </div>
                            <div class="card-header border-bottom-0 mb-0">
                                <h6 class="mb-1 mt-1 font-weight-bold h4">
                                    <img src="{{ asset('assets/dashboard/images/flags/USD.png') }}" alt="USD"
                                        class="mb-1 country-settings">
                                    Dollar (USD) Account
                                </h6>
                            </div>
                            <div class="row mt-5 settings">
                                <div class="col-lg-12 col-md-12 col-xl-12">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Name</label>
                                            <input type="" name="" class="form-control"
                                                id="dom_acc_number" placeholder="" disabled
                                                value="{{ $vendor->dom->name ?? '' }}">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Account Number</label>
                                            <div class="d-flex">
                                                <input type="number" name="dom_acc_number" class="form-control"
                                                    id="dom_acc_number" placeholder="" disabled
                                                    value="{{ $vendor->dom_acc_number ?? '' }}">
                                                @if ($vendor->dom_acc_verified)
                                                    <button type="button" class="btn btn-primary" disabled>
                                                        <i class="fa fa-lock"></i>
                                                        <b class="dom_verify-btn">Verified</b>
                                                    </button>
                                                @else
                                                    <button disabled type="button" id="dom_verify-me"
                                                        class="btn btn-primary" onclick="verifyDomAccount()">
                                                        <i class="" id="dom_spinner"></i>
                                                        <b id="dom_verify-btn">Not Verify</b>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank Account Name</label>
                                            <input type="text" readonly class="form-control" placeholder="" disabled
                                                value="{{ $vendor->dom_acc_name ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-cover">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading p-0">
                        <div class="tabs-menu1 px-3">
                            <ul class="nav" role="tablist">
                                @if (Auth::user()->role == 'admin')
                                    <li><a href="#tab-7" class="fs-14 active" data-bs-toggle="tab" aria-selected="true"
                                            role="tab">Materials</a> </li>
                                    <li><a href="#tab-8" data-bs-toggle="tab" class="fs-14" aria-selected="false"
                                            role="tab" tabindex="-1">Transactions</a></li>
                                @endif
                                <li><a href="#tab-9" data-bs-toggle="tab" class="fs-14 @if (Auth::user()->sub_admin == 'user') active @endif" aria-selected="false"
                                        role="tab" tabindex="-1">Login History</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- /.profile-cover -->
        </div> <!-- Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="border-0">
                    <div class="tab-content">

                        @if (Auth::user()->role == 'admin')
                            <div class="tab-pane active show" id="tab-7" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Materials</h3>
                                    </div>
                                    <div class="card-body pt-5">
                                        <div class="table-responsive">
                                            <div id="datatable_wrapper"
                                                class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table
                                                            class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                                            role="grid" aria-describedby="datatable_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting sorting_asc" style="">No</th>
                                                                    <th scope="row" class="sorting" style="">
                                                                        Book
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Book
                                                                        Name
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Type
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Author
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Description</th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Price
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Material</th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Action
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @isset($materials)
                                                                    @foreach ($materials as $material)
                                                                        <tr class="">
                                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                                            <td class="sorting_1">
                                                                                <img src="{{ asset($material->cover->url ?? '') }}"
                                                                                    style="max-height:60px">
                                                                            </td>
                                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                                    onclick="shiNew(event)" data-type="dark"
                                                                                    data-size="m"
                                                                                    data-title="{{ $material->invoice_id }}"
                                                                                    href="{{ route('admin.view_material', $material->id) }}">{{ $material->title }}</a>
                                                                            </td>
                                                                            <td>{{ $material->type->name ?? '-' }}</td>
                                                                            <td>{{ $material->name_of_author ?? '-' }}</td>
                                                                            <td>
                                                                                {{ mb_strimwidth($material->material_desc ?? '', 0, 40, '...') }}
                                                                            </td>
                                                                            <td>
                                                                                <b
                                                                                    class="money">{{ money($material->amount) }}</b>
                                                                            </td>
                                                                            <td><a class="font-weight-bold"
                                                                                    href="{{ asset($material->file->url ?? '') }}">{{ $material->title }}.pdf</a>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <a onclick="return confirm('Are you sure you want to delete this material?')"
                                                                                        href="{{ route('admin.delete.library', $material->id) }}"
                                                                                        class="btn btn-sm m-1 btn-primary">
                                                                                        Delete</a>
                                                                                    <a href="{{ route('admin.edit.library', $material->id) }}"
                                                                                        class="btn m-1 btn-sm btn-primary">Edit</a>
                                                                                </div>
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
                            <div class="tab-pane" id="tab-8" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Transaction History</h3>
                                    </div>
                                    <div class="card-body pt-5">
                                        <div class="table-responsive">
                                            <div id="datatable_wrapper"
                                                class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table
                                                            class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                                            role="grid" aria-describedby="datatable_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        S/N
                                                                    </th>
                                                                    <th class="sorting sorting_asc" style="">Invoice
                                                                        ID
                                                                    </th>
                                                                    <th class="sorting sorting_asc" style="">
                                                                        PayStack
                                                                        Ref
                                                                    </th>
                                                                    <th scope="row" class="sorting" style="">
                                                                        Date of
                                                                        Transaction
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Transaction Type
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Transaction Value
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">Net
                                                                        Order Value
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Status
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @isset($transactions)
                                                                    @foreach ($transactions as $transaction)
                                                                        <tr class="">
                                                                            <td class="sorting_1">{{ $sn2++ }}</td>
                                                                            <td class="sorting_1">
                                                                                <a class="font-weight-normal1"
                                                                                    onclick="shiNew(event)" data-type="dark"
                                                                                    data-size="m"
                                                                                    data-title="{{ $transaction->mat_his['trans']['invoice_id'] }}"
                                                                                    href="{{ route('admin.transaction.view', $transaction->mat_his['trans']['id']) }}">
                                                                                    {{ $transaction->mat_his['trans']['invoice_id'] }}</a>
                                                                            </td>
                                                                            <td>{{ $transaction->mat_his['trans']['trxref'] }}
                                                                            </td>
                                                                            <td>{{ $transaction->mat_his['trans']['created_at']->format('D, M j, Y h:i a') }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($transaction->mat_his['type'] == 'bought')
                                                                                    <span
                                                                                        class="badge bg-success-light border-success text-capitalize type-text">{{ $transaction->mat_his['type'] }}</span>
                                                                                @endif
                                                                                @if ($transaction->mat_his['type'] == 'rented')
                                                                                    <span
                                                                                        class="badge bg-warning-light border-warning text-capitalize type-text">{{ $transaction->mat_his['type'] }}</span>
                                                                                @endif
                                                                            </td>
                                                                            <td><span
                                                                                    class="money">{{ money($transaction->mat_his['trans']['amount']) }}</span>
                                                                            </td>
                                                                            <td><span
                                                                                    class="money">{{ money((80.5 / 100) * $transaction->mat_his['trans']['amount']) }}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span
                                                                                    class="badge bg-success-light border-success text-capitalize type-text">{{ $transaction->mat_his['trans']['status'] }}</span>
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
                        @endif
                        <div class="tab-pane @if (Auth::user()->sub_admin == 'user') active show @endif" id="tab-9" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Login History</h3>
                                </div>
                                <div class="card-body pt-5">
                                    <div class="table-responsive">
                                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table
                                                        class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                                        role="grid" aria-describedby="datatable_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting" tabindex="0" style="">
                                                                    S/N
                                                                </th>
                                                                <th class="sorting" tabindex="0" style="">Date
                                                                </th>
                                                                <th class="sorting" tabindex="0" style="">IP
                                                                    Address</th>
                                                                <th class="sorting" tabindex="0" style="">Device
                                                                    Type</th>
                                                                <th class="sorting" tabindex="0" style="">Browser
                                                                    Type</th>
                                                                <th class="sorting" tabindex="0" style="">IOS
                                                                </th>
                                                                <th class="sorting" tabindex="0" style="">
                                                                    Location</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @isset($login_histories)
                                                                @foreach ($login_histories as $login_history)
                                                                    <tr class="">
                                                                        <td class="sorting_1">{{ $sn3++ }}</td>
                                                                        <td>
                                                                            {{ $login_history->updated_at->format('D, M j, Y h:i a') ?? '-' }}
                                                                        </td>
                                                                        <td>{{ $login_history->ip ?? '--' }}
                                                                        </td>
                                                                        <td>{{ $login_history->deviceType ?? '--' }}
                                                                        </td>
                                                                        <td>{{ $login_history->browserFamily ?? '--' }}
                                                                        </td>
                                                                        <td>{{ $login_history->platformFamily ?? '--' }}
                                                                        </td>
                                                                        <td>{{ $login_history->regionName ?? '--' }}
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
    <script>
        $(document).ready(function() {
            var tables = $('table').DataTable();
        });
    </script>
@endsection
