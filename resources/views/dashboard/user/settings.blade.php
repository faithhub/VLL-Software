@extends('layouts/dashboard/app')
@section('content')
    <style>
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        .sub-btn {
            margin-top: 3rem;
        }

        .sub-card {
            background-color: #F0F4F9
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-4">
                        <h6 class="mb-1 mt-1 font-weight-bold h4">General Settings</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <form class="validate-form" action="{{ route('user.settings') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="col-lg-12 col-xl-12">
                                    <div class="box-widget widget-user">
                                        <div class="widget-user-image1 d-xl-flex d-block">
                                            <img alt="User Avatar" class="avatar brround p-0"
                                                src="{{ asset(Auth::user()->profile_pics->url ?? 'assets/dashboard/images/photos/22.jpg') }}">
                                            <div style="display: table">
                                                <div class="mt-1 ms-xl-5 add-new-member">
                                                    <label class="btn btn-sm btn-primary m-3">
                                                        <input name="avatar" accept="image/*"
                                                            type="file" />Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5 settings">
                                    @if (Auth::user()->user_type == 'student')
                                        <div class="col-lg-12 col-xl-12">
                                            @if (Auth::user()->user_type == 'student')
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            School
                                                        </label>
                                                        <input name="" type="text" class="form-control"
                                                            required=""
                                                            data-parsley-required-message="School is required" disabled
                                                            placeholder="School" value="{{ Auth::user()->school->name }}">
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-lg-6 col-xl-6">
                                    @endif
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Full Name</label>
                                            <input name="name" type="text" class="form-control" required=""
                                                data-parsley-required-message="Full name is required"
                                                placeholder="First Name" value="{{ Auth::user()->name }}">
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
                                                value="{{ Auth::user()->email }}">
                                            @error('email')
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
                                                placeholder="+234 905 678 234 " value="{{ Auth::user()->phone }}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-12 mb-4">
                                        <label class='form-label'>Gender</label>
                                        <div class='d-flex' style='margin-bottom:-10px'>
                                            <div class='form-check form-check-inline'>
                                                <input class='form-check-input' name='gender' type='radio'
                                                    id='inlineCheckbox1' value='male' required=''
                                                    {{ Auth::user()->gender == 'male' ? 'checked' : '' }}
                                                    data-parsley-errors-container='#gender-error'
                                                    data-parsley-required-message='Status is required'>
                                                <label class='form-check-label' for='inlineCheckbox1'>Male</label>
                                            </div>
                                            <div class='form-check form-check-inline'>
                                                <input class='form-check-input'
                                                    {{ Auth::user()->gender == 'female' ? 'checked' : '' }} name='gender'
                                                    type='radio' id='inlineCheckbox2' value='female'>
                                                <label class='form-check-label' for='inlineCheckbox2'>Female</label>
                                            </div>
                                            <div class='form-check form-check-inline'>
                                                <input class='form-check-input'
                                                    {{ Auth::user()->gender == 'entity' ? 'checked' : '' }} name='gender'
                                                    type='radio' id='inlineCheckbox3' value='entity'>
                                                <label class='form-check-label' for='inlineCheckbox3'>Entity</label>
                                            </div>
                                        </div>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class='invalid-feedback' id='gender-error' role='alert'></span>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Subscriptions</label>
                                            <button onclick="shiNew(event)" data-type="dark" data-size="l"
                                                data-title="Subscriptions" href="{{ route('user.subscriptions') }}"
                                                class="sub-link btn btn-sm btn-primary">
                                                @if (Auth::user()->sub->subscription_id)
                                                    Change
                                                @else
                                                    Subcribe
                                                @endif
                                            </button>

                                            @isset($sub)
                                                <div class="mat-title pl-3 mt-3">
                                                    <h6><b class="font-weight-bold">Plan: {{ $sub->sub->name }} </b></h6>
                                                    <h6><b class="font-weight-bold">Subscribed On:
                                                        </b>{{ date('D, M j, Y', strtotime($sub->start_date)) }}</h6>
                                                    <h6><b class="font-weight-bold">Expired On:
                                                        </b>{{ date('D, M j, Y', strtotime($sub->expired_date)) }}</h6>
                                                    <h6>
                                                        <b class="font-weight-bold">Status: </b>
                                                        @if ($sub->isActive)
                                                            <span class="badge badge-gradient-success">Active</span>
                                                        @else
                                                            <span class="badge badge-gradient-danger">Expired</span>
                                                        @endif
                                                    </h6>
                                                    <h6>
                                                        @if ($sub->isActive) 
                                                        @else
                                                            <a class="btn btn-sm btn-success"
                                                                @isset($sub->session)
                                                                onclick="flutterwaveCheckout('{{ exchange($sub->session) }}', '{{ $sub->id }}', 'session')"
                                                                @endisset
                                                                @isset($sub->system)
                                                                onclick="flutterwaveCheckout('{{ exchange($sub->system) }}', '{{ $sub->id }}', 'system')"
                                                                @endisset
                                                                >
                                                                @if (Auth::user()->sub->subscription_id)
                                                                    Renew
                                                                @endif
                                                            </a>
                                                        @endif
                                                    </h6>
                                                </div>
                                            @endisset

                                            @isset(Auth::user()->team_id)
                                                @if (!Auth::user()->team_admin)
                                                    <div class="mat-title pl-3 mt-3">
                                                        <h6><b class="font-weight-bold">Team Details </b></h6>
                                                        <h6><b class="font-weight-bold">Joined On:
                                                                @isset($invite->date_accepted)
                                                                    {{ date('D, M j, Y', strtotime($invite->date_accepted)) }}
                                                                @endisset </b></h6>
                                                        <h6><b class="font-weight-bold">Subscribed On:
                                                            </b>{{ date('D, M j, Y', strtotime($team->start_date)) }}</h6>
                                                        <h6><b class="font-weight-bold">Expired On:
                                                            </b>{{ date('D, M j, Y', strtotime($team->expired_date)) }}</h6>
                                                        <h6><b class="font-weight-bold">Status: </b>
                                                            @if ($team->sub_status == 'active')
                                                                <span class="badge badge-gradient-success">Active</span>
                                                            @else
                                                                <span class="badge badge-gradient-danger">Expired</span>
                                                            @endif
                                                        </h6>
                                                    </div>
                                                @endif
                                            @endisset
                                        </div>
                                    </div>
                                </div>

                                @if (Auth::user()->user_type == 'professionals')
                                    @isset($sub)
                                        @if ($sub->sub->max_teammate > 1)
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card">
                                                    <div class="card-header border-bottom-0 mt-3 text-black">
                                                        <h3 class="card-title font-weight-bold h2"> Team Members</h3>
                                                        <div class="card-options">
                                                            <button href="{{ route('user.invite_teammate') }}"
                                                                onclick="shiNew(event)" data-type="dark" data-size="s"
                                                                data-title="Add new team member" type="button"
                                                                class="btn btn-primary">Add New</button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <td>S/N</td>
                                                                    <td>Email</td>
                                                                    <td>Action</td>
                                                                </tr>
                                                            <tbody>
                                                            </tbody>
                                                            @isset($team->teammates)
                                                                @foreach ($team->teammates as $teammember)
                                                                    <tr>
                                                                        <td>{{ $sn++ }}</td>
                                                                        <td>{{ $teammember }}</td>
                                                                        <td>
                                                                            @if ($teammember == Auth::user()->email)
                                                                                Team Admin
                                                                            @else
                                                                                <a href="{{ route('user.remove_teammate', ['id' => $team->id, 'email' => $teammember]) }}"
                                                                                    onclick="return confirm('Are you sure you want to remove this memeber?')"
                                                                                    class="btn btn-sm btn-primary">Remove</a>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endisset
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                @endif
                                <div class="col-lg-12 col-xl-12 text-center">
                                    <button class="btn btn-primary p-3 pt-2 pt-2" style="font-size: 18px">Save</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
