<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    {{-------------------------------------------------------------------------
    --------------------------------------------------------------------------
       Author: Shajedul Hasan Arman - armanhassan504@gmail.com
    --------------------------------------------------------------------------
       Github: https://github.com/sh-arman
       Linkedin: https://www.linkedin.com/in/armanhassan504
    --------------------------------------------------------------------------- --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content=" | ACCU Chek Radiant LiveCheck liveCheck |  | ACCU Chek Radiant LiveCheck LiveCheck | ">
    <meta name="author" content="Shajedul Hasan Arman | armanhassan504@gmail.com | https://github.com/sh-arman | https://www.linkedin.com/in/armanhassan504">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="apple-touch-icon" href="{{ asset('front/images/panacealogo.png') }}">
    <link rel="stylesheet" href="{{ asset('front/css/livecheck.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/all.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ACCU Chek Radiant LiveCheck</title>
</head>

<body>
    <div class="hero" id="hero">
        <img class="hero-img" src="{{ asset('front/images/bg2.svg') }}" alt="Background_image">
        <div class="hero-items">
            <div id="logos">
                <div> <img class="hero-items-logo logo-1 mb-2" src="{{ asset('front/images/acculogo.svg') }}"> </div>
                <div> <img class="hero-items-logo logo-2" src="{{ asset('front/images/live_check.svg') }}"> </div>
            </div>

            <div id="verfiedIcon" style="display: none"> <img class="mark" src="{{ asset('front/images/tick.svg') }}"></div>
            <div id="warningIcon" style="display: none"> <img class="mark"src="{{ asset('front/images/warning.svg') }}"> </div>
            <div id="wrongIcon" style="display: none"> <img class="mark" src="{{ asset('front/images/cross.svg') }}"></div>
        </div>
    </div>
    <div class="content" id="content">
        <div class="container">
            @yield('content')
        </div>
        @include('livecheck.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    @yield('js')
</body>

</html>
