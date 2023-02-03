<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <form method="POST" class="validate-form" action="{{ route('user.invite_teammate') }}">
                        @csrf
                        {{-- <input type="hidden" name="material_id" value="{{$material->id}}"> --}}
                        <div class="col-sm-12 col-md-12 mb-4 mt-2">
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input name="email" type="email" class="form-control" placeholder="Email"
                                    required="" data-parsley-required-message="Email is required">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-4 mt-2">
                            <button type="submit" class="btn btn-primary">Send Invite</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
</script>
