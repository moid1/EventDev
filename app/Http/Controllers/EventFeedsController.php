<?php

namespace App\Http\Controllers;

use App\Models\EventFeeds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventFeedsController extends Controller
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
        if ($request->has('path')) {
            $imageName = time() . '.' . $request->path->extension();
            $request->path->move(('images/eventImage'), $imageName);
        }
        $event =    EventFeeds::create([
            'event_id' => $request->event_id,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'path' => ('images/eventImage') . '/' . $imageName,
        ]);

        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Snap Uploaded Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventFeeds  $eventFeeds
     * @return \Illuminate\Http\Response
     */
    public function show(EventFeeds $eventFeeds)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventFeeds  $eventFeeds
     * @return \Illuminate\Http\Response
     */
    public function edit(EventFeeds $eventFeeds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventFeeds  $eventFeeds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventFeeds $eventFeeds)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventFeeds  $eventFeeds
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventFeeds $eventFeeds)
    {
        //
    }

    public function deleteEventSnap(Request $request)
    {
        EventFeeds::where('id', $request->id)->delete();
        return response()->json([
            'success'=>true,
            'data'=>[],
            'msg'=>'Snap Deleted Successfully',
        ]);
    }
}
