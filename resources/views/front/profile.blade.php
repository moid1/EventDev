@extends('layouts.main')
@section('title', 'Profile')
@section('content')
    <div class="container-fluid">
        <div class="d-flex">
            @include('front.partials.sidebar')


            <div class="custom_main_contents pt-5">
                <div class="live_feed_section d-flex flex-column pb-2">
                    <div class="d-flex pb-3 e_live_feed_container border-bottom">
                        <span class="order-2">Your profile</span>
                        <img class="p-1 back_arrow order-1" id="account_options"
                            src="{{ asset('assets/newimages/sidebaricons/chevronicon.svg') }}" alt="arrow">
                    </div>
                    <div class="row mt-5 px-3">
                        <div class="col-12 d-flex py-3 profile_card">
                            <div class="d-flex flex-column align-items-center mr-5">
                                <img class="user_photo"
                                    src="{{ $profilePicture ? asset($profilePicture->image) : asset('assets/images/usersImages/userPlaceHolder.png') }}"
                                    alt="">
                                <span class="user_name mt-2">{{ $user->name }}</span>
                                <span class="user_handle">@ {{ $user->name }}</span>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="d-flex">
                                    <div class="d-flex flex-column pr-5 tag_border_right">
                                        <span class="tag_count_number">{{ $following }}</span>
                                        <span class="tag_count_label">Following</span>
                                    </div>
                                    <div class="d-flex flex-column pl-5 pr-4 tag_border_right">
                                        <span class="tag_count_number">{{ $followers }}</span>
                                        <span class="tag_count_label">Following</span>
                                    </div>
                                    <div class="d-flex flex-column pl-5">
                                        <span class="tag_count_number">{{ $totalEvents ?? '0' }}</span>
                                        <span class="tag_count_label">Events</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-4">
                                    <a href="#" class="d-flex align-items-center mr-5">
                                        <div class="edit_profile_icon_container mr-2">
                                            <img class="p-1 edit_profile_icon" id=""
                                                src="{{ asset('assets/newimages/editicon.svg') }}" alt="editicon">
                                        </div>
                                        <span class="edit_profile_text">Edit profile</span>
                                    </a>
                                    <a href="#" class="d-flex align-items-center">
                                        <div class="edit_profile_icon_container mr-2">
                                            <img class="p-1 edit_profile_icon" id=""
                                                src="{{ asset('assets/newimages/settingsicon.svg') }}" alt="settingsicon">
                                        </div>
                                        <span class="edit_profile_text">Settings</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 tab_container col-12 px-0">
                            <ul class="tab_header_container d-flex align-items-center justify-content-center col-12 px-2">
                                <li data-item='upcomingTabContainer' class="col-4 text-center active_tab">Upcoming</li>
                                <li data-item='pastEventsTabContainer' class="col-4 text-center">Past events</li>
                                <li data-item='draftTabContainer' class="col-4 text-center ">Draft</li>
                            </ul>
                            <div id="upcomingTabContainer" class="tab_items ">
                                @foreach ($upcomingEvents as $event)
                                    <div style="border-bottom: 1px solid #F0F0F0;"
                                        class="pb-4 d-flex justify-content-between align-items-between pl-0">
                                        <div class="d-flex flex-column align-items-start">
                                            <div class="d-flex align-items-center">
                                                <span class="mr-1 pl-0 title">{{$event->event_name}}</span>
                                                <span class="label">New</span>
                                            </div>
                                            <div class="date_distance">{{$event->event_date}} | {{$event->location}}</div>
                                            <div class="d-flex align-items-center mt-3">
                                                <div class="d-flex align-items-center mr-4">
                                                    <img onclick="alert('toggle like')"
                                                        src="{{ asset('assets/newimages/unlikedheart.svg') }}"
                                                        class="cursor_pointer" alt="">
                                                    <span class="text-dark ml-1">71</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('assets/newimages/comment.svg') }}"
                                                        class="cursor_pointer" alt="">
                                                    <span class="text-dark ml-1">71</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="event_image_container">
                                            <img class="event_image" id=""
                                                src="{{ asset($event->eventPictures[0]->image_path) }}"
                                                alt="userprofilephoto">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div id="pastEventsTabContainer" class="tab_items d-none">
                                @foreach ($pastEvents as $event)
                                    <div style="border-bottom: 1px solid #F0F0F0;"
                                        class="pb-4 d-flex justify-content-between align-items-between pl-0">
                                        <div class="d-flex flex-column align-items-start">
                                            <div class="d-flex align-items-center">
                                                <span class="mr-1 pl-0 title">{{$event->event_name}}</span>
                                                <span class="label">New</span>
                                            </div>
                                            <div class="date_distance">{{$event->event_date}} | {{$event->location}}</div>
                                            <div class="d-flex align-items-center mt-3">
                                                <div class="d-flex align-items-center mr-4">
                                                    <img onclick="alert('toggle like')"
                                                        src="{{ asset('assets/newimages/unlikedheart.svg') }}"
                                                        class="cursor_pointer" alt="">
                                                    <span class="text-dark ml-1">71</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('assets/newimages/comment.svg') }}"
                                                        class="cursor_pointer" alt="">
                                                    <span class="text-dark ml-1">71</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="event_image_container">
                                            <img class="event_image" id=""
                                                src="{{ asset($event->eventPictures[0]->image_path) }}"
                                                alt="userprofilephoto">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div id="draftTabContainer" class="tab_items d-none">
                                @foreach ($draftEvents as $event)
                                <div style="border-bottom: 1px solid #F0F0F0;"
                                    class="pb-4 d-flex justify-content-between align-items-between pl-0">
                                    <div class="d-flex flex-column align-items-start">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-1 pl-0 title">{{$event->event_name}}</span>
                                        </div>
                                        <div class="date_distance">{{$event->event_date}} | {{$event->location}}</div>
                                        <div class="d-flex align-items-center mt-3">
                                            <div class="d-flex align-items-center mr-4">
                                                <img onclick="alert('toggle like')"
                                                    src="{{ asset('assets/newimages/unlikedheart.svg') }}"
                                                    class="cursor_pointer" alt="">
                                                <span class="text-dark ml-1">71</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/newimages/comment.svg') }}"
                                                    class="cursor_pointer" alt="">
                                                <span class="text-dark ml-1">71</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="event_image_container">
                                        <img class="event_image" id=""
                                            src="{{ asset($event->eventPictures[0]->image_path) }}"
                                            alt="userprofilephoto">
                                    </div>
                                </div>
                            @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Right bar --}}
            {{-- @include('newfront.partials.rightbar') --}}
            <div class="custom_rightbar pt-5 pl-4 pb-5">
                @include('front.partials.search')

                <div class="sponsored_ads mt-4 p-3">
                    <span class="">Sponsored ads</span>
                </div>
                <div class="show_requests mt-4 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span class="rightbar_heading_title">Notifications</span>
                        <div class="d-flex justify-content-end"><a href="#seeAll" class="primary_color seeAllRequests">See
                                all</a>
                        </div>
                    </div>
                    <div class="">
                        <a class="friend_list_container d-flex align-items-center mb-2">
                            <img class="profilePhoto_thumbnail" src="{{ asset('assets/newimages/thumbnail.svg') }}"
                                alt="thumbnail">
                            <span class="description ml-2">You have a follow request
                                from John Dereek</span>
                            <span class="time_ago">2 hours ago</span>
                        </a>
                        <a class="friend_list_container d-flex align-items-center mb-2">
                            <img class="profilePhoto_thumbnail" src="{{ asset('assets/newimages/thumbnail.svg') }}"
                                alt="thumbnail">
                            <span class="description ml-2">You have a follow request
                                from John Dereek</span>
                            <span class="time_ago">2 hours ago</span>
                        </a>
                    </div>
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
    <script type="text/javascript">
        var eventConditionsArray = [];
        let is_public = 1;
        var lat, lng;
        var geocoder;

        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        var myDate = document.querySelector('event_date');
        var today = new Date();
        $('#event_date').val(today.toISOString().substr(0, 10));


        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
        }
        //Get the latitude and the longitude;
        function successFunction(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            codeLatLng(lat, lng);
        }

        function errorFunction(error) {
            alert('Please enable location');
        }

        function initialize() {
            var places = new google.maps.places.Autocomplete(document.getElementById('venue'));
            console.log(places);
            google.maps.event.addListener(places, 'place_changed', function() {
                var place = places.getPlace();
                console.log(place);
                var address = place.formatted_address;
                lat = place.geometry.location.lat();
                lng = place.geometry.location.lng();


            });
            geocoder = new google.maps.Geocoder();
        }

        function codeLatLng(lat, lng) {
            var latlng = new google.maps.LatLng(lat, lng);
            console.log(lat + '  ' + lng);
            $.ajax({
                type: 'POST',
                url: '/save-lat-lng',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "lat": lat,
                    'lng': lng,
                }
            }).done(function(msg) {

            })
        }

        function myfunction() {
            location.replace("your_event.html")
        }

        function eventConditions(condition) {

            if (condition.innerText == 'Add Conditions') {
                var conditionText = prompt("Condition", "");
                $("<P onclick='removeConditions(this)' id=" + conditionText + " class='event_tagg mt-2'>" +
                    conditionText +
                    "</P>").insertAfter(
                    '.eventCond');
                eventConditionsArray.push(conditionText);

            } else {

            }
        }

        function removeConditions(condition) {
            $('#' + condition.innerText).remove();
            eventConditionsArray = eventConditionsArray.filter(item => item !== condition.innerText)
        }

        function makeEventPublic(val) {
            is_public = val;
            if (val == 1) {
                $('#publicBtn').addClass('event_tag');
                $('#publicBtn').removeClass('event_t')
                $('#privateBtn').addClass('event_t');
                $('#privateBtn').removeClass('event_tag');
                $('#eventMsg').html(
                    'This event will be public. Everyone on Event Spotter will be able to see this event details.');

            } else {
                $('#publicBtn').addClass('event_t');
                $('#publicBtn').removeClass('event_tag');
                $('#privateBtn').addClass('event_tag');
                $('#privateBtn').removeClass('event_t');
                $('#eventMsg').html('This event can only be viewed by your followers Or people you are following.');
            }
        }


        $('#createEventButton').click(function(event) {
            event.preventDefault();
            var form_data = new FormData();
            if (eventImages1 == null) {
                showToaster('Image is required', '');
                return;
            }
            form_data.append("image", eventImages1.files[0]);
            form_data.append('event_name', $('#eventName').val());
            form_data.append('event_description', $('#eventDescription').val());
            form_data.append('event_type', $('#eventType :selected').text());
            form_data.append('location', $('#venue').val());
            form_data.append('event_date', $('#event_date').val());
            form_data.append('ticket_link', $('#ticket_link').val());
            form_data.append('conditions', eventConditionsArray);
            form_data.append('is_public', is_public);
            if (lat)
                form_data.append('lat', lat);
            if (lng)
                form_data.append('lng', lng);
            $.ajax({
                type: 'POST',
                url: '/createEvent',
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                beforeSend: function() {
                    // $("#uploadSnap").prop('disabled', true); //disable.
                    $('.progress').removeClass('d-none');
                    $('#uploadPictureBtn').hide();
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener("progress", function(evt) {

                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);

                            var percentVal = percentComplete + '%';
                            bar.width(percentVal);
                            bar.css("background", "#314648");
                            percent.html(percentVal);

                        }
                    }, false);

                    return xhr;
                },
                error: function(res) {
                    var errors = JSON.parse(res.responseText);
                    console.log(errors);
                    if (errors.errors.event_date) {
                        showToaster('Date is not valid.', 'error');
                    } else if (errors.errors.lat) {
                        showToaster('Location is not valid.', 'error');
                    } else if (errors.errors.lng) {
                        showToaster('Location is not valid.', 'error');
                    }
                    $('#uploadPictureBtn').show();


                }
            }).done(function(msg) {
                showToaster('Your event has been created successfully', 'success');
                $('.progress').addClass('d-none');

                $('#createEventModal').modal('toggle');
                location.reload();

            })
        });

        //draft event

        $('#draftEvent').click(function(event) {
            event.preventDefault();
            var form_data = new FormData();
            if (eventImages1.files[0] != null)
                form_data.append("image", eventImages1.files[0]);
            form_data.append('event_name', $('#eventName').val());
            form_data.append('event_description', $('#eventDescription').val());
            form_data.append('event_type', $('#eventType :selected').text());
            form_data.append('location', $('#venue').val());
            form_data.append('ticket_link', $('#ticket_link').val());
            form_data.append('event_date', $('#event_date').val());
            form_data.append('conditions', eventConditionsArray);
            form_data.append('is_public', is_public);

            $.ajax({
                type: 'POST',
                url: '/draftEvent',
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data
            }).done(function(msg) {
                showToaster('Your event has been drafted', 'success');
                $('#createEventModal').modal('toggle');


            })
        });

        //upload Event Pictures & Videos

        function getImages() {
            $('#uploadEventPicture').click();
        }
        var eventImages1 = null;
        $(function() {
            $('#uploadEventPicture').change(function() {
                var input = this;
                eventImages1 = input;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#eventVideoSrc').hide();
                        $('#eventPictureSrc').attr('src', e.target.result);
                        $('#eventPictureSrc').addClass('img-fluid mb-5 mt-3');
                        $('#eventPictureSrc').show();

                    }
                    $('.uploadCatchyText').addClass('d-none');
                    reader.readAsDataURL(input.files[0]);


                } else if (input.files && input.files[0] && (ext == "mp4" || ext == "mov")) {
                    $('#eventPictureSrc').toggle();
                    var reader = new FileReader();
                    let file = input.files[0];
                    let blobURL = URL.createObjectURL(file);
                    document.querySelector("video").style.display = 'block';
                    document.querySelector("video").src = blobURL;
                    reader.onload = function(e) {
                        $('#eventVideoSrc').show();
                        // var $source = $('#eventVideoSrc');
                        // $source[0].src = URL.createObjectURL(input.files[0]);
                        // $source.parent().load();
                        $('#eventPictureSrc').hide();

                        // $('#eventPictureSrc').addClass('img-fluid mb-5 mt-3');
                    }
                    // $('.uploadCatchyText').addClass('d-none');
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('Invalid Image type');
                }
            });

        });

        function favroute(icon, eventId) {
            var id = $(icon).attr('data-id');
            if ($(icon).hasClass("light-grey")) {
                $.ajax({
                    type: 'POST',
                    url: '/saveFavrouite',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'event_id': id,
                    }
                }).done(function(msg) {
                    showToaster(msg.message, 'success');
                    $(icon).removeClass('light-grey');
                    $(icon).addClass('red');
                })
            } else if ($(icon).hasClass('red')) {
                $.ajax({
                    type: 'POST',
                    url: '/deleteFavrouite',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'event_id': id,
                    }
                }).done(function(msg) {
                    showToaster(msg.message, 'success');
                    $(icon).addClass('light-grey');
                    $(icon).removeClass('red');
                })
            }
        }

        function like(event) {
            var id = $(event).attr('data-id');
            if ($(event).hasClass('nothing')) {
                $(event).removeClass('nothing');
                $(event).addClass('blue');
            } else {
                $(event).removeClass('blue');
                $(event).addClass('nothing');
            }
            $.ajax({
                type: 'POST',
                url: '/like',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'event_id': id,
                }
            }).done(function(msg) {
                // showToaster(msg.message, 'success');
                $('#totalLikes' + id).html(msg.totalLikes + ' Likes');
                $(event).removeClass('blue');
                $(event).addClass(msg.className);

            })
        }
    </script>
@endsection
