<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="mat-title">
                        <h5><b class="font-weight-bold">Transaction ID: </b>{{ $trans->tran_id }}</h5>
                        <h5><b class="font-weight-bold">Date & Time:
                            </b>{{ $trans->created_at->format('D, M j, Y H:i:s') ?? '' }}</h5>
                        <h5><b class="font-weight-bold">Amount: </b
                                class="money">{{ $trans->wallet->currency->symbol }}{{ number_format($trans->amount_withdraw, 2) }}
                        </h5>
                        <h5><b class="font-weight-bold">Charge: </b
                                class="money">{{ $trans->wallet->currency->symbol }}{{ number_format($trans->fee, 2) }}
                        </h5>
                        <h5><b class="font-weight-bold">Status:
                                @if ($trans->status == 'NEW')
                                    <span
                                        class="badge bg-success-light border-success text-capitalize type-text">{{ $trans->status }}</span>
                                @else
                                    <span
                                        class="badge bg-warning-light border-warning text-capitalize type-text">{{ $trans->status }}</span>
                                @endif
                        </h5>
                        @if ($trans->vendor)
                            <h5 class="text-capitalize"><b class="font-weight-bold">Vendor: </b>{{ $trans->vendor->name ?? "" }}</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
