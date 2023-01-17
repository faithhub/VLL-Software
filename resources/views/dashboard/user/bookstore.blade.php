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

                    @isset($all_materials3)
                        @foreach ($all_materials3 as $materials_types)
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-header border-bottom-0 mb-4">
                                        <h6 class="mb-1 mt-1 font-weight-bold h3">{{ $materials_types[0]['type']['name'] }}</h6>
                                        <div class="card-options" style="margin-right:2.5%"> <a
                                                href="{{ route('user.view_material_type', $materials_types[0]['type']['id']) }}"
                                                class="btn btn-sm btn-primary">View All</a> </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            @isset($materials_types)
                                                @foreach ($materials_types->groupBy('folder_id') as $key => $materiall)
                                                    @isset($materiall[0]->folder)
                                                        @if (in_array($key, $limit_folder))
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
                                                        @endif
                                                    @else
                                                        @foreach ($materiall as $key => $material)
                                                        @if (in_array($key, $limit_mat))
                                                                @if(substr($material->type->mat_unique_id, 0, 3) == "TAA")
                                                                @if($material->university_id == Auth::user()->university_id)
                                                                                     <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                                                @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                                                    <div class="image">
                                                                        <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                            data-title="{{ $material->title }}"
                                                                            href="{{ route('user.view_material', $material->id) }}">
                                                                            <img src="{{ asset($material->cover->url) }}"
                                                                                alt="{{ $material->title }}" width="100%"
                                                                                height="auto">
                                                                            <img id="img-2"
                                                                                src="{{ asset('materials/icon/v-play.png') }}"
                                                                                alt="{{ $material->title }}" align="middle"
                                                                                style="color: black">
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div class="image">
                                                                        <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                            data-title="{{ $material->title }}"
                                                                            href="{{ route('user.view_material', $material->id) }}">
                                                                            <img src="{{ asset($material->cover->url) }}"
                                                                                alt="{{ $material->title }}">
                                                                        </a>
                                                                    </div>
                                                                @endif
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
                                                                        <h5 class="text-capitalize">{{ $material->name_of_author }}
                                                                        </h5>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                                @endif
                                                                @else
                                                                                     <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                                                @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                                                    <div class="image">
                                                                        <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                            data-title="{{ $material->title }}"
                                                                            href="{{ route('user.view_material', $material->id) }}">
                                                                            <img src="{{ asset($material->cover->url) }}"
                                                                                alt="{{ $material->title }}" width="100%"
                                                                                height="auto">
                                                                            <img id="img-2"
                                                                                src="{{ asset('materials/icon/v-play.png') }}"
                                                                                alt="{{ $material->title }}" align="middle"
                                                                                style="color: black">
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div class="image">
                                                                        <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                            data-title="{{ $material->title }}"
                                                                            href="{{ route('user.view_material', $material->id) }}">
                                                                            <img src="{{ asset($material->cover->url) }}"
                                                                                alt="{{ $material->title }}">
                                                                        </a>
                                                                    </div>
                                                                @endif
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
                                                                        <h5 class="text-capitalize">{{ $material->name_of_author }}
                                                                        </h5>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                                @endif
                                                        @endif
                                                    @endforeach
                                                @endisset
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset

            </div>
        </div>
    </div>


    {{-- <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-4">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Journals and Articles</h6>
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
                                                <img src="{{ $material->img }}" alt="{{ $material->title }}">
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
