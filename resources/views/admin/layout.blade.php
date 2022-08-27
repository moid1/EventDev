<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <link href="{{ asset('asset/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('asset/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('asset/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!--Morris Chart CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}"> --}}
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
    {{-- <script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield('style')
</head>


<body class="fixed-left">
    @php
        $user = \App\Models\User::where('id', Auth::id())
            ->with('profilePicture')
            ->first();
    @endphp

    <!-- Loader -->
    {{-- <div id="preloader">   
    <div class="w-100 h-100 text-center d-flex justify-content-center align-items-center">
     <img  src="images/g.png"  alt="logo">
    </div>
  </div> --}}
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>





            <div class="topbar-left">
                <div class="text-center">
                    <!--<a href="index.html" class="logo">Admiry</a>-->
                    <a href="#" class="logo"><img src="{{ asset('assets/images/headerLogo.png') }}"
                            height="50" alt="logo"></a>
                </div>
            </div>


            <div class="sidebar-inner slimscrollleft">


                <div class="user-details">
                    <div class="text-center">
                        <img src="{{ asset($user->profilePicture->image) }}" alt="" class="rounded-circle">
                    </div>
                    <div class="user-info">
                        <h4 class="font-16 "> {{ Auth::user()->name }}</h4>
                        <span class=" user-status"><i class="fa fa-dot-circle-o text-success"></i>
                            ADMIN PANEL
                        </span>
                    </div>
                </div>
                <div id="sidebar-menu">
                    <ul>
                        <li>
                            <a href="{{ url('/') }}" class="waves-effect ">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span> Dashboard <span class="badge badge-primary pull-right"></span></span>
                            </a>
                        </li>


                        <li class="has_sub ">
                            <a href="" class="waves-effect "><i class="mdi mdi-buffer "></i> <span>Events Details
                                </span>
                            </a>
                            <ul class="list-unstyled">
                                {{-- <li><a href="{{ url('user') }}"> <i class="mdi mdi-clock "> Home Top Data</i> --}}
                                <li><a href="{{ url('admin-upcoming-events') }}"> <i class="mdi mdi-clock ">Upcoming
                                            Events</i>
                                <li><a href="{{ url('admin-today-events') }}"> <i class="mdi mdi-clock ">Todays
                                            Events</i>
                                <li><a href="{{ url('admin-past-events') }}"> <i class="mdi mdi-clock "> Past
                                            Events</i>
                                    </a>
                            </ul>
                        </li>
                        <li class="has_sub ">
                            <a href="" class="waves-effect "><i class="mdi mdi-buffer "></i> <span>Users Management
                                </span>
                            </a>
                            <ul class="list-unstyled">
                                {{-- <li><a href="{{ url('user') }}"> <i class="mdi mdi-clock "> Home Top Data</i> --}}
                                <li><a href="{{ url('allUsers') }}"> <i class="mdi mdi-clock ">All Users</i>
                                        {{-- <li><a href="{{ url('accordion') }}"> <i class="mdi mdi-clock ">Blocked Users</i> --}}
                                        {{-- <li><a href="{{ url('counter') }}"> <i class="mdi mdi-clock "> Online Users</i> --}}
                                    </a>
                            </ul>
                        </li>



                        <li class="has_sub ">
                            <a href="#" class="waves-effect "><i class="mdi mdi-buffer "></i> <span>Event
                                    Management</span>
                            </a>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('/addEventTypes') }}"> <i class="mdi mdi-clock ">Add Event
                                            Types</i></a></li>
                                {{-- <li><a href="{{ url('social_link') }}"> <i class="mdi mdi-clock ">Add Event
                                            Conditions</i></a></li> --}}

                            </ul>
                        </li>

                        <li class="has_sub ">
                            <a href="#" class="waves-effect "><i class="mdi mdi-buffer "></i> <span>Issues</span>
                            </a>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('/get-all-issues') }}" class="waves-effect ">
                                        <i class="mdi mdi-clock ">All Issues</i>

                                    </a></li>

   

                                <li><a href="{{ url('/addIssueTypes') }}"> <i class="mdi mdi-clock ">Add Issue
                                            Types</i></a></li>
                            </ul>

                        </li>





                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <nav class="navbar-custom">

                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <img src="{{ asset($user->profilePicture->image) }}" alt="user"
                                        class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="GET"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="list-inline-item">
                                <button type="button" class="button-menu-mobile open-left waves-effect">
                                    <i class="ion-navicon"></i>
                                </button>
                            </li>
                            <li class="hide-phone list-inline-item app-search">
                                <h3 class="page-title">@yield('title')</h3>
                            </li>
                        </ul>

                        <div class="clearfix"></div>

                    </nav>

                </div>
                <!-- Top Bar End -->



                @yield('content')
                <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                <span class="text-red">Copyright © 2021 <a class="text-primary"
                        href="https://theeventspotter.com/"><strong>theeventspotter.com</strong></a> </span> <br>
                Designed & Developed By <a class="text-secondary" href="#"><strong> BM Solutions</strong></a>
            </footer>

        </div>
    </div>

    <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/js/tether.min.js') }}"></script>
    <script src="{{ asset('asset/js/popper.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('asset/js/detect.js') }}"></script>
    <script src="{{ asset('asset/js/fastclick.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('asset/js/waves.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/moment/moment.js') }}"></script>

    <!--Data tabel-->
    <script src="{{ asset('asset/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('asset/pages/datatables.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('asset/js/app.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/rfv7rfhx5vafv76ygxza52h080627sqb542j7d7736y9x8c2/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    @toastr_render
    @yield('scripts')
</body>


</html>
