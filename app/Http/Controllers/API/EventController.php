<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventFeeds;
use App\Models\EventsPictures;
use App\Models\EventTypes;
use App\Models\Favrouite;
use App\Models\Follower;
use App\Models\Following;
use App\Models\Likes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function getEvents()
    {
        $eventTypes = EventTypes::all();
        $allEvents = Event::where('is_drafted', 0)->with(['eventPictures', 'user', 'comment', 'liveFeed'])->get();
        $temp = array();

        // dd(Carbon::today()->toDateString());
        foreach ($allEvents as $key => $value) {
            $eventDate = Carbon::parse($value->event_date);
            if ($eventDate >= Carbon::today() || $eventDate == Carbon::yesterday()) {
                $temp[] = $value;
            }
        }

        // $upcomingEvents = Event::where('event_date', '>=', date('Y-m-d'))->where('is_drafted', 0)->with(['eventPictures', 'user', 'comment', 'liveFeed'])->orderBy('created_at', 'DESC')->get();
        $upcomingEvents = $temp;

        $new = null;
        $followerss = Follower::where('user_id', Auth::id())->get()->pluck('follower_id');
        $followingss = Following::where('user_id', Auth::id())->where('is_accepted', 1)->get()->pluck('following_id');
        foreach ($upcomingEvents as $key => $value) {
            $flag = false;
            if ($value->user_id == Auth::id() ||  $value->is_public == 1) {
                $new[] = $value;
                $flag = true;
            }
            if ($flag == false && $value->is_public == 0) {
                foreach ($followingss as $key => $follow) {
                    if ($value->user_id == $follow) {
                        $new[] = $value;
                    }
                }
            }
        }
        $upcomingEvents = $new;
        $user = User::where('id', Auth::id())->with(['followers', 'following'])->first();
        $nearEvents = array();
        if (is_array($upcomingEvents) || is_object($upcomingEvents)) {
            foreach ($upcomingEvents as $key => $value) {
                $latLng = explode(',', $user->lat_lng); // user lat lng

                if (count($latLng) > 1) {
                    $mile = $this->distance($latLng[0], $latLng[1], $value->lat, $value->lng);
                    $fav = Favrouite::where('user_id', Auth::id())->where('event_id', $value->id)->first();
                    $liveFeed = EventFeeds::where('event_id', $value->id)->latest()->first();
                    $isFollowing = Following::where('user_id', Auth::id())->where('following_id', $value->user_id)->where('is_accepted', 1)->first();
                    $isLiked = Likes::where('user_id', Auth::id())->where('event_id', $value->id)->first();
                    $totalLikes = Likes::where('event_id', $value->id)->get()->count();
                    $nearEvents[] = array('events' => $value, 'livefeed' => $liveFeed, 'km' => number_format($mile, 1), 'isFavroute' => $fav ? 1 : 0, 'Following' => $isFollowing ? 1 : 0, 'isLiked' => $isLiked ? 1 : 0, 'totalLikes' => $totalLikes);
                }
            }
            array_multisort(array_column($nearEvents, 'km'), SORT_ASC, $nearEvents);

            return response()->json([
                'success' => true,
                'data' => $nearEvents,
                'message' => 'Near Events'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'No Events Available Right now'
            ]);
        }
    }

    public function getUserUpcomingEvents()
    {
        $user = Auth::user();
        $upcomingEvents = Event::where('user_id', Auth::id())->where('event_date', '>=', date('Y-m-d'))->where('is_drafted', 0)->with('eventPictures')->get();
        $nearEvents = array();
        foreach ($upcomingEvents as $key => $value) {
            $latLng = explode(',', $user->lat_lng); // user lat lng
            $km = $this->distance($latLng[0], $latLng[1], $value->lat, $value->lng);
            $nearEvents[] = array('events' => $value, 'km' => number_format($km, 1));
        }
        array_multisort(array_column($nearEvents, 'km'), SORT_ASC, $nearEvents);

        return response()->json([
            'success' => true,
            'data' => $nearEvents,
            'message' => 'All Upcoming Events',
        ]);
    }

    public function getUserPastEvent()
    {
        $user = Auth::user();
        $upcomingEvents = Event::where('user_id', Auth::id())->where('event_date', '<', date('Y-m-d'))->where('is_drafted', 0)->with('eventPictures')->get();
        $nearEvents = array();
        foreach ($upcomingEvents as $key => $value) {
            $latLng = explode(',', $user->lat_lng); // user lat lng
            $km = $this->distance($latLng[0], $latLng[1], $value->lat, $value->lng);
            $nearEvents[] = array('events' => $value, 'km' => number_format($km, 1));
        }

        return response()->json([
            'success' => true,
            'data' => $nearEvents,
            'message' => 'All Past Events',
        ]);
    }

    public function getUserDraftEvents()
    {
        $draftEvents = Event::where('user_id', Auth::id())->where('is_drafted', 1)->with('eventPictures')->get();
        return response()->json([
            'success' => true,
            'data' => $draftEvents,
            'message' => 'All Drafted Events',
        ]);
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return $miles;
        // $unit = strtoupper($unit);

        // if ($unit == "K") {
        return ($miles * 1.609344);
        // } else if ($unit == "N") {
        //     return ($miles * 0.8684);
        // } else {
        //     return $miles;
        // }
    }

    public function getUserFollowingStatus(Request $request)
    {

        $status = null;
        if (!$request->has('following_id')) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Following Id is required',
            ]);
        } else {
            $following = Following::where([['user_id', Auth::id()], ['following_id', $request->following_id]])->first();

            if ($following) {
                if ($following->is_accepted == 1)
                    $status = 'Following';
                else if ($following->is_accepted == 2)
                    $status = 'Pending';
                else
                    $status = 'Nothing';
                $user = User::with(['address', 'profilePicture', 'followers', 'following', 'events'])->find($request->following_id);
                return response()->json([
                    'success' => true,
                    'data' => $user,
                    'status' => $status,
                ]);
            } else {
                $user = User::with(['address', 'profilePicture', 'followers', 'following', 'events'])->find($request->following_id);
                return response()->json([
                    'success' => true,
                    'data' => $user,
                    'status' => 'nothing',
                    'message' => 'You are not following',
                ]);
            }
        }
    }

    public function userFavrouitePastEvents()
    {
        $user = Auth::user();
        $today = Carbon::today();
        // dd($today);
        $favEvents = Favrouite::where('user_id', Auth::id())->with('event', function ($query) {
            $query->where('event_date', '<', Carbon::today())->get();
        })->get();
        $favUpcomingEvent = array();
        $favrouiteEvent = array();
        foreach ($favEvents as $key => $value) {
            if ($value->event != null) {
                $favUpcomingEvent[] = $value->event;
            }
        }
        foreach ($favUpcomingEvent as $key => $value) {
            $latLng = explode(',', $user->lat_lng); // user lat lng
            if (is_array($latLng)) {
                $km = $this->distance($latLng[0], $latLng[1], $value->lat, $value->lng);
                $isFollowing = Following::where('user_id', Auth::id())->where('following_id', $value->user_id)->where('is_accepted', 1)->first();
                $favrouiteEvent[] = array('events' => $value, 'km' => number_format($km, 1), 'Following' => $isFollowing ? 1 : 0);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $favrouiteEvent,
            'message' => 'User Favrouite Past Events',
        ]);
    }

    public function userFavrouiteUpcomingEvents()
    {
        $user = Auth::user();
        $favEvents = Favrouite::where('user_id', Auth::id())->with('event', function ($query) {
            $query->where('event_date', '>=', Carbon::today())->get();
        })->get();
        $favUpcomingEvent = array();
        $favrouiteEvent = array();
        foreach ($favEvents as $key => $value) {
            if ($value->event != null) {
                $favUpcomingEvent[] = $value->event;
            }
        }
        foreach ($favUpcomingEvent as $key => $value) {
            $latLng = explode(',', $user->lat_lng); // user lat lng
            if (is_array($latLng)) {
                $km = $this->distance($latLng[0], $latLng[1], $value->lat, $value->lng);

                $isFollowing = Following::where('user_id', Auth::id())->where('following_id', $value->user_id)->where('is_accepted', 1)->first();
                $favrouiteEvent[] = array('events' => $value, 'km' => number_format($km, 1), 'Following' => $isFollowing ? 1 : 0);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $favrouiteEvent,
            'message' => 'User Favrouit Upcoming Events',
        ]);
    }

    public function createEvent(Request $request)
    {
        $validate = request()->validate([
            'event_name' => 'required|min:2|max:50',
            'event_description' => 'required',
            'event_type' => 'required',
            'event_date' => 'required|date|after_or_equal:today',
            'location' => 'required',
            'is_public' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);
        if (!$validate) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Data is not valid',
            ]);
        }

        $event =    Event::create([
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'conditions' => serialize($request->conditions),
            'location' => $request->location,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'is_public' => intVal($request->is_public),
            'user_id' => Auth::user()->id,
            'ticket_link' => $request->ticket_link,
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(('images/eventImage'), $imageName);
        $profileImage =  EventsPictures::create([
            'event_id' => $event->id,
            'image_path' => ('images/eventImage') . '/' . $imageName,
        ]);

        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event Created Successfully',
        ]);
    }

    public function getEventTypes()
    {
        $eventTypes = EventTypes::all();
        return response()->json([
            'success' => true,
            'data' => $eventTypes,
            'message' => 'All Event Types',
        ]);
    }

    public function getUserFollowerList()
    {
        $followers = Follower::where('user_id', Auth::id())->with('user')->get();
        return response()->json([
            'success' => true,
            'data' => $followers,
            'message' => 'Current user followers list',
        ]);
    }

    public function getUserFollowingList()
    {
        $user = Following::where('user_id', Auth::id())->with('followingUser')->get();
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Current user Following list',
        ]);
    }

    public function draftEvent(Request $request)
    {
        $event =    Event::create([
            'event_name' => $request->event_name ?? '',
            'event_description' => $request->event_description ?? '',
            'event_type' => $request->event_type ?? '',
            'event_date' => $request->event_date ?? null,
            'conditions' => serialize($request->conditions) ?? '',
            'location' => $request->location ?? '',
            'lat' => $request->lat ?? null,
            'lng' => $request->lng ?? null,
            'is_public' => intVal($request->is_public) ?? 1,
            'user_id' => Auth::user()->id,
            'is_drafted' => 1,
        ]);

        if ($request->has('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(('images/eventImage'), $imageName);
            $profileImage =  EventsPictures::create([
                'event_id' => $event->id,
                'image_path' => ('images/eventImage') . '/' . $imageName,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event saved as draft',
        ]);
    }

    public function getDraftEvents()
    {
        $draftEvents = Event::where([['user_id', Auth::id()], ['is_drafted', 1]])->with('eventPictures')->get();
        return response()->json([
            'success' => true,
            'data' => $draftEvents,
            'message' => 'User draft events list',
        ]);
    }

    public function editEvent($id, Request $request)
    {
        $event =   Event::findorFail($id);
        if ($event && $event->user_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'You dont have permission to edit this event',
            ]);
        }
        if ($event) {
            $event->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $event,
                'message' => 'event updated successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Event not found',
            ]);
        }
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        if ($event && $event->user_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'You don\'t have permission to delete this event',
            ]);
        }
        if ($event) {
            $event->delete();
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'Event deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Event Not Found'
            ]);
        }
    }

    public function getEventDetail($id)
    {
        $event = Event::with(['user','eventPictures', 'comment', 'like', 'livefeed'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event details'
        ]);
    }
}
