

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
    </style>
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10 pt-5">
                    <div class="card-header border-bottom-0 mb-4">
                        <h6 class="mb-1 mt-1 font-weight-bold h4">General Settings</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <div class="box-widget widget-user">
                                    <div class="widget-user-image1 d-xl-flex d-block">
                                        <img alt="User Avatar" class="avatar brround p-0"
                                            src="https://spruko.com/demo/azea/Azea/assets/images/users/2.jpg">
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
                                    <div class="col-sm- col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group"> <label class="form-label">Full Name</label> <input
                                                type="text" class="form-control" placeholder="First Name"
                                                value="Patrenna">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group"> <label class="form-label">Last Name</label> <input
                                                type="text" class="form-control" placeholder="Last Name" value="Schell">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group"> <label class="form-label">Email address</label> <input
                                                type="email" class="form-control" placeholder="Email"
                                                value="patrennaschell@gmail.com"> </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group"> <label class="form-label">Phone Number</label> <input
                                                type="number" class="form-control" placeholder="+234 905 678 234 "
                                                value="+(63-4567-890)"></div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <label class="form-label">Phone Number</label>
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    value="option1">
                                                <label class="form-check-label" for="inlineCheckbox1">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                    value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                                    value="option3">
                                                <label class="form-check-label" for="inlineCheckbox3">Entity</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group"> <label class="form-label">Active Subscription</label>
                                            <a href="" class="sub-link btn btn-sm btn-primary">Change</a>
                                        </div>
                                    </div>
                                <div class="col-lg-12 col-xl-12 text-center">
                                    <button class="btn btn-primary p-3 pt-2 pt-2" style="font-size: 18px">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addNewMember() {
            var card = document.createElement("div");
            card.innerHTML =
                "<div class='col-sm-12 col-md-12'><div class='form-group'><label class='form-label pt-5'></label><div class='d-flex'><div class='col-11' style='padding-left: 0px'><input type='text' class='form-control' placeholder='First Name' value='Add new team member'></div><div class='col-sm-1 col-md-1' style='display: table'><div class='add-new-member'><i class='fa fa-trash' onclick='deleteTeamMember(this)'></i></div></div></div></div></div>";

            var element = document.getElementById("teammembers");
            element.appendChild(card);
        }

        function deleteTeamMember(e) {
            console.log(e.parentNode.parentNode);
            e.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode
                .parentNode.parentNode.parentNode);
        }
    </script>
@endsection
