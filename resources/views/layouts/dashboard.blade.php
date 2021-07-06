<!DOCTYPE html>
<html lang="en">

    <!--begin::Head-->
    <head>
        <base href="/">
        <meta charset="utf-8" />

        @yield('page_meta')

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="/" />

        @include('layouts.components-dashboard.assets_styles')

    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <div id="toaster"></div>
        @include('layouts.components-dashboard.dashLayout')

        @include('layouts.components-dashboard.assets_scripts')

    </body>
    <!--end::Body-->

</html>
