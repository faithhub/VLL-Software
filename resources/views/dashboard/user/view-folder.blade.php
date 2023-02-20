<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    @isset($all_materials)
                        @foreach ($all_materials as $material)
                            <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                <div class="image">
                                    <div class="ribbon-holder">
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
                                        <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                            data-title="{{ $material->title }}"
                                            href="{{ route('user.view_material', $material->id) }}">
                                            <img src="{{ asset($material->cover->url) }}" alt="{{ $material->title }}">
                                        </a>
                                    </div>
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
