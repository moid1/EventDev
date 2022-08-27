<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSpotter</title>

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
</head>

<body>
    @include('front.header')


    <div class="layout-wrapper d-lg-flex">

        <!-- Start left sidebar-menu -->
        {{-- <div class="side-menu flex-lg-column me-lg-1 ms-lg-0">
            <div class="flex-lg-column d-none d-lg-block">
                <ul class="nav side-menu-nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" id="light-dark" href="#" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="Dark / Light Mode">
                            <i class="ri-sun-line theme-mode-icon"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div> --}}
        <div class="chat-leftsidebar me-lg-1 ms-lg-0">
            <div class="tab-content">
                <div class="tab-pane" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
                    <div>
                        <div class="text-center p-4 border-bottom">
                            <div class="mb-4">
                                <img src="{{ url('chat/assets/images/users/avatar-1.jpg') }}"
                                    class="rounded-circle avatar-lg img-thumbnail" alt="">
                            </div>

                            <h5 class="font-size-16 mb-1 text-truncate">Patricia Smith</h5>
                            <p class="text-muted text-truncate mb-1"><i
                                    class="ri-record-circle-fill font-size-10 text-success me-1 ms-0 d-inline-block"></i>
                                Active</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
                    <!-- Start chats content -->
                    <div>
                        <div class="px-4 pt-4">
                            <h4 class="mb-4">Chats</h4>
                        </div> <!-- .p-4 -->
                        <div class="px-2">
                            <div class="chat-message-list" data-simplebar>
                                <ul class="list-unstyled chat-list chat-user-list">
                                    <li class="active">
                                        <a href="#">
                                            <div class="d-flex">
                                                <div class="chat-user-img online align-self-center me-3 ms-0">
                                                    <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt="">

                                                </div>
                                                <div class="flex-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-15 mb-1">Doris Brown</h5>
                                                    <p class="chat-user-message text-truncate mb-0">Nice to meet you</p>
                                                </div>
                                                <div class="font-size-11">10:12 AM</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="d-flex">
                                                <div class="chat-user-img online align-self-center me-3 ms-0">
                                                    <img src="{{ url('chat/assets/images/users/avatar-2.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt="">
                                                    {{-- <span class="user-status"></span> --}}
                                                </div>
                                                <div class="flex-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-15 mb-1">Patrick Hendricks</h5>
                                                    <p class="chat-user-message text-truncate mb-0">Hey! there I'm
                                                        available</p>
                                                </div>
                                                <div class="font-size-11">05 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="unread">
                                        <a href="#">
                                            <div class="d-flex">
                                                <div class="chat-user-img away align-self-center me-3 ms-0">
                                                    <img src="{{ url('chat/assets/images/users/avatar-3.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt="">
                                                    {{-- <span class="user-status"></span> --}}
                                                </div>
                                                <div class="flex-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-15 mb-1">Mark Messer</h5>
                                                    <p class="chat-user-message text-truncate mb-0"><i
                                                            class="ri-image-fill align-middle me-1 ms-0"></i> Images</p>
                                                </div>
                                                <div class="font-size-11">12 min</div>
                                                <div class="unread-message">
                                                    <span class="badge badge-soft-danger rounded-pill">02</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End chat-message-list -->
                    </div>
                    <!-- Start chats content -->
                </div>
            </div>
            <!-- end tab content -->

        </div>
        <!-- end chat-leftsidebar -->

        <!-- Start User chat -->
        <div class="user-chat w-100 overflow-hidden">
            <div class="d-lg-flex">

                <!-- start chat conversation section -->
                <div class="w-100 overflow-hidden position-relative">
                    <div class="p-3 p-lg-4 border-bottom user-chat-topbar">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-8">
                                <div class="d-flex align-items-center">
                                    <div class="d-block d-lg-none me-2 ms-0">
                                        <a href="javascript: void(0);"
                                            class="user-chat-remove text-muted font-size-16 p-2"><i
                                                class="ri-arrow-left-s-line"></i></a>
                                    </div>
                                    <div class="me-3 ms-0">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}"
                                            class="rounded-circle avatar-xs" alt="">
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-0 text-truncate"><a href="#"
                                                class="text-reset user-profile-show">Doris Brown</a> <i
                                                class="ri-record-circle-fill font-size-10 text-success d-inline-block ms-1"></i>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-8 col-4">
                            <ul class="list-inline user-chat-nav text-end mb-0">                                        
                               

                                <li class="list-inline-item d-none d-lg-inline-block me-2 ms-0">
                                    <button type="button" class="btn nav-btn" data-bs-toggle="modal" data-bs-target="#audiocallModal">
                                        <i class="ri-phone-line"></i>
                                    </button>
                                </li>


                            </ul>                                    
                        </div> --}}
                        </div>
                    </div>
                    <!-- end chat user head -->

                    <!-- start chat conversation -->
                    <div class="chat-conversation p-3 p-lg-4" data-simplebar="init">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">
                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Good morning
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:00</span>
                                                </p>
                                            </div>
                                            {{-- <div class="dropdown align-self-start">
                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a>
                                                <a class="dropdown-item" href="#">Save <i class="ri-save-line float-end text-muted"></i></a>
                                                <a class="dropdown-item" href="#">Forward <i class="ri-chat-forward-line float-end text-muted"></i></a>
                                                <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a>
                                            </div>
                                        </div> --}}
                                        </div>
                                        <div class="conversation-name">Doris Brown</div>
                                    </div>
                                </div>
                            </li>

                            <li class="right">
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-1.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">
                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Good morning, How are you? What about our next meeting?
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:02</span>
                                                </p>
                                            </div>


                                        </div>

                                        <div class="conversation-name">Patricia Smith</div>
                                    </div>
                                </div>
                            </li>

                            {{-- <li> 
                            <div class="chat-day-title">
                                <span class="title">Today</span>
                            </div>
                        </li> --}}

                            <li>
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Yeah everything is fine
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    & Next meeting tomorrow 10.00AM
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="conversation-name">Doris Brown</div>
                                    </div>

                                </div>
                            </li>
                            <li>
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Yeah everything is fine
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    & Next meeting tomorrow 10.00AM
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="conversation-name">Doris Brown</div>
                                    </div>

                                </div>
                            </li>
                            <li>
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Yeah everything is fine
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    & Next meeting tomorrow 10.00AM
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="conversation-name">Doris Brown</div>
                                    </div>

                                </div>
                            </li>
                            <li>
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Yeah everything is fine
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    & Next meeting tomorrow 10.00AM
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="conversation-name">Doris Brown</div>
                                    </div>

                                </div>
                            </li>
                            <li>
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Yeah everything is fine
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    & Next meeting tomorrow 10.00AM
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="conversation-name">Doris Brown</div>
                                    </div>

                                </div>
                            </li>
                            <li>
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Yeah everything is fine
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    & Next meeting tomorrow 10.00AM
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="conversation-name">Doris Brown</div>
                                    </div>

                                </div>
                            </li>
                            <li>
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Yeah everything is fine
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    & Next meeting tomorrow 10.00AM
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="conversation-name">Doris Brown</div>
                                    </div>

                                </div>
                            </li>
                            <li>
                                <div class="conversation-list">
                                    <div class="chat-avatar">
                                        <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}" alt="">
                                    </div>

                                    <div class="user-chat-content">

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Yeah everything is fine
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    & Next meeting tomorrow 10.00AM
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:05</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="conversation-name">Doris Brown</div>
                                    </div>

                                </div>
                            </li>



                            {{-- <li>
                            <div class="conversation-list">
                                <div class="chat-avatar">
                                    <img src="{{url('chat/assets/images/users/avatar-4.jpg')}}" alt="">
                                </div>
                                
                                <div class="user-chat-content">
                                    <div class="ctext-wrap">
                                        <div class="ctext-wrap-content">
                                            <p class="mb-0">
                                                typing
                                                <span class="animate-typing">
                                                    <span class="dot"></span>
                                                    <span class="dot"></span>
                                                    <span class="dot"></span>
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="conversation-name">Doris Brown</div>
                                </div>
                                
                            </div>
                        </li> --}}

                        </ul>
                    </div>
                    <!-- end chat conversation end -->

                    <!-- start chat input section -->
                    <div class="chat-input-section p-3 p-lg-4 border-top mb-0">

                        <div class="row g-0">

                            <div class="col">
                                <input type="text" class="form-control form-control-lg bg-light border-light"
                                    placeholder="Enter Message...">
                            </div>
                            <div class="col-auto">
                                <div class="chat-input-links ms-md-2 me-md-0">
                                    <ul class="list-inline mb-0">
                                        {{-- <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Emoji">
                                        <button type="button" class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                                            <i class="ri-emotion-happy-line"></i>
                                        </button>
                                    </li> --}}
                                        {{-- <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Attached File">  
                                        <button type="button" class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                                            <i class="ri-attachment-line"></i>
                                        </button>
                                    </li> --}}
                                        <li class="list-inline-item">
                                            <button type="submit"
                                                class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light">
                                                <i class="ri-send-plane-2-fill"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end chat input section -->
                </div>
            </div>
        </div>

    </div>
    <script src="{{ url('chat/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('chat/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('chat/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('chat/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('chat/assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('chat/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('chat/assets/js/pages/index.init.js') }}"></script>
    <script src="{{ url('chat/assets/js/app.js') }}"></script>
</body>

</html>
