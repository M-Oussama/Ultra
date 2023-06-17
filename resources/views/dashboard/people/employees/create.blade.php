@extends('layouts.dashboard')

@section('page_meta')
    <title>Create employee</title>
    <meta name="keywords" content="Rozaric"/>
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->
@endsection

@section('scripts')
    <!-- Page scripts -->
    <script>
        //Password check


        //Image uploader
        var avatar = new KTImageInput('kt_avatar');

        //Select2
                $('#kt_select2_1').select2();

    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">employees</h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="post" action="dash/employees" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="image-input image-input-empty image-input-outline d-contents" id="kt_avatar"
                                 style="background-image: url(assets/media/users/blank.png);margin-left: 36%;">
                                <div class="image-input-wrapper"></div>

                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" autocomplete="photo"/>
                                    <input type="hidden" name="avatar_remove"/>
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            <span class="form-text text-muted" style="margin-left: 27%;">Allowed file types: png, jpg, jpeg.</span>
                        </div>

                        <div class="col-sm-12 col-md-6 row">
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Name* :</label>
                                <input type="text" name="name" value="{{old('name',$employee->name)}}" autocomplete="family-name"
                                       class="form-control form-control-solid" placeholder="Enter user name" required/>
                                <span class="form-text text-muted">Please enter the employees's name</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Surname* :</label>
                                <input type="text" name="surname" value="{{old('surname',$employee->surname)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter user surname"
                                       required/>
                                <span class="form-text text-muted">Please enter the employees's surname</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>address* :</label>
                                <input type="text" name="address" value="{{old('address',$employee->address)}}"  autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter the address of the employee"
                                       required/>
                                <span class="form-text text-muted">Please enter the address of the employees</span>
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <label>Birthdate* :</label>
                                <input type="date" id="birthdate" name="birthdate"
                                       class="form-control form-control-solid"  value="{{old('birthdate',$employee->birthdate)}}"
                                       placeholder="Please enter Birthdate" required/>
                                <span class="form-text text-muted">Please enter Birthdate</span>
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <label>Birth Place* :</label>
                                <input type="text" name="birthplace" value="{{old('birthplace',$employee->birthplace)}}"
                                       class="form-control form-control-solid" placeholder="Enter Birth Place"
                                       required/>
                                <span class="form-text text-muted">Please enter Birth Place</span>
                            </div>

                        </div>

                        <div class="col-sm-12 col-md-12 row">

                            <div class="form-group col-sm-6 col-md-6">
                                <label>Nationale Card Number* :</label>
                                <input type="text" name="NCN" value="{{old('NCN',$employee->NCN)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter Nationale Card Number"
                                        />
                                <span class="form-text text-muted">Please enter the employees's Nationale Card Number</span>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label>National identification number* :</label>
                                <input type="text" name="NIN" value="{{old('NIN',$employee->NIN)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter National identification number"
                                        />
                                <span class="form-text text-muted">Please enter the employees's National identification number</span>
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                                <label>National Card Issue date* :</label>
                                <input type="date" id="card_issue_date" name="card_issue_date"
                                       class="form-control form-control-solid" value="{{old('card_issue_date',$employee->card_issue_date)}}"
                                       placeholder="Please enter National Card Issue date" required/>
                                <span class="form-text text-muted">Please enter National Card Issue date</span>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label>National Card issue Place* :</label>
                                <input type="text" name="card_issue_place" value="{{old('card_issue_place',$employee->card_issue_place)}}"
                                       class="form-control form-control-solid" placeholder="Enter National Card issue Place"
                                />
                                <span class="form-text text-muted">Please enter National Card issue Place</span>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label>CNAS NUMBER* :</label>
                                <input type="text" name="CNAS" value="{{old('CNAS',$employee->CNAS)}}"
                                       class="form-control form-control-solid" placeholder="Enter CNAS NUMBER" required
                                />
                                <span class="form-text text-muted">Please enter CNAS NUMBER</span>
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                                <label>Start Date* :</label>
                                <input type="date" id="card_start_date" name="start_date"
                                       class="form-control form-control-solid" value="{{old('start_date',$employee->start_date)}}"
                                       placeholder="Please enter Start Date" required/>
                                <span class="form-text text-muted">Please enter Start Date</span>
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                                <label>CNAS Start Date* :</label>
                                <input type="date" id="card_cnas_start_date" name="cnas_start_date"
                                       class="form-control form-control-solid" value="{{old('cnas_start_date',$employee->cnas_start_date)}}"
                                       placeholder="Please enter CNAS Start Date" />
                                <span class="form-text text-muted">Please enter CNAS Start Date</span>
                            </div>


                        </div>

                    </div>



                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="dash/employees" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
