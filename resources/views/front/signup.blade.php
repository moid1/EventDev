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
                    <img class="exploreImage" src="{{ url('assets/images/Explore Events around.png') }}" alt=""
                        srcset="">
                    <br>
                    <img class="exploreImage" src="{{ url('assets/images/You.png') }}" alt="" srcset="">
                </div>
            </div>
        </div>
        <div class="col-md-6 align-items-center justify-content-center centerAnyThing right-col">
            <span class="right-top"></span>
            <span class="left-bottom"></span>
            <div class="text-center">
                <img class="sign_log" src="{{ asset('assets/images/logo.png') }}" width="50%" height="auto"
                    alt="" srcset="">
                <h6 class="medium-heading-green mt-2">Sign UP</h6>

                {{-- @if (count($errors) > 0)
                    <div class="alert alert-danger">

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif --}}

                <form action="{{ url('user') }}" method="POST" class="d-inline-table" style="display: inline-table">
                    @csrf
                    <div class="mt-2 ">
                        <div class="signupCenter">
                            <div class="inputFieldGreenBG d-flex  {{ $errors->has('name') ? 'has-error' : '' }}">
                                <div class="float-left d-flex justify-content-center align-items-center">
                                    <img src="{{ url('assets/images/pro.png') }}" class="ml-3" alt=""
                                        srcset="">
                                    <input type="text" class="headerSearchColor ml-3" name="name" required
                                        value="{{ old('name') }}" placeholder="User name" id="Fullname">
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger errorAlignment">{{ $errors->first('name') }}</span>
                            @endif

                            <div
                                class="inputFieldGreenBG d-flex   mt-2 {{ $errors->has('email') ? 'has-error' : '' }}">
                                <div class="float-left d-flex align-items-center">
                                    <img src="{{ url('assets/images/emailDark.png') }}" class="ml-3">
                                    <input type="email" value="{{ old('email') }}" class="headerSearchColor ml-3"
                                        required name="email" placeholder="Email" id="email">

                                </div>

                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger errorAlignment">{{ $errors->first('email') }}</span>
                            @endif
                            <div
                                class="inputFieldGreenBG d-flex mt-2 {{ $errors->has('password') ? 'has-error' : '' }} ">
                                <div class="float-left  d-flex justify-content-center align-items-center">
                                    <img src="{{ url('assets/images/icons/lockDark.png') }}" class="ml-3">
                                    <input type="password" class="headerSearchColor ml-3" name="password" required
                                        placeholder="Password" id="password">
                                </div>
                                {{-- <img src="{{ url('assets/images/icons/eyeDark.png') }}" class="> --}}
                                <span toggle="#password-field"
                                    class="fa fa-eye
                            toggle-password"
                                    style="margin-right: 15px;"></span>

                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger errorAlignment">{{ $errors->first('password') }}</span>
                            @endif

                            <div
                                class="inputFieldGreenBG d-flex mt-2  {{ $errors->has('confirm_password') ? 'has-error' : '' }} ">
                                <div class="float-left  d-flex justify-content-center align-items-center">
                                    <img src="{{ url('assets/images/icons/lockDark.png') }}" class="ml-3">
                                    <input type="password" class="headerSearchColor  ml-3" name="confirm_password"
                                        required placeholder="Confirm Password" id="confirmPassword">

                                </div>
                                {{-- <img id="eyePass" src="{{ url('assets/images/icons/eyeDark.png') }}"
                                    class="ml-4 float-right "> --}}



                                <span toggle="#confirm-password-field"
                                    class="fa fa-eye  toggle-password"
                                    style="margin-right: 15px;"></span>

                            </div>

                            @if ($errors->has('confirm_password'))
                                <span
                                    class="text-danger errorAlignment">{{ $errors->first('confirm_password') }}</span>
                            @endif


                            <div
                                class="inputFieldGreenBG d-flex mt-2 {{ $errors->has('phone_number') ? 'has-error' : '' }} ">
                                <div class="float-left a d-flex justify-content-center align-items-center">
                                    <img src="{{ url('assets/images/pho.png') }}" class="ml-3">
                                    <input type="text" class="headerSearchColor ml-3" name="phone_number"
                                        placeholder="Phone Number" value="{{ old('phone_number') }}" id="phoneNo"
                                        required>

                                </div>
                                {{-- <img src="{{url('assets/images/icons/eyeDark.png')}}" class="ml-4 float-right "> --}}
                            </div>

                            @if ($errors->has('phone_number'))
                                <span class="text-danger errorAlignment">{{ $errors->first('phone_number') }}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    <button type="submit" class="upcoming mt-3 w-100 ">
                        Sign Up
                    </button>

                    <button class="past mt-2 w-100 ">
                        Already have an account? <a href="{{ url('login') }}">Sign In</a>
                    </button>



                </form>

                <p class="sign_dec mt-4">By signing up you agree to our terms and conditions</p>
            </div>
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

        $("body").on('click', '.toggle-confirm-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var confirmPassword = $('#confirmPassword');

            if (confirmPassword.attr("type") === "password")
                confirmPassword.attr("type", "text");
            else
                confirmPassword.attr("type", "password");





        });
    </script>


</body>

</html>
