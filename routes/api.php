<?php

use App\Http\Controllers\API\AuthController as APIAuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\FollowingController as APiFollowingController;
use App\Http\Controllers\API\NotificationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\EventFeedsController;
use App\Http\Controllers\FavrouiteController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UserController;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/create-account', [AuthController::class, 'createAccount']);
Route::post('/login', [AuthController::class, 'functionLogin']);
Route::get('/getEventTypes', [EventController::class, 'getEventTypes']);
Route::post('send-notification', [NotificationsController::class, 'sendSingleNotification']);
Route::get('/eventsdetails/{id}', [EventController::class, 'getEventDetail']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logged-in', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => auth()->user(),
            'message' => 'Logged In User'
        ]);
    });

    Route::post('/saveLatLng', [AuthController::class, 'saveLatLng']);
    Route::get('/logout', [AuthController::class, 'appLogout']);
    Route::get('/getEvents', [EventController::class, 'getEvents']);
    Route::get('/getUserUpcomingEvents', [EventController::class, 'getUserUpcomingEvents']);
    Route::get('/getUserPastEvent', [EventController::class, 'getUserPastEvent']);
    Route::get('/getUserDraftEvent', [EventController::class, 'getUserDraftEvents']);

    Route::get('/profile', [APIAuthController::class, 'getUserProfile']);
    Route::get('/notifications', [NotificationsController::class, 'getUserNotifications']);

    //FavrouiteEvent

    Route::post('/favrouite', [FavrouiteController::class, 'store']);
    Route::post('/unfavrouit', [FavrouiteController::class, 'remove']);

    Route::post('/following', [FollowingController::class, 'store']);
    Route::post('/unfollow', [FollowerController::class, 'unfollow']);
    Route::post('/acceptFollowingRequest', [FollowingController::class, 'acceptFollowingRequest']);
    Route::post('/cancelPendingRequest', [FollowerController::class, 'cancelPendingRequest']);

    //COMMENT
    Route::post('storeComment', [CommentsController::class, 'store']);

    Route::post('getUserFollowingStatus', [EventController::class, 'getUserFollowingStatus']);

    Route::post('like', [LikesController::class, 'store']);
    Route::get('getFavouriteUserPastEvents', [EventController::class, 'userFavrouitePastEvents']);
    Route::get('getFavouriteUserUpcomingEvents', [EventController::class, 'userFavrouiteUpcomingEvents']);
    Route::post('/update-profile-picture', [UserController::class, 'uploadProfilePicture']);

    Route::post('/uploadEventSnap', [EventFeedsController::class, 'store']);

    Route::post('/createEvent', [EventController::class, 'createEvent']);

    Route::post('/deleteSnap', [EventFeedsController::class, 'deleteEventSnap']);

    Route::get('/getUserFollowerList', [EventController::class, 'getUserFollowerList']);
    Route::get('/getUserFollowingList', [EventController::class, 'getUserFollowingList']);
    Route::get('/getUserId', function () {
        return auth()->id();
    });

    Route::post('/send', [MessagesController::class, 'postSendMessage']);
    Route::post('/draftEvent', [EventController::class, 'draftEvent']);
    Route::get('/getUserDraft', [EventController::class, 'getDraftEvents']);
    Route::post('editEvent/{id}', [EventController::class, 'editEvent']);
    Route::get('delete-event/{id}', [EventController::class, 'deleteEvent']);
    Route::post('edit-profile', [AuthController::class, 'editProfile']);
    //getPendingRequest
    Route::get('pendingRequest', [APiFollowingController::class, 'getPendingRequest']);

    //MAKE MOBILE NO PRIVATE
    Route::post('/makeNoPrivate', [UserController::class, 'makeNoPrivate']);
    //MAKE PROFILE PRIVATE
    Route::post('makeProfilePrivate', [UserController::class, 'makeProfilePrivate']);
    Route::get('/search', [UserController::class, 'search']);
    //chat
    Route::get('/getMessageHistory', [MessagesController::class, 'getMessageHistory']);
    Route::get('/load-latest-messages', [MessagesController::class, 'loadLatestMessages']);
    Route::get('/fetch-old-messages', [MessagesController::class, 'getOldMessagesAPI']);
    Route::post('/checkUserOnline', [UserController::class, 'checkUserOnline']);

    Route::get('/getUserDetailsById/{id}', [AuthController::class, 'getUserDetailsById']);
});
