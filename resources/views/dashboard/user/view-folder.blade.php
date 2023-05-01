<style>
    .vertical {
        border-left: 6px solid blue;
        height: 200px;
        position: absolute;
        /* left: 50%; */
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    @if (in_array($folder->id, $bought_folders))
                        <div class="col-12">
                        @else
                            <div class="col-10">
                    @endif
                    @isset($all_materials)
                        <div class="row">
                            @foreach ($all_materials as $material)
                                <div class="col-lg-3 col-md-3 mb-5 justify-content-center">
                                    <div class="image">
                                        <div class="ribbon-holder">
                                            @if ($material->mat_his)
                                                @if (in_array($material->mat_his->material_id, $my_materials_arr))
                                                    @foreach ($all_my_materials_arr as $all_my_materials_arr_val)
                                                        @if ($all_my_materials_arr_val->material_id == $material->mat_his->material_id)
                                                            {{-- Rented --}}
                                                            {{-- @if ($all_my_materials_arr_val->type == 'rented')
                                                            @if ($all_my_materials_arr_val->is_rent_expired == false)
                                                                <div
                                                                    class="ribbon ribbon-holder ribbon-{{ $all_my_materials_arr_val->type }}">
                                                                    {{ $all_my_materials_arr_val->type }}
                                                                </div>
                                                            @endif
                                                        @endif --}}

                                                            {{-- Bought --}}
                                                            {{-- @if ($all_my_materials_arr_val->type == 'bought')
                                                            <div
                                                                class="ribbon ribbon-holder ribbon-{{ $all_my_materials_arr_val->type }}">
                                                                {{ $all_my_materials_arr_val->type }}</div>
                                                        @endif --}}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif

                                            {{-- @if ($material->price == 'Free')
                                            <div class="ribbon ribbon-holder ribbon-free">Free</div>
                                        @endif --}}
                                            <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                data-title="{{ $material->title }}"
                                                href="{{ route('user.view_material', $material->id) }}">
                                                <img src="{{ asset($material->cover->url ?? '') }}"
                                                    alt="{{ $material->name_of_court }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mat-title">
                                        <div class="mt-2">
                                        </div>
                                        <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                            data-title="{{ $material->name_of_court }}"
                                            href="{{ route('user.view_material', $material->id) }}" class="book-title mt-2">
                                            <h4 class="text-capitalize">{{ $material->name_of_court ?? $material->title }}
                                                {{-- ({{ $material->year_of_publication }}) --}}
                                            </h4>
                                            {{-- <h5 class="text-capitalize">{{ $material->name_of_party }}</h5> --}}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endisset
                </div>
                @isset($folder)
                    @if (in_array($folder->id, $bought_folders))
                        {{-- <a href="{{ route('user.access_material', $folder->id) }}" class="btn btn-primary p-3">
                                    Access Material
                                </a> --}}
                    @else
                        <div class="col-2">
                            <div class="text-left">
                                <div class="card"
                                    style="width: fit-content; box-shadow: 0 0.76rem 1.52rem rgb(18 36 63 / 43%);">
                                    <div class="card-body">
                                        <h5><b class="font-weight-bold">Folder Details</h5>
                                        <h5><b class="font-weight-bold">Name: </b>{{ $folder->name }}</h5>
                                        <h5><b class="font-weight-bold">Amount: {{ money($folder->amount, $folder->currency_id) }}</b>
                                            /
                                            annual </h5>
                                        <h5><b class="font-weight-bold">No of Materials:
                                                {{ $folder_mat_count }}</b>
                                        </h5>
                                        <a onclick="flutterwaveBuyMaterial('{{ exchange($folder->amount, $folder->currency_id) }}', '{{ $folder->id }}', 'folder')"
                                            class="btn m-2 btn-primary p-3">
                                            Buy Folder
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                @endisset
            </div>
        </div>
    </div>
</div>
</div>
