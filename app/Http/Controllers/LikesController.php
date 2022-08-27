<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class LikesController extends Controller
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
        $like = Likes::where('event_id', $request->event_id)->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
            $totalLikes = Likes::where('event_id', $request->event_id)->get()->count();
            return response()->json([
                'success' => true,
                'data' => [],
                'totalLikes' => $totalLikes,
                'message' => 'Unliked Successfully',
                'className' => 'nothing'
            ]);
        } else {
            $like = Likes::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
            ]);
            $totalLikes = Likes::where('event_id', $request->event_id)->get()->count();
            return response()->json([
                'success' => true,
                'data' => $like,
                'message' => 'Liked',
                'totalLikes' => $totalLikes,
                'className' => 'blue'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function show(Likes $likes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function edit(Likes $likes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Likes $likes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Likes $likes)
    {
        //
    }
}
