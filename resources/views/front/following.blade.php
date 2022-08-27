@extends('layouts.main')
<link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">

@section('title', 'Following')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3  float-left">
                <div class="sidebar ">
                    <div>
                        <i class="fa fa-location-arrow mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="{{ url('/') }}">Explore events</a>
                    </div>
                    <hr>
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
                    <div class="sideBarActive active  align-items-center d-flex">
                        <i class="fa fa-user mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="{{ url('following') }}">Following</a>
                    </div>
                    <hr>

                </div>
            </div>
            <div class="col-md-6">

                {{-- following peoples --}}
                <div class="followers">
                    <div class="title">You are Following <span>{{ count($following) }} People </span></div>
                    @foreach ($following as $follow)
                        <a href="{{ url('profile/' . $follow->followingUser->id) }}" style="color: black">
                            <div class="data">
                                <img class="circularImage"
                                    src={{ $follow->followingUser->profilePicture ? asset($follow->followingUser->profilePicture->image) : asset('assets/images/usersImages/userPlaceHolder.png') }}
                                    alt="">
                                <div class="d-grid ml-2">
                                    {{ $follow->followingUser->name }}
                                    <span class="description">Last update
                                        {{ $follow->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </a>


                        <div class="block" onclick="unfollow({{ $follow->id }})">
                            <img src="assets/images/following.png" alt=""> Unfollow
                        </div>
                        @if ($follow->is_accepted == false)
                            <div class="block mr-3">
                                <img src="assets/images/following.png" alt=""> Cancel
                            </div>
                        @endif

                        <div class="last"></div>
                    @endforeach
                </div>
            </div>

            @include('front.right_side')

        </div>
    </div>
@endsection
@section('script')
    <script>
        function unfollow(id) {
            $.ajax({
                    type: 'POST',
                    url: '/unfollowing',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id": id,
                    },
                    success: function(response) {
                        showToaster(response.message, 'success');
                        location.reload();
                    }
                })
                .done(function() {

                })
        }
    </script>
    {{-- <script>
        function acceptFollowingRequest(id) {
            $.ajax({
                    type: 'POST',
                    url: '/acceptFollowingRequest',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id": id,
                    },
                    success: function(response) {
                        showToaster(response.message, 'success');
                        location.reload();
                    }
                })
                .done(function() {

                })
        }
    </script> --}}
@endsection
