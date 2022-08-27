<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSpotter</title>
    <link rel="stylesheet" href="{{ url('assets/style/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
    <link rel="shortcut icon" href="{{ url('assets//images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="assets/libraries/css/bootstrap.min.css">
    <script src="{{ url('assets/libraries/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/libraries/js/fontawesome.js') }}"></script>

</head>

<body style="overflow: auto;">
    <div class="row h-100 m-0">
        <div class="col-md-6 padding-0">
            <div class="loginBg ">
                <span class="left-top"></span>
                <span class="right-top circle"></span>
                <span class="left-bottom circle"></span>
                <span class="right-bottom"></span>

                <div class="text-center bottomPostion ">
                    <img src="{{ url('assets/images/Explore Events around.png') }}" alt="" srcset="">
                    <br>
                    <img src="{{ url('assets/images/You.png') }}" alt="" srcset="">
                </div>
            </div>
        </div>
        <div class="col-md-6 align-items-center justify-content-center centerAnyThing right-col">
            <span class="right-top"></span>
            <span class="left-bottom"></span>

            <div class="text-center">

                <img src="{{ url('assets/images/logo.png') }}" width="50%" height="auto" alt="" srcset="">
                <h6 class="medium-heading-green mt-3">Login</h6>
                @if ($message = Session::get('success'))
                    <div id="success" class="alert alert-success">
                        <p class="d-table-cell">{{ $message }}</p>
                    </div>
                @endif

                <form action="{{ url('login') }}" method="POST" class="loginForm">
                    @csrf
                    <div class="mt-4 d-inline-block">
                        <div class="inputFieldGreenBG d-flex ">
                            <img src="{{ url('assets/images/emailDark.png') }}" class="ml-3" alt=""
                                srcset="">
                            <input type="email" class="headerSearchColor ml-3 w-100" name="email" placeholder="Email"
                                id="email">
                        </div>

                        @if ($errors->has('email'))
                            <span class="text-danger errorAlignment">{{ $errors->first('email') }}</span>
                        @endif

                        <div class="inputFieldGreenBG d-flex mt-4 clearfix ">
                            <div class="float-left d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/images/icons/lockDark.png') }}" class="ml-3">
                                <input type="password" class="headerSearchColor ml-3" name="password"
                                    placeholder="Password" id="password">
                            </div>
                            <span toggle="#password-field"
                                class="fa fa-eye 
                            toggle-password" style="margin-right: 15px;"></span>

                            {{-- <img src="{{ url('assets/images/icons/eyeDark.png') }}" class="ml-4 float-right "> --}}
                        </div>
                        @if ($errors->has('password'))
                            <span class="text-danger errorAlignment">{{ $errors->first('password') }}</span>
                        @endif

                        <a href="{{ url('forgot') }}">
                            <p class="lightGreenTeal font-weight-light textUnderline mt-3">Forgot Password?</p>
                        </a>
                        <button type="submit" class="upcoming mt-3 w-100">
                            Login
                        </button>
                </form>
                <button class="past mt-3 w-100">
                    Don't have an account?<a href="{{ url('signup') }}"> Sign Up</a>
                </button>
            </div>
        </div>
    </div>
    <div class="footer">
        <footer class="w-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="h1 text-white text-center"><img src="{{ url('assets/images/moid1.png') }}" alt="">
                        </h5>
                        <h1 class="text-white text-center" style="font-size: 33px;">Event Spotter</h1>

                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class=" mb-3" style="color: #74ABB0;">Quick links</h5>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2">
                                <a target="_blank" href="{{ url('terms_of_service') }}" style="color: white; ">Terms
                                    of
                                    Services

                                </a>
                            </li>

                            <li class="mb-2"><a target="_blank" href="{{ url('privacy_policy') }}"
                                    style="color: white;">Privacy Policy</a></li>
                            <li class="mb-2"><a target="_blank" href="{{ url('refund') }}"
                                    style="color: white;">Refund Policy</a></li>
                            <li class="mb-2">
                                <a target="_blank" href="{{ url('cookie_policy') }}" style="color: white;">Cookie
                                    Policy</a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ url('disclamier') }}" style="color: white;">Disclamier
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h5 class=" mb-3" style="color: #74ABB0;">Contact Us</h5>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><a target="_blank" href="{{ url('reportIssue') }}"
                                    style="color: white;">Report a Issue</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        {{-- <h4 class="text-white">Coming Soon</h4> --}}
                        <a href=""><img class="mb-3" src="{{ url('assets/images/df.jpeg') }}"
                                alt=""></a><br>
                        <a href="" class=""><img src="{{ url('assets/images/apple2.jpeg') }}"
                                alt=""></a>
                    </div>
                </div>
            </div>
            <div class="w-100 text-center">
                <span class="text-muted text-center w-100 ">Copyrights 2021. EventSpotter <br>All rights reserved</span>
            </div>
        </footer>
    </div>
    </div>
    <script>
        $("body").on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#password");
            if (input.attr("type") === "password")
                input.attr("type", "text");
            else
                input.attr("type", "password");


        });
        setTimeout(function() {
            $('#success').addClass('d-none');

        }, 2000);
    </script>
</body>

</html>
