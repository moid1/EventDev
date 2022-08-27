<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Following;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
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
        $currentUser = Auth::user();
        $followers = Follower::where('user_id', $currentUser->id)->with('user')->get();
        $pendingRequest = Following::where('following_id', $currentUser->id)->with('user')->where('is_accepted', 0)->groupBy(['user_id', 'following_id'])->get();
        return view('front.follower')->with(compact('followers', 'currentUser', 'pendingRequest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancelPendingRequest(Request $request)
    {
        Following::find($request->id)->delete();
        Notifications::where('following_id', $request->id)->delete();

        return response()->json([
            'success' => true,
            'data' => [],
            'message' => 'Following Request has been canceled',
        ]);
    }

    public function unfollow(Request $request)
    {
        $following = Following::with('user')->find($request->id);
   
        $user = $following->user;
        $following->delete();
        $follower = Follower::where('following_id', $following->id)->first();
        $follower->delete();
        return response()->json([
            'success' => true,
            'message' => 'You unfollow' . $user->name,
        ]);
    }
}
