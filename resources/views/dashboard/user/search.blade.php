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
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Search resulsut for
                                        "{{ request()->get('search') }}"</h6>
                                    <small class="h5"><b class="font-weight-bold">{{ $material_array->count() }}</b>
                                        material(s) found </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card-header border-bottom-0 mb-4">
                            {{-- <h6 class="mb-1 mt-1 font-weight-bold h3"></h6>
                            <div class="card-options" style="margin-right:2.5%"> <a href=""
                                    class="btn btn-sm btn-primary">View All</a>
                            </div> --}}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                @isset($material_array)
                                    @foreach ($material_array as $material)
                                        <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                            <div class="image image_big_div">
                                                <div class="ribbon-holder">
                                                    @if (request()->is('user'))
                                                        @if ($material->mat_his)
                                                            @if (in_array($material->mat_his->material_id, $my_materials_arr))
                                                                @foreach ($all_my_materials_arr as $all_my_materials_arr_val)
                                                                    @if ($all_my_materials_arr_val->material_id == $material->mat_his->material_id)
                                                                        {{-- Rented --}}
                                                                        @if ($all_my_materials_arr_val->type == 'rented')
                                                                            @if ($all_my_materials_arr_val->is_rent_expired == false)
                                                                                <div
                                                                                    class="ribbon ribbon-holder ribbon-{{ $all_my_materials_arr_val->type }}">
                                                                                    {{ $all_my_materials_arr_val->type }}
                                                                                </div>
                                                                            @endif
                                                                        @endif

                                                                        {{-- Bought --}}
                                                                        @if ($all_my_materials_arr_val->type == 'bought')
                                                                            <div
                                                                                class="ribbon ribbon-holder ribbon-{{ $all_my_materials_arr_val->type }}">
                                                                                {{ $all_my_materials_arr_val->type }}</div>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endif

                                                        @if ($material->price == 'Free')
                                                            <div class="ribbon ribbon-holder ribbon-free">Free</div>
                                                        @endif
                                                    @endif
                                                    @if (request()->is('library'))
                                                        @if ($material->mat_his_type == 'rented')
                                                            @if ($material->is_rent_expired == false)
                                                                <div
                                                                    class="ribbon ribbon-holder ribbon-{{ $material->mat_his_type }}">
                                                                    {{ $material->mat_his_type }}</div>
                                                            @endif
                                                        @endif
                                                        @if ($material->mat_his_type == 'bought' || $material->mat_his_type == 'free')
                                                            <div
                                                                class="ribbon ribbon-holder ribbon-{{ $material->mat_his_type }}">
                                                                {{ $material->mat_his_type }}</div>
                                                        @endif
                                                    @endif
                                                    <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                        data-title="{!! $material->title[0] !!}"
                                                        href="{{ route('user.view_material', $material->id) }}">
                                                        <img src="{{ asset($material->mat_cover ?? $material->cover->url) }}"
                                                            alt="{!! $material->name_of_author !!}" class="mat_img">

                                                        @isset($material->type->mat_unique_id)
                                                            @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                                                <img id="video-bookstore-cover"
                                                                    src="{{ asset('materials/icon/v-play.png') }}"
                                                                    alt="{!! $material->title[0] !!}" align="middle"
                                                                    style="color: black">
                                                            @endif
                                                        @endisset
                                                        @isset($material->mat_unique_id)
                                                            @if (substr($material->mat_unique_id, 0, 3) == 'VAA')
                                                                <img id="video-bookstore-cover"
                                                                    src="{{ asset('materials/icon/v-play.png') }}"
                                                                    alt="{!! $material->title[0] !!}" align="middle"
                                                                    style="color: black">
                                                            @endif
                                                        @endisset

                                                    </a>
                                                </div>
                                            </div>
                                            <div class="mat-title">
                                                <div class="mt-2">
                                                </div>
                                                <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                    data-title="{!! $material->title[0] !!}"
                                                    href="{{ route('user.view_material', $material->id) }}"
                                                    class="book-title mt-2">
                                                    <h4 class="text-capitalize">{!! $material->title[0] !!}
                                                        ({{ $material->year_of_publication }})
                                                    </h4>
                                                    <h5 class="text-capitalize">
                                                        {{ $material->name_of_author }}
                                                    </h5>
                                                </a>
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
    </div>
@endsection
