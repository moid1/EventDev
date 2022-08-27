<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Event;
use App\Models\EventTypes;
use App\Models\Follower;
use App\Models\Following;
use App\Models\Profile;
use App\Models\ProfileImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
        $user = Auth::user();
        $followers = Follower::where('user_id', $user->id)->count();
        $following = Following::where('user_id', $user->id)->where('is_accepted', 1)->count();
        $address = Address::where('user_id', $user->id)->latest()->first();
        $profilePicture = ProfileImage::where('user_id', $user->id)->latest()->first();
        $totalEvents = Event::where('user_id', Auth::id())->where('is_drafted', 0)->get()->count();
        $isFollowing = [];
        $upcomingEvents = Event::where('user_id', Auth::id())->where('event_date', '>', date('Y-m-d'))->where('is_drafted', 0)->with('eventPictures')->get();
        $pastEvents = Event::where('user_id', Auth::id())->where('event_date', '<', date('Y-m-d'))->where('is_drafted', 0)->with(['eventPictures'])->get();
        $draftEvents = Event::where('user_id', Auth::id())->where('is_drafted', 1)->with(['eventPictures'])->get();
        $eventTypes = EventTypes::all();
        return view('front.profile')->with(compact('user', 'followers', 'following', 'address', 'isFollowing', 'profilePicture', 'upcomingEvents', 'totalEvents', 'pastEvents', 'draftEvents','eventTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    public function currentUserProfile()
    {
        $user = Auth::user();
        $followers = Follower::where('user_id', $user->id)->count();
        $following = Following::where('user_id', $user->id)->where('is_accepted', 1)->count();
        $address = Address::where('user_id', $user->id)->latest()->first();
        $profilePicture = ProfileImage::where('user_id', $user->id)->latest()->first();
        return view('front.editProfile')->with(compact('user', 'address', 'profilePicture'));
    }

    public function userProfile($id)
    {
        $user = User::find($id);
        $currentUser = Auth::id();
        $followers = Follower::where('user_id', $user->id)->count();
        $following = Following::where('user_id', $user->id)->count();
        $address = Address::where('user_id', $user->id)->latest()->first();
        $profilePicture = ProfileImage::where('user_id', $user->id)->latest()->first();
        $isFollowing = Following::where('user_id', $currentUser)->where('following_id', $user->id)->first();
        return view('front.editprofile')->with(compact('user', 'followers', 'following', 'address', 'profilePicture', 'isFollowing'));
    }
}
