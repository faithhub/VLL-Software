<div class="row">
    <style>
.user-role{
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
                            <img src="{{ asset($material->cover->url ?? "") }}" alt="{{ $material->title }}">
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
                        <h4 class="h2 font-weight-bold text-center mt-3">{{ $material->title }}</h4>
                        @if (substr($material->type->mat_unique_id, 0, 3) == 'CSL' || substr($material->type->mat_unique_id, 0, 3) == 'LAW')
                            <h5><b class="font-weight-bold">Name of Court: </b>{{ $material->name_of_court ?? '' }}</h5>
                            <h5><b class="font-weight-bold">Name of Party: </b>{{ $material->name_of_party ?? '' }}</h5>
                            <h5><b class="font-weight-bold">Citation: </b>{{ $material->citation ?? '' }}</h5>
                        @endif
                        @isset($material->name_of_author)
                            <h5><b class="font-weight-bold">Author: </b>{{ $material->name_of_author ?? '' }}</h5>
                        @endisset
                        @isset($material->year_of_publication)
                            <h5><b class="font-weight-bold">Year Of Publication: </b>{{ $material->year_of_publication }}
                            </h5>
                        @endisset
                        @isset($material->country)
                            <h5><b class="font-weight-bold">Country Of Publication: </b>{{ $material->country->name }}</h5>
                        @endisset

                        @if (substr($material->type->mat_unique_id, 0, 3) == 'TAA')
                            @isset($material->test_country_id)
                                <h5><b class="font-weight-bold">Country: </b>{{ $material->test_country->name }}</h5>
                            @endisset
                            @isset($material->university_id)
                                <h5><b class="font-weight-bold">University: </b>{{ $material->university->name }}</h5>
                            @endisset
                        @endif
                        <h5><b class="font-weight-bold">Price:</b>
                            @if ($material->price == 'Paid')
                                ₦{{ number_format($material->amount, 2) }}
                            @else
                                Free
                            @endif
                        </h5>
                        <h5><b class="font-weight-bold">Pages: </b>{{ $pageCount }}</h5>
                        <h5><b class="font-weight-bold">Total Rented: </b>{{ $totalRented }}</h5>
                        <h5><b class="font-weight-bold">Total Bought: </b>{{ $totalBought }}</h5>

                        @isset($material->vendor)
                        <h5><b class="font-weight-bold">Uploaded By: 
                            @if ($material->vendor->role == "vendor")
                            <a href="{{ route('admin.vendor', $material->user->id) }}">{{ $material->user->name }}</a> <span class="text-capitalize user-role btn-sm btn btn-primary">{{$material->vendor->role}}</span>
                            @else
                            {{ $material->user->name }} <span class="text-capitalize user-role btn-sm btn btn-primary">{{$material->vendor->role}}</span>
                            @endif
                            </b></h5>
                        @endisset
                        
                        <h5><b class="font-weight-bold">Summary: </b></h5>
                        <p>
                            {{ $material->material_desc }}
                        </p>
                        <a href="{{ route('admin.edit.library', $material->id) }}" class="btn btn-primary p-3 m-2">
                            <i class="fa fa-pencil"></i>&nbsp&nbspEdit
                        </a>
                        <a href="{{ route('admin.delete.library', $material->id) }}"
                            onclick="return confirm('Are you sure you want to delete this meterial?')"
                            class="btn btn-dark p-3 btn-outline-primary">
                            <i class="fa fa-trash"></i>&nbsp&nbspDelete
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
