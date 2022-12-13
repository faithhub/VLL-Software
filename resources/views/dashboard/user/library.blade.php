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
                    <div class="card-body pt-0">
                        <div class="row">
                            @isset($materials)
                                @foreach ($materials as $material)
                                    <div class="col-lg-4 col-md-4 mb-5 justify-content-center">
                                        <div class="image">
                                            {{-- <div class="ribbon ribbon-top-left"><span>ribbon</span></div> --}}
                                            <div>
                                                {{-- <div class="ribbon-1 left">Rotated Ribbon</div> --}}
                                            </div>
                                            <a href="{{ route('user.view', $material->id) }}">
                                                <img src="{{ $material->img }}" alt="{{ $material->title }}">
                                            </a>
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                                {{-- <input type="range" class="range-input" name="rangeInput" min="0"
                                                    max="100" value="20" disabled>
                                                <input type="text" id="textInput" value="">

                                                <input type="range" min="1" max="100" value="50"
                                                    class="slider" id="myRange">
                                                    <input type="range" class="form-range" id="customRange1" value="30"
                                                    disabled> --}}

                                                {{-- <div class="d-flex book-con">
                                                    <div class="loader-con">
                                                        <div class="book-pages-loader newww"></div>
                                                    </div>
                                                    <span class="book-count">45/78</span>
                                                </div> --}}
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
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card text-card">
                    <div class="card-header border-bottom-0 mt-3 text-white">
                        <h3 class="card-title font-weight-bold h2">Notes</h3>
                        <div class="card-options">
                            <a href="javascript:void(0);" class="btn btn-sm font-weight-bold text-white">View All</a>
                        </div>
                    </div>
                    <div class="card-body p-0 card-margin">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom-0 pb-1">
                                    <h4 class="card-title font-weight-bold h2" style="text-transform:initial;">Note One</h4>
                                    <div class="card-options">
                                        <a href="javascript:void(0);" class="btn btn-sm font-weight-bold">05 May</a>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <h4 class="font-weight-bold h5">The Introduction to Business Law</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et eu, donec aliquet cras
                                        id purus nibh. Diam, sapien dignissim massa risus magna massa, nunc hendrerit
                                        mauris. Ut sed vulputate sed bibendum.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom-0 pb-1">
                                    <h4 class="card-title font-weight-bold h2" style="text-transform:initial;">Note One</h4>
                                    <div class="card-options">
                                        <a href="javascript:void(0);" class="btn btn-sm font-weight-bold">05 May</a>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <h4 class="font-weight-bold h5">The Introduction to Business Law</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et eu, donec aliquet cras
                                        id purus nibh. Diam, sapien dignissim massa risus magna massa, nunc hendrerit
                                        mauris. Ut sed vulputate sed bibendum.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom-0 pb-1">
                                    <h4 class="card-title font-weight-bold h2" style="text-transform:initial;">Note One</h4>
                                    <div class="card-options">
                                        <a href="javascript:void(0);" class="btn btn-sm font-weight-bold">05 May</a>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <h4 class="font-weight-bold h5">The Introduction to Business Law</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et eu, donec aliquet cras
                                        id purus nibh. Diam, sapien dignissim massa risus magna massa, nunc hendrerit
                                        mauris. Ut sed vulputate sed bibendum.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card text-card">
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

