@extends('layouts/dashboard/app')
@section('content')
    <style>
        #img-2 {
            position: absolute;
            justify-content: center;
            width: 10%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 offset-xl-3 offset-lg-3 offset-md-3">
                <div class="card border-10 pt-5 card-primary">
                    <div class="card-body pt-0 p-5">
                        <div class="row">
                            <div class="image text-center">
                                <a href="">
                                    <img src="{{ asset('materials/img/001.png') }}" alt="dsdd">
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
                                <h4 class="h2 font-weight-bold text-center">Law of Counsel</h4>
                                <h5><b class="font-weight-bold">Author:</b> Evelyn Brigge, Aladdin Carter, Fredrick Young
                                </h5>
                                <h5><b class="font-weight-bold">Year Of Publication:</b> 2010</h5>
                                <h5><b class="font-weight-bold">Pages:</b> 235</h5>
                                <h5><b class="font-weight-bold">Price:</b> ₦{{ number_format(4560, 2) }}</h5>
                                <h5><b class="font-weight-bold">Summary::</b></h5>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque morbi id purus
                                    ultrices eget gravida et. Quam sit tincidunt dolor porta ac malesuada ipsum convallis.
                                    Leo imperdiet ornare est cras velit, adipiscing. Porta auctor augue vitae augue risus
                                    lacus, massa commodo. Facilisis ipsum ac eget ornare mauris, nulldis quam.
                                    Nec ornare aliquam in euismod luctus cursus. Convallis nisl nunc lacus, sit. Dui nec, at
                                    ipsum mauris suspendisse mauris curabitur porttitor malesuada. Tincidunt dui egestas
                                    vitae, vitae in. Eu pellentesque libero.
                                </p>
                                <a href="" class="btn btn-primary p-3">
                                    Add To Library
                                </a>
                                <a href="" class="btn btn-dark p-3 btn-outline-primary">
                                    Rent Book
                                </a>
                                <a href="" class="btn btn-primary p-3">
                                    Buy Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
