@extends('layouts.dashboard')

@section('page_meta')
    <title>Create user</title>
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
        var password = $('input[name="password"]');
        var password2 = $('input[name="password2"]');

        password2.on('keyup', function () {
            if (password.val()) {
                if (password2.val() != password.val()) {
                    password2.removeClass('is-valid');
                    password2.addClass('is-invalid');
                } else {
                    password2.removeClass('is-invalid');
                    password2.addClass('is-valid');
                }
            }
        })

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
                <h3 class="card-title">User</h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="post" action="dash/users" enctype="multipart/form-data">
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
                                <span class="form-text text-muted">Please enter the user's name</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Surname* :</label>
                                <input type="text" name="surname" value="{{old('surname')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter user surname"
                                       required/>
                                <span class="form-text text-muted">Please enter the user's surname</span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label>Email* :</label>
                            <input type="email" name="email" autocomplete="email" value="{{old('email')}}"
                                   class="form-control form-control-solid @error('email') is-invalid @enderror"
                                   placeholder="Enter user email" required/>
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                            <span class="form-text text-muted">Please enter the user's email</span>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label>Birthdate :</label>
                            <input type="date" name="birthdate" value="{{old('birthdate')}}" autocomplete="bday"
                                   class="form-control form-control-solid" placeholder="Enter user birthdate"/>
                            <span class="form-text text-muted">Please enter the user's birthdate</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label>Password* :</label>
                            <input type="password" name="password" autocomplete="new-password"
                                   class="form-control form-control-solid @error('password') is-invalid @enderror"
                                   placeholder="Enter user password" required/>
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                            <span class="form-text text-muted">Please enter the user's password</span>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label>Repeat password* :</label>
                            <input type="password" name="password2" autocomplete="new-password"
                                   class="form-control form-control-solid @error('password2') is-invalid @enderror"
                                   placeholder="Repeat user password" required/>
                            <div class="invalid-feedback">The repeated password does not match the first password.</div>
                            <div class="valid-feedback">Passwords match !</div>
                            <span class="form-text text-muted">Please repeat the user's password</span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Choose a role : </label>
                        <select class="form-control" id="kt_select2_1" name="param">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="dash/users" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
