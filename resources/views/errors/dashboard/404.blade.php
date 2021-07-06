@extends('layouts.dashboard')

@section('page_meta')
    <title>You're lost</title>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')
    <div class="container">
        <!--begin::Error-->
        <div class="d-flex flex-row-fluid flex-column bgi-size-cover bgi-position-center bgi-no-repeat p-10 p-sm-30" style="background-image: url(assets/media/error/bg1.jpg);padding-bottom: 80px !important;">
            <!--begin::Content-->
            <h1 class="font-weight-boldest text-dark-75 mt-15" style="font-size: 10rem">404</h1>
            <p class="font-size-h3 text-muted font-weight-normal">OOPS! Something went wrong here</p>
            <!--end::Content-->
        </div>
        <!--end::Error-->
    </div>
@endsection
