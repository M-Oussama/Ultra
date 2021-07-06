@extends('layouts.dashboard')

@section('page_meta')
    <title>Rozaric</title>
    <meta name="keywords" content="Rozaric" />
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <!-- Page scripts -->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="assets/js/pages/widgets.js"></script>
@endsection

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">
                    <!--begin::List Widget 8-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">{{ __('Dashboard') }}</h3>
                            <div class="card-toolbar">
                                <div class="dropdown dropdown-inline">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-ver"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover">
                                            <li class="navi-header pb-1">
                                                <span class="text-primary text-uppercase font-weight-bold font-size-sm">actions:</span>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-shopping-cart-1"></i>
                                                    </span>
                                                    <span class="navi-text">Action</span>
                                                </a>
                                            </li>
                                        </ul>
                                    <!--end::Navigation-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Item-->
                            <div class="mb-10">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light mr-5">
                                        <span class="symbol-label">
                                            <img src="assets/media/svg/misc/006-plurk.svg" class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{Auth::user()->name}}</a>
                                        <span class="text-muted font-weight-bold">5 day ago</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Desc-->
                                <p class="text-dark-50 m-0 pt-5 font-weight-normal">
                                    {{ __('You are logged in!') }}
                                </p>
                                <!--end::Desc-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end: Card-->
                    <!--end::List Widget 8-->
                </div>
            </div>
        </div>
    </div>
@endsection
