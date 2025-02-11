<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="mat-title">
                        <h5><b class="font-weight-bold">Transaction ID: </b>{{ $tran->invoice_id }}</h5>
                        <h5><b class="font-weight-bold">PayStack Reference ID: </b>{{ $tran->trxref }}</h5>
                        <h5><b class="font-weight-bold">Date & Time: </b>{{ $tran->created_at->format('D, M j, Y H:i:s') ?? '' }}</h5>
                        {{-- <h5><b class="font-weight-bold">User Name: </b>{{ $tran->user->name }}</h5>
                        <h5><b class="font-weight-bold">User Email: </b>{{ $tran->user->email }}</h5>
                        <h5><b class="font-weight-bold">User Role: </b>{{ $tran->user->user_type }}</h5> --}}
                        <h5><b class="font-weight-bold">Amount: </b>{{ money($tran->amount)  }}</h5>
                        @if ($tran->type)
                        <h5 class="text-capitalize"><b class="font-weight-bold">Type: </b>{{ $tran->type  }}</h5>
                        @endif
                        @isset($mat_his)
                        <h5><b class="font-weight-bold text-capitalize">Material: </b>{{ $mat_his->mat->title ?? "" }}</h5>
                        @endisset
                        @isset($mat_folder)
                        <h5><b class="font-weight-bold text-capitalize">Folder: </b>{{ $mat_folder->folder->name ?? "" }}</h5>
                        @endisset
                        @dump($tran)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
