@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0">
                        <div class="d-flex">
                            <div class="media mt-4">
                                <div class="media-body">
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Vendor List</h6>
                                    <small class="h5"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table
                                            class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                            id="datatable" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" style="">No</th>
                                                    <th scope="row" class="sorting" style="">User Name </th>
                                                    <th class="sorting" tabindex="0" style="">Email Address</th>
                                                    <th class="sorting" tabindex="0" style="">Phone Number</th>
                                                    <th class="sorting" tabindex="0" style="">Date Joined</th>
                                                    <th class="sorting" tabindex="0" style="">Bank Name</th>
                                                    <th class="sorting" tabindex="0" style="">Bank Account</th>
                                                    <th class="sorting" tabindex="0" style="">Account Name</th>
                                                    <th class="sorting" tabindex="0" style="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($vendors)
                                                    @foreach ($vendors as $vendor)
                                                        <tr class="">
                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                    href="{{ route('admin.vendor', $vendor->id) }}">{{ $vendor->name }}</a></td>
                                                            <td>{{ $vendor->email }}</td>
                                                            <td>{{ $vendor->phone }}</td>
                                                            <td>{{ $vendor->created_at->format('D, M j, Y') ?? '' }}</td>
                                                            <td>{{ $vendor->bank->name ?? '-' }}</td>
                                                            <td>{{ $vendor->acc_number ?? '-' }}</td>
                                                            <td>{{ $vendor->acc_name ?? '-' }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.vendor', $vendor->id) }}" class="btn btn-sm btn-primary">View</i></a>
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
@endsection
