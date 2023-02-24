@extends('layouts.dashboard')

@section('page_meta')
    <title>Edit Company Profile</title>
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
                <h3 class="card-title">Company Profiles</h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="post" action="dash/company/update" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">

                        @if(empty($company->getFirstMedia('avatars')))
                            <div class="image-input image-input-empty image-input-outline d-contents" id="kt_avatar"
                                 style="background-image: url(assets/media/users/blank.png);margin-left: 36%;">

                        @else
                         <div class="image-input image-input-empty image-input-outline d-contents" id="kt_avatar"
                                                         style="background-image:url({{$company->getFirstMedia('avatars')->getURL()}}) ;margin-left: 36%;">
                        @endif
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
                                <input type="text" name="name" value="{{old('name',$company->name)}}" autocomplete="family-name"
                                       class="form-control form-control-solid" placeholder="Enter user name" required/>
                                <span class="form-text text-muted">Please enter the companys's name</span>
                            </div>



                            <div class="form-group col-sm-12 col-md-12">
                                <label>Email* :</label>
                                <input type="email" name="email" autocomplete="email" value="{{old('email',$company->email)}}"
                                       class="form-control form-control-solid @error('email') is-invalid @enderror"
                                       placeholder="Enter user email" required/>
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                <span class="form-text text-muted">Please enter the companys's email</span>
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <label>address* :</label>
                                <input type="text" name="address" value="{{old('surname',$company->address)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter address "
                                       required/>
                                <span class="form-text text-muted">Please enter the companys's address</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>capital* :</label>
                                <input type="text" name="capital" value="{{old('surname',$company->capital)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter capital "
                                       required/>
                                <span class="form-text text-muted">Please enter the companys's capital</span>
                            </div>

                        <div class="form-group col-sm-12 col-md-12">
                                <label>phone* :</label>
                                <input type="text" name="phone" value="{{old('surname',$company->phone)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter phone "
                                       required/>
                                <span class="form-text text-muted">Please enter the companys's phone</span>
                            </div>


                        <div class="row col-sm-12 col-md-12 row">

                            <div class="form-group col-sm-6 col-md-6">
                                <label>N°RC* :</label>
                                <input type="text" name="nrc" value="{{old('NRC',$company->NRC)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter registration number(RC)"
                                        />
                                <span class="form-text text-muted">Please enter the companys's N°RC</span>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label>N°IF* :</label>
                                <input type="text" name="nif" value="{{old('NIF',$company->NIF)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter NIF"
                                       />
                                <span class="form-text text-muted">Please enter the companys's N°IF</span>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label>N°ART* :</label>
                                <input type="text" name="nart" value="{{old('NART',$company->NART)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter NART"
                                       />
                                <span class="form-text text-muted">Please enter the companys's N°ART</span>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label>N°IS* :</label>
                                <input type="text" name="nis" value="{{old('NIS',$company->NIS)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter NIS"
                                       />
                                <span class="form-text text-muted">Please enter the companys's N°IS</span>
                            </div>

                        </div>

                    </div>



                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="/dash" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
