<div class="col-md-3 float-left">
    <div class="sidebar ">
        <div class="sideBarActive active  align-items-center d-flex">
            <i class="fa fa-location-arrow mr-3 ml-3" aria-hidden="true"></i>
            <a class="side_tag" href="{{ '/' }}">Explore events</a>
        </div>
        <div>
            <i class="fa fa-calendar mr-3 ml-3" aria-hidden="true"></i>
            <a class="side_tag" href="{{ url('userEvents') }}">Your events</a>
        </div>
        <hr>
        <div>
            <i class="fa fa-heart mr-3 ml-3" aria-hidden="true"></i>
            <a class="side_tag" href="{{ url('favrouite') }}"> Favorite events</a>
        </div>
        <hr>
        <div>
            <i class="fa fa-user-plus mr-3 ml-3" aria-hidden="true"></i>
            <a class="side_tag" href="{{ url('follower') }}">Followers</a>
        </div>
        <hr>
        <div>
            <i class="fa fa-user mr-3 ml-3" aria-hidden="true"></i>
            <a class="side_tag" href="{{ url('following') }}">Following</a>
        </div>
        <hr>

    </div>
    <div class="filterEvents d-none ">
        <span class="leftMenuHeading">Filter events</span>
        <div class="filterEventsBox">
            {{-- <div class="row  ">
                    <span class="hintText">Sort by</span>
                    <div class=" fieldBackground ">
                        <select class="grey-background selectpicker" name="Interest" id="">
                            <option value="Interest">Interest</option>
                            <option value="Interest">Interest</option>
                            <option value="Interest">Interest</option>
                        </select>
                    </div>
                </div>
                <div class="row ">
                    <span class="hintText">Distance</span>
                    <div class="fieldBackground ">
                        5 kms
                    </div>
                </div>
                <div class="row">
                    <span class="hintText">From</span>
                    <div class=" fieldBackground  ">
                        <input type="date" name="fromDate" id="">
                    </div>
                </div>
                <div class="row ">
                    <span class="hintText">To</span>
                    <div class=" fieldBackground ">
                        <input type="date" name="toDate" id="">
                    </div>
                </div> --}}

            <div class="row ">
                <span class="leftMenuHeading ml-3">Conditions</span>
            </div>
            @php
                $events = \App\Models\Event::latest()->get();
                
                $eventConditionsArray = [];
                $df;
                foreach ($events as $key => $event) {
                    $eventConditionsArray = ($event->conditions);
                }
            @endphp
            <div class="row tagsParent">
                @foreach ($eventConditionsArray as $condition)
                    <div class=" tags">
                        {{ $condition }}
                    </div>
                @endforeach
            </div>


        </div>
    </div>
</div>
