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
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Transactions</h6>
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
                                                    <th class="sorting sorting_asc" style="">Invoice No</th>
                                                    <th scope="row" class="sorting" style="">Date & Time</th>
                                                    <th class="sorting" tabindex="0" style="">User name</th>
                                                    <th class="sorting" tabindex="0" style="">Email Address</th>
                                                    <th class="sorting" tabindex="0" style="">Material</th>
                                                    <th class="sorting" tabindex="0" style="">Amount</th>
                                                    <th class="sorting" tabindex="0" style="">Currency</th>
                                                    <th class="sorting" tabindex="0" style="">Type of transaction</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>JDS876SHJDGHJ</td>
                                                    <td>Wed, Dec 21, 2022 22:33</td>
                                                    <td>Olawale</td>
                                                    <td>Ola@gmail.com</td>
                                                    <td>Civil Law.pdf</td>
                                                    <td>₦{{ number_format(4500, 2) }}</td>
                                                    <td>NGN</td>
                                                    <td>Purchase</td>
                                                </tr>
                                                @isset($vendors)
                                                    @foreach ($vendors as $vendor)
                                                        <tr class="">
                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                    href="">{{ $vendor->name }}</a></td>
                                                            <td>{{ $vendor->email }}</td>
                                                            <td>{{ $vendor->phone }}</td>
                                                            <td>{{ $vendor->created_at->format('D, M j, Y') ?? '' }}</td>
                                                            <td>{{ 'GTBank' ?? '-' }}</td>
                                                            <td>{{ '0211929219' ?? '-' }}</td>
                                                            <td>{{ 'Faith Dara' ?? '-' }}</td>
                                                            <td><a href=""><i class="fa fa-trash"></i></a></td>
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
