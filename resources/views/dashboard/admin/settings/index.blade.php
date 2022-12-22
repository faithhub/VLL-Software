@extends('layouts/dashboard/app')
@section('content')
    <style>
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        .sub-btn {
            margin-top: 3rem;
        }

        .sub-card {
            background-color: #F0F4F9
        }

        .tabs-menu-body {
            border: 0px
        }

        .richText .richText-editor {
            height: 55vh;
        }

        .richText .richText-editor:focus {
            border: 0 none #FFF !important;
            overflow: hidden !important;
            outline: none !important;
        }
    </style>
    <div class="main-container container-fluid px-0">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title">Tabs Style 3</h3>
                </div> --}}
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class=" tab-menu-heading p-0 bg-white">
                            <div class="tabs-menu1 ">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class=""><a href="#general" class="active" data-bs-toggle="tab">General</a>
                                    </li>
                                    <li><a href="#privacy" data-bs-toggle="tab" class="">Privacy</a></li>
                                    <li><a href="#materialType" data-bs-toggle="tab" class="">Material Type</a></li>
                                    <li><a href="#subjects" data-bs-toggle="tab" class="">Subjects</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="general">
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="box-widget widget-user">
                                                <div class="widget-user-image1 d-xl-flex d-block">
                                                    <img alt="User Avatar" class="avatar brround p-0"
                                                        src="https://st4.depositphotos.com/14903220/22197/v/450/depositphotos_221970610-stock-illustration-abstract-sign-avatar-icon-profile.jpg">
                                                    <div style="display: table">
                                                        <div class="mt-1 ms-xl-5 add-new-member">
                                                            <label class="btn btn-sm btn-primary m-3"><input
                                                                    type="file" />Upload</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5 settings">
                                            <form>
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="form-group"> <label class="form-label">Email
                                                                address</label>
                                                            <input type="email" class="form-control" placeholder="Email"
                                                                value="patrennaschell@gmail.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="form-group"> <label class="form-label">Phone
                                                                Number</label>
                                                            <input type="number" class="form-control"
                                                                placeholder="+234 905 678 234 " value="+(63-4567-890)">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="form-group"> <label class="form-label">Aiternate Email
                                                                Address</label>
                                                            <input type="email" class="form-control" placeholder="Email"
                                                                value="patrennaschell@gmail.com">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <h4 class="font-weight-semibold mb-4">Social Media</h4>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="form-group"> <label class="form-label">Instagram</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Instagram" value="Instagram">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="form-group"> <label class="form-label">Linkedin</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Linkedin" value="Linkedin">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="form-group"> <label class="form-label">Facebook</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Facebook" value="Facebook">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="form-group"> <label class="form-label">Twitter</label>
                                                            <input type="text" class="form-control" placeholder="Twitter"
                                                                value="Twitter">
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Bank Namee</label>
                                                        <select class="form-control" name="bank" id="search"
                                                            data-parsley-required-message="The Bank is required"
                                                            data-placeholder="Select your Bank">
                                                            @isset($banks)
                                                                @foreach ($banks as $bank)
                                                                    <option data-value="{{ $bank->id }}"
                                                                        value="{{ $bank->id }}"
                                                                        @if (old('form_type') == 'vendor') {{ old('bank') == $bank->id ? 'selected' : '' }} @endif>
                                                                        {{ $bank->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endisset
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Bank Account
                                                            Number</label>
                                                        <input type="number" class="form-control" placeholder=""
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group"> <label class="form-label">Bank Account
                                                            Name</label>
                                                        <input type="" class="form-control" placeholder=""
                                                            value="">
                                                    </div>
                                                </div> --}}
                                                </div>
                                                <div class="col-lg-12 col-xl-12 text-center mt-4">
                                                    <button class="btn btn-primary p-3 pt-2 pt-2"
                                                        style="font-size: 18px">Save
                                                        Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="privacy">
                                    <textarea class="content richText-initial" name="example" style="display: none;">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur mauris in ante accumsan quisque venenatis. Porttitor urna ut ornare cras consectetur leo senectus. Aliquet vitae risus mi tortor. Diam, nec lorem ante eget vitae.
                                        Volutpat pretium neque amet enim. Amet nulla et in nisl enim. Leo sodales varius a odio varius sit ornare. At dignissim purus posuere non. Metus gravida pellentesque leo a elit leo enim in. Ante venenatis, cras integer congue lectus in dignissim nisi. Elit sapien convallis arcu et viverra ornare sit etiam. Adipiscing at enim ut euismod. Condimentum accumsan tellus ut nunc, nibh non tellus. Viverra pellentesque tortor, cursus eu dictum massa nulla nunc, viverra. Integer ipsum sollicitudin commodo quis ultrices sit nisl eros. Aenean urna pellentesque pharetra netus nisl enim. Quam mauris id integer ac nisl facilisi lectus phasellus. Augue sit et massa, ultrices posuere tincidunt elit venenatis.
                                        Ornare vel aliquet in ut massa. Morbi id pellentesque ac, est sit ultricies dui, cras. Id non amet cras sagittis erat quam. Posuere diam viverra sit fermentum. Eu, sit accumsan, lacus justoPurus tristique gravida accumsan nisl tincidunt. Maecenas in.
                                        </textarea>
                                    <div class="col-lg-12 col-xl-12 text-center mt-4">
                                        <button class="btn btn-primary p-3 pt-2 pt-2" style="font-size: 18px">Save
                                            Changes</button>
                                    </div>
                                </div>
                                <div class="tab-pane" id="materialType">
                                    <div class="card border-0" style="box-shadow:none">
                                        <div class="card-header border-bottom-0">
                                            <div class="card-options" style="margin-right:2.5%">
                                                <button data-bs-effect="effect-scale" data-bs-toggle="modal"
                                                    data-bs-target="#addNewMaterial" class="btn btn-bg btn-primary p-3"><b>+
                                                        Add New Material</b></button>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <div id="datatable_wrapper"
                                                    class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table
                                                                class="table table-bordere card-table table-vcenter dataTable no-footer"
                                                                id="" role="grid">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting sorting_asc" style="width:20%">
                                                                            Type of Material</th>
                                                                        <th scope="row" class="sorting"
                                                                            style="width:70%">Description</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            style="width:10%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Textbook</td>
                                                                        <td>Lorem ipsum dolor sit amet, consectetur
                                                                            adipiscing elit. Nec varius ut fermentum, duis a
                                                                            viverra sed condimentum. Scelerisque parturient
                                                                            et nunc sollicitudin. Sed quis malesuada elit,
                                                                            tortor nisl.</td>
                                                                        <td>
                                                                            <a class="p-2"  href=""><i
                                                                                    class="fa fa-trash"></i></a>
                                                                            <a class="p-2"  href=""><i
                                                                                    class="fa fa-edit"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    @isset($materials)
                                                                        @foreach ($materials as $material)
                                                                            <tr class="">
                                                                                <td class="sorting_1">{{ $sn++ }}</td>
                                                                                <td class="sorting_1">
                                                                                    <img src="{{ $material->img }}"
                                                                                        style="max-height:60px">
                                                                                </td>
                                                                                <td class="sorting_1"><a
                                                                                        class="font-weight-bold"
                                                                                        href="">{{ $material->title }}</a>
                                                                                </td>
                                                                                <td>{{ $material->type ?? '-' }}</td>
                                                                                <td>{{ $material->author }}</td>
                                                                                <td>{{ $material->vendor ?? '-' }}</td>
                                                                                <td>{{ $material->desc ?? '-' }}</td>
                                                                                <td>₦{{ number_format($material->price ?? 0, 2) }}
                                                                                </td>
                                                                                <td><a class="font-weight-bold"
                                                                                        href="{{ $material->link }}">{{ $material->title }}.pdf</a>
                                                                                </td>
                                                                                <td>
                                                                                    <a href=""><i
                                                                                            class="fa fa-trash"></i></a></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endisset
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="subjects">
                                    <div class="card border-0" style="box-shadow:none">
                                        <div class="card-header border-bottom-0">
                                            <div class="card-options" style="margin-right:2.5%">
                                                <button data-bs-effect="effect-scale" data-bs-toggle="modal"
                                                    data-bs-target="#addNewSubject" class="btn btn-bg btn-primary p-3"><b>+
                                                        Add New Type</b></button>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <div id="datatable_wrapper"
                                                    class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table
                                                                class="table table-bordere card-table table-vcenter dataTable no-footer"
                                                                id="" role="grid">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting sorting_asc" style="width:20%">
                                                                            Type of Subjects</th>
                                                                        <th scope="row" class="sorting"
                                                                            style="width:70%">Description</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            style="width:10%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Civil Law</td>
                                                                        <td>Lorem ipsum dolor sit amet, consectetur
                                                                            adipiscing elit. Nec varius ut fermentum, duis a
                                                                            viverra sed condimentum. Scelerisque parturient
                                                                            et nunc sollicitudin. Sed quis malesuada elit,
                                                                            tortor nisl.</td>
                                                                        <td>
                                                                            <a class="p-2" href=""><i
                                                                                    class="fa fa-trash"></i></a>
                                                                            <a class="p-2" href=""><i
                                                                                    class="fa fa-edit"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    @isset($materials)
                                                                        @foreach ($materials as $material)
                                                                            <tr class="">
                                                                                <td class="sorting_1">{{ $sn++ }}</td>
                                                                                <td class="sorting_1">
                                                                                    <img src="{{ $material->img }}"
                                                                                        style="max-height:60px">
                                                                                </td>
                                                                                <td class="sorting_1"><a
                                                                                        class="font-weight-bold"
                                                                                        href="">{{ $material->title }}</a>
                                                                                </td>
                                                                                <td>{{ $material->type ?? '-' }}</td>
                                                                                <td>{{ $material->author }}</td>
                                                                                <td>{{ $material->vendor ?? '-' }}</td>
                                                                                <td>{{ $material->desc ?? '-' }}</td>
                                                                                <td>₦{{ number_format($material->price ?? 0, 2) }}
                                                                                </td>
                                                                                <td><a class="font-weight-bold"
                                                                                        href="{{ $material->link }}">{{ $material->title }}.pdf</a>
                                                                                </td>
                                                                                <td>
                                                                                    <a href=""><i
                                                                                            class="fa fa-trash"></i></a></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endisset
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade effect-scale" id="addNewMaterial" tabindex="-1" aria-labelledby="addNewMaterialLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="card border-10 pt-2 card-primary">
                                <div class="card-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Material Type</label>
                                                    <input type="text" class="form-control" placeholder="Material Type"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-xl-12 text-center mt-1">
                                            <button class="btn btn-primary p-3" style="font-size: 15px">Add New</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade effect-scale" id="addNewSubject" tabindex="-1" aria-labelledby="addNewSubjectLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="card border-10 pt-2 card-primary">
                                <div class="card-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Subject Type</label>
                                                    <input type="text" class="form-control" placeholder="Subject Type"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-xl-12 text-center mt-1">
                                            <button class="btn btn-primary p-3" style="font-size: 15px">Add New</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
