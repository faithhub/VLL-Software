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

        #img-3 {
            position: absolute;
            justify-content: center;
            width: 5%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0">
                        <div class="d-flex">
                            <div class="media mt-4">
                                <div class="media-body">
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Welcome to the Bookstore</h6>
                                    <small class="h5">View all your Legal Related Textbooks, Articles and Videos</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @isset($material_array)
                        @foreach ($material_array as $material_arr)
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                @if (substr($material_arr->type->mat_unique_id, 0, 3) == 'TAA')
                                    @if (Auth::user()->user_type == 'student')
                                        <div class="card-header border-bottom-0 mb-4">
                                            <h6 class="mb-1 mt-1 font-weight-bold h3">{{ $material_arr->type->name }}</h6>
                                            <div class="card-options" style="margin-right:2.5%"> <a
                                                    href="{{ route('user.view_material_type', $material_arr->type->id) }}"
                                                    class="btn btn-sm btn-primary">View All</a>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="card-header border-bottom-0 mb-4">
                                        <h6 class="mb-1 mt-1 font-weight-bold h3">{{ $material_arr->type->name }}</h6>
                                        <div class="card-options" style="margin-right:2.5%"> <a
                                                href="{{ route('user.view_material_type', $material_arr->type->id) }}"
                                                class="btn btn-sm btn-primary">View All</a>
                                        </div>
                                    </div>
                                @endif
                                <div class="card-body pt-0">
                                    <div class="row">
                                        @isset($material_arr->materials)
                                            @foreach ($material_arr->materials as $key => $material)
                                                @if (substr($material_arr->type->mat_unique_id, 0, 3) == 'CSL' ||
                                                        substr($material_arr->type->mat_unique_id, 0, 3) == 'LAW')
                                                    @if (in_array($key, $limit_folder))
                                                        <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                                            <div class="image image_big_div">
                                                                <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                                    data-title="{{ $material[0]['folder']['name'] }}"
                                                                    href="{{ route('user.view_folder', $material[0]['folder']['id']) }}">
                                                                    <img src="{{ asset($material[0]['folder']['folder_cover']['url']) }}"
                                                                        alt="{{ $material[0]['folder']['name'] }}" class="mat_img">
                                                                </a>
                                                            </div>
                                                            <div class="mat-title">
                                                                <div class="mt-2">
                                                                </div>
                                                                <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                                    data-title="{{ $material[0]['folder']['name'] }}"
                                                                    href="{{ route('user.view_folder', $material[0]['folder']['id']) }}"
                                                                    class="book-title mt-2">
                                                                    <h4 class="text-capitalize">
                                                                        {{ $material[0]['folder']['name'] }}
                                                                    </h4>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if (substr($material_arr->type->mat_unique_id, 0, 3) == 'TAA')
                                                        @if (Auth::user()->user_type == 'student')
                                                            @if ($material->university_id == Auth::user()->university_id)
                                                                <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                                                    <div class="image image_big_div">
                                                                        <div class="ribbon-holder">
                                                                            @if ($material->mat_his)
                                                                                @if (in_array($material->mat_his->material_id, $my_materials_arr))
                                                                                    @foreach ($all_my_materials_arr as $all_my_materials_arr_val)
                                                                                        @if ($all_my_materials_arr_val->material_id == $material->mat_his->material_id)
                                                                                            @if ($all_my_materials_arr_val->type == 'rented')
                                                                                                @if ($all_my_materials_arr_val->is_rent_expired == false)
                                                                                                    <div
                                                                                                        class="ribbon ribbon-holder ribbon-{{ $all_my_materials_arr_val->type }}">
                                                                                                        {{ $all_my_materials_arr_val->type }}
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endif

                                                                                            @if ($all_my_materials_arr_val->type == 'bought')
                                                                                                <div
                                                                                                    class="ribbon ribbon-holder ribbon-{{ $all_my_materials_arr_val->type }}">
                                                                                                    {{ $all_my_materials_arr_val->type }}
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endif

                                                                            @if ($material->price == 'Free')
                                                                                <div class="ribbon ribbon-holder ribbon-free">
                                                                                    Free
                                                                                </div>
                                                                            @endif

                                                                            @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                                                                <a onclick="shiNew(event)" data-type="dark"
                                                                                    data-size="m"
                                                                                    data-title="{{ $material->title }}"
                                                                                    href="{{ route('user.view_material', $material->id) }}">
                                                                                    <img src="{{ asset($material->cover->url) }}"
                                                                                        alt="{{ $material->title }}"
                                                                                        class="mat_img">
                                                                                    <img id="img-2"
                                                                                        src="{{ asset('materials/icon/v-play.png') }}"
                                                                                        alt="{{ $material->title }}" align="middle"
                                                                                        style="color: black">
                                                                                </a>
                                                                            @else
                                                                                <a onclick="shiNew(event)" data-type="dark"
                                                                                    data-size="m"
                                                                                    data-title="{{ $material->title }}"
                                                                                    href="{{ route('user.view_material', $material->id) }}">
                                                                                    <img src="{{ asset($material->cover->url) }}"
                                                                                        alt="{{ $material->title }}"
                                                                                        class="mat_img">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="mat-title">
                                                                        <div class="mt-2">
                                                                        </div>
                                                                        <a onclick="shiNew(event)" data-type="dark"
                                                                            data-size="m" data-title="{{ $material->title }}"
                                                                            href="{{ route('user.view_material', $material->id) }}"
                                                                            class="book-title mt-2">
                                                                            <h4 class="text-capitalize">{{ $material->title }}
                                                                                ({{ $material->year_of_publication }})
                                                                            </h4>
                                                                            <h5 class="text-capitalize">
                                                                                {{ $material->name_of_author }}
                                                                            </h5>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                                            <div class="image image_big_div">
                                                                <div class="ribbon-holder">
                                                                    @if ($material->mat_his)
                                                                        @if (in_array($material->mat_his->material_id, $my_materials_arr))
                                                                            @foreach ($all_my_materials_arr as $all_my_materials_arr_val)
                                                                                @if ($all_my_materials_arr_val->material_id == $material->mat_his->material_id)
                                                                                    @if ($all_my_materials_arr_val->type == 'rented')
                                                                                        @if ($all_my_materials_arr_val->is_rent_expired == false)
                                                                                            <div
                                                                                                class="ribbon ribbon-holder ribbon-{{ $all_my_materials_arr_val->type }}">
                                                                                                {{ $all_my_materials_arr_val->type }}
                                                                                            </div>
                                                                                        @endif
                                                                                    @endif

                                                                                    @if ($all_my_materials_arr_val->type == 'bought')
                                                                                        <div
                                                                                            class="ribbon ribbon-holder ribbon-{{ $all_my_materials_arr_val->type }}">
                                                                                            {{ $all_my_materials_arr_val->type }}
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endif

                                                                    @if ($material->price == 'Free')
                                                                        <div class="ribbon ribbon-holder ribbon-free">Free
                                                                        </div>
                                                                    @endif

                                                                    @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                                                        <a onclick="shiNew(event)" data-type="dark"
                                                                            data-size="m" data-title="{{ $material->title }}"
                                                                            href="{{ route('user.view_material', $material->id) }}">
                                                                            <img src="{{ asset($material->cover->url) }}"
                                                                                alt="{{ $material->title }}" class="mat_img">
                                                                            <img id="img-2"
                                                                                src="{{ asset('materials/icon/v-play.png') }}"
                                                                                alt="{{ $material->title }}" align="middle"
                                                                                style="color: black">
                                                                        </a>
                                                                    @else
                                                                        <a onclick="shiNew(event)" data-type="dark"
                                                                            data-size="m" data-title="{{ $material->title }}"
                                                                            href="{{ route('user.view_material', $material->id) }}">
                                                                            <img src="{{ asset($material->cover->url) }}"
                                                                                alt="{{ $material->title }}" class="mat_img">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="mat-title">
                                                                <div class="mt-2">
                                                                </div>
                                                                <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                    data-title="{{ $material->title }}"
                                                                    href="{{ route('user.view_material', $material->id) }}"
                                                                    class="book-title mt-2">
                                                                    <h4 class="text-capitalize">{{ $material->title }}
                                                                        ({{ $material->year_of_publication }})
                                                                    </h4>
                                                                    <h5 class="text-capitalize">
                                                                        {{ $material->name_of_author }}
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
