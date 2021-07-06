<!DOCTYPE html>

<html>

    <head>

        <!-- Basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('page_meta')

        <!-- Favicon -->
        <link rel="shortcut icon" href="porto/img/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="porto/img/apple-touch-icon.png">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7COpen+Sans:400,700,800&display=swap" rel="stylesheet" type="text/css">

        @include('layouts.components-app.assets_styles')

    </head>

    <body class="one-page loading-overlay-showing" data-target="#header" data-spy="scroll" data-offset="100" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 500}">
        <div class="loading-overlay">
            <div class="bounce-loader">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>

        <div class="body">

            @include('layouts.components-app.nav-header')

            <div role="main" class="main" id="home">
                @yield('content')
            </div>

            @include('layouts.components-app.footer')

        </div>

        @include('layouts.components-app.assets_scripts')

    </body>

</html>
