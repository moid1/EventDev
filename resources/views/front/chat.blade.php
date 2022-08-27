<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSpotter</title>
    <link rel="stylesheet" href="{{url('assets/style/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{url('assets//images/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/382f336cbc.js"></script>
</head>

<body>
@include('front.header')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-9">
                <div class="notification">
                    <div class="not_title">Chat </div>
                    <div class="row chat">
                        <div class="col-1">
                            <img class="notify_prfile" src="{{url('assets/images/follower.png')}}" alt="">
                        </div>
                        <div class="col-2">
                            <p class="notify_description"><span class="notify_title">Joana Karg</span></p>
                        </div>
                        <div class="col-8">
                            <p class="chat_description"> started following you</p>
                        </div>
                        <div class="col-1">
                            <p class="notify_time">3s ago</p>
                        </div>
                    </div>
                    <div class="row chat">
                        <div class="col-1">
                            <img class="notify_prfile" src="{{url('assets/images/follower.png')}}" alt="">
                        </div>
                        <div class="col-2">
                            <p class="notify_description"><span class="notify_title">Joana Karg</span></p>
                        </div>
                        <div class="col-8">
                            <p class="chat_description"> started following you</p>
                        </div>
                        <div class="col-1">
                            <p class="notify_time">3s ago</p>
                        </div>
                    </div>
                    <div class="row chat">
                        <div class="col-1">
                            <img class="notify_prfile" src="{{url('assets/images/follower.png')}}" alt="">
                        </div>
                        <div class="col-2">
                            <p class="notify_description"><span class="notify_title">Joana Karg</span></p>
                        </div>
                        <div class="col-8">
                            <p class="chat_description"> started following you</p>
                        </div>
                        <div class="col-1">
                            <p class="notify_time">3s ago</p>
                        </div>
                    </div>
                    <div class="row chat">
                        <div class="col-1">
                            <img class="notify_prfile" src="{{url('assets/images/follower.png')}}" alt="">
                        </div>
                        <div class="col-2">
                            <p class="notify_description"><span class="notify_title">Joana Karg</span></p>
                        </div>
                        <div class="col-8">
                            <p class="chat_description"> started following you</p>
                        </div>
                        <div class="col-1">
                            <p class="notify_time">3s ago</p>
                        </div>
                    </div>
                    <div class="row chat">
                        <div class="col-1">
                            <img class="notify_prfile" src="{{url('assets/images/follower.png')}}" alt="">
                        </div>
                        <div class="col-2">
                            <p class="notify_description"><span class="notify_title">Joana Karg</span></p>
                        </div>
                        <div class="col-8">
                            <p class="chat_description"> started following you</p>
                        </div>
                        <div class="col-1">
                            <p class="notify_time">3s ago</p>
                        </div>
                    </div>

                </div>
            </div>
           @include('front.right_side')
        </div>
    </div>
</body>
</html>