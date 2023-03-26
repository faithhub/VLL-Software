<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
                <h6><b>{{$all_materials->count()}} Material(s)</b></h6>
            <div class="card-body">
                <div class="row">
                    @isset($all_materials)
                        @foreach ($all_materials as $material)
                            <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                <div class="image">
                                    <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                        data-title="{{ $material->title }}"
                                        href="{{ route('admin.view_material', $material->id) }}">
                                        <img src="{{ asset($material->cover->url ?? "") }}" alt="{{ $material->title }}">
                                    </a>
                                </div>
                                <div class="mat-title">
                                    <div class="mt-2">
                                    </div>
                                    <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                        data-title="{{ $material->title }}"
                                        href="{{ route('admin.view_material', $material->id) }}" class="book-title mt-2">
                                        <h4 class="text-capitalize">{{ $material->title }}
                                            ({{ $material->year_of_publication }})
                                        </h4>
                                        <h5 class="text-capitalize">{{ $material->name_of_author }}</h5>
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
