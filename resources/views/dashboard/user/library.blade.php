@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0">
                        <div class="d-flex">
                            <div class="media mt-5">
                                <div class="media-body">
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Hello {{ Auth::user()->name ?? 'Daniel' }},
                                    </h6>
                                    <small class="h4">Let’s read some books</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        <div class="row">
                            @isset($materials)
                                @foreach ($materials as $key => $material)
                                    <div class="col-lg-4 col-md-4 mb-5 justify-content-center">
                                        <div class="image image_big_div">
                                            <div class="ribbon-holder">
                                                @if ($material->mat_his_type == 'rented')
                                                    @if ($material->is_rent_expired == false)
                                                        <div class="ribbon ribbon-holder ribbon-{{ $material->mat_his_type }}">
                                                            {{ $material->mat_his_type }}</div>
                                                    @endif
                                                @endif
                                                @if ($material->mat_his_type == 'bought' || $material->mat_his_type == 'free')
                                                    <div class="ribbon ribbon-holder ribbon-{{ $material->mat_his_type }}">
                                                        {{ $material->mat_his_type }}</div>
                                                @endif
                                                <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                    data-title="{{ $material->title }}"
                                                    href="{{ route('user.view_material', $material->id) }}">
                                                    <img src="{{ asset($material->mat_cover) }}" alt="{{ $material->title }}"
                                                        class="mat_img">

                                                    @if (substr($material->mat_unique_id, 0, 3) == 'VAA')
                                                        <img id="video-bookstore-cover"
                                                            src="{{ asset('materials/icon/v-play.png') }}"
                                                            alt="{{ $material->title }}" align="middle" style="color: black">
                                                    @endif
                                                </a>
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
                                @endforeach
                            @endisset

                            @isset($master_classes)
                                @foreach ($master_classes as $key => $material)
                                    <div class="col-lg-4 col-md-4 mb-5 justify-content-center">
                                        <div class="image image_big_div">
                                            <div class="ribbon-holder">
                                                {{-- @dump($material) --}}
                                                @if ($material->class_his->type == 'bought' || $material->class_his->type == 'free')
                                                    <div class="ribbon ribbon-holder ribbon-{{ $material->class_his->type }}">
                                                        {{ $material->class_his->type }}</div>
                                                @endif
                                                <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                    data-title="{{ $material->title }}"
                                                    href="{{ route('user.view_class', $material->id) }}">
                                                    <img src="{{ route('image.private', $material->cover->name ?? '') }}"
                                                        alt="{{ $material->title }}" class="mat_img">
                                                </a>
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
                                                    {{-- ({{ $material->year_of_publication }}) --}}
                                                </h4>
                                                {{-- <h5 class="text-capitalize">
                                                    {{ $material->name_of_author }}
                                                </h5> --}}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                @isset($master_classes)
                                                    @foreach ($master_classes as $key => $material)
                                                        <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                                            <div class="image image_big_div">
                                                                <div class="ribbon-holder">
                                                                    @if ($material->class_his)
                                                                        @if (in_array($material->class_his->class_id, $my_classes_arr))
                                                                            @foreach ($all_classes_arr as $all_classes_arr_val)
                                                                                @if ($all_classes_arr_val->class_id == $material->class_his->class_id)
                                                                                    @if ($all_classes_arr_val->type == 'bought')
                                                                                        <div
                                                                                            class="ribbon ribbon-holder ribbon-{{ $all_classes_arr_val->type }}">
                                                                                            {{ $all_classes_arr_val->type }}
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
                                                                    <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                        data-title="{{ $material->title }}"
                                                                        href="{{ route('user.view_class', $material->id) }}">
                                                                        <img src="{{ route('image.private', $material->cover->name ?? '') }}"
                                                                            alt="{{ $material->title }}" class="mat_img">
                                                                </div>
                                                            </div>
                                                            <div class="mat-title">
                                                                <div class="mt-2">
                                                                </div>
                                                                <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                                    data-title="{{ $material->title }}"
                                                                    href="{{ route('user.view_class', $material->id) }}"
                                                                    class="book-title mt-2">
                                                                    <h4 class="text-capitalize">{{ $material->title }}</h4>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endisset
                                            </div>
                                        </div>
                                    </div> --}}
                            @endisset
                            @isset($folders)
                                @foreach ($folders as $key => $folder)
                                    <div class="col-lg-4 col-md-2 mb-2 justify-content-center">
                                        <div class="image image_big_div">
                                            <div class="ribbon-holder">
                                                @if (in_array($folder->id, $bought_folders))
                                                    <div class="ribbon ribbon-holder ribbon-bought">Bought</div>
                                                @endif
                                                @if (in_array($folder->id, $free_folders))
                                                    <div class="ribbon ribbon-holder ribbon-bought">Free</div>
                                                @endif
                                                <a onclick="shiNew(event)" data-type="dark" data-size="l"
                                                    data-title="{{ $folder->name }}"
                                                    href="{{ route('user.view_folder', $folder->id) }}">
                                                    <img src="{{ asset($folder->folder_cover->url) }}"
                                                        alt="{{ $folder->title }}" class="mat_img">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                            </div>
                                            <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                data-title="{{ $folder->name }}"
                                                href="{{ route('user.view_folder', $folder->id) }}" class="book-title mt-2">
                                                <h4 class="text-capitalize">{{ $folder->name }}</h4>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card text-card">
                    <div class="card-header border-bottom-0 mt-3 text-white">
                        <h3 class="card-title font-weight-bold h2">Notes</h3>
                        <div class="card-options">
                            <a href="{{ route('user.notes') }}" class="btn btn-sm font-weight-bold text-white">View All</a>
                        </div>
                    </div>
                    <div class="card-body p-0 card-margin">
                        @isset($notes)
                            @if ($notes->count() > 0)
                                @foreach ($notes as $note)
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header border-bottom-0">
                                                <h4 class="card-title font-weight-bold h2" style="text-transform:initial;">
                                                </h4>
                                                <div class="card-options">
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-sm font-weight-bold">{{ $note->created_at->format('D j, Y') }}</a>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                    data-title="{{ $note->title }}"
                                                    href="{{ route('user.note', $note->id) }}">
                                                    <h4 class="font-weight-bold h5">{{ $note->title ?? '' }}</h4>
                                                </a>
                                                <p>
                                                    {{ mb_strimwidth($note->content ?? '', 0, 50, '...') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center pb-2 text-white">
                                    <h4>No notes available yet</h4>
                                </div>
                            @endif
                        @endisset
                    </div>
                </div>
                @unless (Auth::user()->user_type == 'professionals')
                    {{-- <div class="card text-card">
                        <div class="card-header border-bottom-0 mt-3 text-white">
                            <h3 class="card-title font-weight-bold h2">Test</h3>
                            <div class="card-options">
                                <a href="javascript:void(0);" class="btn btn-sm font-weight-bold text-white">View All</a>
                            </div>
                        </div>
                        <div class="card-body p-0 card-margin">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header border-bottom-0 pb-1">
                                        <div class="media mt-1 mb-2">
                                            <div class="media-body">
                                                <h6 class="mb-0 mt-1 font-weight-bold">
                                                    Introduction to Business Law
                                                </h6>
                                                <small class="h6 fw-bold">60 Questions</small>
                                            </div>
                                        </div>
                                        <div class="card-options">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-primary font-weight-bold">Start
                                                Test</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header border-bottom-0 pb-1">
                                        <div class="media mt-1 mb-2">
                                            <div class="media-body">
                                                <h6 class="mb-0 mt-1 font-weight-bold">
                                                    Introduction to Business Law
                                                </h6>
                                                <small class="h6 fw-bold">60 Questions</small>
                                            </div>
                                        </div>
                                        <div class="card-options">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-primary font-weight-bold">Start
                                                Test</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                @endunless
            </div>
        </div>
    </div>
    <script>
        function updateTextInput(val) {
            document.getElementById('textInput').value = val;
        }
    </script>
@endsection
