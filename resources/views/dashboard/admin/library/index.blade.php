@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Material List</h6>
                        <div class="card-options" style="margin-right:2.5%">
                            <a href="{{ route('admin.upload') }}" class="btn btn-bg btn-primary p-3"><b>Upload a
                                    Material</b></a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <div id="datatable_wrapper" c lass="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table
                                            class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                            id="datatable" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" style="">No</th>
                                                    <th scope="row" class="sorting" style="">Book </th>
                                                    <th class="sorting" tabindex="0" style="">Book Name</th>
                                                    <th class="sorting" tabindex="0" style="">Type</th>
                                                    <th class="sorting" tabindex="0" style="">Author</th>
                                                    <th class="sorting" tabindex="0" style="">Vendor</th>
                                                    <th class="sorting" tabindex="0" style="">Description</th>
                                                    <th class="sorting" tabindex="0" style="">Price</th>
                                                    <th class="sorting" tabindex="0" style="">Material</th>
                                                    <th class="sorting" tabindex="0" style="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($materials)
                                                    @foreach ($materials as $material)
                                                        <tr class="">
                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                            <td class="sorting_1">
                                                                {{-- <img src="{{ asset($material->cover->url ?? 'images/new-meeting.png') }}"
                                                                    style="max-height:60px"> --}}
                                                                @if ($material->folder)
                                                                    <img src="{{ asset($material->folder->folder_cover->url ?? 'images/new-meeting.png') }}"
                                                                        alt="{{ $material->title }}" style="max-height:60px">
                                                                @else
                                                                    <img src="{{ asset($material->cover->url ?? 'images/new-meeting.png') }}"
                                                                        alt="{{ $material->title }}" style="max-height:60px">
                                                                @endif
                                                            </td>
                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                    onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                    data-title="{{ $material->invoice_id }}"
                                                                    href="{{ route('admin.view_material', $material->id) }}">
                                                                    @isset($material->name_of_party)
                                                                        {{ mb_strimwidth($material->name_of_party ?? '', 0, 30, '...') }}
                                                                    @else
                                                                        {{ mb_strimwidth($material->title ?? '', 0, 30, '...') }}
                                                                    @endisset
                                                                </a></td>
                                                            <td>{{ $material->type->name ?? '-' }}</td>
                                                            <td>{{ $material->name_of_author ?? '-' }}</td>
                                                            <td>{{ $material->vendor->name ?? '-' }}</td>
                                                            <td>{{ mb_strimwidth($material->material_desc ?? '', 0, 20, '...') }}
                                                            </td>
                                                            <td><span
                                                                    class="money">{{ money($material->amount, $material->currency_id) }}
                                                                </span> </td>
                                                            <td>
                                                                {{-- <a class="font-weight-bold" href="{{ asset($material->file->url ?? "") }}" target="blank" >{{ mb_strimwidth($material->title ?? '', 0, 20, '...') }}.pdf</a> --}}
                                                                <a class="font-weight-bold btn m-1 btn-sm btn-primary"
                                                                    href="{{ asset($material->file->url ?? '') }}"
                                                                    target="blank"><i class="fa fa-eye"></i> Material</a>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    {{-- <a href="" class="p-2"><i class="fa fa-trash"></i></a> --}}
                                                                    <a onclick="return confirm('Are you sure you want to delete this material?')"
                                                                        href="{{ route('admin.delete.library', $material->id) }}"
                                                                        class="btn m-1 btn-sm btn-danger">Delete</a>
                                                                    <a href="{{ route('admin.edit.library', $material->id) }}"
                                                                        class="btn btn-sm m-1 btn-primary">Edit</a>
                                                                    <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                        data-title="{{ $material->invoice_id }}"
                                                                        href="{{ route('admin.view_material', $material->id) }}"
                                                                        class="btn btn-sm m-1 btn-blue">Summary</a>
                                                                    {{-- <a onclick="return confirm('Are you sure you want to delete this material?')" href="{{ route('admin.delete.library', $material->id) }}" class="p-2"><i class="fa fa-trash"></i></a>
                                                                <a href="{{ route('admin.edit.library', $material->id) }}" class="p-2"><i class="fa fa-pencil"></i></a> --}}
                                                                    {{-- <a href="{{ route('admin.view.library', $material->id) }}" class="p-2"><i class="fa fa-eye"></i></a> --}}
                                                                </div>
                                                            </td>
                                                            {{-- <td>{{ $material->created_at->format('D, M j, Y') ?? '' }}</td> --}}
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
