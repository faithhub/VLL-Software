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
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">User List</h6>
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
                                                    <th class="sorting" tabindex="0" style="">Last Subcription</th>
                                                    <th class="sorting" tabindex="0" style="">Active Plan</th>
                                                    <th class="sorting" tabindex="0" style="">Last Login</th>
                                                    <th class="sorting" tabindex="0" style="">Browser Type</th>
                                                    <th class="sorting" tabindex="0" style="">Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($users)
                                                    @foreach ($users as $user)
                                                        <tr class="">
                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                    href="">{{ $user->name }}</a></td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td>Today</td>
                                                            <td>Premium</td>
                                                            <td>
                                                               @isset($user->last_login)
                                                                    @if ($user->last_login->updated_at)
                                                                    {{ $user->last_login->updated_at->format('D, M j, Y H:i') }}
                                                                @else
                                                                    "-"
                                                                @endif
                                                               @endisset
                                                            </td>
                                                            <td>{{ $user->last_login->browserFamily ?? '-' }} </td>
                                                            <td>{{ $user->last_login->regionName ?? '-' }} </td>
                                                            {{-- <td>
                                                        <span class="badge bg-warning-light border-warning fs-11">Pending</span>
                                                    </td> --}}
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
