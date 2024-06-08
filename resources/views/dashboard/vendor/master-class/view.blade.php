@php
    use Carbon\Carbon;
@endphp
<div class="row">
    <style>
        .user-role {
            font-size: 10px;
            padding: 2px;
            /* padding-top: 2px; */
            font-weight: 800;
            font-family: fantasy !important;
        }
    </style>
    @if ($response->status)
        @php
            $date_with_timezone = Carbon::parse($class->dates[0] . ' ' . $class->time, $class->timezone); // Example date in New York timezone

            // Get the timezone in full name
            $timezone_new = $date_with_timezone->timezone->getName();

            // Format the date with timezone in full name
            $formatted_timezone = $date_with_timezone->format('h:i:s A') . ' ' . $timezone_new;

            // Get the timezone in full name
            $timezone_new2 = $date_with_timezone->setTimezone(date_default_timezone_get());

            // Format the date with timezone in full name
            $formatted_mylocal_timezone =
                $date_with_timezone->format('h:i:s A') . ' ' . $timezone_new2->timezone->getName();
        @endphp
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
                            <h5 class="text-capitalize"><b class="font-weight-bold">Time: </b>{{ $formatted_timezone }}
                            </h5>
                            <h5 class="text-capitalize"><b class="font-weight-bold">Local Time:
                                </b>{{ $formatted_mylocal_timezone }}</h5>
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
                                                <th>Status</th>
                                                <th>Join Class</th>
                                            </tr>
                                            @php
                                                $sn = 1;
                                            @endphp
                                            @foreach ($meetings_array as $key => $data)
                                                <tr>
                                                    <th scope="col">{{ $sn++ }}</th>
                                                    <th scope="col">
                                                        @php
                                                            $original_date = Carbon::parse(
                                                                $data->date. ' ' . $class->time,
                                                                $class->timezone,
                                                            ); // Example date in New York timezone

                                                            // Get the timezone in full name
                                                            $my_local_timezone = $original_date->setTimezone(
                                                                date_default_timezone_get(),
                                                            );

                                                            // Format the date with timezone in full name
                                                            $formatted_mylocal_timezone =
                                                                $original_date->format('D, M j, Y h:i:s A') .
                                                                ' ' .
                                                                $my_local_timezone->timezone->getName();
                                                                $startTime = $original_date->subMinutes(5);

                                                                $format_end_date = new DateTime($data->date);
                                                                $format_end_date = $format_end_date->format('Y-m-d');
                                                                $original_end_date = Carbon::parse(
                                                                    $format_end_date . ' ' . $class->time,
                                                                    $class->timezone,
                                                                ); // Example date in New York timezone

                                                                // Get the timezone in full name
                                                                $end_date_in_my_local_timezone = $original_end_date->setTimezone(
                                                                    date_default_timezone_get(),
                                                                );
                                                                $endTime = $original_end_date->addMinutes(70);
                                                        @endphp
                                                        {{ $formatted_mylocal_timezone }}
                                                        {{-- {{ date('D, M j, Y h:i:s A', strtotime($carbonDate)) }} --}}
                                                    </th>
                                                    <th scope="col" class="text-centerr">
                                                        @if ($data->meeting)
                                                            {{-- <b>{{ substr($link, 0, 20) }}...</b> --}}
                                                            @if (now() <= $endTime)
                                                                <button class="btn btn-sm btn-outline-dark"
                                                                    onclick="copyMeeting('{{ route('join.meeting', $data->meeting->token) }}')">Copy
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
                                                            {{-- @if (now() <= $endTime)
                                                                <button class="btn btn-sm btn-outline-dark"
                                                                    onclick="copyMeetingPassword('{{ $data->meeting->password }}')">Copy
                                                                    Password</button>
                                                            @else
                                                                <button class="btn btn-sm btn-outline-danger" disabled
                                                                    style="cursor: no-drop !important">Copy
                                                                    Password</button>
                                                            @endif --}}
                                                                    @php
                                                                        $currentDateTime = now();
                                                                        $shouldShowButton = $currentDateTime->between(
                                                                            $startTime,
                                                                            $endTime,
                                                                        );
                                                                    @endphp
                                                                    @if ($shouldShowButton)
                                                                        <span
                                                                            class="btn btn-sm btn-success">Ongoing</span>
                                                                    @elseif (now() > $endTime)
                                                                        <span
                                                                            class="badge btn-sm btn-danger">Expired</span>
                                                                    @elseif (now() < $startTime)
                                                                        <span
                                                                            class="badge btn-sm btn-primary">Pending</span>
                                                                    @else
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
                                                            {{-- {{ Carbon::parse($meetings_arr[$key]->start)->subMinutes(5) }}<br>
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
                                                            {{-- @if (Carbon::parse($data['meeting']->start)->subMinutes(5) <= Carbon::now())
                                                            <a href="{{ route('join.meeting', $meetings_arr[$key]->token) }}"
                                                                class="btn btn-primary">Join Class</a>
                                                        @endif
                                                        @if (Carbon::parse($meetings_arr[$key]->start)->addMinutes(70) <= Carbon::now())
                                                            <a href="{{ route('join.meeting', $meetings_arr[$key]->token) }}"
                                                                class="btn btn-primary">Join Class</a>
                                                        @endif --}}
                                                        @else
                                                            ---
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
