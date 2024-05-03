@php
    use Carbon\Carbon;
@endphp
<div class="row">
    <style>
        .spinner_span {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 51px;
            height: 51px;
            margin: 6px;
            border: 6px solid #fff;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0.5, 0.5, 0.5) infinite;
            border-color: #000 #000 #000 transparent;
        }

        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @if ($response->status)
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card border-10 pt-2 card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="image text-center">
                            <a href="#">
                                <img src="{{ route('image.private', $class->cover->name ?? '') }}"
                                    alt="{{ $class->title }}" style="max-height: 300px">
                            </a>
                        </div>
                        <div class="rating text-center">
                            {{-- <h4 class="font-weight-bold h6 mt-3">Ratings:
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </h4> --}}
                        </div>
                        <div class="mat-title">
                            <h4 class="h2 font-weight-bold text-center mt-3 text-capitalize">
                                {{ $class->title }}</h4>
                            <h5 class="text-capitalize"><b class="font-weight-bold">Title: </b>{{ $class->title }}</h5>
                            <h5 class="text-capitalize"><b class="font-weight-bold">Instructor Name:
                                </b>{{ $class->instructor_name }}</h5>
                            <h5 class="text-capitalize"><b class="font-weight-bold">Special Guest:
                                </b>{{ $class->special_guest }}</h5>
                            <h5 class="text-capitalize"><b class="font-weight-bold">Duration: </b>
                                {{ $class->duration }}
                                @if ($class->duration > 1)
                                    months
                                @else
                                    month
                                @endif
                            </h5>
                            <h5 class="text-capitalize"><b class="font-weight-bold">Interval: </b>{{ $class->interval }}
                            </h5>
                            <h5 class="text-capitalize"><b class="font-weight-bold">Time: </b>{{ $class->time }}</h5>
                            <h5><b class="font-weight-bold">Amount:
                                    @if ($class->price == 'Paid')
                                        {{ money($class->amount, $class->currency_id) }}
                                    @else
                                        Free
                                    @endif
                                </b>
                            </h5>
                            {{-- <h5 class="text-capitalize"><b class="font-weight-bold">Dates: </b>
                            @isset($class->dates)
                                @foreach ($class->dates as $date)
                                    {{ date('D, M j, Y', strtotime($date)) }}
                                @endforeach
                            @endisset
                        </h5> --}}
                            <h5><b class="font-weight-bold">Summary: </b></h5>
                            <p>
                                {{ $class->desc }}
                            </p>

                            <h5 class="text-capitalize"><b class="font-weight-bold">Meetings:</b>
                                @isset($meetings_array)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Dates</th>
                                                <th>Class Link</th>
                                                <th>Class Password</th>
                                                <th>Join Class</th>
                                            </tr>
                                            @php
                                                $sn = 1;
                                            @endphp
                                            @foreach ($meetings_array as $key => $data)
                                                {{-- @dump($data) --}}
                                                @if ($data->meeting)
                                                    @php
                                                        $startTime = Carbon::parse($data->meeting->start)->subMinutes(
                                                            15,
                                                        );
                                                        $endTime = Carbon::parse($data->meeting->start)->addMinutes(70);
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <th scope="col">{{ $sn++ }}</th>
                                                    <th scope="col">
                                                        @php
                                                            // $now = new Carbon::now();
                                                            $carbonDate = new Carbon($data->date . ' ' . $class->time);
                                                            $carbonDate->timezone = $class->timezone;
                                                            $new_date = $carbonDate->toDayDateTimeString();
                                                        @endphp
                                                        {{ $new_date }}<br>

                                                        {{-- {{ date('D, M j, Y h:i:s A', strtotime($new_date)) }} --}}
                                                    </th>
                                                    <th scope="col" class="text-centerr">
                                                        @if ($data->meeting)
                                                            {{-- <b>{{ substr($link, 0, 20) }}...</b> --}}
                                                            @if (now() <= $endTime)
                                                                <button class="btn btn-sm btn-outline-dark"
                                                                    onclick="copyMeeting('{{ $data->meeting->link }}')">Copy
                                                                    Link</button>
                                                            @else
                                                                <button class="btn btn-sm btn-outline-danger" disabled
                                                                    style="cursor: no-drop !important">Copy
                                                                    Link</button>
                                                            @endif
                                                        @else
                                                            <span
                                                                class="badge bg-warning-light border-warning text-capitalize type-text">Awaiting
                                                                <img src="https://media.tenor.com/On7kvXhzml4AAAAj/loading-gif.gif"
                                                                    style="width:15px;" alt="">
                                                            </span>
                                                        @endif
                                                    </th>
                                                    <th scope="col" class="text-centerr">
                                                        @if ($data->meeting)
                                                            @if (now() <= $endTime)
                                                                <button class="btn btn-sm btn-outline-dark"
                                                                    onclick="copyMeetingPassword('{{ $data->meeting->password }}')">Copy
                                                                    Password</button>
                                                            @else
                                                                <button class="btn btn-sm btn-outline-danger" disabled
                                                                    style="cursor: no-drop !important">Copy
                                                                    Password</button>
                                                            @endif
                                                        @else
                                                            <span
                                                                class="badge bg-warning-light border-warning text-capitalize type-text">Awaiting
                                                                <img src="https://media.tenor.com/On7kvXhzml4AAAAj/loading-gif.gif"
                                                                    style="width:15px;" alt=""></span>
                                                        @endif
                                                    </th>
                                                    <th>
                                                        @if ($data->meeting)
                                                            {{-- {{ Carbon::parse($meetings_arr[$key]->start)->subMinutes(15) }}<br>
                                                        {{ Carbon::now() }}<br>
                                                        {{ Carbon::parse($meetings_arr[$key]->start)->addMinutes(70) }}<br> --}}

                                                            @if (now() >= $startTime && now() <= $endTime)
                                                                <a href="{{ route('join.meeting', $data->meeting->token) }}"
                                                                    class="btn btn-primary">Join Class</a>
                                                            @else
                                                                {{ $startTime->diffForHumans() }}
                                                                {{-- <p>The button is only available between {{ $startTime }} and
                                                                {{ $endTime }}.</p> --}}
                                                            @endif
                                                            {{-- @if (Carbon::parse($data['meeting']->start)->subMinutes(15) <= Carbon::now())
                                                            <a href="{{ route('join.meeting', $meetings_arr[$key]->token) }}"
                                                                class="btn btn-primary">Join Class</a>
                                                        @endif
                                                        @if (Carbon::parse($meetings_arr[$key]->start)->addMinutes(70) <= Carbon::now())
                                                            <a href="{{ route('join.meeting', $meetings_arr[$key]->token) }}"
                                                                class="btn btn-primary">Join Class</a>
                                                        @endif --}}
                                                        @else
                                                            {{ $startTime->diffForHumans() }}
                                                        @endif
                                                    </th>
                                                </tr>
                                            @endforeach
                                        </thead>
                                    </table>
                                @endisset
                            </h5>
                            {{-- <a href="{{ route('vendor.edit', $class->id) }}" class="btn btn-primary p-3 m-2">
                            <i class="fa fa-pencil"></i>&nbsp&nbspEdit
                        </a> --}}
                            <a href="{{ route('vendor.delete_master_class', $class->id) }}"
                                onclick="return confirm('Are you sure you want to delete this class?')"
                                class="btn btn-dark p-3 btn-outline-primary">
                                <i class="fa fa-trash"></i>&nbsp&nbspDelete Class
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card border-10 pt-2 card-primary">
                <div class="card-body">
                    <h3>List of Subscribers</h3>
                    @isset($students)
                        <table class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                            role="grid" aria-describedby="datatable_info">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Date Joined</th>
                                </tr>
                                @php
                                    $sn = 1;
                                @endphp
                                @foreach ($students as $student)
                                    <tr>
                                        <th scope="col">{{ $sn++ }}</th>
                                        <th scope="col">
                                            {{ $student->user->name }}
                                        </th>
                                        <th scope="col">
                                            {{ date('D, M j, Y h:i:s A', strtotime($student->created_at)) }}
                                        </th>
                                    </tr>
                                @endforeach
                            </thead>
                        </table>
                    @endisset
                </div>
            </div>
        </div>
    @else
        <h3>{{ $response->msg }}</h3>
    @endif
</div>
<script>
    $(document).ready(function() {
        var tables = $('.dataTable').DataTable();
    });

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
