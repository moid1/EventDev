@extends('layouts.main')
<link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">

@section('title', 'Followers')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3  float-left">
                <div class="sidebar ">
                    <div>
                        <i class="fa fa-location-arrow mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="{{ '/' }}">Explore events</a>
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
                    <div class="sideBarActive active  align-items-center d-flex">
                        <i class="fa fa-user-plus mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="#">Followers</a>
                    </div>
                    <hr>
                    <div class=" align-items-center d-flex">
                        <i class="fa fa-user mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="{{ url('/following') }}">Following</a>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="col-md-6">
                {{-- pending Request --}}
                @if (count($pendingRequest) > 0)
                    <div class="followers ">
                        <div class="title">Pending Follow Requests</div>
                        @foreach ($pendingRequest as $request)
                            <div class=" pendingRequests d-flex  justify-content-between">
                                <div class="d-flex align-items-center ml-2">
                                    @if ($request->user->profilePicture)
                                        <img class="circularImage"
                                            src="{{ asset($request->user->profilePicture->image) }}" alt="">
                                    @else
                                        <img class="circularImage"
                                            src="{{ asset('assets/images/usersImages/userPlaceHolder.png') }}" alt="">
                                    @endif
                                    <span class="ml-2"> {{ $request->user->name }}</span>
                                </div>
                                <div class="d-flex m-2">
                                    <button id="acceptFollowingRequest"
                                        onclick="acceptFollowingRequest({{ $request->id }})"
                                        class="logout">Accept</button>
                                    <button id="cancelFollowingRequest"
                                        onclick="cancelFollowerRequest({{ $request->id }}, {{$request->following_id}})"
                                        class="logout cancelBG">Cancel</button>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                    </div>
                @endif
                {{-- following peoples --}}
                <div class="followers">
                    <div class="title">You have <span>{{ count($followers) }} Followers</span></div>
                    @foreach ($followers as $follower)
                        <a href="{{ url('profile/' . $follower->user->id) }}" style="color: black">
                            <div class="data text-left">
                                @if ($follower->user->profilePicture)
                                    <img class="circularImage" src="{{ asset($follower->user->profilePicture->image) }}"
                                        alt="">
                                @else
                                    <img class="circularImage"
                                        src="{{ asset('assets/images/usersImages/userPlaceHolder.png') }}" alt="">
                                @endif
                                <div class="d-grid ml-2">
                                    {{ $follower->user->name }}
                                    <span class="description"> Follows you since
                                        {{ $follower->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                        </a>
                        {{-- <div class="description">
                        </div> --}}

                        <div class="block">
                            <i class="fa fa-ban" onclick="unfollow('{{ $follower->following_id }}')"></i> Unfollow`
                        </div>
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
                    }
                })
                .done(function() {
                    location.reload();

                })
        }

        function cancelFollowerRequest(id,followingId) {
            $.ajax({
                    type: 'POST',
                    url: '/cancelPendingRequest',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id": id,
                        
                    },
                    success: function(response) {
                        // showToaster(response.message, 'success');

                    }
                })
                .done(function() {
                    location.reload();
                })
        }

        function unfollow(id) {
            $.ajax({
                    type: 'POST',
                    url: '/unfollow',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id": id,
                    },
                    success: function(response) {
                        showToaster(response.message, 'success');
                    }
                })
                .done(function() {
                    location.reload();

                })
        }
    </script>
@endsection
