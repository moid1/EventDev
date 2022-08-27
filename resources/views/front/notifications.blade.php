@extends('layouts.main')
@section('title', 'Notifications')
@section('content')
    <div class="container-fluid">
        <div class="d-flex">
            @include('front.partials.sidebar')
            <div class="custom_main_contents pt-5">
                <div class="live_feed_section d-flex flex-column pb-2">
                    <div class="d-flex pb-3 e_live_feed_container border-bottom">
                        <span class="order-2">Notifications</span>
                        <img class="back_arrow order-1" id="account_options"
                            src="{{ asset('assets/newimages/sidebaricons/chevronicon.svg') }}" alt="arrow">
                    </div>
                    @if (count($notifications) > 0)
                        @foreach ($notifications as $item)
                            @php
                                $routeURL = $item->route_name ?? 'follower';
                                $url = $item->id . '/' . $item->route_name;
                            @endphp
                            <div class="row">
                                <div class="col-12 d-flex notification_item_container mt-4">
                                    @if ($item->user->profilePicture != null)
                                        <img src="{{ $item->user->profilePicture->image }}" class="profilePhoto_thumbnail">
                                    @else
                                        <img src="{{ asset('assets/newimages/thumbnail.svg') }}"
                                            class="profilePhoto_thumbnail" alt="">
                                    @endif
                                    <div class="d-flex flex-column ml-2">
                                        <span class="title_message">{{ $item->message }}</span>
                                        <span class="time_ago">{{ $item->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="col-12 d-flex notification_item_container mt-4">
                                    <img src="{{ asset('assets/newimages/thumbnail.svg') }}"
                                        class="profilePhoto_thumbnail" alt="">
                                    <div class="d-flex flex-column ml-2">
                                        <span class="title_message">You have a follow request from John Dereek</span>
                                        <span class="time_ago">2 hours ago</span>
                                    </div>
                                </div>
                                <div class="col-12 d-flex notification_item_container mt-4">
                                    <img src="{{ asset('assets/newimages/thumbnail.svg') }}"
                                        class="profilePhoto_thumbnail" alt="">
                                    <div class="d-flex flex-column ml-2">
                                        <span class="title_message">You have a follow request from John Dereek</span>
                                        <span class="time_ago">2 hours ago</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
                    <div class="d-flex justify-content-end mb-4"><a href="{{ url('/notifications') }}"
                            class="primary_color seeAllRequests">See
                            all</a>
                    </div>
                    @foreach (\App\Models\Notifications::where('user_id', Auth::id())->take(5)->orderBy('created_at', 'DESC')->get()
        as $noti)
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
                <div class="d-flex align-items-center flex-wrap">
                    <a href="{{ url('privacy_policy') }}" class="bottom_links">Privacy Policy</a>
                    <div class="dot_separator mx-3"></div>
                    <a href="{{ url('terms_of_service') }}" class="bottom_links">Terms of service</a>
                    <div class="dot_separator mx-3"></div>
                    <a href="{{ url('disclamier') }}" class="bottom_links">Disclaimer</a>
                </div>
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