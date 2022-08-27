<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EventSpotters</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />

    {{-- ///REAL CHAT --}}
    <link href="{{ url('chat/assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ url('chat/assets/libs/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('chat/assets/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
    <link href="{{ url('chat/assets/css/bootstrap-dark.min.css') }}" id="bootstrap-dark-style" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('chat/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('chat/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('chat/assets/css/app-dark.min.css') }}" id="app-dark-style" rel="stylesheet" type="text/css" />
    <link href="{{ url('chat/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    {{-- REAL CHAT END --}}
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script>
        var base_url = '{{ url('/') }}';
    </script>

    <style>
        /* .panel-default{
            width: 500px;
        } */
        .panel-default>.panel-heading {
            color: #333;
            background-color: #26C696;
            border-color: #ddd;
        }

        .panel-title {
            margin-top: 0;
            margin-bottom: 0;
            font-size: 16px;
            color: inherit;
            color: white;
        }

        .greenDot {
            height: 10px;
            width: 10px;
            background-color: #26C696;
            border-radius: 50%;
            /* display: inline-block; */
        }

        .redDot {
            height: 10px;
            width: 10px;
            background-color: red;
            border-radius: 50%;
            /* display: inline-block; */
        }

        .panel-footer {
            padding: 10px 25px;
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        @include('front.header')
        @yield('content')
    </div>
    <div id="chat-overlay" class="d-flex justify-content-between"></div>
    <audio id="chat-alert-sound" style="display: none">
        <source src="{{ asset('sound/facebook_chat.mp3') }}" />
    </audio>
    @yield('script')
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>

</body>

</html>
