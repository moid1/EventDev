<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Following;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
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
        $following = Following::where('user_id', $currentUser->id)->where('is_accepted', 1)->with('followingUser')->groupBy(['user_id', 'following_id'])->get();
        $pendingRequest = Following::where('user_id', $currentUser->id)->with('user')->where('is_accepted', 0)->groupBy(['user_id', 'following_id'])->get();
        return view('front.following')->with(compact('following', 'currentUser', 'pendingRequest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $followingId = $request->following_id;
        $isAny =   Following::where('user_id', $userId)->where('following_id', $followingId)->first();
        if ($isAny) {
            if ($isAny->is_accepted == 2 || $isAny->is_accepted == 0) {
                Following::where('user_id', $userId)->where('following_id', $followingId)->delete();
                return response()->json([
                    'success' => true,
                    'data' => [],
                    'message' => 'Follow Request has been canceled',
                    'ButtonText' => 'Follow'
                ]);
            } else if ($isAny->is_accepted == 1) {
                Following::where('user_id', $userId)->where('following_id', $followingId)->delete();
                Follower::where('following_id', $isAny->id)->delete;
                return response()->json([
                    'success' => true,
                    'data' => [],
                    'message' => 'You unfollowed this person',
                    'ButtonText' => 'Follow'
                ]);
            }
        } else {
            $followingResponse =   Following::create([
                'user_id' => $userId,
                'following_id' => $followingId,
                'is_accepted' => 0,
            ]);

            Notifications::where([['user_id', $followingId], ['sent_by', $userId], ['route_name', 'follower']])->delete();
            Notifications::create([
                'title' => 'Follow Request',
                'message' => 'You have a follow request from ' . Auth::user()->name,
                'user_id' => $followingId,
                'sent_by' => $userId,
                'notification_type' => 1,
                'route_name' => 'follower',
                'following_id'=>$followingResponse->id,
            ]);


            return response()->json([
                'success' => true,
                'data' => $followingResponse,
                'message' => 'Following request has been sent',
                'ButtonText' => 'Pending'

            ]);
        }
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

    public function acceptFollowingRequest(Request $request)
    {
        $following = Following::find($request->id);
        $currentUser = Auth::user();
        $following->is_accepted = true;
        $following->update();

        Follower::create([
            'user_id' => $currentUser->id,
            'follower_id' => $following->user_id,
            'following_id' => $following->id, // foreign key of following table
        ]);
        $notification = Notifications::create([
            'title' => 'Follow Request Accepted',
            'message' =>  $currentUser->name . ' accepted your following request',
            'user_id' => $following->user_id,
            'sent_by' => $currentUser->id,
            'notification_type' => 2,
            'route_name' => 'following'
        ]);
        return response()->json([
            'success' => true,
            'data' => $following,
            'message' => 'Following Request has been accepted',
        ]);
    }
    //this will unfollow from followingTable
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
