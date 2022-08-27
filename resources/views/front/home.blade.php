@extends('layouts.main')
@section('title', 'HomePage')
@section('content')
    <div class="container-fluid">
        <div class="d-flex">
            @include('front.partials.sidebar')
            <div class="custom_main_contents pt-5">
                <div class="live_feed_section d-flex flex-column pb-2">
                    <div class="d-flex pb-4 e_live_feed_container justify-content-between align-items-center">
                        <span class="">Event Live Feed</span>
                        <a href="#seeAll" class="see_all">See All</a>
                    </div>
                    <div class="row">
                        @foreach ($nearEvents as $feed)
                            @if ($feed['livefeed'] != null)
                                <div class="col-6 d-flex live_feed_item">
                                    <img src="{{ asset($feed['livefeed']->path) }}" class="thumbnail" alt="">
                                    <div class="d-flex flex-column justify-content-start align-items-start ml-3">
                                        <div class="title font-weight-bold p-0">{{ $feed['livefeed']->description }}</div>
                                        <div class="d-flex align-items-center mt-1">
                                            <img src="{{ asset('assets/newimages/locationicon.svg') }}" class=""
                                                alt="">
                                            <span class="primary_color">9.4 miles away</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="live_feed_container"></div>
                    </div>
                </div>
                <div class="live_feed_section d-flex flex-column pb-2">
                    <div class="d-flex mt-3 pb-4 e_live_feed_container justify-content-between align-items-center">
                        <span class="">Event Near You</span>
                    </div>

                    {{-- Dynamic events near you --}}
                    @if (count($nearEvents) > 0)
                        @foreach ($nearEvents as $event)
                            @if (count($event['events']->eventPictures) > 0)
                                <div class="d-flex flex-column event_list_container pb-4 mb-5">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $event['events']->user->profilePicture != null ? url($event['events']->user->profilePicture->image) : url('assets/images/usersImages/userPlaceHolder.png') }}"
                                                class="profilePhoto_thumbnail" alt="">

                                            <div class="d-flex flex-column ml-2">
                                                <span class="user_name">{{ $event['events']->user->name }}</span>
                                                <span
                                                    class="time_ago">{{ \Carbon\Carbon::parse($event['events']->created_at)->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="">
                                            @if (Auth::id() != $event['events']->user_id)
                                                <a href="{{ url('profile/' . $event['events']->user->id) }}">

                                                </a>
                                                <button id="followBtn" class="btn follow_btn"
                                                    data-user-id="{{ $event['events']->user_id }}">
                                                    {{ $event['Following'] == 1 ? 'Followed' : 'Follow' }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="event_photo_container mt-3">
                                        <a href="{{ url('eventDetails/' . $event['events']->id) }}">
                                            @if (Str::substr($event['events']->eventPictures[0]->image_path, -3) == 'mp4' ||
                                                Str::substr($event['events']->eventPictures[0]->image_path, -3) == 'mov')
                                                <video class="eventBgImage img-fluid mr-3"
                                                    src="{{ asset($event['events']->eventPictures[0]->image_path) }}"
                                                    controls>
                                                    <source
                                                        src="{{ asset($event['events']->eventPictures[0]->image_path) }}"
                                                        type="video/mp4">
                                                </video>
                                            @else
                                                <img src="{{ asset($event['events']->eventPictures[0]->image_path) }}"
                                                    class="event_photo img-fluid" alt="no photo available" />
                                            @endif
                                        </a>
                                        <div class="d-flex flex-column event_details_container mt-3">
                                            <span class="title pb-0 px-0">{{ $event['events']->event_name }}</span>
                                            <span
                                                class="description mt-2 pt-0">{{ substr($event['events']->event_description, 0, 100) }}...</span>

                                            <div
                                                class="event_reactions_container mt-4 d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex align-items-center mr-4"
                                                        id="totalLikes{{ $event['events']->id }}">
                                                        {{-- <img
                                            src="{{ $event['isLiked'] == 1 ? asset('assets/newimages/likedheart.svg') : asset('assets/newimages/unlikedheart.svg') }}"
                                            class="cursor_pointer" alt=""> --}}
                                                        <img onclick="favroute(this) " data-id="{{ $event['events']->id }}"
                                                            src="{{ $event['isFavroute'] == 1 ? asset('assets/newimages/likedheart.svg') : asset('assets/newimages/unlikedheart.svg') }}"
                                                            class="cursor_pointer" alt="">


                                                        <span
                                                            class="text-dark ml-1">{{ $event['events']->like->count() }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('assets/newimages/comment.svg') }}"
                                                            class="cursor_pointer" alt="">
                                                        <span
                                                            class="text-dark ml-1">{{ $event['events']->comment->count() }}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex align-items-center mr-4">
                                                        <img src="{{ asset('assets/newimages/livesnap.svg') }}"
                                                            class="" alt="">
                                                        <span
                                                            class="text-dark ml-1">{{ $event['events']->liveFeed->count() }}
                                                            Live
                                                            snaps</span>
                                                    </div>
                                                    <div class="" style="position: relative;"
                                                        onclick="toggleOptions('toggle_option_container_e1')">
                                                        <img src="{{ asset('assets/newimages/optionicon.svg') }}"
                                                            class="py-1 cursor_pointer" alt="">

                                                        {{-- start toggle options --}}
                                                        <ul id="toggle_option_container_e1"
                                                            class="toggle_option_container d-none flex-column py-2">
                                                            <li class="py-2 pl-3">
                                                                <a href="{{ url('/social-media-share', $event['events']->id) }}"
                                                                    class="d-block w-full">
                                                                    <img src="{{ asset('assets/newimages/shareicon.svg') }}"
                                                                        class="" alt="">
                                                                    <span class="pl-1 share">Share</span>
                                                                </a>
                                                            </li>
                                                            <li class="py-2 pl-3">
                                                                <a href="#" class="d-block w-full">
                                                                    <img src="{{ asset('assets/newimages/reporticon.svg') }}"
                                                                        class="" alt="">
                                                                    <span class="pl-1 report">Report</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        {{-- end toggle options --}}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    @endif
                    {{-- End dynamic events near you --}}

                    {{-- Event container starts --}}
                    {{-- <div class="d-flex flex-column event_list_container pb-4 mb-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{asset('assets/newimages/thumbnail.svg')}}" class="profilePhoto_thumbnail"
                                alt="">
                            <div class="d-flex flex-column ml-2">
                                <span class="user_name">Kings Wallace</span>
                                <span class="time_ago">2 mins ago</span>
                            </div>
                        </div>
                        <div class="">
                            <button class="btn follow_btn">follow</button>
                        </div>
                    </div>
                    <div class="event_photo_container mt-3">
                        <img src="{{asset('assets/newimages/eventimage.svg')}}" class="event_photo" alt="">
                        <div class="d-flex flex-column event_details_container mt-3">
                            <span class="title pb-0 px-0">🎙️ AMA: Campus Night</span>
                            <span class="description mt-2 pt-0">The goal is to Inspire, empower and celebrate the next
                                generation of musical talents
                                through the...</span>
                            <div
                                class="event_reactions_container mt-4 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-4">
                                        <img src="{{asset('assets/newimages/likedheart.svg')}}" class="cursor_pointer"
                                            alt="">
                                        <span class="text-dark ml-1">71</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('assets/newimages/comment.svg')}}" class="cursor_pointer"
                                            alt="">
                                        <span class="text-dark ml-1">71</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-4">
                                        <img src="{{asset('assets/newimages/livesnap.svg')}}" class="" alt="">
                                        <span class="text-dark ml-1">6 Live snaps</span>
                                    </div>
                                    <div class="">
                                        <img src="{{asset('assets/newimages/optionicon.svg')}}"
                                            class="py-1 cursor_pointer" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                    {{-- Event container ends --}}

                </div>
            </div>

            {{-- Right bar --}}
            {{-- @include('newfront.partials.rightbar') --}}
            <div class="custom_rightbar pt-5 pl-4">
                @include('front.partials.search')

                <div class="sponsored_ads mt-4 p-3">
                    <span class="">Sponsored ads</span>
                </div>
                <div class="show_requests mt-4 p-3">
                    <div class="d-flex justify-content-end mb-4"><a href="{{ url('/notifications') }}"
                            class="primary_color seeAllRequests">See
                            all</a>
                    </div>
                    @foreach (\App\Models\Notifications::where('user_id', Auth::id())->take(5)->orderBy('created_at', 'DESC')->get() as $noti)
                        <a href="{{ url($noti->route_name) }}">
                            <div class="friend_list_container d-flex align-items-center mb-3">
                                @if ($noti->user->profilePicture != null)
                                    <img class="profilePhoto_thumbnail" src="{{ $noti->user->profilePicture->image }}"
                                        alt="thumbnail">
                                @else
                                    <img class="profilePhoto_thumbnail"
                                        src="{{ asset('assets/newimages/thumbnail.svg') }}" alt="thumbnail">
                                @endif
                                <span class="description ml-2">{{ $noti->message }}</span>
                                <span class="time_ago">{{ $noti->created_at->diffForHumans() }}</span>
                            </div>
                    @endforeach
                </div>
                @include('front.partials.doclinks')
                <div class="mt-2 pb-3 bottom_links_border"><a href="#" class="primary_color">More...</a></div>
                <div class="footer_notes d-flex align-items-center justify-content-between mt-4">
                    <span class="">© Event Spotter. 2022</span>
                    <a href="#" target="_blank" rel="noopener noreferrer">
                        <img class="getApp" src="{{ asset('assets/newimages/rightbaricons/getapp.svg') }}"
                            alt="searchicon">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
