<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Following;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{

    public function getPendingRequest()
    {
        $pendingRequest = Following::where('following_id', Auth::id())->where('is_accepted', 0)->with('user')->groupBy(['user_id', 'following_id'])->get();
        return response()->json([
            'success' => true,
            'data' => $pendingRequest,
            'message' => 'Current user pending request',
        ]);
    }
}
