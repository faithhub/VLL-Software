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
        @if ($type == 'Material')
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card border-10">
                        <div class="card-header border-bottom-0 mb-4">
                            <div class="d-flex">
                                <div class="media mt-4">
                                    <div class="media-body">
                                        <h6 class="mb-1 mt-1 font-weight-bold h3">{{ $material_type->name }}</h6>
                                        <small class="h5">{{ $materials->count() }} Material(s)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @isset($materials)
                            {{-- @foreach ($all_materials3 as $materials_types) --}}
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            @isset($materials)
                                                {{-- @foreach ($materials_types->groupBy('folder_id') as $key => $materiall) --}}
                                                {{-- @isset($materiall[0]->folder)
                                                        @if (in_array($key, $limit_folder))
                                                        <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                                            <div class="image">
                                                                <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                                    data-title="{{ $materiall[0]['folder']['name'] }}"
                                                                    href="{{ route('user.view_folder', $materiall[0]['folder']['id']) }}">
                                                                    <img src="{{ $materiall[0]['folder']['folder_cover']['url'] }}"
                                                                        alt="{{ $materiall[0]['folder']['name'] }}">
                                                                </a>
                                                            </div>
                                                            <div class="mat-title">
                                                                <div class="mt-2">
                                                                </div>
                                                                <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                                    data-title="{{ $materiall[0]['folder']['name'] }}"
                                                                    href="{{ route('user.view_folder', $materiall[0]['folder']['id']) }}"
                                                                    class="book-title mt-2">
                                                                    <h4 class="text-capitalize">
                                                                        {{ $materiall[0]['folder']['name'] }}
                                                                    </h4>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @else
                                                @endisset --}}
                                                @foreach ($materials as $key => $material)
                                                    
                                                    @if (substr($material->type->mat_unique_id, 0, 3) == 'TAA')
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
                                                                                <div class="ribbon ribbon-holder ribbon-free">Free
                                                                                </div>
                                                                            @endif

                                                                            @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                                                                <a onclick="shiNew(event)" data-type="dark"
                                                                                    data-size="m"
                                                                                    data-title="{{ $material->title }}"
                                                                                    href="{{ route('user.view_material', $material->id) }}">
                                                                                    {{-- <img src="{{ asset($material->cover->url ??  "images/new-meeting.png") }}"
                                                                                        alt="{{ $material->title }}"
                                                                                        class="mat_img"> --}}
                                                                                @if ($material->folder)
                                                                                    <img src="{{ asset($material->folder->folder_cover->url ?? 'images/new-meeting.png') }}"
                                                                                        alt="{{ $material->title }}"
                                                                                        class="mat_img">
                                                                                @else
                                                                                    <img src="{{ asset($material->cover->url ?? 'images/new-meeting.png') }}"
                                                                                        alt="{{ $material->title }}"
                                                                                        class="mat_img">
                                                                                @endif
                                                                                    <img id="img-2"
                                                                                        src="{{ asset('materials/icon/v-play.png' ?? "") }}"
                                                                                        alt="{{ $material->title }}" align="middle"
                                                                                        style="color: black">
                                                                                </a>
                                                                            @else
                                                                                <a onclick="shiNew(event)" data-type="dark"
                                                                                    data-size="m"
                                                                                    data-title="{{ $material->title }}"
                                                                                    href="{{ route('user.view_material', $material->id) }}">
                                                                                    <img src="{{ asset($material->cover->url ??  "images/new-meeting.png") }}"
                                                                                        alt="{{ $material->title }}"
                                                                                        class="mat_img">
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
                                                                        <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                            data-title="{{ $material->title }}"
                                                                            href="{{ route('user.view_material', $material->id) }}">
                                                                            <img src="{{ asset($material->cover->url ??  "images/new-meeting.png") }}"
                                                                                alt="{{ $material->title }}" class="mat_img">
                                                                            <img id="img-2"
                                                                                src="{{ asset('materials/icon/v-play.png') }}"
                                                                                alt="{{ $material->title }}" align="middle"
                                                                                style="color: black">
                                                                        </a>
                                                                    @else
                                                                        <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                            data-title="{{ $material->title }}"
                                                                            href="{{ route('user.view_material', $material->id) }}">
                                                                            <img src="{{ asset($material->cover->url ??  "images/new-meeting.png") }}"
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
                                                @endforeach
                                                {{-- @endforeach --}}
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- @endforeach --}}
                        @endisset

                    </div>
                </div>
        @endif
        @if ($type == 'Folder')
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card border-10">
                        <div class="card-header border-bottom-0 mb-4">
                            <div class="d-flex">
                                <div class="media mt-4">
                                    <div class="media-body">
                                        <h6 class="mb-1 mt-1 font-weight-bold h3">{{ $material_type->name }}</h6>
                                        <small class="h5">{{ $materials->count() }} Material(s)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @isset($t_materials)
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            @foreach ($t_materials as $materiall)
                                                @isset($materiall[0]->folder)
                                                    <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                                        <div class="image">
                                                            <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                                data-title="{{ $materiall[0]['folder']['name'] }}"
                                                                href="{{ route('user.view_folder', $materiall[0]['folder']['id']) }}">
                                                                <img src="{{ asset($materiall[0]['folder']['folder_cover']['url']) }}"
                                                                    alt="{{ $materiall[0]['folder']['name'] }}">
                                                            </a>
                                                        </div>
                                                        <div class="mat-title">
                                                            <div class="mt-2">
                                                            </div>
                                                            <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                                data-title="{{ $materiall[0]['folder']['name'] }}"
                                                                href="{{ route('user.view_folder', $materiall[0]['folder']['id']) }}"
                                                                class="book-title mt-2">
                                                                <h4 class="text-capitalize">
                                                                    {{ $materiall[0]['folder']['name'] }}
                                                                </h4>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                @endisset
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset

                    </div>
                </div>
        @endif
    </div>

    {{-- <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-4">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Video and Audio</h6>
                        <div class="card-options" style="margin-right:2.5%"> <a href="javascript:void(0);"
                                class="btn btn-sm btn-primary">View All</a> </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @isset($videos)
                                @foreach (array_slice($videos, 0, 4) as $video)
                                    <div class="col-lg-6 col-md-6 mb-5 justify-content-center">
                                        <div class="image">
                                            <a href="{{ $video->link }}">
                                                <img src="{{ $video->img }}" alt="{{ $video->title }}" width="100%"
                                                    height="auto">
                                                <img id="img-2" src="{{ asset('materials/icon/v-play.png') }}"
                                                    alt="{{ $video->title }}" align="middle">
                                            </a>
                                        </div>
                                        <div class="div">
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                            </div>
                                            <a href="{{ $video->link }}" class="book-title">
                                                <h4>{{ $video->title }} ({{ $video->year }})</h4>
                                                <h5>{{ $video->author }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    {{-- <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-4">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Test</h6>
                        <div class="card-options" style="margin-right:2.5%"> <a href="javascript:void(0);"
                                class="btn btn-sm btn-primary">View All</a> </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @isset($materials)
                                @foreach (array_slice($materials, 0, 4) as $material)
                                    <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                        <div class="image">
                                            <a href="{{ $material->link }}">
                                                <img src="{{ $material->img }}" alt="{{ $material->title }}"
                                                    style="filter: blur(8px); -webkit-filter: blur(10px);">
                                                <img id="img-3" src="{{ asset('materials/icon/test-lock.png') }}"
                                                    alt="{{ $video->title }}" align="middle">
                                            </a>
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                            </div>
                                            <a href="{{ $material->link }}" class="book-title">
                                                <h4>{{ $material->title }} ({{ $material->year }})</h4>
                                                <h5>{{ $material->author }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
@endsection
