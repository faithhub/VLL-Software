@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0">
                        {{-- <div class="d-flex">
                            <h3 class="card-title bit-text">Hello {{ Auth::user()->name ?? 'Daniel' }}</h3><br>
                            <h3 class="card-title sm-text">Hello {{ Auth::user()->name ?? 'Daniel' }}</h3>
                        </div> --}}
                        <div class="d-flex">
                            <div class="media mt-5">
                                <div class="media-body">
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Hello {{ Auth::user()->name ?? 'Daniel' }},
                                    </h6>
                                    <small class="h4">Let’s read some books</small>
                                </div>
                            </div>
                            {{-- <div class="ms-auto">
                                <div class="dropdown"> <a class="pro-option" href="JavaScript:void(0);"
                                        data-bs-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);">Edit Post</a> <a
                                            class="dropdown-item" href="javascript:void(0);">Delete Post</a> <a
                                            class="dropdown-item" href="javascript:void(0);">Personal Settings</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        <div class="row">
                            @isset($materials)
                                @foreach ($materials as $key => $material)
                                    {{-- @if ($material->type->mat_unique_id == 'CSL786746357')
                                        @foreach ($material->groupBy('folder_id') as $key => $material_csl)
                                            @isset($material_csl[0]->folder)
                                                @if (in_array($key, $limit_folder))
                                                    <div class="col-l4 col-md-4 mb-5 justify-content-center">
                                                        <div class="image">
                                                            <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                                data-title="{{ $material_csl[0]['folder']['name'] }}"
                                                                href="{{ route('user.view_folder', $material_csl[0]['folder']['id']) }}">
                                                                <img src="{{ asset($material_csl[0]['folder']['folder_cover']['url']) }}"
                                                                    alt="{{ $material_csl[0]['folder']['name'] }}">
                                                            </a>
                                                        </div>
                                                        <div class="mat-title">
                                                            <div class="mt-2">
                                                            </div>
                                                            <a onclick="shiNew(event)" data-type="dark" data-size="xl"
                                                                data-title="{{ $material_csl[0]['folder']['name'] }}"
                                                                href="{{ route('user.view_folder', $material_csl[0]['folder']['id']) }}"
                                                                class="book-title mt-2">
                                                                <h4 class="text-capitalize">
                                                                    {{ $material_csl[0]['folder']['name'] }}
                                                                </h4>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endisset
                                        @endforeach
                                    @else --}}
                                    <div class="col-lg-4 col-md-4 mb-5 justify-content-center">
                                        <div class="image">
                                            <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                data-title="{{ $material->title }}"
                                                href="{{ route('user.view_material', $material->id) }}">
                                                <img src="{{ asset($material->cover->url) }}" alt="{{ $material->title }}"
                                                    class="mat_img">
                                            </a>
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                            </div>
                                            <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                data-title="{{ $material->title }}"
                                                href="{{ route('user.view_material', $material->id) }}" class="book-title mt-2">
                                                <h4 class="text-capitalize">{{ $material->title }}
                                                    ({{ $material->year_of_publication }})
                                                </h4>
                                                <h5 class="text-capitalize">
                                                    {{ $material->name_of_author }}
                                                </h5>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                @endforeach
                            @endisset
                            {{-- @isset($materials)
                                @foreach ($materials as $material)
                                    <div class="col-lg-4 col-md-4 mb-5 justify-content-center">
                                        <div class="image">
                                            <div class="ribb/on ribbon-top-left"><span>ribbon</span></div>
                                            <div>
                                                <div class="ribbon-1 left">Rotated Ribbon</div>
                                            </div>
                                            <a href="{{ route('user.view', $material->id) }}">
                                                <img src="{{ $material->img }}" alt="{{ $material->title }}">
                                            </a>
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                                <input type="range" class="range-input" name="rangeInput" min="0"
                                                    max="100" value="20" disabled>
                                                <input type="text" id="textInput" value="">

                                                <input type="range" min="1" max="100" value="50"
                                                    class="slider" id="myRange">
                                                    <input type="range" class="form-range" id="customRange1" value="30"
                                                    disabled>

                                                <div class="d-flex book-con">
                                                    <div class="loader-con">
                                                        <div class="book-pages-loader newww"></div>
                                                    </div>
                                                    <span class="book-count">45/78</span>
                                                </div>
                                            </div>
                                            <a href="{{ $material->link }}" class="book-title">
                                                <h4>{{ $material->title }} ({{ $material->year }})</h4>
                                                <h5>{{ $material->author }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card text-card">
                    <div class="card-header border-bottom-0 mt-3 text-white">
                        <h3 class="card-title font-weight-bold h2">Notes</h3>
                        <div class="card-options">
                            <a href="javascript:void(0);" class="btn btn-sm font-weight-bold text-white">View All</a>
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
                                                <a href="javascript:void(0);" class="btn btn-sm font-weight-bold">{{ $note->created_at->format('D j, Y') }}</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <h4 class="font-weight-bold h5">{{ $note->title ?? "" }}</h4>
                                            <p>
                                               {{ $note->content ?? "" }}
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
                @unless(Auth::user()->user_type == 'professionals')
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
