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
                            @if ($material->folder)
                                <img src="{{ asset($material->folder->folder_cover->url ?? 'images/new-meeting.png') }}"
                                    alt="{{ $material->title }}">
                            @else
                                <img src="{{ asset($material->cover->url ?? 'images/new-meeting.png') }}"
                                    alt="{{ $material->title }}">
                            @endif
                            @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                <img id="video-bookstore-cover-view" src="{{ asset('materials/icon/v-play.png') }}"
                                    alt="{{ $material->title }}" align="middle" style="color: black">
                            @endif
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
                        <h4 class="h2 font-weight-bold text-center mt-3">
                            {{ $material->title ?? $material->name_of_party }}</h4>
                        @isset($material->title)
                            <h5><b class="font-weight-bold">Title: </b>{{ $material->title }}</h5>
                        @endisset
                        @if (substr($material->type->mat_unique_id, 0, 3) == 'CSL')
                            <h5><b class="font-weight-bold">Name of Court: </b>{{ $material->name_of_party ?? '' }}</h5>
                            <h5><b class="font-weight-bold">Name of Party: </b>{{ $material->name_of_party ?? '' }}</h5>
                            <h5><b class="font-weight-bold">Citation: </b>{{ $material->citation ?? '' }}</h5>
                            <h5><b class="font-weight-bold">Publisher: </b>{{ $folder->publisher ?? '' }}</h5>
                            <h5><b class="font-weight-bold">Name of Author: </b>{{ $folder->name_of_author ?? '' }}
                            </h5>
                            <h5><b class="font-weight-bold">version: </b>{{ $folder->version ?? '' }}</h5>
                            <h5><b class="font-weight-bold">Publisher: </b>{{ $folder->publisher ?? '' }}</h5>
                            </h5>
                        @endif
                        @if (substr($material->type->mat_unique_id, 0, 3) == 'LAW')
                            <h5><b class="font-weight-bold">Year of Enactmen:
                                </b>{{ $material->year_of_enactmen ?? '' }}</h5>
                            <h5><b class="font-weight-bold">Publisher: </b>{{ $folder->publisher ?? '' }}</h5>
                            <h5><b class="font-weight-bold">Name of Author: </b>{{ $folder->name_of_author ?? '' }}
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
                            <h5><b class="font-weight-bold">Year Of Publication: </b>{{ $material->year_of_publication }}
                            </h5>
                        @endisset
                        @isset($material->country)
                            <h5><b class="font-weight-bold">Country Of Publication: </b>{{ $material->country->name }}</h5>
                        @endisset
                        @isset($material->university_id)
                            @if (substr($material->type->mat_unique_id, 0, 3) == 'TAA')
                                <h5><b class="font-weight-bold">University: </b>{{ $material->university->name }}</h5>
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
                        <h5><b class="font-weight-bold">Total Rented: </b>{{ $totalRented }}</h5>
                        <h5><b class="font-weight-bold">Total Bought: </b>{{ $totalBought }}</h5>

                        @isset($material->vendor)
                            <h5><b class="font-weight-bold">Uploaded By:
                                    @if ($material->vendor->role == 'vendor')
                                        <a
                                            href="{{ route('admin.vendor', $material->user->id) }}">{{ $material->user->name }}</a>
                                        <span
                                            class="text-capitalize user-role btn-sm btn btn-primary">{{ $material->vendor->role }}</span>
                                    @else
                                        {{ $material->user->name }} <span
                                            class="text-capitalize user-role btn-sm btn btn-primary">{{ $material->vendor->role }}</span>
                                    @endif
                                </b></h5>
                        @endisset
                        <h5><b class="font-weight-bold">Date Uploaded:
                            </b>{{ $material->created_at->format('D, M j, Y h:i a') }}</h5>

                        <h5><b class="font-weight-bold">Summary: </b></h5>
                        <p>
                            {{ $material->material_desc }}
                        </p>
                        @if ($material->trashed())
                            <a onclick="return confirm('Are you sure you want to restore this material?')"
                                href="{{ route('admin.delete.library', $material->id) }}"
                                class="btn font-weight-bold btn-primary p-3 m-2">
                                Restore Material
                            </a>
                        @else
                            <a href="{{ route('admin.edit.library', $material->id) }}" class="btn btn-primary p-3 m-2">
                                <i class="fa fa-pencil"></i>&nbsp&nbspEdit
                            </a>
                            <a href="{{ route('admin.delete.library', $material->id) }}"
                                onclick="return confirm('Are you sure you want to delete this meterial?')"
                                class="btn btn-dark p-3 btn-outline-primary">
                                <i class="fa fa-trash"></i>&nbsp&nbspDelete
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
