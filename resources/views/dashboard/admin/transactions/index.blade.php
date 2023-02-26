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
                                                    <th class="sorting sorting_asc" style="">Paystack Ref</th>
                                                    <th scope="row" class="sorting" style="">Date & Time</th>
                                                    <th class="sorting" tabindex="0" style="">User name</th>
                                                    <th class="sorting" tabindex="0" style="">Email Address</th>
                                                    {{-- <th class="sorting" tabindex="0" style="">Material</th> --}}
                                                    <th class="sorting" tabindex="0" style="">Amount</th>
                                                    {{-- <th class="sorting" tabindex="0" style="">Currency</th> --}}
                                                    <th class="sorting" tabindex="0" style="">Type of transaction
                                                    </th>
                                                    <th class="sorting" tabindex="0" style=""></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($transactions)
                                                    @foreach ($transactions as $transaction)
                                                        <tr class="">
                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                            <td class="sorting_1">
                                                                <a class="font-weight-bold"
                                                                    onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                    data-title="{{ $transaction->invoice_id }}"
                                                                    href="{{ route('admin.transaction.view', $transaction->id) }}">
                                                                    {{ $transaction->invoice_id }}
                                                                </a>
                                                            </td>
                                                            <td class="sorting_1">{{ $transaction->trxref }}</td>
                                                            <td>{{ $transaction->created_at->format('D, M j, Y H:i:s') ?? '' }}
                                                            </td>
                                                            <td class="sorting_1"><a class="font-weight-bold"
                                                                    href="">{{ $transaction->user->name }}</a></td>
                                                            <td>{{ $transaction->user->email }}</td>
                                                            <td><b class="money">{{ money($transaction->amount) }}</b></td>
                                                            <td><b class="text-capitalize">{{ $transaction->type }}</b></td>
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
