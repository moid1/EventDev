<div class="custom_sidebar pt-5">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <a href="{{url('/')}}"> <img class="img-fluid mb-5" src="{{ asset('assets/newimages/logo.svg') }}" alt="logo">
        </a>
        <ul class="w-100">
            <li class="w-100">
                <a href="{{ url('/') }}" class="d-flex py-2 mb-2 justify-content-center align-items-center">
                    <div class="sidebar_icon">
                        <img src="{{ asset('/assets/newimages/sidebaricons/home.svg') }}" alt="img">
                    </div>
                    <span @class(['ml-2', 'font-weight-bold' => false])>Home</span>
                </a>
            </li>
            <li class="w-100">
                <a href="#2" class="d-flex py-2 mb-2 justify-content-center align-items-center">
                    <div class="sidebar_icon">
                        <img src="{{ asset('/assets/newimages/sidebaricons/events.svg') }}" alt="img">
                    </div>
                    <span @class(['ml-2', 'font-weight-bold' => false])>Events</span>
                </a>
            </li>
            <li class="w-100">
                <a href="#2" class="d-flex pl-4 py-2 mb-2 justify-content-center align-items-center">
                    <div class="sidebar_icon">
                        <img src="{{ asset('/assets/newimages/sidebaricons/message.svg') }}" alt="img">
                    </div>
                    <span @class(['ml-2', 'font-weight-bold' => false])>Message</span>
                </a>
            </li>
            <li class="w-100">
                <a href="{{ url('profile') }}" class="d-flex py-2 mb-2 justify-content-center align-items-center">
                    <div class="sidebar_icon">
                        <img src="{{ asset('/assets/newimages/sidebaricons/profile.svg') }}" alt="img">
                    </div>
                    <span @class(['ml-2', 'font-weight-bold' => false])>Profile</span>
                </a>
            </li>
            <li class="w-100">
                <button onclick="createEventModal()" class="btn mx-auto create_event_btn d-flex align-items-center">
                    <img src="{{ asset('/assets/newimages/sidebaricons/plusicon.svg') }}" alt="img">
                    <span class="text-white ml-2">Create event</span>
                </button>
            </li>
        </ul>
    </div>
    <div class="profile_user d-flex align-items-center" id="profileUser">
        <img class="user_avatar" src="{{ asset('assets/newimages/logo.svg') }}" alt="logo">
        <span class="font-weight-bold ml-1"><span>@</span>{{ Auth::user()->name }}</span>
        <img class="ml-4 p-1 account_options" id="account_options"
            src="{{ asset('assets/newimages/sidebaricons/chevronicon.svg') }}" alt="arrow">
        <ul class="options_list_container" id="options_list_container">
            <li class="option_list_item w-full">
                <a href="#Asettings" class="d-block py-2 text-center text-white w-full">Account settings</a>
            </li>
            <li class="option_list_item">
                <a href="{{url('/logout')}}" class="d-block py-2 text-center text-white w-full">Logout</a>
            </li>
        </ul>
    </div>
</div>

@include('front.partials.eventmodal')
