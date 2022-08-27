@extends('chat_layout.app')

@section('content')
    <style>
        .modal-dialog {
            position: absolute !important;
            left: 0 !important;
            right: 0 !important;
            top: 20px !important;
        }

        @media only screen and (max-width: 600px) {
            .panel {
                margin-left: 25%;
                width: 70%;
            }
        }

    </style>

    <div class="layout-wrapper d-lg-flex">

        <div class="chat-leftsidebar mt-5" style="background-color: white; border: 1px solid rgb(223, 223, 223)">

            <div class="px-4 pt-4 " style="padding:20px">
                <div class="float-left">
                    <h4 class="mb-4">Chats</h4>
                </div>
                <div class="float-right">


                    <i class="fa fa-plus " data-toggle="modal" data-target="#exampleModalCenter"
                        style="font-size: 16px"></i>
                </div>
            </div> <!-- .p-4 -->
            <hr>

            <div class="mt-5">

                @foreach ($messages as $message)
                    <div class="px-2" style="height: 100px">
                        <div class="chat-message-list" data-simplebar>
                            <ul class="list-unstyled chat-list chat-user-list">

                                <li class="active">
                                    <a href="javascript:void(0);" class="chat-toggle"
                                        data-id="{{ $message->user->id }}"
                                        data-is-active=" {{ Cache::has('user-is-online-' . $message->toUser->id) }}"
                                        data-last-seen="{{ \Carbon\Carbon::parse($message->toUser->last_seen)->diffForHumans() }}"
                                        data-user="{{ $message->toUser->name }}">
                                        <div class="d-flex">
                                            <div class="chat-user-img online align-self-center me-3 ms-0">

                                                <img src="{{ url($message->toUser->profilePicture->image ?? 'image/user-avatar.png') }}"
                                                    class="rounded-circle avatar-xs " alt="">

                                                {{-- <img src="{{ url('chat/assets/images/users/avatar-4.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt=""> --}}

                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-15 mb-1 ">
                                                    {{ $message->toUser->id == Auth::id() ? $message->fromUser->name : $message->toUser->name }}

                                                </h5>

                                                <p class="chat-user-message text-truncate mb-0">
                                                    {{ $message->content }}</p>



                                            </div>
                                            <div class="font-size-11">{{ $message->created_at->diffForHumans() }}

                                                <p
                                                    class="  {{ Cache::has('user-is-online-' . $message->toUser->id) ? 'greenDot' : 'redDot' }} ">
                                                </p>
                                            </div>



                                        </div>

                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                @endforeach

                <!-- End chat-message-list -->
            </div>
            <!-- Start chats content -->


        </div>


        <div class=" w-100 d-flex  align-items-center justify-content-center">
            <div class="text-center">
                <img src="{{ asset('assets/images/headerLogo.png') }}" alt="">
                <h2 class="ml-5">Start a new conversation</h2>
            </div>
        </div>


        <!-- Button trigger modal -->





        @include('chat_layout.chat-box')

        <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
        <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
        <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />

        <!-- Modal -->
        <div class="modal " id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Start a conversation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-3">
                            <div class="d-flex    headerSearchBColor ">
                                <img class="img-fluid ml-2 mr-2 " src="{{ url('assets/images/icons/searechIcon.png') }}"
                                    alt="search">
                                <input class="" id="searchss" name="search" type="text" placeholder="Search">

                            </div>
                        </div>
                        <div class="searchUserChatResult"></div>
                        {{-- <ul>
                        @foreach ($followingUser as $following)
                            <a href="javascript:void(0);" class="chat-toggle" data-id="{{$following->followingUser->id }}"
                                data-user="{{ $following->followingUser->name }}">
                                <li>{{ $following->followingUser->name }}</li>
                            </a>
                        @endforeach

                    </ul> --}}
                    </div>
                    {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')

    <script>
        $('#searchss').on('keyup', function() {
            var text = $('#searchss').val();
            if (text == '')
                $('.searchUserChatResult').addClass('d-none');
            else
                $('.searchUserChatResult').removeClass('d-none');
            if (text.length >= 3) {
                $.ajax({
                    type: "GET",
                    url: '/search',
                    data: {
                        text: text,
                    },
                    success: function(data) {
                        $('.searchUserChatResult').html("");
                        if (data[0].profile_picture !== null)
                            var img =
                                "<img class='circularImage pic mr-3' src=" + data[0]
                                .profile_picture.image + " />"
                        else
                            var img =
                                "<img class='circularImage pic mr-3 mb-3' src='{{ asset('assets/images/usersImages/userPlaceHolder.png') }}' />"
                        if (data.length == 0)
                            $('.searchUserChatResult').append(
                                '<div class="w-100 justify-content-center " style="background:white;padding:20px">No Result Found</div>'
                            );
                        $.each(data, function(key, value) {
                            var url = "{{ url('profile') }}" + "/" + value.id;

                            $('.searchUserChatResult').append(
                                '<a href="javascript:void(0);" class="chat-toggle"  data-id="' +
                                value.id + '" data-user="' + value.name +
                                '" > <div class="w-100  justify-content-center " style="background:white">' +
                                img + value
                                .name + '<hr></div> </a>');
                        })
                    }
                }).done(function() {})
            }
        });
    </script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>



@stop
