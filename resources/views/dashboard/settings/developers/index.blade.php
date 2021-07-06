@extends('layouts.dashboard')

@section('page_meta')
    <title>Developers console</title>
    <meta name="keywords" content="Rozaric" />
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->

@endsection

@section('scripts')
    <!-- Page scripts -->
    <script>
        $('.run-button').click(function (){
            KTApp.blockPage({
                overlayColor: '#000000',
                opacity: 0.1,
                size: 'lg',
                state: 'danger',
                message: 'Backing up, please wait...'
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Mixed Widget 1-->
        <div class="card card-custom bg-gray-100 card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 bg-danger py-5">
                <h3 class="card-title font-weight-bolder text-white">Commands</h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0 position-relative overflow-hidden">
                <!--begin::Chart-->
                <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger" style="height: 100px; min-height: 100px;"></div>
                <!--end::Chart-->
                <!--begin::Stats-->
                <div class="card-spacer mt-n25">
                    <!--begin::Row-->
                    <div class="row m-0 d-flex justify-content-center">
                        <div class="col-md-5 col-sm-12 bg-light-primary px-6 py-8 rounded-xl mr-md-7 mb-7 d-flex justify-content-between">
                            <span>
                                <i class="fas fa-2x fa-terminal my-2 text-dark"> </i>
                                <a href="dash/ide-helper" class="font-weight-bold font-size-h3 ml-5 text-dark run-button"><b>IDE helper</b> <span class="font-size-base">dev only</span></a>
                            </span>
                            <a href="dash/ide-helper" class="btn btn-dark ml-5 font-size-h3 run-button">RUN</a>
                        </div>
                        <div class="col-md-5 col-sm-12 bg-light-primary px-6 py-8 rounded-xl mb-7 d-flex justify-content-between">
                            <span>
                                <i class="fas fa-2x fa-terminal my-2 text-dark"> </i>
                                <a href="dash/clear-cache" class="font-weight-bold font-size-h3 ml-5 text-dark run-button"><b>Clear cache</b></a>
                            </span>
                            <a href="dash/clear-cache" class="btn btn-dark ml-5 font-size-h3 run-button">RUN</a>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row m-0 d-flex justify-content-center">
                        <div class="col-md-5 col-sm-12 bg-light-primary px-6 py-8 rounded-xl mr-md-7 mb-7 d-flex justify-content-between">
                            <span>
                                <i class="fas fa-2x fa-terminal my-2 text-dark"> </i>
                                <a href="dash/optimize-cache" class="font-weight-bold font-size-h3 ml-5 text-dark run-button"><b>Opt cache</b></a>
                            </span>
                            <a href="dash/optimize-cache" class="btn btn-dark ml-5 font-size-h3 run-button">RUN</a>
                        </div>
                        <div class="col-md-5 col-sm-12 bg-light-primary px-6 py-8 rounded-xl mb-7 d-flex justify-content-between">
                            <span>
                                <i class="fas fa-2x fa-terminal my-2 text-dark"> </i>
                                <a href="dash/add-model" class="font-weight-bold font-size-h3 ml-5 text-dark run-button"><b>Make model</b></a>
                            </span>
                            <a href="dash/add-model" class="btn btn-dark ml-5 font-size-h3 run-button">RUN</a>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Stats-->
                <div class="resize-triggers"><div class="expand-trigger"><div style="width: 463px; height: 448px;"></div></div><div class="contract-trigger"></div></div></div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 1-->
    </div>
@endsection
