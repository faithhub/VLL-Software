@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Sub Admins</h6>
                        <div class="card-options" style="margin-right:2.5%">
                            <a onclick="shiSubAdmin(event)" data-type="dark" data-size="m" data-title="Add Sub Admin"
                                href="{{ route('admin.sub_admin.create') }}" class="btn btn-bg btn-primary p-3"><b>Add
                                    New</b></a>
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
                                                    <th scope="row" class="sorting" style="">Name</th>
                                                    <th class="sorting" tabindex="0" style="">Email Address</th>
                                                    <th class="sorting" tabindex="0" style="">Phone Number</th>
                                                    <th class="sorting" tabindex="0" style="">Role</th>
                                                    <th class="sorting" tabindex="0" style="">Created on</th>
                                                    {{-- <th class="sorting" tabindex="0" style="">Last Login</th>
                                                    <th class="sorting" tabindex="0" style="">Device IOS</th>
                                                    <th class="sorting" tabindex="0" style="">Browser Type</th>
                                                    <th class="sorting" tabindex="0" style="">Location</th> --}}
                                                    <th class="sorting" tabindex="0" style="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($users)
                                                    @foreach ($users as $user)
                                                        <tr class="">
                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                    href="{{ route('admin.user', $user->id) }}"></a>
                                                                    {{ $user->name }}
                                                            </td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td>
                                                                @isset($user->sub_admin)
                                                                <span class="btn btn-sm btn-primary text-capitalize">{{$user->sub_admin}} Management</span>
                                                                @endisset
                                                            </td>
                                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                                            
                                                            <td>
                                                                <a href="{{ route('admin.sub_admin.delete', $user->id) }}"
                                                                    onclick="return confirm('Are you sure you want to delete this user?')"
                                                                    class="btn btn-sm btn-danger">Delete</i></a>
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
