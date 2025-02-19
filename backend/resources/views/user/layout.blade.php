<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>TechShop</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/bootstrap.min.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/font-awesome.min.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/bootstrap-grid.min.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/bootstrap-reboot.min.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/font-techmarket.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/slick.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/techmarket-font-awesome.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/slick-style.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/animate.min.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/style.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template2/assets/css/colors/blue.css') }}" media="all" />
        
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,900" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('template2/assets/images/fav-icon.png') }}">
        @yield('css')
    </head>

    @yield('content')
    @yield('js')
</html>