@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <!--Page header-->
        <div class="page-header">
            <div class="page-leftheader">
                <h4 class="page-title mb-0 text-primary">{{ $user->name }} Profile</h4>
            </div>
            <div class="page-rightheader">
            </div>
        </div>
        <!--End Page header-->
        <div class="main-proifle border">
            <div class="row">
                <div class="col-lg-12 col-xl-7">
                    <div class="box-widget widget-user">
                        <div class="widget-user-image1 d-xl-flex d-block"> <img alt="User Avatar" class="avatar brround p-0"
                                src="{{ asset($user->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}">
                            <div class="mt-1 ms-xl-5">
                                <h4 class="pro-user-username mb-3 font-weight-bold">{{ $user->name }}
                                </h4>
                                <ul class="mb-0 pro-details">

                                    <li>
                                        <span class="profile-icon bg-success-transparent text-success">
                                            <i class="fe fe-mail"></i>
                                        </span>
                                        <span class="h6 mt-3">{{ $user->email }}</span>
                                    </li>
                                    <li>
                                        <span class="profile-icon bg-warning-transparent text-warning">
                                            <i class="fe fe-phone-call"></i></span>
                                        <span class="h6 mt-3">
                                            {{ $user->phone ?? '--' }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="profile-icon bg-danger-transparent text-danger">
                                            <i class="fe fe-users"></i></span>
                                        <span class="h6 mt-3 text-capitalize">
                                            {{ $user->gender ?? '--' }}
                                        </span>
                                    </li>
                                    <li><span class="profile-icon bg-info-transparent text-info"><i
                                                class="fe fe-flag"></i></span><span class="h6 mt-3">
                                            {{ $user->country->name ?? '--' }}
                                        </span>
                                    </li>
                                    <li><span class="profile-icon bg-info-transparent text-info"><i
                                                class="fe fe-user"></i></span><span class="h6 mt-3 text-capitalize">
                                            {{ $user->user_type ?? '--' }}
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
                            {{-- <div class="media col-sm-4 mb-3">
                                <div class="media-icon bg-primary-transparent text-primary me-3 mt-1">
                                    <i class="ion-folder"></i>
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Uploaded Materials</small>
                                    <div class="font-weight-normal1">{{ $materials->count() }}</div>
                                </div>
                            </div> --}}
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
            </div>
            <div class="profile-cover">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading p-0">
                        <div class="tabs-menu1 px-3">
                            <ul class="nav" role="tablist">
                                <li><a href="#tab-7" class="fs-14 active" data-bs-toggle="tab" aria-selected="true"
                                        role="tab">Materials</a> </li>
                                <li><a href="#tab-8" data-bs-toggle="tab" class="fs-14" aria-selected="false"
                                        role="tab" tabindex="-1">Transactions</a></li>
                                <li><a href="#tab-9" data-bs-toggle="tab" class="fs-14" aria-selected="false"
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
                        <div class="tab-pane active show" id="tab-7" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Materials</h3>
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
                                                                <th class="sorting sorting_asc" style="">No</th>
                                                                <th scope="row" class="sorting" style="">Book
                                                                </th>
                                                                <th class="sorting" tabindex="0" style="">Book
                                                                    Name
                                                                </th>
                                                                <th class="sorting" tabindex="0" style="">Type
                                                                </th>
                                                                <th class="sorting" tabindex="0" style="">Author
                                                                </th>
                                                                <th class="sorting" tabindex="0" style="">
                                                                    Description</th>
                                                                <th class="sorting" tabindex="0" style="">Trans Type
                                                                </th>
                                                                <th class="sorting" tabindex="0" style="">Amount
                                                                </th>
                                                                <th class="sorting" tabindex="0" style="">
                                                                    Material</th>
                                                                <th class="sorting" tabindex="0" style="">Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @isset($materials)
                                                                @foreach ($materials as $material)
                                                                    <tr class="">
                                                                        <td class="sorting_1">{{ $sn++ }}</td>
                                                                        <td class="sorting_1">
                                                                            <img src="{{ asset($material->mat->cover->url ?? '') }}"
                                                                                style="max-height:60px">
                                                                        </td>
                                                                        <td class="sorting_1">
                                                                            <a class="font-weight-bold"
                                                                                onclick="shiNew(event)" data-type="dark"
                                                                                data-size="m"
                                                                                data-title="{{ $material->mat->title }}"
                                                                                href="{{ route('admin.view_material', $material->mat->id) }}">{{ $material->mat->title }}</a>
                                                                            </td>
                                                                        <td>{{ $material->mat->type->name ?? '-' }}</td>
                                                                        <td>{{ $material->mat->name_of_author ?? '-' }}</td>
                                                                        <td>
                                                                            {{ mb_strimwidth($material->mat->material_desc ?? '', 0, 40, '...') }}
                                                                        </td>
                                                                        <td>
                                                                            <span class="text-capitalize">
                                                                                {{ $material->type }}
                                                                                </span>
                                                                        </td>
                                                                        <td>
                                                                            <b class="money">
                                                                                @isset($material->trans->amount)
                                                                                    {{ money($material->trans->amount) }}
                                                                                @else
                                                                                    ---
                                                                                @endisset
                                                                            </b>
                                                                        </td>
                                                                        <td><a class="font-weight-bold"
                                                                                href="{{ asset($material->mat->file->url ?? '') }}"
                                                                                target="blank">{{ $material->mat->title }}.pdf</a>
                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <a onclick="return confirm('Are you sure you want to delete this material?')"
                                                                                    href="{{ route('admin.delete.library', $material->mat->id) }}"
                                                                                    class="btn btn-sm m-1 btn-primary">
                                                                                    Delete</a>
                                                                                <a href="{{ route('admin.edit.library', $material->mat->id) }}"
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
                                                                <th class="sorting sorting_asc" style="">Invoice ID
                                                                </th>
                                                                <th class="sorting sorting_asc" style="">PayStack
                                                                    Ref
                                                                </th>
                                                                <th scope="row" class="sorting" style="">Date of
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
                                                                <th class="sorting" tabindex="0" style="">Status
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
                                                                                data-title="{{ $transaction->invoice_id }}"
                                                                                href="{{ route('admin.transaction.view', $transaction->id) }}">
                                                                                {{ $transaction->invoice_id }}</a>
                                                                        </td>
                                                                        <td>{{ $transaction->trxref }}</td>
                                                                        <td>{{ $transaction->created_at->format('D, M j, Y h:i a') }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($transaction->type == 'subscription')
                                                                                <span
                                                                                    class="badge bg-success-light border-success text-capitalize type-text">{{ $transaction->type }}</span>
                                                                            @endif
                                                                            @if ($transaction->type == 'bought')
                                                                                <span
                                                                                    class="badge bg-success-light border-success text-capitalize type-text">{{ $transaction->type }}</span>
                                                                            @endif
                                                                            @if ($transaction->type == 'rented')
                                                                                <span
                                                                                    class="badge bg-warning-light border-warning text-capitalize type-text">{{ $transaction->type }}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td><span
                                                                                class="money">{{ money($transaction->amount) }}</span>
                                                                        </td>
                                                                        <td><span
                                                                                class="money">{{ money((80.5 / 100) * $transaction->amount) }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span
                                                                                class="badge bg-success-light border-success text-capitalize type-text">{{ $transaction->status }}</span>
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
                        <div class="tab-pane" id="tab-9" role="tabpanel">
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
