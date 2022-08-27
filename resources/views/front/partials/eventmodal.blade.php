<div id="custom_modal_container" class="custom_modal_container">

        <div class="create_event_card">
            <div class="custom_card_title d-flex justify-content-between align-items-center px-2">
                <span class="title">Create new event</span>
                <button type="button" id="close_icon_container" class="btn close_icon_container">
                    <img class="" src="{{ asset('assets/newimages/closeicon.svg') }}" alt="closeicon">
                </button>
            </div>
            <div class="px-4 pt-3 pb-4">
                <label for="selectImage" class="img_container_label mb-3" style="width: 100%;">
                    <div class="default_img_container d-block" id="">
                        <div class="d-flex flex-column align-items-center" id="defaultImgContainer">
                            <img class="" src="{{ asset('assets/newimages/camera.svg') }}" alt="camera">
                            <span class="upload_icon_text mt-1">Upload photo/video</span>
                        </div>
                        <img id="imageToShow" class="d-none image_to_show">
                        <input type="file" class="d-none" id="selectImage" />
                    </div>
                </label>
                <div class="mb-2">
                    <input type="text" placeholder="Event Name" name="event_name" id="eventName"
                        class="event_name_field" />
                </div>
                <div class="mb-2">
                    <textarea placeholder="Add a description" name="event_description" class="event_description pt-2" id="eventDescription"
                        cols="20" rows="10"></textarea>
                </div>
                <div class="mb-3">
                    <select class="inputFieldGreenBG d-flex even_type new_event_type" name="eventType" id="eventType">
                        <option selected disabled>Select</option>
                        <option>Select</option>
                        <option selected disabled>Select</option>
                        @foreach ($eventTypes as $type)
                            <option value="{{ $type->type }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <div class="venue_container">
                        <input type="text" placeholder="Venue" name="location" id="eventVenue"
                            class="event_name_field mr-1 pr-4" />
                        <i class="bi bi-geo-alt venue_icon"></i>
                    </div>
                    <input type="date" id="event_date" name="event_date" class="event_date_field ml-1" />
                </div>
                <div class="mb-2">
                    <input type="text" name="ticket_link" placeholder="Ticket link" id="ticket_link"
                        class="event_name_field" />
                </div>
                <div class="mb-2 event_condition_container">
                    <label for="">Event Conditions</label>
                    <div class="d-flex flex-column" id="eventConditionsList"></div>
                    <input type="text" placeholder="Add an event condition" id="eventCondition"
                        class="event_name_field pr-5" />
                    <button class="btn p-1 add_condition_btn" id="addEventCondition">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
                <div class="mb-5">
                    <label for="" class="event_privacy_label mb-2">Event privacy</label>
                    <div id="privatePrivacy"
                        class="d-flex flex-column mb-2 justify-content-center pl-3 align-items-start privacy_container_default">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/newimages/private.svg') }}" alt="" />
                            <span class="ml-1">Private</span>
                        </div>
                        <div style="color: #808080;font-size: 12px;">Only your followers or your following can see this
                            event</div>
                    </div>
                    <div id="publicPrivacy"
                        class="d-flex flex-column justify-content-center pl-3 align-items-start privacy_container_default">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/newimages/public.svg') }}" alt="" />
                            <span class="ml-1">Public</span>
                        </div>
                        <div style="color: #808080;font-size: 12px;">Everyone will be able to see this event details.
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <button  class="btn submit_create_event mb-2" id="createEventButton">Create</button>
                    <button type="reset" class="btn cancel_create_event">Save as draft</button>
                </div>
            </div>
        </div>
</div>
