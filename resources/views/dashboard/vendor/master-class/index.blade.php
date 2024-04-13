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
                                <h6 class="mb-1 mt-1 font-weight-bold h3">Master Classes</h6>
                                <small class="h5"></small>
                            </div>
                        </div>

                        {{-- <div class="card-options" style="margin-right:2.5%">
                            <a onclick="shiNew(event)" data-type="dark" data-size="s" data-title="Add New Folder"
                                href="{{ route('vendor.add_folder') }}" class="btn btn-bg btn-primary p-3"><i
                                    class="fa fa-upload"></i>&nbsp&nbspAdd New</a>
                        </div> --}}
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
                                                    <th class="sorting sorting_asc" style="">Cover
                                                    </th>
                                                    <th class="sorting sorting_asc" style="">Title
                                                    </th>
                                                    <th class="sorting sorting_asc" style="">Instructor Name
                                                    </th>
                                                    <th class="sorting sorting_asc" style="">Special Guest
                                                    </th>
                                                    <th scope="row" class="sorting" style="">Duration
                                                    </th>
                                                    <th scope="row" class="sorting" style="">Interval
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Amount
                                                    </th>
                                                    <th scope="row" class="sorting" style="">Dates
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Created on
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($classes)
                                                @php
                                                    $sn = 1;
                                                @endphp
                                                    @foreach ($classes as $class)
                                                        <tr class="">
                                                            <td>{{ $sn++ }}</td>
                                                            <td class="sorting_1">
                                                                <img src="{{ route('image.private', $class->cover->name ?? '') }}"
                                                                    style="max-height:40px">
                                                            </td>
                                                            <td class="sorting_1">
                                                                <a class="font-weight-bold text-capitalize" onclick="shiNew(event)" data-type="dark" data-size="m" data-title="{{$class->title}}" 
                                                                    href="{{ route('vendor.master_class', $class->id) }}">{{ $class->title }}</a>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-capitalize">{{ $class->instructor_name }}</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-capitalize">{{ $class->special_guest }}</span>
                                                            </td>
                                                            <td class="sorting_1">
                                                                <span class="">
                                                                    {{ $class->duration }} 
                                                                    @if ($class->duration > 1)
                                                                        months
                                                                    @else
                                                                        month
                                                                    @endif
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-capitalize">{{ $class->interval }}</span>
                                                            </td>
                                                            <td>
                                                                @if ($class->price == 'Free')
                                                                Free
                                                                    @else
                                                                    <span class="money">{{ money($class->amount, $class->currency_id) }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span class="text-capitalize">
                                                                    @isset($class->dates)
                                                                        @foreach ($class->dates as $date)
                                                                            {{ date('D, M j, Y', strtotime($date))  }}<br>
                                                                        @endforeach
                                                                    @endisset
                                                                </span>
                                                            </td>
                                                            <td>{{ $class->created_at->format('D, M j, Y') }}
                                                            </td>
                                                            <td>
                                                                {{-- <a onclick="shiNew(event)" data-type="dark" data-size="m" data-title="{{$class->title}}" href="{{ route('vendor.edit_folder', $class->id) }}" class="btn btn-sm btn-primary">Edit</a> --}}
                                                                <a onclick="shiNew(event)" data-type="dark" data-size="m" data-title="{{$class->title}}" href="{{ route('vendor.master_class', $class->id) }}" class="btn btn-sm btn-primary">View</a>
                                                                <a onclick="return confirm('Are you sure you want to delete this class?')" href="{{ route('vendor.delete_master_class', $class->id) }}" class="btn btn-sm btn-danger">Delete</a>
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
