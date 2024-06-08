@php
    use Carbon\Carbon;
@endphp
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
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
                    <div class="row">
                        <div class="image text-center">
                            <div id="frame">
                                <a href="#">
                                    <img src="{{ route('image.private', $class->cover->name ?? '') }}"
                                        alt="{{ $class->title }}">
                                </a>
                            </div>
                        </div>
                        <div class="mat-title mt-3">
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
                            <h5><b class="font-weight-bold">Summary: </b></h5>
                            <p>
                                {{ $class->desc }}
                            </p>

                            <h5 class="text-capitalize"><b class="font-weight-bold">Class Dates:</b>
                                @foreach ($class->dates as $date)
                                    @php
                                        // $original_date = Carbon::parse(
                                        //     $class->date . ' ' . $class->time,
                                        //     $class->timezone,
                                        // ); // Example date in New York timezone

                                        // // Get the timezone in full name
                                        // $my_local_timezone = $original_date->setTimezone(date_default_timezone_get());

                                        // // Format the date with timezone in full name
                                        // $formatted_mylocal_timezone_class_date =
                                        //     $original_date->format('D, M j, Y h:i:s A') .
                                        //     ' ' .
                                        //     $my_local_timezone->timezone->getName();

                                        $format_new_date_class_date = new DateTime($date);
                                        $format_new_date_class_date = $format_new_date_class_date->format('Y-m-d');
                                        $original_date_class_date = Carbon::parse(
                                            $format_new_date_class_date . ' ' . $class->time,
                                            $class->timezone,
                                        ); // Example date in New York timezone

                                        // Get the timezone in full name
                                        $my_local_timezone_class_date = $original_date_class_date->setTimezone(date_default_timezone_get());

                                        // Format the date with timezone in full name
                                        $formatted_mylocal_timezone_class_date =
                                            $original_date_class_date->format('D, M j, Y h:i:s A') .
                                            ' ' .
                                            $my_local_timezone_class_date->timezone->getName();
                                    @endphp
                                    {{-- {{ $formatted_mylocal_timezone_class_date }} --}}
                                    <span class="btn btn-sm text-white m-1"
                                        style="background-color: #1d3557">{{ $formatted_mylocal_timezone_class_date }}</span>
                                    {{-- {{ $actual_date }},  --}}
                                @endforeach
                                @if (Auth::user()->sub->isActive)
                                    @if (in_array($class->id, $all_classes_arr))
                                        @isset($meetings_arr)
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Dates</th>
                                                        <th>Class Status</th>
                                                        {{-- <th>Class Password</th> --}}
                                                        <th>Join Class</th>
                                                    </tr>
                                                    @php
                                                        $sn = 1;
                                                    @endphp
                                                    @foreach ($meetings_arr as $key => $data)
                                                        @php
                                                            $format_new_date = new DateTime($data->date);
                                                            $format_new_date = $format_new_date->format('Y-m-d');
                                                            $original_date = Carbon::parse(
                                                                $format_new_date . ' ' . $class->time,
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
                                                        <tr>
                                                            <th scope="col">{{ $sn++ }}</th>
                                                            <th scope="col">
                                                                @php
                                                                    // $now = new Carbon::now();
                                                                    // $carbonDate = new Carbon($data->date);
                                                                    // $carbonDate->timezone = $class->timezone;
                                                                    // $new_date = $carbonDate->toDayDateTimeString();
                                                                @endphp
                                                                {{-- {{ $new_date }}<br> --}}

                                                                {{ $formatted_mylocal_timezone }}
                                                                {{-- {{ date('D, M j, Y h:i:s A', strtotime($carbonDate)) }} --}}
                                                            </th>
                                                            <th scope="col" class="text-centerr">

                                                                <button id="timed-button" style="display:none;">Click
                                                                    Me</button>
                                                                @if ($data->meeting)
                                                                    @php
                                                                        $currentDateTime = now();
                                                                        $shouldShowButton = $currentDateTime->between(
                                                                            $startTime,
                                                                            $endTime,
                                                                        );
                                                                    @endphp
                                                                    @if ($shouldShowButton)
                                                                        <span class="btn btn-sm btn-success">Ongoing</span>
                                                                    @elseif (now() > $endTime)
                                                                        <span class="badge btn-sm btn-danger">Expired</span>
                                                                    @elseif (now() < $startTime)
                                                                        <span
                                                                            class="badge btn-sm btn-primary">Pending</span>
                                                                    @else
                                                                    @endif
                                                                @else
                                                                    <span
                                                                        class="badge bg-warning-light border-warning text-capitalize type-text">Awaiting
                                                                        <img src="https://media.tenor.com/On7kvXhzml4AAAAj/loading-gif.gif"
                                                                            style="width:15px;" alt="">
                                                                    </span>
                                                                @endif
                                                            </th>
                                                            <th>
                                                                @if ($data->meeting)
                                                                    @if (now() >= $startTime && now() <= $endTime)
                                                                        <a href="{{ route('join.meeting', $data->meeting->token) }}"
                                                                            target="blank" class="btn btn-primary">Join
                                                                            Class</a>
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
                                    @endif
                                @endif
                            </h5>


                            @if (Auth::user()->sub->isActive) {{-- If user has an active sub --}}
                                @if (in_array($class->id, $all_classes_arr))
                                    {{-- <a href="{{ route('user.access_material', $class->id) }}"
                                        class="btn btn-primary p-3">
                                        Access Material
                                    </a> --}}
                                @else
                                    @if ($class->price == 'Free')
                                        <a href="{{ route('user.add_masterclass_to_library', $class->id) }}"
                                            class="btn btn-primary p-3">
                                            Add To Library
                                        </a>
                                    @endif
                                    @if ($class->price == 'Paid')
                                        {{-- <a class="btn m-2 btn-dark p-2 btn-outline-primary"
                                                onclick="flutterwaveBuyMaterial('{{ exchange($settings['rent'] ?? getenv('RENTED_AMOUNT')) }}', '{{ $class->id }}', 'rented')">
                                                Rent Book
                                            </a> --}}
                                        <a onclick="flutterwaveBuyMaterial('{{ exchange($class->amount, $class->currency_id) }}', '{{ $class->id }}', 'bought', 'class')"
                                            class="btn m-2 btn-primary p-2">
                                            Subscribe to Class
                                        </a>
                                    @endif
                                @endif
                            @elseif (Auth::user()->team_id && Auth::user()->team->sub_status == 'active')
                                {{-- if the user is in a team and the team has an active sub --}}
                                @if (in_array($material->id, $my_materials_arr))
                                    {{-- <a href="{{ route('user.access_material', $material->id) }}"
                                        class="btn btn-primary p-3">
                                        Access Material
                                    </a> --}}
                                @else
                                    @if ($material->price == 'Free')
                                        <a href="{{ route('user.add_to_library', $material->id) }}"
                                            class="btn btn-primary p-3">
                                            Add To Library
                                        </a>
                                    @endif
                                    @if ($material->price == 'Paid')
                                        {{-- <a class="btn m-2 btn-dark p-2 btn-outline-primary"
                                            onclick="flutterwaveBuyMaterial('{{ exchange($settings['rent'] ?? getenv('RENTED_AMOUNT')) }}', '{{ $material->id }}', 'rented')">
                                            Rent Book
                                        </a>
                                        <a onclick="flutterwaveBuyMaterial('{{ exchange($material->amount) }}', '{{ $material->id }}', 'bought')"
                                            class="btn m-2 btn-primary p-2">
                                            Buy Book
                                        </a> --}}
                                    @endif
                                @endif
                            @else
                                {{-- Access material if already bought it or subscribe --}}
                                @if (in_array($class->id, $all_classes_arr))
                                    {{-- <a href="{{ route('user.access_material', $class->id) }}"
                                        class="btn btn-primary p-3">
                                        Access Material
                                    </a> --}}
                                @else
                                    <button onclick="shiSub(event)" data-type="dark" data-size="s"
                                        data-title="Subscribe" href="{{ route('user.sub.text', $class->id) }}"
                                        class="sub-link btn p-2 font-weight-bold h4 btn-primary">Subscribe</button>
                                @endif
                            @endif
                        </div>
                    @else
                        <h3>{{ $response->msg }}</h3>
                @endif
            </div>
        </div>
    </div>
</div>
</div>

<style>
    #timed-button {
        margin: 20px;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
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
