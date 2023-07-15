@extends('layouts.dashboard')

@section('page_meta')
    <title>change password</title>
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
        $('#kt_select2_1').select2({
            dir: "rtl",
            language: "ar",
        });
        $('#responsible_select').select2({
            dir: "ltr",
            language: "ar",
        });

    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Card-->
            <div class="card card-custom">
                <form class="form" method="post" action="{{URL('dash/user/change_password')}}" enctype="multipart/form-data">    <!--begin::Header-->
                    @csrf
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card-title align-items-start flex-column" style="margin-top: 20px;">
                                    <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">change your account password</span>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="card-toolbar" style="float: left;margin-top: 20px;">
                                    <button type="submit" class="btn btn-success mr-2">save</button>
                                    <button type="reset" class="btn btn-secondary">cancel</button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-alert">current password</label>
                            <div class="col-lg-9 col-xl-6">
                                <input type="password" class="form-control form-control-lg form-control-solid mb-2" name="old_password" value="" placeholder="current password" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-alert">new password</label>
                            <div class="col-lg-9 col-xl-6">
                                <input type="password" class="form-control form-control-lg form-control-solid" value="" name="password" placeholder="new password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-alert">confirm password</label>
                            <div class="col-lg-9 col-xl-6">
                                <input type="password" class="form-control form-control-lg form-control-solid" value="" name="password2" placeholder="confirm password" required>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection
