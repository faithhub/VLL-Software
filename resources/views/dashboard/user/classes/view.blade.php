@php
    use Carbon\Carbon;
@endphp
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                @if ($response->status)
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
                            <h5 class="text-capitalize"><b class="font-weight-bold">Time: </b>{{ $class->time }}</h5>
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
                                    // $now = new Carbon::now();
                                        $carbonDate = new Carbon($date . ' ' . $class->time);
                                        $carbonDate->timezone = $class->timezone;
                                        $actual_date = $carbonDate->toDayDateTimeString();
                                    @endphp
                                    <span class="btn btn-sm text-white m-1" style="background-color: #1d3557">{{ $actual_date }}</span>
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
                                                <th>Class Link</th>
                                                {{-- <th>Class Password</th> --}}
                                                <th>Join Class</th>
                                            </tr>
                                            @php
                                                $sn = 1;
                                            @endphp
                                            @foreach ($meetings_arr as $key => $data)
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
                                                            $carbonDate = new Carbon($data->date);
                                                            // $carbonDate->timezone = $class->timezone;
                                                            // $new_date = $carbonDate->toDayDateTimeString();
                                                        @endphp
                                                        {{-- {{ $new_date }}<br> --}}

                                                        {{ date('D, M j, Y h:i:s A', strtotime($carbonDate)) }}
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
                                                    {{-- <th scope="col" class="text-centerr">
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
                                                    </th> --}}
                                                    <th>
                                                        @if ($data->meeting)
                                                            {{-- {{ Carbon::parse($meetings_arr[$key]->start)->subMinutes(15) }}<br>
                                                        {{ Carbon::now() }}<br>
                                                        {{ Carbon::parse($meetings_arr[$key]->start)->addMinutes(70) }}<br> --}}

                                                            @if (now() >= $startTime && now() <= $endTime)
                                                                <a href="{{ route('join.meeting', $data->meeting->token) }}" target="blank"
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
                                    <a href="{{ route('user.access_material', $class->id) }}"
                                        class="btn btn-primary p-3">
                                        Access Material
                                    </a>
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
                                    <a href="{{ route('user.access_material', $material->id) }}"
                                        class="btn btn-primary p-3">
                                        Access Material
                                    </a>
                                @else
                                    @if ($material->price == 'Free')
                                        <a href="{{ route('user.add_to_library', $material->id) }}"
                                            class="btn btn-primary p-3">
                                            Add To Library
                                        </a>
                                    @endif
                                    @if ($material->price == 'Paid')
                                        <a class="btn m-2 btn-dark p-2 btn-outline-primary"
                                            onclick="flutterwaveBuyMaterial('{{ exchange($settings['rent'] ?? getenv('RENTED_AMOUNT')) }}', '{{ $material->id }}', 'rented')">
                                            Rent Book
                                        </a>
                                        <a onclick="flutterwaveBuyMaterial('{{ exchange($material->amount) }}', '{{ $material->id }}', 'bought')"
                                            class="btn m-2 btn-primary p-2">
                                            Buy Book
                                        </a>
                                    @endif
                                @endif
                            @else
                                {{-- Access material if already bought it or subscribe --}}
                                @if (in_array($class->id, $all_classes_arr))
                                    <a href="{{ route('user.access_material', $class->id) }}"
                                        class="btn btn-primary p-3">
                                        Access Material
                                    </a>
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
