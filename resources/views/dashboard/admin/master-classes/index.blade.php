    @extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Master Class</h6>
                        {{-- <div class="card-options" style="margin-right:2.5%">
                            <a href="{{ route('admin.upload') }}" class="btn btn-bg btn-primary p-3"><b>Upload a
                                    Material</b></a>
                        </div> --}}
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
                                                    <th scope="row" class="sorting" style="">Cover </th>
                                                    <th class="sorting" tabindex="0" style="">Title</th>
                                                    <th class="sorting" tabindex="0" style="">Vendor</th>
                                                    <th class="sorting" tabindex="0" style="">Instructor Name</th>
                                                    <th class="sorting" tabindex="0" style="">Special Guest</th>
                                                    <th class="sorting" tabindex="0" style="">Duration</th>
                                                    <th class="sorting" tabindex="0" style="">Interval</th>
                                                    <th class="sorting" tabindex="0" style="">Price</th>
                                                    <th class="sorting" tabindex="0" style="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($materials)
                                                    @foreach ($materials as $material)
                                                        <tr class="">
                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                            <td class="sorting_1">
                                                                    <img src="{{ route('image.private', $material->cover->name ?? '') }}"
                                                                        alt="{{ $material->title }}" style="max-height:60px">
                                                            </td>
                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                    onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                    data-title="{{ $material->title }}"
                                                                    href="{{ route('admin.masterclass.view', $material->id) }}">{{ $material->title }}
                                                                </a></td>
                                                             <td>
                                                                <span
                                                                    class="text-capitalize">{{ $material->vendor->name }}</span>
                                                            </td>
                                                             <td>
                                                                <span
                                                                    class="text-capitalize">{{ $material->instructor_name }}</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-capitalize">{{ $material->special_guest }}</span>
                                                            </td>
                                                            <td class="sorting_1">
                                                                <span class="">
                                                                    {{ $material->duration }} 
                                                                    @if ($material->duration > 1)
                                                                        months
                                                                    @else
                                                                        month
                                                                    @endif
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-capitalize">{{ $material->interval }}</span>
                                                            </td>
                                                            {{-- <td>{{ mb_strimwidth($material->desc ?? '', 0, 20, '...') }}
                                                            </td> --}}
                                                            <td><span
                                                                    class="money">{{ money($material->amount, $material->currency_id) }}
                                                                </span> </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    {{-- <a href="" class="p-2"><i class="fa fa-trash"></i></a> --}}
                                                                    <a onclick="return confirm('Are you sure you want to delete this class?')"
                                                                        href="{{ route('admin.masterclass.delete', $material->id) }}"
                                                                        class="btn m-1 btn-sm btn-danger">Delete</a>
                                                                    {{-- <a href="{{ route('admin.edit.library', $material->id) }}"
                                                                        class="btn btn-sm m-1 btn-primary">Edit</a> --}}
                                                                    <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                        data-title="{{ $material->invoice_id }}"
                                                                        href="{{ route('admin.masterclass.view', $material->id) }}"
                                                                        class="btn btn-sm m-1 btn-dark">View</a>
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
