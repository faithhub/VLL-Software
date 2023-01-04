<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        @isset($sub)
            @if ($sub->type == 'student')
                <form class="validate-form" method="POST" action="{{ route('admin.edit_subscription', $sub->id) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $sub->id }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="Subscription name"
                                    value="{{ $sub->name }}" name="name" required=""
                                    data-parsley-required-message="Subscription name is required">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @isset($sub->session)
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Amount</label>
                                    <input type="number" class="form-control" placeholder="Subscription Amount"
                                        value="{{ $sub->session }}" name="session" required=""
                                        data-parsley-required-message="Subscription Amount is required">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Duration</label>
                                    <input type="number" class="form-control" placeholder="4 Months"
                                        value="{{ $sub->session_duration }}" name="session_duration" required=""
                                        data-parsley-required-message="{{ $sub->name }} Amount is required">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endisset
                        @isset($sub->system)
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Amount</label>
                                    <input type="number" class="form-control" placeholder="Subscription Amount"
                                        value="{{ $sub->system }}" name="system" required=""
                                        data-parsley-required-message="Amount is required">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Duration</label>
                                    <input type="number" class="form-control" placeholder="4 Months"
                                        value="{{ $sub->system_duration }}" name="system_duration" required=""
                                        data-parsley-required-message="{{ $sub->name }} Amount is required">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endisset
                    </div>
                    <div class="col-lg-12 col-xl-12 text-center mt-3">
                        <button class="btn btn-primary p-2" type="submit" style="font-size: 15px">Update</button>
                    </div>
                </form>
            @endif
            @if ($sub->type == 'professional')
                <form class="validate-form" method="POST" action="{{ route('admin.edit_subscription', $sub->id) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $sub->id }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="Subscription name"
                                    value="{{ $sub->name }}" name="name" required=""
                                    data-parsley-required-message="Subscription name is required">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @isset($sub->annual)
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Annual</label>
                                    <input type="number" class="form-control" placeholder="Annual Amount"
                                        value="{{ $sub->annual }}" name="annual" required=""
                                        data-parsley-required-message="Annual Amount is required">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endisset
                        @isset($sub->quarterly)
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Quarterly</label>
                                    <input type="number" class="form-control" placeholder="Quarterly Amount"
                                        value="{{ $sub->quarterly }}" name="quarterly" required=""
                                        data-parsley-required-message="Quarterly Amount is required">
                                    @error('quarterly')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endisset
                        @isset($sub->monthly)
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Monthly</label>
                                    <input type="number" class="form-control" placeholder="Monthly Amount"
                                        value="{{ $sub->monthly }}" name="monthly" required=""
                                        data-parsley-required-message="Monthly Amount is required">
                                    @error('monthly')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endisset
                        @isset($sub->weekly)
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Weekly</label>
                                    <input type="number" class="form-control" placeholder="Weekly Amount"
                                        value="{{ $sub->weekly }}" name="weekly" required=""
                                        data-parsley-required-message="Weekly Amount is required">
                                    @error('weekly')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endisset
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Maximum team member</label>
                                    <input type="number" class="form-control" placeholder="Maximum team member"
                                        value="{{ $sub->max_teammate }}" name="max_teammate" required=""
                                        data-parsley-required-message="Maximum Teammates is required">
                                    @error('max_teammate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-12 col-xl-12 text-center mt-1">
                        <button class="btn btn-primary p-2" type="submit" style="font-size: 15px">Update</button>
                    </div>
                </form>
            @endif
        @endisset
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('.validate-form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
    });
    tinymce.init({
        selector: 'textarea#editor',
    });
</script>
