@extends('layouts/dashboard/app')
@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            background-color: red
        }

        #img-2 {
            position: absolute;
            justify-content: center;
            width: 10%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #eee;
            display: inline-block;
            height: 50px;
            cursor: pointer;
            color: #3b566e !important;
            font-weight: 700 !important;
            background-color: #f0f4f9 !important;
            padding: 12px 12px
        }

        .custom-file-upload:hover {
            color: #3b566e !important;
            font-weight: 700 !important;
            background-color: transparent !important
        }

        .money {
            color: green;
            font-weight: 800;
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <div class="media mt-4">
                            <div class="media-body">
                                <h6 class="mb-1 mt-1 font-weight-bold h3">All folders</h6>
                                <small class="h5"></small>
                            </div>
                        </div>

                        <div class="card-options" style="margin-right:2.5%">
                            <a onclick="shiNew(event)" data-type="dark" data-size="s" data-title="Add New Folder"
                                href="{{ route('admin.add_folder') }}" class="btn btn-bg btn-primary p-3"><i
                                    class="fa fa-upload"></i>&nbsp&nbspAdd New</a>
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
                                                    <th class="sorting sorting_asc" style="">S/N
                                                    </th>
                                                    <th class="sorting sorting_asc" style="">Cover Image
                                                    </th>
                                                    <th scope="row" class="sorting" style="">Name
                                                    </th>
                                                    <th scope="row" class="sorting" style="">Material
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Amount
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Created on
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Action
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
                                                                    href="#">{{ $folder->mat_type->name ?? "" }}</a>
                                                            </td>
                                                            <td><span
                                                                    class="money">₦{{ number_format($folder->amount ?? 0, 2) }}</span>
                                                            </td>
                                                            <td>{{ $folder->created_at->format('D, M j, Y') }}
                                                            </td>
                                                            <td>
                                                                <a onclick="shiNew(event)" data-type="dark" data-size="s" data-title="{{$folder->name}}" href="{{ route('admin.edit_folder', $folder->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                                <a onclick="shiNew(event)" data-type="dark" data-size="xl" data-title="{{$folder->name}}'s Folder" href="{{ route('admin.view_folder', $folder->id) }}" class="btn btn-sm btn-primary">Materials</a>
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
    <script>
        // $(document).ready(function() {
        //     $("#selectMaterial").change(function() {
        //     }).change();
        // });

        function selectMat() {
            $('form#selectMaterialForm').submit();
        }
    </script>
@endsection
