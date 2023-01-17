<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="image text-center">
                        <a href="#">
                            <img src="{{ asset($material->cover->url) }}" alt="{{ $material->title }}">
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
                            <h5><b class="font-weight-bold">University: </b>{{ $material->university->name }}</h5>
                        @endisset
                        <h5><b class="font-weight-bold">Amount:
                                @if ($material->price == 'Paid')
                                    ₦{{ number_format($material->amount, 2) }}
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

                        @if(!isset(Auth::user()->sub_id))
                            <button onclick="shiNew(event)" data-type="dark" data-size="l" data-title="Subscriptions"
                                href="{{ route('user.subscriptions') }}"
                                class="sub-link btn p-2 font-weight-bold h4 btn-primary">Subscribe</button>
                        @else
                            @if ($material->price == 'Free')
                                <a href="" class="btn btn-primary p-3">
                                    Add To Library
                                </a>
                            @endif
                            @if ($material->price == 'Paid')
                                <a class="btn m-2 btn-dark p-2 btn-outline-primary"
                                    onclick="payWithPaystack('{{ $rent }}', '{{ Auth::user()->email }}')">
                                    Rent Book
                                </a>
                                <a onclick="payWithPaystack('{{ $material->amount }}', '{{ Auth::user()->email }}')"
                                    class="btn m-2 btn-primary p-2">
                                    Buy Book
                                </a>
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
