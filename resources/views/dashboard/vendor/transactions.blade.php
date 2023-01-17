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
                        <div class="row">
                        </div>
                        <div class="table-responsive">
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table
                                            class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                            id="datatable" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" style="">Invoice ID
                                                    </th>
                                                    <th scope="row" class="sorting" style="">Date of Transaction
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Transaction Value
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Net Order Value
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($transactions)
                                                    @foreach ($transactions as $transaction)
                                                        <tr class="">
                                                            <td class="sorting_1">
                                                                <a class="font-weight-normal1"
                                                                    href="#">{{$transaction->invoice_id}}</a>
                                                                </td>
                                                            <td>{{$transaction->date}}</td>
                                                            <td>₦{{number_format($transaction->amount, 2)}}</td>
                                                            <td>-</td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-success-light border-success fs-11">{{$transaction->status}}</span>
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
