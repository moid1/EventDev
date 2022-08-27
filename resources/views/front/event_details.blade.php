@extends('layouts.main')
@section('title', 'Event Details')
@section('content')
    <div class="container-fluid">
        <div class="d-flex">
            @include('front.partials.sidebar')
            <div class="custom_main_contents pt-5">
                <div class="live_feed_section d-flex flex-column pb-2">
                    <div class="d-flex justify-content-between pb-3 e_live_feed_container border-bottom">
                        <div class="d-flex" style="cursor: pointer;" onclick="history.go(-1)">
                            <span class="order-2">{{ $eventDetails['event']->event_name }}</span>
                            <img class="back_arrow order-1" id="account_options"
                                src="{{ asset('assets/newimages/sidebaricons/chevronicon.svg') }}" alt="arrow">
                        </div>
                        <img style="cursor: pointer;" onclick="alert('hello')" id=""
                            src="{{ asset('assets/newimages/optionicon.svg') }}" alt="arrow">
                    </div>
                    <div class="row mt-4 pb-4 px-3">
                        <div class="event_photo_container mt-3">
                            {{-- <img src="{{asset('assets/newimages/eventimage.svg')}}" class="event_photo" alt=""> --}}
                            @if (count($eventDetails['event']->eventPictures) > 0)
                                @if (Str::substr($eventDetails['event']->eventPictures[0]->image_path, -3) == 'mp4' ||
                                    Str::substr($eventDetails['event']->eventPictures[0]->image_path, -3) == 'mov')
                                    <video class="eventBgImage mr-3 img-fluid"
                                        src="{{ asset($eventDetails['event']->eventPictures[0]->image_path) }}" controls>
                                        <source src="{{ asset($eventDetails['event']->eventPictures[0]->image_path) }}"
                                            type="video/mp4">
                                    </video>
                                @else
                                    <img src="{{ asset($eventDetails['event']->eventPictures[0]->image_path) }}"
                                        class="event_photo img-fluid" alt="" srcset="">
                                @endif
                            @else
                                <img src="{{ asset('placeholder.jpg') }}" class="eventBgImage " alt=""
                                    srcset="">
                            @endif
                            <div class="d-flex flex-column event_details_container mt-3">
                                <div
                                    class="event_reactions_container mt-4 d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center mr-4">
                                            <img src="{{ $eventDetails['isFavroute'] == 1 ? asset('assets/newimages/likedheart.svg') : asset('assets/newimages/unlikedheart.svg') }}"
                                                class="cursor_pointer" alt="">
                                            <span class="text-dark ml-1">{{ $eventDetails['event']->like->count() }}</span>
                                        </div>
                                        <div class="d-flex align-items-center" id="commentTrigger">
                                            <img id="commenticon" src="/assets/newimages/comment.svg" class="cursor_pointer"
                                                alt="">
                                            <span
                                                class="text-dark ml-1">{{ $eventDetails['event']->comment->count() }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="d-flex align-items-center mr-4">
                                            <img src="{{ asset('assets/newimages/livesnap.svg') }}" class=""
                                                alt="">
                                            <span class="text-dark ml-1">{{ $eventDetails['event']->livefeed->count() }}
                                                Live snaps</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="eventDetailsHolder" class="my-2 col-12">
                            <div class="col-12 px-0 mt-4 event_summary_container p-3">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $eventDetails['event']->user->profilePicture != null ? url($eventDetails['event']->user->profilePicture->image) : url('assets/images/usersImages/userPlaceHolder.png') }}"
                                            class="profilePhoto_thumbnail" alt="">
                                        <div class="d-flex flex-column ml-2">
                                            <span class="user_name">{{ $eventDetails['event']->user->name }}</span>
                                            <span
                                                class="time_ago">{{ \Carbon\Carbon::parse($eventDetails['event']->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="eventdetails_description mt-3">
                                        {{ $eventDetails['event']->event_description }}
                                    </div>
                                    <div class="eventdetails_guide_container mt-3">
                                        <div class="title px-0 mb-3">Event details</div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon_container d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('assets/newimages/bluelocation.svg') }}"
                                                        alt="">
                                                </div>
                                                <div class="d-flex ml-2 flex-column align-items-start">
                                                    <span class="distance_away">{{ $eventDetails['km'] }} miles away</span>
                                                    <span class="distance_away_label">Distance from your location</span>
                                                </div>
                                            </div>
                                            <div class="rotate_90">
                                                <img src="{{ asset('assets/newimages/sidebaricons/chevronicon.svg') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon_container d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('assets/newimages/bluecalendar.svg') }}"
                                                        alt="">
                                                </div>
                                                <div class="d-flex ml-2 flex-column align-items-start">
                                                    <span
                                                        class="distance_away">{{ $eventDetails['event']->event_date }}</span>
                                                    <span class="distance_away_label">Event date</span>
                                                </div>
                                            </div>
                                            <div class="rotate_90">
                                                <img src="{{ asset('assets/newimages/sidebaricons/chevronicon.svg') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon_container d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('assets/newimages/bluelink.svg') }}" alt="">
                                                </div>
                                                <div class="d-flex ml-2 flex-column align-items-start">
                                                    <span
                                                        class="distance_away">{{ $eventDetails['event']->ticket_link ?? 'N/A' }}</span>
                                                    <span class="distance_away_label">Ticket link</span>
                                                </div>
                                            </div>
                                            <div class="rotate_90">
                                                <img src="{{ asset('assets/newimages/sidebaricons/chevronicon.svg') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 event_location_container pb-3 mt-3">
                                <div class="title px-0 mb-1">Event location</div>
                                {{-- <img src="{{asset('assets/newimages/dummylocationmap.svg')}}"
                                class="dummymap px-0 mb-3" alt=""> --}}
                                <div id="map"></div>
                                <div class="map_location_details">{{ $eventDetails['event']->location }}</div>
                            </div>
                            {{-- {{dd($eventDetails['event'])}} --}}
                            <div class="col-12 event_location_container pb-3 mt-3">
                                <div class="title px-0 mb-1">Event conditions</div>

                                @if (count($eventDetails['event']->conditions) > 0 || !empty($conditionsArr))
                                    <div class="padding16">Conditions </div>
                                    @foreach ($eventDetails['event']->conditions as $key => $condition)
                                        <div class="d-flex flex-column mb-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <img src="{{ asset('assets/newimages/exclaim.svg') }}" class=""
                                                    alt="">
                                                <span class="condition_number ml-2">{{ ++$key }}</span>
                                            </div>
                                            <div class="condition_text">{{ $condition }}</div>
                                        </div>
                                    @endforeach
                                @endif



                                {{-- <div class="d-flex flex-column mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{asset('assets/newimages/exclaim.svg')}}" class="" alt="">
                                    <span class="condition_number ml-2">1</span>
                                </div>
                                <div class="condition_text">Nobody will be allowed admission to the event without a
                                    valid ticket or pass.</div>
                            </div> --}}











                                <a href="#" class="read_more_conditions">
                                    Read more...
                                </a>
                            </div>
                        </div>
                        <div class="d-none col-12 px-0 flex-column" id="commentsHolder">
                            <div class="comment_container mt-4">
                                <textarea class="px-2 py-2" name="" id="comment" cols="2" rows="1"></textarea>
                                <button class="btn submit_comment" data-event-id={{ $eventDetails['event']->id }}
                                    id="submit_comment">Send</button>
                            </div>
                            @foreach ($eventDetails['event']->comment as $comm)
                                <div class="replies_container d-flex flex-column mt-4 p-3">
                                    <div class="commenter_container mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            @if ($comm->user->profilePicture != null)
                                                <img class="commenter_photo"
                                                    src="{{ url($comm->user->profilePicture->image) }}"
                                                    alt="commenterphoto">
                                            @else
                                                <img class="smallCircularImage mr-2 "
                                                    src="{{ url('assets/images/usersImages/userPlaceHolder.png') }}" />
                                            @endif
                                            <span
                                                class="commenter_name ml-3">{{ Auth::id() == $comm->user_id ? 'You' : $comm->user->name }}</span>
                                        </div>
                                        <div class="details">{{ $comm->comment }}</div>
                                        <div class="time_posted text-right mt-2">
                                            {{ $comm->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right bar --}}
            {{-- @include('front.partials.rightbar') --}}
            <div class="custom_rightbar pt-5 pl-4 pb-5">
                @include('front.partials.search')

                <div class="sponsored_ads mt-4 p-3">
                    <span class="">Sponsored ads</span>
                </div>
                <div class="show_requests mt-4 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span class="rightbar_heading_title">Event Live Feed</span>
                        <div class="d-flex justify-content-end"><a href="{{ url('/notifications') }}"
                                class="primary_color seeAllRequests">See
                                all</a>
                        </div>
                    </div>
                    <div class="row">
                        {{-- @foreach ($nearEvents as $event)
                            @isset($event['livefeed'])
                                <div class="col-12 d-flex rightbar_event_live_feed mb-3">
                                    <img src="{{ asset('assets/newimages/thumbnail.svg') }}" class="rightbar_thumbnail"
                                        alt="">
                                    <div class="d-flex flex-column justify-content-start align-items-start ml-3">
                                        <span class="font-weight-bold p-0">Campus Pop-culture
                                            Discovery</span>
                                        <div class="d-flex align-items-center mt-1">
                                            <img src="{{ asset('assets/newimages/locationicon.svg') }}" class=""
                                                alt="">
                                            <span class="primary_color">9.4 miles away</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ url('eventSnap/' . $event['events']->id) }}" style="color:black">

                                    <div class="text-center">
                                        @if (Str::substr($event['livefeed']->path, -3) == 'mp4' || Str::substr($event['livefeed']->path, -3) == 'mov')
                                            <video class="eventsPic mr-3" src="{{ asset($event['livefeed']->path) }}"
                                                controls>
                                                <source src="{{ asset($event['livefeed']->path) }}" type="video/mp4">
                                            </video>
                                            <h6 class="home_km mt-2">{{ $event['km'] }} miles</h6>
                                        @else
                                            <img class="eventsPic mr-3" src="{{ asset($event['livefeed']->path) }}" />
                                            <h6 class="home_km mt-2">{{ $event['km'] }} miles</h6>
                                        @endif
                                    </div>
                                </a>
                            @endisset
                        @endforeach --}}

                        <div class="col-12 d-flex rightbar_event_live_feed mb-3">
                            <img src="{{ asset('assets/newimages/thumbnail.svg') }}" class="rightbar_thumbnail"
                                alt="">
                            <div class="d-flex flex-column justify-content-start align-items-start ml-3">
                                <span class="font-weight-bold p-0">Campus Pop-culture
                                    Discovery</span>
                                <div class="d-flex align-items-center mt-1">
                                    <img src="{{ asset('assets/newimages/locationicon.svg') }}" class=""
                                        alt="">
                                    <span class="primary_color">9.4 miles away</span>
                                </div>
                            </div>
                        </div>
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
    <script>
        function like(event) {
            var id = $(event).attr('data-id');
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
                showToaster(msg.message, 'success');
                $('#totalLikes' + id).html(msg.totalLikes + ' Likes');
                $(event).removeClass('blue');
                $(event).addClass(msg.className);

            })
        }
        var event = {!! json_encode($eventDetails['event']->toArray()) !!};

        function initialize() {
            var myLatlng = new google.maps.LatLng(event.lat, event.lng);
            var myOptions = {
                zoom: 16,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map"), myOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: "Fast marker"
            });

            marker['infowindow'] = new google.maps.InfoWindow({
                content: event.location
            });

            google.maps.event.addListener(marker, 'mouseover', function() {
                this['infowindow'].open(map, this);
            });
        }

        function deleteEvent(event) {
            var id = $(event).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '/deleteEvent',
                beforeSend: function() {
                    $('#loading').show();
                    $('#deleteEvent').html('Deleting');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'event_id': id,
                }
            }).done(function(msg) {
                showToaster(msg.message, 'success');
                $('#loading').hide();
                window.location = '/';


            })

        }
    </script>
@endsection





{{-- @section('script')
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
@endsection --}}
