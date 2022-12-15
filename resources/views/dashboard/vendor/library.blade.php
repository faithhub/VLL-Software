@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Textboooks</h6>
                        <div class="card-options" style="margin-right:2.5%"> <a href="{{ route('vendor.upload') }}"
                                class="btn btn-bg btn-primary p-3">Upload a Material</a> </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @isset($materials)
                                @foreach ($materials as $material)
                                   <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                        <div class="image">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                {{-- <a href="{{ route('user.summary', $material->id) }}"> --}}
                                                <img src="{{ $material->img }}" alt="{{ $material->title }}">
                                            </a>
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                            </div>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                class="book-title">
                                                {{-- <a href="{{ route('user.summary', $material->id) }}" class="book-title"> --}}
                                                <h4>{{ $material->title }} ({{ $material->year }})</h4>
                                                <h5>{{ $material->author }}</h5>
                                            </a>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                            <div class="card border-10 pt-2 card-primary">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="image text-center">
                                                                            <a href="">
                                                                                <img src="{{ asset('materials/img/001.png') }}"
                                                                                    alt="dsdd">
                                                                            </a>
                                                                        </div>
                                                                        <div class="rating text-center">
                                                                            <h4 class="font-weight-bold h6 mt-3">Ratings:
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="mat-title">
                                                                            <h4 class="h2 font-weight-bold text-center">Law of
                                                                                Counsel</h4>
                                                                            <h5><b class="font-weight-bold">Author:</b> Evelyn
                                                                                Brigge, Aladdin Carter, Fredrick Young
                                                                            </h5>
                                                                            <h5><b class="font-weight-bold">Year Of
                                                                                    Publication:</b> 2010</h5>
                                                                            <h5><b class="font-weight-bold">Pages:</b> 235</h5>
                                                                            <h5><b class="font-weight-bold">Price:</b>
                                                                                ₦{{ number_format(4560, 2) }}</h5>
                                                                                <h5><b class="font-weight-bold">Pages:</b> 235</h5>
                                                                                <h5><b class="font-weight-bold">Amount Rented:</b> 40</h5>
                                                                                <h5><b class="font-weight-bold">Amount Bought:</b> 50</h5>
                                                                            <h5><b class="font-weight-bold">Summary:</b></h5>
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur
                                                                                adipiscing elit. Scelerisque morbi id purus
                                                                                ultrices eget gravida et. Quam sit tincidunt
                                                                                dolor porta ac malesuada ipsum convallis.
                                                                                Leo imperdiet ornare est cras velit, adipiscing.
                                                                                Porta auctor augue vitae augue risus
                                                                                lacus, massa commodo. Facilisis ipsum ac eget
                                                                                ornare mauris, nulldis quam.
                                                                                Nec ornare aliquam in euismod luctus cursus.
                                                                                Convallis nisl nunc lacus, sit. Dui nec, at
                                                                                ipsum mauris suspendisse mauris curabitur
                                                                                porttitor malesuada. Tincidunt dui egestas
                                                                                vitae, vitae in. Eu pellentesque libero.
                                                                            </p>
                                                                            <a href="" class="btn btn-primary p-3 m-2">
                                                                               Edit
                                                                            </a>
                                                                            <a href=""
                                                                                class="btn btn-dark p-3 btn-outline-primary">
                                                                               Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Understood</button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateTextInput(val) {
            document.getElementById('textInput').value = val;
        }
    </script>
@endsection
