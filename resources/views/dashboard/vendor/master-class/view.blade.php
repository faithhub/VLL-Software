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
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="image text-center">
                        <a href="#">
                            <img src="{{ route('image.private', $class->cover->name ?? '') }}" alt="{{ $class->title }}">
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
                            @isset($meetings_arr)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Dates</th>
                                            <th>Link</th>
                                            <th>Password</th>
                                        </tr>
                                        @php
                                            $sn = 1;
                                        @endphp
                                        @foreach ($class->dates as $key => $date)
                                            <tr>
                                                <th scope="col">{{ $sn++ }}</th>
                                                <th scope="col">
                                                    @php
                                                        $carbonDate = new Carbon($date . ' ' . $class->time);
                                                        $carbonDate->timezone = $class->timezone;
                                                        $new_date = $carbonDate->toDayDateTimeString();
                                                    @endphp
                                                    {{ $new_date }}
                                                    {{-- {{ date('D, M j, Y h:i:s A', strtotime($new_date)) }} --}}
                                                </th>
                                                <th scope="col">
                                                    @if (array_key_exists($key, $meetings_arr))
                                                        @php
                                                            $link = $meetings_arr[$key]->link;
                                                        @endphp
                                                        <b>{{ substr($link, 0, 20) }}...</b>
                                                        <button class="btn btn-sm btn-outline-dark"
                                                            onclick="copyMeeting('{{ $meetings_arr[$key]->link }}')">Copy
                                                            Meeting Link</button>
                                                    @endif
                                                </th>
                                                <th scope="col">
                                                    @if (array_key_exists($key, $meetings_arr))
                                                        <button class="btn btn-sm btn-outline-dark"
                                                            onclick="copyMeetingPassword('{{ $meetings_arr[$key]->password }}')">Copy
                                                            Meeting Password</button>
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
                            <i class="fa fa-trash"></i>&nbsp&nbspDelete
                        </a>
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