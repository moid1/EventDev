<?php

namespace App\Http\Controllers;

use App\Models\Favrouite;
use App\Models\Following;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavrouiteController extends Controller
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
        $favrouite = Favrouite::where('user_id', Auth::id())->with('event', function ($query) {
            $query->where('event_date', '>=', Carbon::today())->get();
        })->get();

        $user = Auth::user();
        $favUpcomingEvent = array();
        $favrouiteEvent = array();
        foreach ($favrouite as $key => $value) {

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


        $metaData = false;
        // dd($favrouiteEvent);

        return view('front.favourit')->with(compact('favrouiteEvent', 'metaData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eventId = $request->event_id;
        $userId = Auth::id();
        $isAlreadyFav = Favrouite::where('user_id', Auth::id())->where('event_id', $eventId)->get()->first();
        if (!$isAlreadyFav) {
            $favroute =  Favrouite::create([
                'event_id' => $eventId,
                'user_id' => $userId,
            ]);
            return response()->json([
                'success' => true,
                'data' => $favroute,
                'message' => 'Event has been favorited',
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'Event is already favorited',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favrouite  $favrouite
     * @return \Illuminate\Http\Response
     */
    public function show(Favrouite $favrouite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favrouite  $favrouite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favrouite $favrouite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favrouite  $favrouite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favrouite $favrouite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favrouite  $favrouite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favrouite $favrouite)
    {
        //
    }

    public function remove(Request $request)
    {
        Favrouite::where('user_id', Auth::id())->where('event_id', $request->event_id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Your event has been unfavourited',
        ]);
    }

    public function getFavouritePastEvents()
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
                // if ($value->event->event_date < $today) {
                $favUpcomingEvent[] = $value->event;
                // }
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

        $metaData = true;
        return view('front.favourit')->with(compact('favrouiteEvent', 'metaData'));
    }

    public function getFavouriteUpcomingEvents()
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
        $metaData = false;
        return view('front.favourit')->with(compact('favrouiteEvent', 'metaData'));
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
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
