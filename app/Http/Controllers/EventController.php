<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventFeeds;
use App\Models\EventsPictures;
use App\Models\EventTypes;
use App\Models\Favrouite;
use App\Models\Following;
use App\Models\Likes;
use Carbon\Carbon;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'event_name' => 'required|min:2|max:50',
            'event_description' => 'required',
            'event_type' => 'required',
            'event_date' => 'required|date|after_or_equal:today',
            'lat' => 'required',
            'lng' => 'required',
            'conditions' => 'required'
        ]);

        $event =    Event::create([
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'conditions' => serialize($request->conditions),
            'location' => $request->location,
            'is_public' => $request->is_public,
            'user_id' => Auth::user()->id,
            'ticket_link' => $request->ticket_link,
            'lat' => $request->lat,
            'lng' => $request->lng,
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
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
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

        return response()->json([
            'success' => true,
            'data' => $nearEvents,
            'message' => 'All Upcoming Events',
        ]);
    }

    public function getDraftEvents()
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
        if (is_numeric($lon1) && is_numeric($lon2)) {
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
    }

    public function getEventDetail($id)
    {
        $event = Event::where('id', $id)->with(['eventPictures', 'user', 'like', 'comment', 'livefeed'])->first();
        // dd($event);
        $user = Auth::user();
        if ($user->lat_lng != null)
            $latLng = explode(',', $user->lat_lng); // user lat lng
        $eventDetails = null;
        if (isset($latlng) || is_array($latLng)) {
            $km = $this->distance($latLng[0], $latLng[1], $event->lat, $event->lng);
            $fav = Favrouite::where('user_id', Auth::id())->where('event_id', $event->id)->first();
            $isLiked = Likes::where('user_id', Auth::id())->where('event_id', $event->id)->first();
            $eventTypes = EventTypes::all();
            $isFollowing = Following::where('user_id', Auth::id())->where('following_id', $event->user_id)->where('is_accepted', 1)->first();
            $eventDetails = array('event' => $event, 'km' => number_format($km, 1), 'isFavroute' => $fav ? 1 : 0, 'Following' => $isFollowing ? 1 : 0, 'isLiked' => $isLiked ? 1 : 0);
        }
        return view('front.event_details')->with(compact('eventDetails', 'user', 'eventTypes'));
    }


    public function yourEvents()
    {
        $user = Auth::user();
        $yourUpcomingEvents = Event::where('user_id', $user->id)->where('event_date', '>=', Carbon::today())->where('is_drafted', 0)->with(['eventPictures', 'user', 'like', 'comment', 'livefeed'])->get();
        $userUpcomingEvents = array();
        $ourEvents = array();
        foreach ($yourUpcomingEvents as $key => $value) {
            $latLng = explode(',', $user->lat_lng); // user lat lng
            if (is_array($latLng)) {
                $km = $this->distance($latLng[0], $latLng[1], $value->lat, $value->lng);

                $isFollowing = Following::where('user_id', Auth::id())->where('following_id', $value->user_id)->where('is_accepted', 1)->first();
                $ourEvents[] = array('events' => $value, 'km' => number_format($km, 1), 'Following' => $isFollowing ? 1 : 0);
            }
        }
        // dd($ourEvents);
        $eventDuration = 'upcoming';
        $eventMessage = 'No Upcoming Events Found';
        return view('front.your_events')->with(compact('ourEvents', 'eventDuration', 'eventMessage'));
    }

    public function yourPastEvents()
    {
        $user = Auth::user();
        $yourUpcomingEvents = Event::where('user_id', $user->id)->where('event_date', '<', Carbon::today())->where('is_drafted', 0)->with(['eventPictures', 'user', 'like', 'comment', 'livefeed'])->get();
        $userUpcomingEvents = array();
        $ourEvents = array();
        foreach ($yourUpcomingEvents as $key => $value) {
            $latLng = explode(',', $user->lat_lng); // user lat lng
            if (is_array($latLng)) {
                $km = $this->distance($latLng[0], $latLng[1], $value->lat, $value->lng);
                $isFollowing = Following::where('user_id', Auth::id())->where('following_id', $value->user_id)->where('is_accepted', 1)->first();
                $ourEvents[] = array('events' => $value, 'km' => number_format($km, 1), 'Following' => $isFollowing ? 1 : 0);
            }
        }
        $eventDuration = 'past';
        $eventMessage = 'No Past Events Found';


        return view('front.your_events')->with(compact('ourEvents', 'eventDuration', 'eventMessage'));
    }

    public function yourDraftEvents()
    {
        $user = Auth::user();
        $yourUpcomingEvents = Event::where('user_id', $user->id)->where('is_drafted', 1)->with(['eventPictures', 'user'])->get();
        // return $yourUpcomingEvents;
        $ourEvents = array();

        foreach ($yourUpcomingEvents as $key => $value) {
            $latLng = explode(',', $user->lat_lng); // user lat lng
            if (is_array($latLng)) {
                $km = $this->distance($latLng[0], $latLng[1], $value->lat, $value->lng);
                $isFollowing = Following::where('user_id', Auth::id())->where('following_id', $value->user_id)->where('is_accepted', 1)->first();
                $ourEvents[] = array('events' => $value, 'km' => number_format($km, 1), 'Following' => $isFollowing ? 1 : 0);
            }
        }


        $eventDuration = 'draft';
        $eventMessage = 'No Draft Events Found';

        return view('front.your_events')->with(compact('ourEvents', 'eventDuration', 'eventMessage'));
    }

    /// EVENT SNAPS

    public function eventSnap($id)
    {
        $event = Event::where('id', $id)->with(['eventPictures', 'user', 'livefeed', 'like', 'comment'])->first();

        $user = Auth::user();
        $eventFeeds = EventFeeds::where('event_id', $id)->with(['user'])->get();
        $latLng = explode(',', $user->lat_lng); // user lat lng
        $eventDetails = null;
        if (is_array($latLng)) {
            $km = $this->distance($latLng[0], $latLng[1], $event->lat, $event->lng);
            $fav = Favrouite::where('user_id', Auth::id())->where('event_id', $event->id)->first();
            $isLiked = Likes::where('user_id', Auth::id())->where('event_id', $event->id)->first();
            $isFollowing = Following::where('user_id', Auth::id())->where('following_id', $event->user_id)->where('is_accepted', 1)->first();
            $eventDetails = array('event' => $event, 'km' => number_format($km, 1), 'isFavroute' => $fav ? 1 : 0, 'Following' => $isFollowing ? 1 : 0, 'isLiked' => $isLiked ? 1 : 0);
        }
        return view('front.event_snap')->with(compact('eventDetails', 'user', 'eventFeeds'));
    }

    public function filterEvent($filter)
    {
        $events = Event::where('is_drafted', 0)->where('user_id', '!=', Auth::id())->get();
        $filterEvent = array();
        foreach ($events as $key => $event) {
            $conditions = explode(',', unserialize($event->conditions));
            foreach ($conditions as $key => $value) {
                if ($filter == $value) {
                    $filterEvent[] = $event;
                }
            }
        }

        dd($event);
    }

    public function deleteEvent(Request $request)
    {
        Event::where('id', $request->event_id)->where('user_id', Auth::id())->delete();
        return response()->json([
            'success' => true,
            'data' => [],
            'message' => 'Event Deleted Successfully',
        ]);
    }
}
