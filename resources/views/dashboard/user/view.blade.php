<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    @if ($status)
                        <div class="image text-center">
                            <div id="frame">
                                <a href="#">
                                    {{-- <img src="{{ asset($material->cover->url ?? 'images/new-meeting.png') }}"
                                    alt="{{ $material->title }}"> --}}
                                    @if ($material->folder)
                                        <img src="{{ asset($material->folder->folder_cover->url ?? 'images/new-meeting.png') }}"
                                            alt="{{ $material->title }}">
                                    @else
                                        <img src="{{ asset($material->cover->url ?? 'images/new-meeting.png') }}"
                                            alt="{{ $material->title }}">
                                    @endif
                                    @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                        <img id="video-bookstore-cover-view"
                                            src="{{ asset('materials/icon/v-play.png') }}" alt="{{ $material->title }}"
                                            align="middle" style="color: black">
                                    @endif
                                </a>
                            </div>
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

                        @if ($material->citation == 'new_meeting')
                            <div class="mat-title mt-3">
                                <h4 class="h2 font-weight-bold text-center mt-3">
                                    {{ $material->title ?? $material->name_of_party }}
                                </h4>
                                <h5><b class="font-weight-bold">Class Title: </b>{{ $meeting->title ?? '' }}</h5>
                                {{-- <h5><b class="font-weight-bold">Meeting Password: </b>{{ $meeting->password ?? "" }}
                                        <button class="btn btn-sm btn-outline-dark"
                                            onclick="copyMeetingPassword('{{ $meeting->password ?? '' }}')">Copy</button></h5> --}}
                                <h5><b class="font-weight-bold">Class Date: </b>
                                    {{ \Carbon\Carbon::parse($meeting->start)->format('D, M j, Y H:i:s') }}
                                    {{-- {{ \Carbon\Carbon::parse($meeting->end)->format('D, M j, Y H:i:s') }} --}}
                                </h5>
                                <h5><b class="font-weight-bold">Class Duration: </b> {{ $meeting->end }} min
                                    {{-- <span class="badge bg-success text-capitalize">{{ $meeting->status }}</span> --}}
                                </h5>
                                {{-- <h5 style="line-break: anywhere;"><b class="font-weight-bold">Meeting Link: </b>{{ $meeting->link }} <button class="btn btn-sm btn-outline-dark"
                                            onclick="copyMeeting('{{ $meeting->link }}')">Copy</button></h5> --}}
                                {{-- <iframe src="{{ $meeting->link }}" allow="camera; microphone"></iframe> --}}
                                <a href="{{ route('join.meeting', $material->version) }}" target="blank"
                                    class="sub-link btn p-2 font-weight-bold h4 btn-primary">Join Class</a>
                            </div>
                        @else
                            <div class="mat-title mt-3">
                                <h4 class="h2 font-weight-bold text-center mt-3">
                                    {{ $material->title ?? $material->name_of_party }}
                                </h4>
                                @isset($material->title)
                                    <h5><b class="font-weight-bold">Title: </b>{{ $material->title }}</h5>
                                @endisset
                                @if (substr($material->type->mat_unique_id, 0, 3) == 'CSL')
                                    <h5><b class="font-weight-bold">Name of Court:
                                        </b>{{ $material->name_of_party ?? '' }}
                                    </h5>
                                    <h5><b class="font-weight-bold">Name of Party:
                                        </b>{{ $material->name_of_party ?? '' }}
                                    </h5>
                                    <h5><b class="font-weight-bold">Citation: </b>{{ $material->citation ?? '' }}</h5>
                                    <h5><b class="font-weight-bold">Publisher: </b>{{ $folder->publisher ?? '' }}</h5>
                                    <h5><b class="font-weight-bold">Name of Author:
                                        </b>{{ $folder->name_of_author ?? '' }}
                                    </h5>
                                    <h5><b class="font-weight-bold">version: </b>{{ $folder->version ?? '' }}</h5>
                                    <h5><b class="font-weight-bold">Publisher: </b>{{ $folder->publisher ?? '' }}</h5>
                                    </h5>
                                @endif
                                @if (substr($material->type->mat_unique_id, 0, 3) == 'LAW')
                                    <h5><b class="font-weight-bold">Year of Enactmen:
                                        </b>{{ $material->year_of_enactmen ?? '' }}</h5>
                                    <h5><b class="font-weight-bold">Publisher: </b>{{ $folder->publisher ?? '' }}</h5>
                                    <h5><b class="font-weight-bold">Name of Author:
                                        </b>{{ $folder->name_of_author ?? '' }}
                                    </h5>
                                    <h5><b class="font-weight-bold">version: </b>{{ $folder->version ?? '' }}</h5>
                                    <h5><b class="font-weight-bold">Publisher: </b>{{ $folder->publisher ?? '' }}</h5>
                                @endif
                                @isset($material->name_of_author)
                                    <h5><b class="font-weight-bold">Author: </b>{{ $material->name_of_author }}</h5>
                                @endisset
                                @isset($material->version)
                                    <h5><b class="font-weight-bold">Version: </b>{{ $material->version }}</h5>
                                @endisset
                                @isset($material->publisher)
                                    <h5><b class="font-weight-bold">Publisher: </b>{{ $material->publisher }}</h5>
                                @endisset
                                @isset($material->year_of_publication)
                                    <h5><b class="font-weight-bold">Year Of Publication:
                                        </b>{{ $material->year_of_publication }}
                                    </h5>
                                @endisset
                                @isset($material->country)
                                    <h5><b class="font-weight-bold">Country Of Publication:
                                        </b>{{ $material->country->name }}
                                    </h5>
                                @endisset
                                @isset($material->university_id)
                                    @if (substr($material->type->mat_unique_id, 0, 3) == 'TAA')
                                        <h5><b class="font-weight-bold">University: </b>{{ $material->university->name }}
                                        </h5>
                                    @endif
                                @endisset
                                @isset($folder)
                                @else
                                    <h5><b class="font-weight-bold">Amount:
                                            @if ($material->price == 'Paid')
                                                {{ money($material->amount, $material->currency_id) }}
                                            @else
                                                Free
                                            @endif
                                        </b>
                                    </h5>
                                @endisset
                                <h5><b class="font-weight-bold">Pages: </b>{{ $pageCount }}</h5>
                                <h5><b class="font-weight-bold">Tags:
                                        @if ($material->tags)
                                            @foreach ($material->tags as $tag)
                                                <span class="badge bg-primary-light">{{ $tag }}</span>
                                            @endforeach
                                        @endif
                                        @isset($folder->tags)
                                            @foreach ($folder->tags as $tag)
                                                <span class="badge bg-primary-light">{{ $tag }}</span>
                                            @endforeach
                                        @endisset
                                </h5>
                                <h5><b class="font-weight-bold">Summary: </b></h5>
                                <p>
                                    {{ $material->material_desc }}
                                </p>

                                @if (Auth::user()->sub->isActive)
                                    @isset($folder)
                                        @if (in_array($folder->id, $bought_folders))
                                            <a href="{{ route('user.access_material', $material->id) }}"
                                                class="btn btn-primary p-3">
                                                Access Material
                                            </a>
                                        @else
                                            <div class="mt-5">
                                                <div class="card"
                                                    style="width: fit-content; box-shadow: 0 0.76rem 1.52rem rgb(18 36 63 / 43%);">
                                                    <div class="card-body">
                                                        <h5><b class="font-weight-bold">Folder Details</h5>
                                                        <h5><b class="font-weight-bold">Name: </b>{{ $folder->name }}</h5>
                                                        <h5><b class="font-weight-bold">Amount:
                                                                @if ($folder->price == 'Paid')
                                                                    {{ money($folder->amount, $folder->currency_id) }} /
                                                                    <span
                                                                        class="text-capitalize">{{ $folder->duration }}</span>
                                                                @elseif ($folder->price == 'Free')
                                                                    Free
                                                                @endif
                                                            </b></h5>
                                                        <h5><b class="font-weight-bold">No of Materials:
                                                                {{ $folder_mat_count }}</b>
                                                        </h5>
                                                        @if ($folder->price == 'Paid')
                                                            <a onclick="flutterwaveBuyMaterial('{{ exchange($folder->amount, $folder->currency_id) }}', '{{ $folder->id }}', 'folder')"
                                                                class="btn m-2 btn-primary p-3">
                                                                Buy Folder
                                                            </a>
                                                        @elseif ($folder->price == 'Free')
                                                            <a href="{{ route('user.add_free_folder_to_library', $folder->id) }}"
                                                                class="btn btn-primary p-3"
                                                                onclick="return confirm('Are you sure you want to add this folder to your library?')">
                                                                Add To Library
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
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
                                                {{-- @if ($rentedMatCount >= 2)
                                                <a aria-readonly="true" class="btn m-2 btn-primary p-2"
                                                    @disabled(true) style="cursor: no-drop">
                                                    Maximum rent reached
                                                </a>
                                            @elseif($rentedMatCount == 1)
                                                <a class="btn m-2 btn-dark p-2 btn-outline-primary"
                                                    href="{{ route('user.second_rent', $material->id) }}">
                                                    Rent Book
                                                </a>
                                            @elseif($rentedMatCount == 0)
                                                <a class="btn m-2 btn-dark p-2 btn-outline-primary"
                                                    onclick="flutterwaveBuyMaterial('{{ exchange($settings['rent'] ?? 700) }}', '{{ $material->id }}', 'rented')">
                                                    Rent Book
                                                </a>
                                            @endif --}}
                                                <a onclick="flutterwaveBuyMaterial('{{ exchange($material->amount, $material->currency_id) }}', '{{ $material->id }}', 'bought')"
                                                    class="btn m-2 btn-primary p-2">
                                                    Buy Book
                                                </a>
                                            @endif
                                        @endif
                                    @endisset
                                @elseif (Auth::user()->team_id && Auth::user()->team->sub_status == 'active')
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
                                            {{-- @if ($rentedMatCount >= 2)
                                            <a aria-readonly="true" class="btn m-2 btn-primary p-2"
                                                @disabled(true) style="cursor: no-drop">
                                                Maximum rent reached
                                            </a>
                                        @elseif($rentedMatCount == 1)
                                            <a class="btn m-2 btn-dark p-2 btn-outline-primary"
                                                href="{{ route('user.second_rent', $material->id) }}">
                                                Rent Book
                                            </a>
                                        @elseif($rentedMatCount == 0)
                                            <a class="btn m-2 btn-dark p-2 btn-outline-primary"
                                                onclick="flutterwaveBuyMaterial('{{ exchange($settings['rent'] ?? 700) }}', '{{ $material->id }}', 'rented')">
                                                Rent Book
                                            </a>
                                        @endif --}}
                                            <a onclick="flutterwaveBuyMaterial('{{ exchange($material->amount) }}', '{{ $material->id }}', 'bought')"
                                                class="btn m-2 btn-primary p-2">
                                                Buy Book
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    @if (in_array($material->id, $my_materials_arr))
                                        <a href="{{ route('user.access_material', $material->id) }}"
                                            class="btn btn-primary p-3">
                                            Access Material
                                        </a>
                                    @else
                                        <button onclick="shiSub(event)" data-type="dark" data-size="s"
                                            data-title="Subscribe" href="{{ route('user.sub.text', $material->id) }}"
                                            class="sub-link btn p-2 font-weight-bold h4 btn-primary">Subscribe</button>
                                    @endif
                                @endisset

                            @endif
                        </div>
                    @else
                        <h3>Soemthing went wrong, try again</h3>
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
