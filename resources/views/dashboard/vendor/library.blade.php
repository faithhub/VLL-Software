@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <div class="card-options" style="margin-left:2.5%">
                            <select class="form-control select2" style="min-width: 10% !important">
                                @isset($material_types)
                                    @foreach ($material_types as $type)
                                        <option>{{ $type->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="card-options" style="margin-right:2.5%"> <a href="{{ route('vendor.upload') }}"
                                class="btn btn-bg btn-primary p-3"><i class="fa fa-upload"></i>&nbsp&nbspUpload a
                                Material</a> </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @isset($all_materials)
                                @foreach ($all_materials as $material)
                                    <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                        <div class="image">
                                            <a onclick="shiNew(event)" data-type="dark" data-size="l"
                                                data-title="{{ $material->title }}"
                                                href="{{ route('vendor.view_material', $material->id) }}">
                                                <img src="{{ $material->cover->url }}" alt="{{ $material->title }}">
                                            </a>
                                        </div>
                                        <div class="mat-title">
                                            <div class="mt-2">
                                            </div>
                                            <a onclick="shiNew(event)" data-type="dark" data-size="l"
                                                data-title="{{ $material->title }}"
                                                href="{{ route('vendor.view_material', $material->id) }}" class="book-title">
                                                <h4>{{ $material->title }} ({{ $material->year_of_publication }})</h4>
                                                <h5>{{ $material->name_of_author }}</h5>
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
