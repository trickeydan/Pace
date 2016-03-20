<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KLBS PACE Points | @yield('title')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{!! asset('assets/bootstrap/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/form-elements.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{!! asset('assets/ico/apple-icon-57x57.png')!!}">
    <link rel="apple-touch-icon" sizes="60x60" href="{!! asset('assets/ico/apple-icon-60x60.png')!!}">
    <link rel="apple-touch-icon" sizes="72x72" href="{!! asset('assets/ico/apple-icon-72x72.png')!!}">
    <link rel="apple-touch-icon" sizes="76x76" href="{!! asset('assets/ico/apple-icon-76x76.png')!!}">
    <link rel="apple-touch-icon" sizes="114x114" href="{!! asset('assets/ico/apple-icon-114x114.png')!!}">
    <link rel="apple-touch-icon" sizes="120x120" href="{!! asset('assets/ico/apple-icon-120x120.png')!!}">
    <link rel="apple-touch-icon" sizes="144x144" href="{!! asset('assets/ico/apple-icon-144x144.png')!!}">
    <link rel="apple-touch-icon" sizes="152x152" href="{!! asset('assets/ico/apple-icon-152x152.png')!!}">
    <link rel="apple-touch-icon" sizes="180x180" href="{!! asset('assets/ico/apple-icon-180x180.png')!!}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{!! asset('assets/ico/android-icon-192x192.png')!!}">
    <link rel="icon" type="image/png" sizes="32x32" href="{!! asset('assets/ico/favicon-32x32.png')!!}">
    <link rel="icon" type="image/png" sizes="96x96" href="{!! asset('assets/ico/favicon-96x96.png')!!}">
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('assets/ico/favicon-16x16.png')!!}">
    <link rel="manifest" href="{!! asset('assets/ico/manifest.json')!!}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{!! asset('assets/ico/ms-icon-144x144.png')!!}">
    <meta name="theme-color" content="#ffffff">

</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg-less">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 form-box">
                    <div class="form-top">
                        <div class="form-top-right">
                            <img class="img-responsive logo-img-main" src="{!! asset('assets/img/logo.png') !!}">
                        </div>
                    </div>
                    <div class="form-bottom">
                        @yield('content')
                        @include('layouts.footer')
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="{!! asset('assets/js/jquery-1.11.1.min.js') !!}"></script>
<script src="{!! asset('assets/bootstrap/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.backstretch.min.js') !!}"></script>
<script src="{!! asset('assets/js/scripts.js') !!}"></script>

<!--[if lt IE 10]>
<script src="{!! asset('assets/js/placeholder.js') !!}"></script>
<![endif]-->

<script>
    jQuery(document).ready(function() {
        $.backstretch("{!! asset('assets/img/backgrounds/1.jpg') !!}");
    });
</script>

</body>

</html>