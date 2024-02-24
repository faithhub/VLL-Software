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
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Payouts</h6>
                                    <small class="h5"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @isset($wallets)
                                @foreach ($wallets as $wallet)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header border-bottom-0 mb-4 mt-3">
                                                <div class="card-options" style="margin-left:2.5%">
                                                    <div class="card-body">
                                                        <h3 class="font-weight-bolder money" style="line-height: 0">
                                                            {{$wallet->currency->symbol}}{{ number_format($wallet->amount, 2) }}</h3>
                                                        <p>Balance</p>
                                                    </div>
                                                </div>
                                                <div class="card-options" style="margin-right:2.5%"> <a
                                                    onclick="shiNew(event)" data-type="dark" data-size="m"
                                                    data-title="Withdraw"
                                                        href="{{ route('vendor.withdraw', $wallet->code) }}"
                                                        class="btn btn-bg btn-primary p-3"><i class="fa fa-money"></i>&nbsp&nbsp
                                                        Withdraw</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                            {{-- <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header border-bottom-0 mb-4 mt-3">
                                        <div class="card-options" style="margin-left:2.5%">
                                            <div class="card-body">
                                                <h3 class="font-weight-bolder money" style="line-height: 0">
                                                    {{ money(500000) }}</h3>
                                                <p>Available balance</p>
                                            </div>
                                        </div>
                                        <div class="card-options" style="margin-right:2.5%"> <a
                                                href="{{ route('vendor.upload') }}" class="btn btn-bg btn-primary p-3"><i
                                                    class="fa fa-money"></i>&nbsp&nbsp Withdraw</a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="table-responsive">
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <h4>Payout History</h4>
                                    <div class="col-sm-12">
                                        <table
                                            class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                            id="datatable" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" style="">S/N
                                                    </th>
                                                    <th class="sorting sorting_asc" style="">Invoice ID
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Amount
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">charge
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Status</th>
                                                    <th scope="row" class="sorting" style="">Date
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($withdrawals)
                                                    @foreach ($withdrawals as $transaction)
                                                        <tr class="">
                                                            <td>{{ $sn++ }}</td>
                                                            <td class="sorting_1">
                                                                <a class="font-weight-normal1"
                                                                    href="#">{{ $transaction->tran_id }}</a>
                                                            </td>
                                                            <td>
                                                                <span class="money">{{$transaction->wallet->currency->symbol}}{{ number_format($transaction->amount_withdraw, 2) }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="money">{{$transaction->wallet->currency->symbol}}{{ number_format($transaction->fee, 2) }}</span>
                                                            </td>
                                                            
                                                            <td>
                                                                @if ($transaction->status == "NEW")
                                                                <span
                                                                            class="badge bg-success-light border-success text-capitalize type-text">{{ $transaction->status }}</span>
                                                                @else
                                                                <span
                                                                            class="badge bg-warning-light border-warning text-capitalize type-text">{{ $transaction->status }}</span>
                                                                    
                                                                @endif
                                                          </td>
                                                            <td>{{ $transaction->created_at->format('D, M j, Y h:i a') }}
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
