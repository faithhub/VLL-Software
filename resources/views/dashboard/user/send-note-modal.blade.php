<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <form method="POST" class="validate-form" action="{{ route('user.send_note', $material->id) }}">
                        @csrf
                        <input type="hidden" name="material_id" value="{{$material->id}}">
                        <div class="col-sm-12 col-md-12 mb-4">
                            <label class='form-label'>Send To</label>
                            <div class='d-flex' style='margin-bottom:-10px'>
                                <div class='form-check form-check-inline'>
                                    <input class='form-check-input' onchange="checkEmail(this.value)" name='send_note'
                                        type='radio' id='inlineCheckbox1' value='my_email' required='' checked
                                        {{ old('send_note') == 'my_email' ? 'checked' : '' }}
                                        data-parsley-errors-container='#send_note-error'
                                        data-parsley-required-message='Status is required'>
                                    <label class='form-check-label' for='inlineCheckbox1'>My Email</label>
                                </div>
                                <div class='form-check form-check-inline'>
                                    <input onchange="checkEmail(this.value)" class='form-check-input'
                                        {{ old('send_note') == 'other' ? 'checked' : '' }} name='send_note'
                                        type='radio' id='inlineCheckbox2' value='other'>
                                    <label class='form-check-label' for='inlineCheckbox2'>Other Email</label>
                                </div>
                            </div>
                            @error('send_note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class='invalid-feedback' id='send_note-error' role='alert'></span>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-4 mt-2">
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input name="email" type="email" class="form-control" placeholder="Email"
                                    required="" id="emailInput" data-parsley-required-message="Email is required"
                                    readonly value="{{ Auth::user()->email }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 mb-4 mt-2">
                            <div class="form-group">
                                <label class="form-label">Email Subject</label>
                                <input name="email_subject" type="text" class="form-control" placeholder="Email Subject"
                                    required="" data-parsley-required-message="Email Subject is required"
                                    value="">
                                @error('email_subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 mb-4 mt-2">
                            <button type="submit" class="btn btn-primary">Send</button>
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

    function checkEmail(value) {
        switch (value) {
            case "my_email":
                document.getElementById("emailInput").readOnly = true;
                document.getElementById("emailInput").value = "{{ Auth::user()->email }}"
                break;
            case "other":
                document.getElementById("emailInput").readOnly = false;
                break;

            default:
                break;
        }
    }
</script>
