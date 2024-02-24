<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    @if (Auth::user()->acc_verified)
                    <form class="validate-form" action="{{ route('withdraw.transaction') }}" method="POST">
                        @csrf
                        <input type="hidden" name="currency" value="{{$wallet->code}}">
                        <input type="hidden" name="currency_id" value="{{$wallet->id}}">
                        <div class="row mt-5 settings">
                            <div class="col-lg-12 col-xl-12">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Amount</label>
                                        <input name="amount" type="number" class="form-control" requiredd=""
                                            data-parsley-required-message="Amount is required"
                                            minn="10000"
                                            data-parsley-min-message="Amount is required"
                                            placeholder="" value="">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Bank</label>
                                        <input name="" type="" class="form-control" placeholder="" readonly
                                            value=" @if (Auth::user()->acc_verified) {{Auth::user()->bank->name}} @endif">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Account Number</label>
                                        <input name="" type="" class="form-control" placeholder="" readonly
                                            value=" @if (Auth::user()->acc_verified) {{Auth::user()->acc_number}} @endif">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label">Account Name</label>
                                        <input name="" type="" class="form-control" placeholder="" readonly
                                            value=" @if (Auth::user()->acc_verified) {{Auth::user()->acc_name}} @endif">
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 col-xl-12 text-center">
                                <button type="submit" class="btn btn-primary p-3 pt-2 pt-2"
                                    style="font-size: 18px">Submit</button>
                            </div>
                        </div>
                    </form>
                    @else
                        <h3>Update your account details from the <a href="{{ route('vendor.settings') }}">Settings page</a></h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
