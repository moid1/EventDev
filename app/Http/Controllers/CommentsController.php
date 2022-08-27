<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Event;
use App\Models\EventFeeds;
use App\Models\Favrouite;
use App\Models\Following;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
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
    public function create($id)
    {
        $event = Event::where('id', $id)->with(['eventPictures', 'user','like','comment','livefeed'])->first();

        $user = Auth::user();
        $eventFeeds = EventFeeds::where('event_id', $id)->with(['user'])->get();
        $comments = Comments::where('event_id', $id)->latest()->with('user')->get();
        $latLng = explode(',', $user->lat_lng); // user lat lng
        $eventDetails = null;
        if (is_array($latLng)) {
            $km = $this->distance($latLng[0], $latLng[1], $event->lat, $event->lng);
            $fav = Favrouite::where('user_id', Auth::id())->where('event_id', $event->id)->first();
            $isFollowing = Following::where('user_id', Auth::id())->where('following_id', $event->user_id)->where('is_accepted', 1)->first();
            $eventDetails = array('event' => $event, 'km' => number_format($km, 1), 'isFavroute' => $fav ? 1 : 0, 'Following' => $isFollowing ? 1 : 0);
        }
        return view('front.event_comment')->with(compact('eventDetails', 'user', 'comments', 'eventFeeds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comments::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'comment' => $request->comment,
        ]);
        

        return response()->json([
            'success' => true,
            'data' => $comment,
            'message' => 'Comment Saved Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comments)
    {
        //
    }

    public function distance($lat1, $lon1, $lat2, $lon2)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        // $unit = strtoupper($unit);
        return $miles;
        // if ($unit == "K") {
        // return ($miles * 1.609344);
        // } else if ($unit == "N") {
        //     return ($miles * 0.8684);
        // } else {
        //     return $miles;
        // }
    }
}
