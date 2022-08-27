@extends('layouts.main')
@section('title', 'Event Comments')
<style>
    .commentBtn{
        margin-right: 15px;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <div class="eventsNearYouSection ">
                    <div class="eventsNearYouBG" style="box-shadow: none">
                        <div class="eventsNearYou">
                            <img src="{{ asset($eventDetails['event']->eventPictures[0]->image_path) }}"
                                class="eventBgImage " alt="" srcset="">
                            <div class="options">
                                {{-- <div
                                    class="{{ $eventDetails['Following'] == 1 ? 'darkGreenBanner' : 'greenBanner' }}   align-items-center d-flex">
                                    <i class="fa fa-user-plus text-white">
                                        <span class="text-white">Followed</span>
                                    </i>
                                </div> --}}
                                {{-- <div class="whiteIconsBackgroundBox ">
                                    <i class="fa fa-heart red "></i>
                                </div> --}}
                                {{-- <div class="whiteIconsBackgroundBox mt-5 ">
                                    <i class="fa fa-flag light-grey "></i>
                                </div> --}}
                            </div>
                            <div class="whiteBanner left-0  text-center align-items-center d-flex">
                                @if ($eventDetails['event']->user->profilePicture != null)
                                    <img class="smallCircularImage mr-2 "
                                        src="{{ url($eventDetails['event']->user->profilePicture->image) }}" />
                                @else
                                    <img class="smallCircularImage mr-2 "
                                        src="{{ url('assets/images/usersImages/userPlaceHolder.png') }}" />
                                @endif
                                <span>{{ $eventDetails['event']->user->name }}</span>
                            </div>
                            <div class="whiteBanner text-center align-items-center d-flex">
                                <i class="fa fa-user-plus">
                                    <span>{{ $eventDetails['event']->user->followers->count() }} Followers</span>
                                </i>
                            </div>
                        </div>

                        <div class="eventsSubDetails row ">
                            <div class="col-md-5">
                                <span class="eventsTitle">{{ $eventDetails['event']->event_name }}</span>
                            </div>
                            <div class="col-md-5 col-sm-5 col-5">
                                <div class="smallTextGrey row">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <i class="fa fa-calendar nowrap ">
                                            <span>{{ $eventDetails['event']->created_at->diffForHumans() }}</span>
                                        </i>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <i class="fa fa-map-marker nowrap ">
                                            <span>{{ $eventDetails['km'] }} Miles away</span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="eventOptions">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ url('eventDetails/' . $eventDetails['event']->id) }}">
                                    <div class="col-md-2  mediumTextGrey">
                                        <span class="nowrap ">Events Details</span>
                                        <span class="ml-5 center"></span>
                                    </div>
                                </a>
                                <div class="col-md-2  mediumTextGrey">
                                    <span id="totalLikes{{ $eventDetails['event']->id }}"
                                        class="eventsDetailsHome  fa fa-thumbs-up">
                                    </span>
                                    {{ $eventDetails['event']->like->count() }}
                                    Likes

                                </div>
                                <div class="col-md-3 mb-2  mediumTextGrey nowrap">

                                    <span class="ml-1 b_comment"><img class="comt_img"
                                            src="{{ asset('assets/images/chatwhite.png') }}" alt="">
                                        {{ $comments->count() }}
                                        Comments</span>


                                </div>
                                {{-- <div class="col-md-2  mediumTextGrey ">
                                    <img src="{{ asset('assets/images/forword.png') }}" alt="">
                                    <span class="ml-1 "> 20 Shares</span>
                                    <span class="ml-5 center"></span>

                                </div> --}}
                                <a class="nowrap" href="{{ url('eventSnap/' . $eventDetails['event']->id) }}">
                                    <div class="col-md-2  mediumTextGrey">
                                        <img src="{{ asset('assets/images/sna.png') }}" alt="">
                                        <span class="ml-2 "> {{ $eventFeeds->count() }} Live Snaps</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="eventsComment">
                    <span class="commentTitle "> {{ $comments->count() }} Comments</span>
                    @foreach ($comments as $comment)
                        <div
                            class="{{ Auth::id() == $comment->user_id ? 'yourComment ' : 'otherComment' }} comments mt-2">
                            <div class="row ">
                                @if ($comment->user->profilePicture != null)
                                    <img class="smallCircularImage mr-2 "
                                        src="{{ url($comment->user->profilePicture->image) }}" />
                                @else
                                    <img class="smallCircularImage mr-2 "
                                        src="{{ url('assets/images/usersImages/userPlaceHolder.png') }}" />
                                @endif

                                <span
                                    class="commenterName">{{ Auth::id() == $comment->user_id ? 'You' : $comment->user->name }}
                                </span>
                                <span class="commentTime"> {{ $comment->created_at->diffForHumans() }}</span>
                                {{-- <img src="{{ url('assets/images/forword.png') }}"
                                        alt=""> --}}
                                {{-- <img
                                        src="{{ url('assets/images/flag.png') }}" alt=""> --}}
                            </div>
                            <br>
                            <span class="commentText"> {{ $comment->comment }}</span>
                        </div>
                    @endforeach

                    <div class="userWillComment mt-3">
                        <textarea placeholder="Write Comment" style="color: #74ABB0" type="text" name="comment"
                            id="comment"></textarea>
                        <button id="commentBtn" class="commentBtn" value="Comment">Comment</button>
                    </div>




                </div>
            </div>
            @include('front.right_side')
        </div>
    </div>
@endsection

@section('script')
    <script>
        var eventss = {!! json_encode($eventDetails['event']->toArray()) !!};

        $('#commentBtn').click(function(event) {
            event.preventDefault();
            if ($('#comment').val().length == 0) {
                alert('Comment required to post');
                return;
            }
            var formData = {
                event_id: eventss.id,
                comment: $('#comment').val(),
            };


            $.ajax({
                type: 'POST',
                url: '/storeComment',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                error: function(res) {
                    var errors = JSON.parse(res.responseText);

                }
            }).done(function(msg) {
                location.reload();
            })
        });
    </script>
@endsection
