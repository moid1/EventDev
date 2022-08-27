<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSpotter</title>
    <link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
    <link rel="shortcut icon" href="{{ asset('assets//images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/libraries/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/libraries/js/fontawesome.js') }}"></script>
    <script>
        var user = {!! json_encode((array) auth()->user()) !!};
    </script>

</head>

<style>

</style>

<body>
    @php
        $userWithImage = Auth::user()->load('profilePicture');
        $notifications = App\Models\Notifications::where('user_id', $userWithImage->id)
            ->where('is_read', '!=', 1)
            ->get();
    @endphp
    <div class="header">
        <div class="row ">
            <div class="col-md-2">
                <div class="headerlogo">
                    <a href="{{ url('/') }}"><img class="img-fluid"
                            src="{{ url('assets/images/headerLogo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class=" col-md-7 ">

                <div class="d-flex    headerSearchBColor ">
                    <img class="img-fluid ml-2 mr-2 " src="{{ url('assets/images/icons/searechIcon.png') }}"
                        alt="search">
                    <input class="" id="search" name="search" type="text" placeholder="Search">

                </div>


            </div>

            <div class="col-md-2 topMargin ">
                <div class="row align-items-center tools">
                    <div class="col-md-4 col-sm-4 col-4">
                        <div class="iconsBackgroundBox ">
                            <a href="{{ url('notifications') }}"><img class="img-fluid "
                                    src="{{ asset('assets/images/icons/notificationBellIcon.png') }}" /></a>
                            @if (count($notifications) > 0)
                                <div class="notificationDot"></div>
                            @endif

                        </div>

                    </div>
                    <div class="col-md-4 col-sm-4 col-4">
                        <div class="iconsBackgroundBox ">
                            <a href="{{ url('chat-home') }}"><img class="img-fluid "
                                    src="{{ asset('assets/images/emailDark.png') }}" /></a>
                            {{-- <div class="notificationDot"></div> --}}
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-4 col-4">
                        @if ($userWithImage->profilePicture != null)
                            <a href="{{ url('/profile') }}"> <img class="circularImage"
                                    src="{{ asset($userWithImage->profilePicture->image) }}" /></a>
                        @else
                            <a href="{{ url('/profile') }}"> <img class="circularImage"
                                    src="{{ url('assets/images/usersImages/userPlaceHolder.png') }}" /></a>

                        @endif
                        <div class="activeDot"></div>
                    </div>
                </div>
            </div>

        </div>
        <div style="text-align:center;"><img id="loading" style="display: none" src="{{ asset('loader.gif') }}"
                alt="" /></div>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script type="application/javascript">
        $(document).ready(function() {
            var down = false;

            $('#bell').click(function(e) {

                var color = $(this).text();
                if (down) {

                    $('#box').css('height', '0px');
                    $('#box').css('opacity', '0');
                    down = false;
                } else {

                    $('#box').css('height', 'auto');
                    $('#box').css('opacity', '1');
                    down = true;

                }

            });

        });

    </script>
</body>

</html>
