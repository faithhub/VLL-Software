<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="image text-center">
                        <a href="#">
                            <img src="{{ $material->cover->url }}" alt="{{ $material->title }}">
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
                        <h5><b class="font-weight-bold">Author: </b>{{ $material->name_of_author }}</h5>
                        @isset($material->year_of_publication)
                            <h5><b class="font-weight-bold">Year Of Publication: </b>{{ $material->year_of_publication }}
                            </h5>
                        @endisset
                        @isset($material->country)
                            <h5><b class="font-weight-bold">Country Of Publication: </b>{{ $material->country->name }}</h5>
                        @endisset
                        @isset($material->test_country_id)
                            <h5><b class="font-weight-bold">Country: </b>{{ $material->test_country->name }}</h5>
                        @endisset
                        @isset($material->university_id)
                            <h5><b class="font-weight-bold">University: </b>{{ $material->university->name }}</h5>
                        @endisset
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
                        <h5><b class="font-weight-bold">Summary: </b></h5>
                        <p>
                            {{ $material->material_desc }}
                        </p>
                        @if (!isset(Auth::user()->sub_id))
                            <button onclick="shiNew(event)" data-type="dark" data-size="l" data-title="Subscriptions"
                                href="{{ route('vendor.subscriptions') }}"
                                class="sub-link btn p-2 font-weight-bold h4 btn-primary">Subscribe</button>
                        @else
                            <a href="{{ route('vendor.edit', $material->id) }}" class="btn btn-primary p-3 m-2">
                                <i class="fa fa-pencil"></i>&nbsp&nbspEdit
                            </a>
                            <a href="{{ route('vendor.delete', $material->id) }}"
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
