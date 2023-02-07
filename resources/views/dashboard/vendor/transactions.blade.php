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
                                                    <th class="sorting sorting_asc" style="">S/N
                                                    </th>
                                                    <th class="sorting sorting_asc" style="">Invoice ID
                                                    </th>
                                                    <th scope="row" class="sorting" style="">Date of Transaction
                                                    </th>
                                                    <th class="sorting" tabindex="0" style="">Transaction Type
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
                                                            <td>{{ $sn++ }}</td>
                                                            <td class="sorting_1">
                                                                <a class="font-weight-normal1"
                                                                    href="#">{{ $transaction->invoice_id }}</a>
                                                            </td>
                                                            <td>{{ $transaction->created_at->format('D, M j, Y h:i a') }}
                                                            </td>
                                                            <td>
                                                                @if ($transaction->type == 'bought')
                                                                    <span
                                                                        class="badge bg-success-light border-success text-capitalize type-text">{{ $transaction->type }}</span>
                                                                @endif
                                                                @if ($transaction->type == 'rented')
                                                                    <span
                                                                        class="badge bg-warning-light border-warning text-capitalize type-text">{{ $transaction->type }}</span>
                                                                @endif
                                                            </td>

                                                            @if ($transaction->type == 'bought')
                                                                <td><span
                                                                        class="money">{{ money($transaction->amount) }}</span>
                                                                </td>
                                                                <td><span
                                                                        class="money">{{ money((80.5 / 100) * $transaction->amount) }}</span>
                                                                </td>
                                                            @endif
                                                            @if ($transaction->type == 'rented')
                                                                <td>
                                                                    @if ($transaction->mat_his->is_rent_expired)
                                                                        <span
                                                                            class="money">{{ money($transaction->amount) }}</span>
                                                                    @else
                                                                        --
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($transaction->mat_his->is_rent_expired)
                                                                        @switch($transaction->mat_his->rent_count)
                                                                            @case(2)
                                                                                <span
                                                                                    class="money">{{ money((60 / 100) * $transaction->amount/2) }}</span>
                                                                            @break
                                                                            @case(1)
                                                                                <span
                                                                                    class="money">{{ money((60 / 100) * $transaction->amount) }}</span>
                                                                            @break

                                                                            @default
                                                                        --
                                                                        @endswitch
                                                                    @else
                                                                        --
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            <td>
                                                               @if ($transaction->type == 'rented')
                                                                    @if ($transaction->mat_his->is_rent_expired)
                                                                <span
                                                                    class="badge bg-success-light border-success text-capitalize type-text">{{ $transaction->status }}</span>
                                                                @else
                                                                <span
                                                               class="badge bg-warning-light border-warning text-capitalize type-text">Pending</span>
                                                                @endif
                                                               @else
                                                                <span
                                                                    class="badge bg-success-light border-success text-capitalize type-text">{{ $transaction->status }}</span>
                                                               @endif
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
