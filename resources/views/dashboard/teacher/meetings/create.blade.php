@extends('layouts/dashboard/app')
@section('content')
    <style>
        input[readonly] {
            cursor: no-drop;
            border-color: transparent;
        }

        .alert-danger {
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-2 card-primary">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Create Meeting</h6>
                        <div class="card-options" style="margin-right:2.5%">
                            <a href="{{ route('teacher.meetings') }}" class="btn btn-bg btn-primary p-3"><b><i
                                        class="fa fa-arrow-left"></i>&nbsp;&nbsp; Back to Meetings</b></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row pt-1 mt-1">
                            <form class="validate-form" action="{{ route('teacher.meetings.create') }}" method="POST">
                                @csrf
                                <div class="row settings">
                                    @if (session()->get('webex_errors'))
                                        <div class="col-lg-12 col-xl-12 mb-4">
                                            @foreach (session()->get('webex_errors') as $webex_error)
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        {{ $webex_error['description'] }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endisset
                                    <div class="col-lg-12 col-xl-12 mb-4">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">School <strong
                                                        class="text-danger">*</strong></label>
                                                <input type="hidden" name="university_id"
                                                    value="{{ Auth::user()->school->id }}">
                                                <input name="school" type="text" class="form-control" required=""
                                                    data-parsley-required-message="School is required" placeholder=""
                                                    value="{{ Auth::user()->school->name }}" readonly>
                                                @error('university_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Meeting Title <strong
                                                        class="text-danger">*</strong></label>
                                                <input name="title" type="text" class="form-control" placeholder=""
                                                    required=""
                                                    data-parsley-required-message="Meeting Title is required"
                                                    value="{{ old('title') }}">
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Meeting Password</label>
                                                <input name="password" type="text" class="form-control"
                                                    placeholder=""
                                                    data-parsley-required-message="Meeting Password is required"
                                                    value="{{ old('password') }}">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Start Time <strong
                                                        class="text-danger">*</strong></label>
                                                <input name="start" type="datetime-local" class="form-control"
                                                    data-parsley-required-message="Meeting Start Time is required"
                                                    required placeholder="" value="{{ old('start') }}">
                                                @error('start')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">End Time <strong
                                                        class="text-danger">*</strong></label>
                                                <input name="end" type="datetime-local" class="form-control"
                                                    data-parsley-required-message="Meeting End Time is required"
                                                    required placeholder="" value="{{ old('end') }}">
                                                @error('end')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-xl-12 text-center">
                                        <button class="btn btn-primary p-3 pt-2 pt-2"
                                            style="font-size: 18px">Submit</button>
                                    </div>
                            </div>
                        </form>
                    </div>
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
@endsection
