const profileUser = document.querySelector('#profileUser');
const acctOption = document.querySelector('#account_options');
profileUser.addEventListener('click', function () {
  if (!acctOption.classList.contains('show_items')) {
    acctOption.classList.add('show_items');
    document.querySelector('#options_list_container').style.display = 'block';
  } else {
    acctOption.classList.remove('show_items');
    document.querySelector('#options_list_container').style.display = 'none';
  }
});

function toggleOptions(id) {
  const item = document.querySelector('#' + id);
  if (item.classList.contains('d-none')) {
    item.classList.remove('d-none');
    item.classList.add('d-flex');
  } else {
    item.classList.remove('d-flex');
    item.classList.add('d-none');
  }
}

$('#close_icon_container').on('click', function () {
  $('#custom_modal_container').hide();
});

function createEventModal() {
  $('#custom_modal_container').show();
}

const imageContainer = document.querySelector('#selectImage');
imageContainer.addEventListener('change', function (e) {
  const imageContainer = document.querySelector('#imageToShow');
  const defaultImgContainer = document.querySelector('#defaultImgContainer');
  if (defaultImgContainer.classList.contains('d-flex')) {
    defaultImgContainer.classList.remove('d-flex');
    defaultImgContainer.classList.add('d-none');
    imageContainer.classList.remove('d-none');
  }
  const reader = new FileReader();
  reader.onload = function (e) {
    imageContainer.setAttribute('src', e.target.result);
  };
  reader.readAsDataURL(this.files[0]);
});

function removeItem(id) {
  alert(id);
}



//Select privacy
$('#privatePrivacy').on('click', function () {
  $('#publicPrivacy').removeClass('selected_privacy');
  $(this).addClass('selected_privacy');
});
$('#publicPrivacy').on('click', function () {
  $('#privatePrivacy').removeClass('selected_privacy');
  $(this).addClass('selected_privacy');
});

//Select profile tab
$('.tab_header_container li').on('click', function () {
  $('.tab_header_container li').removeClass('active_tab');
  $(this).addClass('active_tab');
  const container = $(this).attr('data-item');
  $('.tab_items').removeClass('d-block').addClass('d-none');
  $(`#${container}`).removeClass('d-none').addClass('d-block');
});

// let updatePhotoContainer = document.querySelector('#uploadImage');
$('#uploadImage').on('change', function () {
  // const updateImageShow = document.querySelector('#updateImageShow');
  const reader = new FileReader();
  reader.onload = function (e) {
    $('#updateImageShow').setAttribute('src', e.target.result);
  };
  reader.readAsDataURL(this.files[0]);
});

$('#commenticon').on('click', function () {
  $(this).attr('src', '/assets/newimages/commentactive.svg');
  $('#eventDetailsHolder').removeClass('d-flex').addClass('d-none');
  $('#commentsHolder').removeClass('d-none').addClass('d-flex');
});

$('#snapdetails_option').on('click', function () {
  const srcArr = $(this).attr('src').split('/');
  if (srcArr[srcArr.length - 1] === 'opensnapoption.svg') {
    $(this).attr('src', '/assets/newimages/optionicon.svg');
  } else {
    $(this).attr('src', '/assets/newimages/opensnapoption.svg');
  }
});

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
  var places = new google.maps.places.Autocomplete(document.getElementById('eventVenue'));
  console.log(places);
  google.maps.event.addListener(places, 'place_changed', function () {
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
  }).done(function (msg) {

  })
}

function myfunction() {
  location.replace("your_event.html")
}

function eventConditions(condition) {

  if (condition.innerText == 'Add Conditions') {
    var conditionText = prompt("Condition", "");
    $("<p onclick='removeConditions(this)' id=" + conditionText + " class='event_tagg mt-2'>" +
      conditionText +
      "</p>").insertAfter(
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


$('#createEventButton').click(function (event) {
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
  form_data.append('location', $('#eventVenue').val());
  form_data.append('event_date', $('#event_date').val());
  form_data.append('ticket_link', $('#ticket_link').val());
  form_data.append('conditions', eventConditionsArr);
  form_data.append('is_public', $('#privatePrivacy').hasClass('selected_privacy') ? 0 : 1);
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
    beforeSend: function () {
      // $("#uploadSnap").prop('disabled', true); //disable.
      $('.progress').removeClass('d-none');
      $('#uploadPictureBtn').hide();
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();

      xhr.upload.addEventListener("progress", function (evt) {

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
    error: function (res) {
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
  }).done(function (msg) {
    showToaster('Your event has been created successfully', 'success');
    $('.progress').addClass('d-none');

    $('#createEventModal').modal('toggle');
    location.reload();

  })
});

//draft event

$('#draftEvent').click(function (event) {
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
  }).done(function (msg) {
    showToaster('Your event has been drafted', 'success');
    $('#createEventModal').modal('toggle');


  })
});

//upload Event Pictures & Videos
var eventConditionsArr = [];
function getImages() {
  $('#uploadEventPicture').click();
}
var eventImages1 = null;
$(function () {
  $('#selectImage').change(function () {
    var input = this;
    eventImages1 = input;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
      ext == "jpg")) {
      var reader = new FileReader();
      reader.onload = function (e) {
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
      reader.onload = function (e) {
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
    }).done(function (msg) {
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
    }).done(function (msg) {
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
  }).done(function (msg) {
    // showToaster(msg.message, 'success');
    $('#totalLikes' + id).html(msg.totalLikes + ' Likes');
    $(event).removeClass('blue');
    $(event).addClass(msg.className);

  })
}

//Append event condition
const addEventCondition = document.querySelector('#addEventCondition');


addEventCondition.addEventListener('click', function () {

  let eventConditionValue = document.querySelector('#eventCondition').value;
  let eventConditionsList = document.querySelector('#eventConditionsList');
  eventConditionsArr.push(eventConditionValue);
  eventConditionValue = '';
  eventConditionsArr.map((val, index) => {
    eventConditionsList.insertAdjacentHTML(
      'beforebegin',
      `
            <div class="d-flex selected_event_condition px-2 mb-3 justify-content-between align-items-center">
                <span class="">${val}</span>
                <button class="dbtn remove_condition_btn" onclick="removeItem('${index + '-' + val
      }')">
                    <i class="bi bi-x"></i>
                </button>
            </div>
          `
    );
  });
});

$('#submit_comment').click(function (event) {
  event.preventDefault();

  if ($('#comment').val().length == 0) {
    alert('Comment required to post');
    return;
  }
  var formData = {
    event_id: $(this).attr('data-event-id'),
    comment: $('#comment').val(),
  };


  $.ajax({
    type: 'POST',
    url: '/storeComment',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: formData,
    error: function (res) {
      var errors = JSON.parse(res.responseText);

    }
  }).done(function (msg) {
    location.reload();
  })
});
