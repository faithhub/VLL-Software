@extends('layouts/dashboard/app')
@section('content')
    <style>
        .text-black {
            color: black !important;
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Recycle Bin</h6>
                    </div>
                    <div class="card-body pt-0">

                        <div class="card-body p-6">
                            <div class="panel panel-primary">
                                <div class=" tab-menu-heading p-0 bg-white">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav nav-tabs" id="myTab">
                                            <li class=""><a href="#deletedMaterials"
                                                    class="{{ empty(old('tabName')) || old('tabName') == 'deletedMaterials' ? 'active' : '' }}">Materials</a>
                                            </li>
                                            <li><a href="#deletedFolders"
                                                    class="{{ !empty(old('tabName')) && old('tabName') == 'deletedFolders' ? 'active' : '' }}">Folders</a>
                                            </li>
                                            <li><a href="#deletedMaterialType"
                                                    class="{{ !empty(old('tabName')) && old('tabName') == 'deletedMaterialType' ? 'active' : '' }}">Material
                                                    Type</a>
                                            </li>
                                            <li><a href="#deleteLogs"
                                                    class="{{ !empty(old('tabName')) && old('tabName') == 'deleteLogs' ? 'active' : '' }}">Delete Logs</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- <div class="panel-body tabs-menu-body"> --}}
                                <div class="tab-content">
                                    <div class="tab-pane {{ empty(old('tabName')) || old('tabName') == 'deletedMaterials' ? 'active' : '' }}"
                                        id="deletedMaterials">
                                        <div class="row pt-4 mt-3">

                                            <div class="table-responsive">
                                                <div id="datatable_wrapper"
                                                    class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                    <div class="row">
                                                        <table
                                                            class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                                            id="datatable" role="grid" aria-describedby="datatable_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting sorting_asc" style="">No
                                                                    </th>
                                                                    <th scope="row" class="sorting" style="">
                                                                        Book </th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Book Name</th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Type</th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Uploaded By</th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Deleted By</th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Date Deleted</th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Material</th>
                                                                    <th class="sorting" tabindex="0" style="">
                                                                        Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @isset($materials)
                                                                    @php
                                                                        $sn = 1;
                                                                    @endphp
                                                                    @foreach ($materials as $material)
                                                                        <tr class="">
                                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                                            <td class="sorting_1">
                                                                                <img src="{{ asset($material->cover->url ?? 'images/new-meeting.png') }}"
                                                                                    style="max-height:60px">
                                                                            </td>
                                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                                    onclick="shiNew(event)" data-type="dark"
                                                                                    data-size="m"
                                                                                    data-title="{{ $material->invoice_id }}"
                                                                                    href="{{ route('admin.view_material', $material->id) }}">
                                                                                    @isset($material->name_of_party)
                                                                                        {{ mb_strimwidth($material->name_of_party ?? '', 0, 30, '...') }}
                                                                                    @else
                                                                                        {{ mb_strimwidth($material->title ?? '', 0, 30, '...') }}
                                                                                    @endisset
                                                                                </a></td>
                                                                            <td>{{ $material->type->name ?? '-' }}</td>
                                                                            <td>{{ $material->vendor->name ?? '-' }}</td>
                                                                            <td></td>
                                                                            <td><b
                                                                                    class="font-weight-bold">{{ $material->deleted_at->format('D, M j, Y h:i a') }}</b>
                                                                            </td>
                                                                            <td>
                                                                                <a class="font-weight-bold btn m-1 btn-sm btn-primary"
                                                                                    href="{{ asset($material->file->url ?? '') }}"
                                                                                    target="blank">File</a>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <a onclick="return confirm('Are you sure you want to restore this material?')"
                                                                                        href="{{ route('admin.restore_material', $material->id) }}"
                                                                                        class="btn m-1 btn-sm btn-red font-weight-bold">Restore</a>
                                                                                    <a onclick="shiNew(event)" data-type="dark"
                                                                                        data-size="m"
                                                                                        data-title="{{ $material->invoice_id }}"
                                                                                        href="{{ route('admin.view_material', $material->id) }}"
                                                                                        class="btn btn-sm m-1 btn-blue">Summary</a>
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
                                    <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'deletedFolders' ? 'active' : '' }}"
                                        id="deletedFolders">
                                        <div class="row pt-4 mt-3">
                                            <div class="row mt-5 settings">

                                                <div class="table-responsive">
                                                    <div id="datatable_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <table
                                                                    class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                                                    id="datatable" role="grid"
                                                                    aria-describedby="datatable_info">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th class="sorting sorting_asc"
                                                                                style="">S/N
                                                                            </th>
                                                                            <th class="sorting sorting_asc"
                                                                                style="">Cover Image
                                                                            </th>
                                                                            <th scope="row" class="sorting"
                                                                                style="">Name
                                                                            </th>
                                                                            <th scope="row" class="sorting"
                                                                                style="">Material
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                style="">Amount
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                style="">Duration
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                style="">Created on
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                style="">Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @isset($folders)
                                                                            @foreach ($folders as $folder)
                                                                                <tr class="">
                                                                                    <td>{{ $sn++ }}</td>
                                                                                    <td class="sorting_1">
                                                                                        <img src="{{ asset($folder->folder_cover->url ?? '') }}"
                                                                                            style="max-height:40px">
                                                                                    </td>
                                                                                    <td class="sorting_1">
                                                                                        <a class="font-weight-normal1"
                                                                                            href="#">{{ $folder->name }}</a>
                                                                                    </td>
                                                                                    <td class="sorting_1">
                                                                                        <a class="font-weight-normal1"
                                                                                            href="#">{{ $folder->mat_type->name ?? '' }}</a>
                                                                                    </td>
                                                                                    <td>
                                                                                        @if ($folder->price == 'Free')
                                                                                            Free
                                                                                        @else
                                                                                            <span
                                                                                                class="money">{{ money($folder->amount, $folder->currency_id) }}</span>
                                                                                        @endif
                                                                                    </td>
                                                                                    <td><span
                                                                                            class="text-capitalize">{{ $folder->duration }}</span>
                                                                                    </td>
                                                                                    <td>{{ $folder->created_at->format('D, M j, Y') }}
                                                                                    </td>
                                                                                    <td>
                                                                                        <a onclick="shiNew(event)"
                                                                                            data-type="dark" data-size="m"
                                                                                            data-title="{{ $folder->name }}"
                                                                                            href="{{ route('admin.edit_folder', $folder->id) }}"
                                                                                            class="btn btn-sm btn-primary">Edit</a>
                                                                                        <a onclick="shiNew(event)"
                                                                                            data-type="dark" data-size="xl"
                                                                                            data-title="{{ $folder->name }}'s Folder"
                                                                                            href="{{ route('admin.view_folder', $folder->id) }}"
                                                                                            class="btn btn-sm btn-primary">Materials</a>
                                                                                        <a onclick="return confirm('Are you sure you want to delete this folder?')"
                                                                                            href="{{ route('admin.delete_folder', $folder->id) }}"
                                                                                            class="btn btn-sm btn-danger">Delete</a>
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
                                    <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'deletedMaterialType' ? 'active' : '' }}"
                                        id="deletedMaterialType">
                                        <div class="mt-5 pt-4">

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
                                                                        <th scope="row"
                                                                            class="sorting font-weight-bold"
                                                                            style="width:50%">
                                                                            Description</th>
                                                                        <th class="sorting font-weight-bold"
                                                                            tabindex="0" style="width:5%">
                                                                            Status</th>
                                                                        <th class="sorting font-weight-bold"
                                                                            tabindex="0" style="width:15%">
                                                                            Role</th>
                                                                        <th class="sorting font-weight-bold"
                                                                            tabindex="0" style="width:10%">
                                                                            Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    </tr>
                                                                    @isset($material_types)
                                                                        @foreach ($material_types as $material_type)
                                                                            <tr>
                                                                                <td class="sorting_1">
                                                                                    {{ $material_type->name }}
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
                                    <div class="tab-pane {{ !empty(old('tabName')) && old('tabName') == 'deleteLogs' ? 'active' : '' }}"
                                        id="deleteLogs">
                                        <div class="mt-5 pt-4">
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
