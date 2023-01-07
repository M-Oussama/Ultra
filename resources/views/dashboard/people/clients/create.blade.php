@extends('layouts.dashboard')

@section('page_meta')
    <title>Create Client</title>
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
                <h3 class="card-title">Clients</h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="post" action="dash/clients" enctype="multipart/form-data">
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
                                <input type="text" name="name" value="{{old('name')}}" autocomplete="family-name"
                                       class="form-control form-control-solid" placeholder="Enter user name" required/>
                                <span class="form-text text-muted">Please enter the clients's name</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Surname* :</label>
                                <input type="text" name="surname" value="{{old('surname')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter user surname"
                                       required/>
                                <span class="form-text text-muted">Please enter the clients's surname</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>address* :</label>
                                <input type="text" name="address" value="{{old('address')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter the address of the client"
                                       required/>
                                <span class="form-text text-muted">Please enter the Old Sold of the Clients</span>
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <label>Email* :</label>
                                <input type="email" name="email" autocomplete="email" value="{{old('email')}}"
                                       class="form-control form-control-solid @error('email') is-invalid @enderror"
                                       placeholder="Enter user email" required/>
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                <span class="form-text text-muted">Please enter the clients's email</span>
                            </div>


                            <div class="form-group col-sm-12 col-md-12">
                                <label>old Sold* :</label>
                                <input type="text" name="sold" value="{{old('sold')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter the sold of the client"
                                       required/>
                                <span class="form-text text-muted">Please enter the Old Sold of the Clients</span>
                            </div>

{{--                            <div class="form-group col-sm-12 col-md-12">--}}
{{--                                <label>Choose a Type : </label>--}}
{{--                                <select class="form-control" id="kt_select2_1" name="type">--}}
{{--                                    @foreach($types as $type)--}}
{{--                                        <option value="{{$type->id}}">{{$type->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                        </div>

                        <div class="col-sm-12 col-md-12 row">

                            <div class="form-group col-sm-6 col-md-6">
                                <label>N°RC* :</label>
                                <input type="text" name="nrc" value="{{old('nrc')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter user surname"
                                        />
                                <span class="form-text text-muted">Please enter the clients's N°RC</span>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label>N°IF* :</label>
                                <input type="text" name="nif" value="{{old('nif')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter user surname"
                                       />
                                <span class="form-text text-muted">Please enter the clients's N°IF</span>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label>N°ART* :</label>
                                <input type="text" name="nart" value="{{old('nart')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter user surname"
                                       />
                                <span class="form-text text-muted">Please enter the clients's N°ART</span>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label>N°IS* :</label>
                                <input type="text" name="nis" value="{{old('nis')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter user surname"
                                       />
                                <span class="form-text text-muted">Please enter the clients's N°IS</span>
                            </div>

                        </div>

                    </div>



                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="dash/clients" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
