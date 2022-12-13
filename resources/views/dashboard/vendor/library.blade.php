@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Textboooks</h6>
                        <div class="card-options" style="margin-right:2.5%"> <a href="javascript:void(0);"
                                class="btn btn-bg btn-primary p-3">Upload a Material</a> </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @isset($materials)
                                @foreach ($materials as $material)
                                    <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                        <div class="image">
                                            {{-- <div class="ribbon ribbon-top-left"><span>ribbon</span></div> --}}
                                            <div>
                                                {{-- <div class="ribbon-1 left">Rotated Ribbon</div> --}}
                                            </div>
                                            <a href="{{ route('vendor.summary', $material->id) }}">
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
        </div>
    </div>
    <script>
        function updateTextInput(val) {
            document.getElementById('textInput').value = val;
        }
    </script>
@endsection
