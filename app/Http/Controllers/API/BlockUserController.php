<?php

namespace App\Http\Controllers\API;

use App\Models\BlockUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BlockUserController extends Controller
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
        $blockUserData =  Validator::make($request->all(), [
            'block_user_id' => 'required|exists:users,id'
        ]);
        if ($blockUserData->fails()) {
            return response()->json([
                'success' => false,
                'message' => $blockUserData->errors()->first(),
            ]);
        }

        $alreadyBlocked =  BlockUser::where('block_user_id', $request->block_user_id)->where('user_id', Auth::id())->first();
        if ($alreadyBlocked) {
            return response()->json([
                'success' => false,
                'message' => 'User is already Blocked',
            ]);
        } else {
            BlockUser::create([
                'user_id' => Auth::id(),
                'block_user_id' => $request->block_user_id
            ]);
            return response()->json([
                'success' => true,
                'message' => 'User Blocked Successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlockUser  $blockUser
     * @return \Illuminate\Http\Response
     */
    public function show(BlockUser $blockUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlockUser  $blockUser
     * @return \Illuminate\Http\Response
     */
    public function edit(BlockUser $blockUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlockUser  $blockUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlockUser $blockUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlockUser  $blockUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlockUser $blockUser)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function unblockUser(Request $request)
    {
        $blockUserData =  Validator::make($request->all(), [
            'block_user_id' => 'required|exists:users,id'
        ]);
        if ($blockUserData->fails()) {
            return response()->json([
                'success' => false,
                'message' => $blockUserData->errors()->first(),
            ]);
        }

        $alreadyBlocked =  BlockUser::where('block_user_id', $request->block_user_id)->where('user_id', Auth::id())->first();
        if ($alreadyBlocked) {
            $isDeleted =    $alreadyBlocked->delete();
            if ($isDeleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Unblocked Successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Service is not available right now',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User is not Blocked from the current user',
            ]);
        }
    }
}
