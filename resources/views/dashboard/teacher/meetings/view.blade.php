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

        hr {
            margin-top: 0rem;
            margin-bottom: 0rem;
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-2 card-primary">
                    <div class="card-header border-bottom-0 mt-3">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">{{ $meeting->title }}</h6>
                        <div class="card-options" style="margin-right:2.5%">
                            <a href="{{ route('teacher.meetings') }}" class="btn btn-bg btn-primary p-3"><b><i
                                        class="fa fa-arrow-left"></i>&nbsp;&nbsp; Back to Meetings</b></a>
                        </div>
                    </div>
                    <div class="card-body mt-0 pt-2">
                        <hr>
                        <div class="row pt-1 mt-1">
                            <h4 class="font-weight-bold">Meeting Details</h4>
                            <div class="row align-items-center mb-3">
                                <div class="col-2">
                                    <h5>Meeting Title:</h5>
                                </div>
                                <div class="col-10">
                                    <h5 class="font-weight-bold">{{ $meeting->title }}</h5>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-2">
                                    <h5>Meeting Password:</h5>
                                </div>
                                <div class="col-10">
                                    <h5 class="font-weight-bold">{{ $meeting->password }}
                                        <button class="btn btn-sm btn-outline-dark"
                                            onclick="copyMeetingPassword('{{ $meeting->password }}')">Copy</button>
                                    </h5>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-2">
                                    <h5>Meeting Date:</h5>
                                </div>
                                <div class="col-10">
                                    <h5 class="font-weight-bold">
                                        {{ \Carbon\Carbon::parse($meeting->start)->format('D, M j, Y H:i:s') }} -
                                        {{ \Carbon\Carbon::parse($meeting->end)->format('D, M j, Y H:i:s') }}
                                    </h5>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-2">
                                    <h5>Meeting Link:</h5>
                                </div>
                                <div class="col-10">
                                    <h5 class="font-weight-bold">{{ $meeting->link }}
                                        <button class="btn btn-sm btn-outline-dark"
                                            onclick="copyMeeting('{{ $meeting->link }}')">Copy</button>
                                    </h5>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-2">
                                    <h5>Meeting Status:</h5>
                                </div>
                                <div class="col-10">
                                    <h5 class="font-weight-bold">
                                        @if ($meeting_res['state'])
                                            @switch($meeting_res['state'])
                                                @case('scheduled')
                                                    <span
                                                        class="badge bg-warning text-capitalize">{{ $meeting_res['state'] }}</span>
                                                @break

                                                @case('ready')
                                                    <span
                                                        class="badge bg-warning text-capitalize">{{ $meeting_res['state'] }}</span>
                                                @break

                                                @case('lobby')
                                                    <span
                                                        class="badge bg-warning text-capitalize">{{ $meeting_res['state'] }}</span>
                                                @break

                                                @case('inProgress')
                                                    <span
                                                        class="badge bg-warning text-capitalize">{{ $meeting_res['state'] }}</span>
                                                @break

                                                @case('ended')
                                                    <span
                                                        class="badge bg-warning text-capitalize">{{ $meeting_res['state'] }}</span>
                                                @break

                                                @case('missed')
                                                    <span
                                                        class="badge bg-warning text-capitalize">{{ $meeting_res['state'] }}</span>
                                                @break

                                                @case('active')
                                                    <span
                                                        class="badge bg-success text-capitalize">{{ $meeting_res['state'] }}</span>
                                                @break

                                                @case('expired')
                                                    <span
                                                        class="badge bg-danger text-capitalize">{{ $meeting_res['state'] }}</span>
                                                @break

                                                @default
                                            @endswitch
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row pt-1 mt-1">
                            <h4 class="font-weight-bold">Participants</h4>
                            <table class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                id="datatable" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Joined Time</th>
                                    <th>Left Time</th>
                                    <th>Device</th>
                                    <th>Duration Second</th>
                                </thead>
                                @isset($participants)
                                    @php
                                        $sn = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($participants as $participant)
                                            <tr>
                                                <td>{{ $sn++ }}</td>
                                                <td>{{ $participant['displayName'] }}</td>
                                                <td>{{ $participant['email'] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($participant['joinedTime'])->format('D, M j, Y H:i:s') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($participant['leftTime'])->format('D, M j, Y H:i:s') }}
                                                </td>
                                                <td>{{ $participant['devices'][0]['deviceType'] }}</td>
                                                <td>{{ $participant['devices'][0]['durationSecond'] }} sec</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endisset
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyMeetingPassword(password) {
            // console.log(password);
            navigator.clipboard.writeText(password).then(function() {
                console.log('Async: Copying to clipboard was successful!');
                toastr.success("Meeting password copied", "Success");
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }

        function copyMeeting(link) {
            // console.log(link);
            navigator.clipboard.writeText(link).then(function() {
                console.log('Async: Copying to clipboard was successful!');
                toastr.success("Meeting link copied", "Success");
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }
    </script>
@endsection
