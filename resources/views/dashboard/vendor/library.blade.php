@extends('layouts/dashboard/app')
@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            background-color: red
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <div class="card-options" style="margin-left:2.5%">
                            <form method="GET" id="selectMaterialForm" action="">
                                <select class="form-control select2" onchange="selectMat()" name="mat_unique_id"
                                    id="selectMaterial" style="min-width: 10% !important">
                                    <option value="all">All</option>
                                    @isset($material_types)
                                        @foreach ($material_types as $type)
                                            <option value="{{ $type->mat_unique_id }}"
                                              @selected(Request::get('mat_unique_id') == $type->mat_unique_id)>{{ $type->name }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                            </form>
                        </div>
                        <div class="card-options" style="margin-right:2.5%"> <a href="{{ route('vendor.upload') }}"
                                class="btn btn-bg btn-primary p-3"><i class="fa fa-upload"></i>&nbsp&nbspUpload a
                                Material</a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        @isset($mt)
                            <div class="card-header border-bottom-0 m">
                                <div class="d-flex">
                                    <div class="media mb-5">
                                        <div class="media-body">
                                            <h6 class="mb-1 mt-1 font-weight-bold h3">{{ $mt->name ?? '' }}</h6>
                                            <small class="h5">{{ $all_materials->count() }} Material(s) found</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                        <div class="row">
                            @isset($all_materials)
                                @foreach ($all_materials->groupBy('folder_id') as $materiall)
                                    @isset($materiall[0]->folder)
                                        <div class="col-lg-3 col-md-4 mb-5 justify-content-center">
                                            <div class="image">
                                                <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                    data-title="{{ $materiall[0]['folder']['name'] }}"
                                                    href="{{ route('vendor.view_folder', $materiall[0]['folder']['id']) }}">
                                                    <img src="{{ $materiall[0]['folder']['folder_cover']['url'] }}" class="mat_img"
                                                        alt="{{ $materiall[0]['folder']['name'] }}">
                                                </a>
                                            </div>
                                            <div class="mat-title">
                                                <div class="mt-2">
                                                </div>
                                                <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                    data-title="{{ $materiall[0]['folder']['name'] }}"
                                                    href="{{ route('vendor.view_folder', $materiall[0]['folder']['id']) }}"
                                                    class="book-title mt-2">
                                                    <h4 class="text-capitalize">{{ $materiall[0]['folder']['name'] }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($materiall as $material)
                                            <div class="col-lg-3 col-md-4 mb-5 justify-content-center">
                                                <div class="image">
                                                    <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                        data-title="{{ $material->title }}"
                                                        href="{{ route('vendor.view_material', $material->id) }}">
                                                        <img src="{{ $material->cover->url ??  "images/new-meeting.png" }}" alt="{{ $material->title }}" class="mat_img">

                                                            @if (substr($material->type->mat_unique_id, 0, 3) == 'VAA')
                                                                <img id="video-bookstore-cover"
                                                                    src="{{ asset('materials/icon/v-play.png') }}"
                                                                    alt="{!! $material->title[0] !!}" align="middle"
                                                                    style="color: black">
                                                            @endif
                                                    </a>
                                                </div>
                                                <div class="mat-title">
                                                    <div class="mt-2">
                                                    </div>
                                                    <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                        data-title="{{ $material->title }}"
                                                        href="{{ route('vendor.view_material', $material->id) }}"
                                                        class="book-title mt-2">
                                                        <h4 class="text-capitalize">{{ $material->title }}
                                                            ({{ $material->year_of_publication }})
                                                        </h4>
                                                        <h5 class="text-capitalize">{{ $material->name_of_author }}</h5>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endisset
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // $(document).ready(function() {
        //     $("#selectMaterial").change(function() {
        //     }).change();
        // });

        function selectMat() {
            $('form#selectMaterialForm').submit();
        }
    </script>
@endsection
