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
                        <h5><b class="font-weight-bold">Year Of Publication: </b>{{ $material->year_of_publication }}
                        </h5>
                        <h5><b class="font-weight-bold">Price:
                            @if ($material->price == 'Paid')
                                ₦{{ number_format($material->amount, 2) }}
                            @else
                                Free
                            @endif
                            </b>
                        </h5>
                        <h5><b class="font-weight-bold">Pages: </b>{{ $pageCount }}</h5>
                        <h5><b class="font-weight-bold">Total Rented: </b>{{ $totalRented }}</h5>
                        <h5><b class="font-weight-bold">Total Bought: </b>{{ $totalBought }}</h5>
                        <h5><b class="font-weight-bold">Summary: </b></h5>
                        <p>
                            {{ $material->material_desc }}
                        </p>

                        @if ($material->price == 'Free')
                            <a href="" class="btn btn-primary p-3">
                                Add To Library
                            </a>
                        @endif

                        @if ($material->price == 'Paid')
                            <a href="#" class="btn m-2 btn-dark p-2 btn-outline-primary">
                                Rent Book
                            </a>
                            <a href="#" onclick="payWithPaystack('{{ $material->amount }}', '{{ Auth::user()->email }}')" class="btn m-2 btn-primary p-2">
                                Buy Book
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
