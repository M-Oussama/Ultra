<!DOCTYPE html>
<html lang="en">

    <!--begin::Head-->
    <head>
        <base href="/">
        <meta charset="utf-8" />

        <link rel="apple-touch-icon" sizes="180x180" href="assets/media/logos/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/media/logos/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/media/logos/favicon-16x16.png">
        <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
        <meta name="theme-color" content="#1e1e2d"/>
        <link rel="manifest" href="{{ asset('/manifest.json') }}">
        <meta name="keywords" content="SPI, Intervention" />
        <meta name="description" content="SPI - Intervention">
        <meta name="author" content="YouceTech">
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
