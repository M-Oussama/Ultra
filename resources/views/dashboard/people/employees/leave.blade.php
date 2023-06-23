@extends('layouts.dashboard')

@section('page_meta')
    <title>Employee LEAVES</title>
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
                <h3 class="card-title">FILL THE FIELDS</h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="post" action="dash/employees" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 row">
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Leave Date* :</label>
                                <input type="date" id="leave_date" name="leave_date"
                                       class="form-control form-control-solid"
                                       placeholder="Please enter leave date" required/>
                                <span class="form-text text-muted">Please enter leave date</span>
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
