<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventFeeds;
use App\Models\EventTypes;
use App\Models\Favrouite;
use App\Models\Follower;
use App\Models\Following;
use App\Models\Likes;
use App\Models\Notifications;
use App\Models\ProfileImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class UserController extends Controller
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
        if (Auth::user()->role == 'admin') {
            $user = User::where('id', Auth::id())->with('profilePicture')->first();
            $totalEvents = Event::all()->count();
            $totalUsers = User::all()->except(Auth::id())->count();
            $lastMonthUsers  = User::where(
                'created_at',
                '>=',
                Carbon::now()->firstOfMonth()->toDateTimeString()
            )->get()->count();
            $lastMonthEvents =  Event::where(
                'created_at',
                '>=',
                Carbon::now()->firstOfMonth()->toDateTimeString()
            )->get()->count();

            $latestUsers = User::latest()->take(10)->get();



            return view('admin.index', compact('user', 'totalEvents', 'totalUsers', 'lastMonthUsers', 'lastMonthEvents', 'latestUsers'));
        }

        $eventTypes = EventTypes::all();
        $allEvents = Event::where('is_drafted', 0)->with(['eventPictures', 'user', 'comment', 'liveFeed'])->get();
        $temp = array();
        foreach ($allEvents as $key => $value) {
            $eventDate = Carbon::parse($value->event_date);
            if ($eventDate >= Carbon::today() || $eventDate == Carbon::yesterday()) {
                $temp[] = $value;
            }
        }

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
                    $nearEvents[] = array('events' => $value, 'livefeed' => $liveFeed, 'km' => number_format($mile, 1), 'isFavroute' => $fav ? 1 : 0, 'Following' => $isFollowing ? 1 : 0, 'isLiked' => $isLiked ? 1 : 0);
                }
            }
            array_multisort(array_column($nearEvents, 'km'), SORT_ASC, $nearEvents);
        }
        return view('front.home')->with(compact('user', 'nearEvents', 'eventTypes'));
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
            'name' => 'required|min:2|max:50',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:8|max:20|same:password',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);

        $input = request()->except('password', 'confirm_password');
        $user = new User($input);
        $user->password = ($request->password);
        $user->ip_address = $request->ip();
        $user->save();
        return redirect('/login')->with('success', 'You have successfully signed up, please login');
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


    public function saveLatLng(Request $request)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $user->lat_lng = $request->lat . ',' . $request->lng;
        $user->update();
    }

    public function uploadProfilePicture(Request $request)
    {
        if ($request->has('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(('images'), $imageName);
            ProfileImage::where('user_id', Auth::id())->delete();
            //saving image to db
            $profileImage =  ProfileImage::create([
                'user_id' => Auth::id(),
                'image' => ('images') . '/' . $imageName,
            ]);

            return response()->json([
                'success' => true,
                'data' => $profileImage,
                'message' => 'Profile Image Updated Successfully',
            ]);
        }
    }

    public function search(Request $request)
    {
        $text = $request->input('text');
        $users = User::whereRaw('email = ? or name like ?', [$text, "%{$text}%"])->with('profilePicture')->get();
        $users = $users->except(Auth::id());
        return response()->json($users);
    }

    public function makeNoPrivate(Request $request)
    {
        $user = User::find(Auth::id());
        $user->mobile_is_private = $request->isPrivate;
        $user->update();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Phone No Status Changed Successfully',
        ]);
    }

    public function useYourLocation(Request $request)
    {
        $user = User::find(Auth::id());
        $user->use_location = $request->use_location;
        $user->update();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Use Location Status Changed Successfully',
        ]);
    }

    public function allowDirectMessage(Request $request)
    {
        $user = User::find(Auth::id());
        $user->allow_direct_message = $request->allow_direct_message;
        $user->update();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Direct Message Status Changed Successfully',
        ]);
    }

    public function makeProfilePrivate(Request $request)
    {
        // $isValid =  $request->validate([
        //     'is_private' => 'required'
        // ]);
        // if (!$isValid) {
        //     return response()->json([
        //         'success' => false,
        //     ]);
        // }
        $user = User::find(Auth::id());
        $user->profile_private = $request->profile_private;
        $user->update();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Profile Status Changed Successfully',
        ]);
    }


    function distance($lat1, $lon1, $lat2, $lon2)
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

    public function checkUserOnline(Request $request)
    {
        $isOnline =   Cache()->has('user-is-online-' . $request->user_id);
        return response()->json([
            'success' => true,
            'data' => $isOnline,
            'message' => 'sf'
        ]);
    }
}
