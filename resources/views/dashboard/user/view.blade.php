<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="image text-center">
                        <div id="frame">
                            <a href="#">
                                <img src="{{ asset($material->cover->url ?? '') }}" alt="{{ $material->title }}">
                                @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                    <img id="video-bookstore-cover-view" src="{{ asset('materials/icon/v-play.png') }}"
                                        alt="{{ $material->title }}" align="middle" style="color: black">
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
                    <div class="mat-title">
                        <h4 class="h2 font-weight-bold text-center mt-3">{{ $material->title }}</h4>
                        <h5><b class="font-weight-bold">Author: </b>{{ $material->name_of_author }}</h5>
                        <h5><b class="font-weight-bold">Version: </b>{{ $material->version }}</h5>
                        <h5><b class="font-weight-bold">Publisher: </b>{{ $material->publisher }}</h5>
                        @isset($material->year_of_publication)
                            <h5><b class="font-weight-bold">Year Of Publication: </b>{{ $material->year_of_publication }}
                            </h5>
                        @endisset
                        @isset($material->country)
                            <h5><b class="font-weight-bold">Country Of Publication: </b>{{ $material->country->name }}</h5>
                        @endisset
                        {{-- @isset($material->test_country_id)
                            <h5><b class="font-weight-bold">Country: </b>{{ $material->test_country->name }}</h5>
                        @endisset --}}
                        @isset($material->university_id)
                            @if (substr($material->type->mat_unique_id, 0, 3) == 'TAA')
                                <h5><b class="font-weight-bold">University: </b>{{ $material->university->name }}</h5>
                            @endif
                        @endisset
                        <h5><b class="font-weight-bold">Amount:
                                @if ($material->price == 'Paid')
                                    {{ money($material->amount) }}
                                @else
                                    Free
                                @endif
                            </b>
                        </h5>
                        <h5><b class="font-weight-bold">Pages: </b>{{ $pageCount }}</h5>
                        <h5><b class="font-weight-bold">Tags:
                                @foreach ($material->tags as $tag)
                                    <span class="badge bg-primary-light">{{ $tag }}</span>
                                @endforeach
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
                                                <h5><b class="font-weight-bold">Folder Name: </b>{{ $folder->name }}</h5>
                                                <h5><b class="font-weight-bold">Folder Amount:
                                                        {{ money($folder->amount) }}</b>
                                                    /
                                                    annual </h5>
                                                <h5><b class="font-weight-bold">No of Materials:
                                                        {{ $folder_mat_count }}</b>
                                                </h5>
                                                <a onclick="material('{{ $folder->amount }}', '{{ $material->id }}', 'folder')"
                                                    class="btn m-2 btn-primary p-3">
                                                    Buy Folder
                                                </a>
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
                                        @if ($rentedMatCount >= 2)
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
                                                onclick="material('{{ $settings['rent'] ?? 700 }}', '{{ $material->id }}', 'rented')">
                                                Rent Book
                                            </a>
                                        @endif
                                        <a onclick="material('{{ $material->amount }}', '{{ $material->id }}', 'bought')"
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
                                    @if ($rentedMatCount >= 2)
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
                                            onclick="material('{{ $settings['rent'] ?? 700 }}', '{{ $material->id }}', 'rented')">
                                            Rent Book
                                        </a>
                                    @endif
                                    <a onclick="material('{{ $material->amount }}', '{{ $material->id }}', 'bought')"
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
                                <button onclick="shiSub(event)" data-type="dark" data-size="s" data-title="Subscribe"
                                    href="{{ route('user.sub.text', $material->id) }}"
                                    class="sub-link btn p-2 font-weight-bold h4 btn-primary">Subscribe</button>
                            @endif
                        @endisset
                </div>
            </div>
        </div>
    </div>
</div>
</div>
