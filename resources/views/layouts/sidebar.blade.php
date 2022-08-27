<div class="sidebar ">
    <div>
        <i class="fa fa-location-arrow mr-3 ml-3" aria-hidden="true"></i>
        <a class="side_tag" href="{{ url('/') }}">Explore events</a>
    </div>
    <hr>
    <div>
        <i class="fa fa-calendar mr-3 ml-3" aria-hidden="true"></i>
        <a class="side_tag" href="{{ url('/yourEvents') }}">Your events</a>
    </div>
    <hr>
    <div>
        <i class="fa fa-heart mr-3 ml-3" aria-hidden="true"></i>
        <a class="side_tag" href="favourit.html"> Favorite events</a>
    </div>
    <hr>
    <div>
        <i class="fa fa-user-plus mr-3 ml-3" aria-hidden="true"></i>
        <a class="side_tag" href="{{ url('/follower') }}">Followers</a>
    </div>
    <hr>
    <div class="sideBarActive active  align-items-center d-flex">
        <i class="fa fa-user mr-3 ml-3" aria-hidden="true"></i>
        <a class="side_tag" href="{{ url('following') }}">Following</a>
    </div>
    <hr>
    <div>
        <i class="fa fa-calendar-check-o mr-3 ml-3" aria-hidden="true"></i>
        <a class="side_tag" href="events_your.html">Event you attended</a>
    </div>
    <hr>
</div>
