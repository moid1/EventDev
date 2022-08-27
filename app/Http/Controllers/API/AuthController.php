<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Event;
use App\Models\ProfileImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getUserProfile()
    {
        $user = User::where('id', Auth::id())->with(['profilePicture', 'followers', 'following', 'address', 'events'])->first();
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User Profile',
        ]);
    }

    public function deleteUser()
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['success' => false, 'data' => null, 'message' => 'user not found']);
        }

        $user = User::find($userId);
        $addresses = Address::where('user_id', $userId)->get();
        $profileImages = ProfileImage::where('user_id', $userId)->get();
        $events = Event::where('user_id', $userId)->get();
        if ($addresses) {
            $addresses->delete();
        }
        if ($profileImages) {
            $profileImages->delete();
        }
        if ($events) {
            $events->delete();
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'User deleted permanently successfully',
        ]);
    }
}
