<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
}
