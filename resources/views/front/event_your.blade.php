<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSpotter</title>
    <link rel="stylesheet" href="{{url('assets/style/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
    <link rel="shortcut icon" href="{{url('assets//images/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="assets/libraries/css/bootstrap.min.css">
    <script src="assets/libraries/js/fontawesome.js"></script>

</head>

<body>
@include('front.header')



    <div class="container-fluid">
        <div class="row">
@include('front.left_side')
            <div class="col-md-6">
                <div class="favourit">
                    <div class="row">
                        <div class="col-2 col-md-2 col-sm-2 imgGap">
                            <img class="eventImage" src="{{url('assets/images/favourit1.png')}}" alt="">
                        </div>
                        <div class="col-9 eventsDetailSection">
                            <div class="d-flex clearfix">
                                <h4 class="title_favourit">New year party at local park</h4>
                                <img class="heartIcon " src="{{url('assets/images/heart.png')}}" alt="">

                            </div>
                            <div class="row mb">
                                <div class="col-4 col-md-4 date">
                                    <img class="fav_title" src="{{url('assets/images/date.png')}}" alt="" />
                                    <span class="smallTextGrey">Tomorrow</span>
                                </div>
                                <div class="col-4">
                                    <img class="fav_title" src="{{url('assets/images/location.png')}}" alt="" />
                                    <span class="smallTextGrey"> 5km away</span>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-4 col-sm-3 col-4">
                                    <img class="fav_title" src="{{url('assets/images/following.png')}}" alt="" />
                                    <span class="smallTextGrey">10 Following</span>
                                </div>
                                <div class="col-md-3 col-sm-3 col-4 align-items-center ">
                                    <img class="fav_title" src="{{url('assets/images/like.png')}}" alt="" />
                                    <span class="smallTextGrey">20</span>
                                </div>

                                <div class="col-md-2 col-sm-3 col-4 align-items-center ">
                                    <img class="fav_title" src="{{url('assets/images/text.png')}}" alt="">
                                    <span class="smallTextGrey">20</span>
                                </div>

                                <div class="col-md-3 col-sm-3 col-4 align-items-center">
                                    <img class="fav_title" src="{{url('assets/images/forword.png')}}" alt="">
                                    <span class="smallTextGrey">20</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>                
                <div class="favourit">
                    <div class="row">
                        <div class="col-2 col-md-2 col-sm-2 imgGap">
                            <img class="eventImage" src="{{url('assets/images/favourit1.png')}}" alt="">
                        </div>
                        <div class="col-9 eventsDetailSection">
                            <div class="d-flex clearfix">
                                <h4 class="title_favourit">New year party at local park</h4>
                                <img class="heartIcon " src="{{url('assets/images/heart.png')}}" alt="">

                            </div>
                            <div class="row mb">
                                <div class="col-4 col-md-4 date">
                                    <img class="fav_title" src="{{url('assets/images/date.png')}}" alt="" />
                                    <span class="smallTextGrey">Tomorrow</span>
                                </div>
                                <div class="col-4">
                                    <img class="fav_title" src="{{url('assets/images/location.png')}}" alt="" />
                                    <span class="smallTextGrey"> 5km away</span>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-4 col-sm-3 col-4">
                                    <img class="fav_title" src="{{url('assets/images/following.png')}}" alt="" />
                                    <span class="smallTextGrey">10 Following</span>
                                </div>
                                <div class="col-md-3 col-sm-3 col-4 align-items-center ">
                                    <img class="fav_title" src="{{url('assets/images/like.png')}}" alt="" />
                                    <span class="smallTextGrey">20</span>
                                </div>

                                <div class="col-md-2 col-sm-3 col-4 align-items-center ">
                                    <img class="fav_title" src="{{url('assets/images/text.png')}}" alt="">
                                    <span class="smallTextGrey">20</span>
                                </div>

                                <div class="col-md-3 col-sm-3 col-4 align-items-center">
                                    <img class="fav_title" src="{{url('assets/images/forword.png')}}" alt="">
                                    <span class="smallTextGrey">20</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>               
                 <div class="favourit">
                    <div class="row">
                        <div class="col-2 col-md-2 col-sm-2 imgGap">
                            <img class="eventImage" src="{{url('assets/images/favourit1.png')}}" alt="">
                        </div>
                        <div class="col-9 eventsDetailSection">
                            <div class="d-flex clearfix">
                                <h4 class="title_favourit">New year party at local park</h4>
                                <img class="heartIcon " src="{{url('assets/images/heart.png')}}" alt="">

                            </div>
                            <div class="row mb">
                                <div class="col-4 col-md-4 date">
                                    <img class="fav_title" src="{{url('assets/images/date.png')}}" alt="" />
                                    <span class="smallTextGrey">Tomorrow</span>
                                </div>
                                <div class="col-4">
                                    <img class="fav_title" src="{{url('assets/images/location.png')}}" alt="" />
                                    <span class="smallTextGrey"> 5km away</span>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-4 col-sm-3 col-4">
                                    <img class="fav_title" src="{{url('assets/images/following.png')}}" alt="" />
                                    <span class="smallTextGrey">10 Following</span>
                                </div>
                                <div class="col-md-3 col-sm-3 col-4 align-items-center ">
                                    <img class="fav_title" src="{{url('assets/images/like.png')}}" alt="" />
                                    <span class="smallTextGrey">20</span>
                                </div>

                                <div class="col-md-2 col-sm-3 col-4 align-items-center ">
                                    <img class="fav_title" src="{{url('assets/images/text.png')}}" alt="">
                                    <span class="smallTextGrey">20</span>
                                </div>

                                <div class="col-md-3 col-sm-3 col-4 align-items-center">
                                    <img class="fav_title" src="{{url('assets/images/forword.png')}}" alt="">
                                    <span class="smallTextGrey">20</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            @include('front.right_side')
        </div>
    </div>
</body>

</html>