<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{



    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->is_block == 'true') {
                return back()->withErrors([
                    'email' => 'Your account is blocked by admin',
                ]);
            }
        }

        if (Auth::attempt($credentials)) {

            $user = User::find(Auth::user()->id);
            $user->is_online = true;
            $user->update();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout()
    {
        $user = User::find(Auth::user()->id);
        $user->is_online = false;
        $user->last_seen = Carbon::now();
        $user->update();
        Auth::logout();
        return redirect()->intended('/login');
    }

    //apis function

    public function functionLogin(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }
        $user = User::find(Auth::user()->id);
        $user->is_online = true;
        $user->firebase_token = $request->token;
        $user->update();
        $user = User::where('id', Auth::id())->with('profilePicture')->first();
        return response()->json([
            'user' => $user,
            'token' => auth()->user()->createToken('API Token')->plainTextToken,
            'message' => 'Login Successfully',
        ]);
    }

    public function createAccount(Request $request)
    {
        $userData =  Validator::make($request->all(), [
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
        if ($userData->fails()) {
            return response()->json([
                'success' => false,
                'message' => $userData->errors()->first(),
            ]);
        }

        $input = request()->except('password', 'confirm_password');
        $user = new User($input);
        $user->password = ($request->password);
        $user->ip_address = $request->ip();
        $user->save();

        $token = $user->createToken('tokens')->plainTextToken;

        $to = $user->email;

        $subject = 'Thank you for registering at EventSpotters';

        $headers = "From: " . strip_tags('no-reply@theeventspotters.com') . "\r\n";
        $headers .= "Reply-To: " . strip_tags($to) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = '<div style="text-align:center"> <img src="https://theeventspotter.com/assets/images/logo.png"/>';
        $message .= '<br><h4>The Event Spotter </h4>';
        $message .=   '<br> <p>Thank you for registering at EventSpotters.</p>';
        $message .=    '</div>';


        $mail = mail($to, $subject, $message, $headers);

        return response()->json([
            'success' => true,
            'data' => $user,
            'token' => $token,
            'message' => 'User Created Successfully',
            'mail' => $mail,
        ]);
    }

    public function saveLatLng(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user = User::find($user->id);
            $user->lat_lng = $request->lat_lng;
            $user->update();
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Lat Lng updated successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Authentication Required',
            ]);
        }
    }

    public function appLogout()
    {
        $user = User::find(Auth::user()->id);
        $user->is_online = false;
        $user->last_seen = Carbon::now();
        $user->update();
        $user->tokens()->delete();
        return response()->json([
            'success' => true,
            'data' => [],
            'message' => 'Logout Successfully',
        ]);
    }

    public function editProfile(Request $request)
    {

        $user = User::find(Auth::id());
        Address::where('user_id', $user->id)->first()->update([
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
        ]);
        if ($request->has('phoneNumber')) {
            $user->phone_number = ($request->phoneNumber);
            $user->update();
        }
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Profile updated successfully',
        ]);
    }

    public function getUserDetailsById($id)
    {
        $user = User::find($id);
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User Detail'
        ]);
    }
}
