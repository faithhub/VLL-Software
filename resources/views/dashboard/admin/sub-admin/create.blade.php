<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row pt-1 mt-1">
                    <form class="validate-form" action="{{ route('admin.sub_admin.create') }}" method="POST">
                        @csrf
                        <div class="row settings">
                            <div class="col-lg-12 col-xl-12 mb-4">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Full Name</label>
                                        <input name="name" type="text" class="form-control" required=""
                                            data-parsley-required-message="Full name is required"
                                            placeholder="First Name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Email address</label>
                                        <input name="email" type="email" class="form-control" placeholder="Email"
                                            required="" data-parsley-required-message="Email is required"
                                            value="{{ old('email') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control"
                                            placeholder="********" value="{{ old('password') }}"
                                            data-parsley-required-message="Password is required" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input name="phone" type="number" class="form-control"
                                            placeholder="+234 905 678 234 " value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-12 mb-4">
                                    <label class='form-label'>Role</label>
                                    <div class='d-flex' style='margin-bottom:-10px'>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' name='role' type='radio'
                                                id='inlineCheckbox1' value='user' required=''
                                                {{ Auth::user()->role == 'user' ? 'checked' : '' }}
                                                data-parsley-errors-container='#role-error'
                                                data-parsley-required-message='Role is required'>
                                            <label class='form-check-label' for='inlineCheckbox1'>User Management</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input'
                                                {{ Auth::user()->role == 'transaction' ? 'checked' : '' }} name='role'
                                                type='radio' id='inlineCheckbox2' value='transaction'>
                                            <label class='form-check-label' for='inlineCheckbox2'>Transaction Management</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input'
                                                {{ Auth::user()->role == 'material' ? 'checked' : '' }} name='role'
                                                type='radio' id='inlineCheckbox3' value='material'>
                                            <label class='form-check-label' for='inlineCheckbox3'>Material Managemen</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input'
                                                {{ Auth::user()->role == 'chat' ? 'checked' : '' }} name='role'
                                                type='radio' id='inlineCheckbox3' value='chat'>
                                            <label class='form-check-label' for='inlineCheckbox3'>Chat</label>
                                        </div>
                                    </div>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class='invalid-feedback' id='role-error' role='alert'></span>
                                </div>

                            </div>
                            <div class="col-lg-12 col-xl-12 text-center">
                                <button class="btn btn-primary p-3 pt-2 pt-2" style="font-size: 18px">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.validate-form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        // .on('form:submit', function() {
        //     return false; // Don't submit form for this demo
        // });
    });

</script>
