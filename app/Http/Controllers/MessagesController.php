<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Lib\PusherFactory;
use App\Models\Following;
use App\Models\Message;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * getLoadLatestMessages
     *
     *
     * @param Request $request
     */
    public function getLoadLatestMessages(Request $request)
    {
        if (!$request->user_id) {
            return;
        }
        $messages = Message::where(function ($query) use ($request) {
            $query->where('from_user', Auth::user()->id)->where('to_user', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id);
        })->orderBy('created_at', 'ASC')->limit(10)->get();
        $return = [];
        foreach ($messages as $message) {
            $return[] = view('chat_layout.message-line')->with('message', $message)->render();
        }
        return response()->json(['state' => 1, 'messages' => $return]);
    }

    public function loadLatestMessages(Request $request)
    {
        $messages = Message::where(function ($query) use ($request) {
            $query->where('from_user', Auth::user()->id)->where('to_user', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id);
        })->orderBy('created_at', 'DESC')->limit(10)->get();
        return response()->json([
            'success' => true,
            'data' => $messages,
            'message' => 'Latest Messages',
        ]);
    }


    public function indexHome()
    {

        // dd($lastMessages);
        //  $messages=   User::with('messages')->find(Auth::id())->messages;
        //  dd($messages);

        $messages = Message::where('from_user', Auth::id())
            ->select('*')->with(['toUser', 'fromUser'])
            ->selectRaw('MAX(created_at) AS last_date')
            ->groupBy(['from_user', 'to_user'])
            ->orderBy('last_date', 'DESC')
            ->get();
        // $messages = User::with('messages')->get();



        $followingUser = Following::where('user_id', Auth::id())->with('user')->get();
        return view('chat_layout.home', compact('messages', 'followingUser'));
    }

    /**
     * postSendMessage
     *
     * @param Request $request
     */
    public function postSendMessage(Request $request)
    {
        if (!$request->to_user || !$request->message) {
            return;
        }

        $hasData = Message::where('from_user', Auth::id())->where('to_user', $request->to_user)->orWhere('to_user', Auth::id())->where('from_user', $request->to_user)->get();
        if (count($hasData) == 0) {
            $mes = new Message();

            $mes->to_user = Auth::user()->id;

            $mes->from_user = $request->to_user;

            $mes->content = '';

            $mes->save();
        }

        $message = new Message();

        $message->from_user = Auth::user()->id;

        $message->to_user = $request->to_user;

        $message->content = $request->message;

        $message->save();


        // prepare some data to send with the response
        $message->dateTimeStr = date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString()));

        $message->dateHumanReadable = $message->created_at->diffForHumans();

        $message->fromUserName = $message->fromUser->name;

        $message->from_user_id = Auth::user()->id;

        $message->toUserName = $message->toUser->name;

        $message->to_user_id = $request->to_user;

        // event(new MessageSent($message));
        PusherFactory::make()->trigger('chat', 'send', ['data' => $message]);

        // PusherFactory::make()->trigger('chat-message.' . $request->to_user .''. Auth::user()->id, 'send', ['data' => $message]);


        return response()->json(['state' => 1, 'data' => $message]);
    }

    /**
     * getOldMessages
     *
     * we will fetch the old messages using the last sent id from the request
     * by querying the created at date
     *
     * @param Request $request
     */
    public function getOldMessages(Request $request)
    {
        if (!$request->old_message_id || !$request->to_user)
            return;
        $message = Message::find($request->old_message_id);
        $lastMessages = Message::where(function ($query) use ($request, $message) {
            $query->where('from_user', Auth::user()->id)
                ->where('to_user', $request->to_user)
                ->where('created_at', '<', $message->created_at);
        })
            ->orWhere(function ($query) use ($request, $message) {
                $query->where('from_user', $request->to_user)
                    ->where('to_user', Auth::user()->id)
                    ->where('created_at', '<', $message->created_at);
            })
            ->orderBy('created_at', 'ASC')->limit(10)->get();
        $return = [];
        if ($lastMessages->count() > 0) {
            foreach ($lastMessages as $message) {
                $return[] = view('chat_layout.message-line')->with('message', $message)->render();
            }
            PusherFactory::make()->trigger('chat', 'oldMsgs', ['to_user' => $request->to_user, 'data' => $return]);
        }
        return response()->json(['state' => 1, 'data' => $return]);
    }

    public function getOldMessagesAPI(Request $request)
    {
        if (!$request->old_message_id || !$request->to_user)
            return;
        $message = Message::find($request->old_message_id);
        if ($message) {
            $lastMessages = Message::where(function ($query) use ($request, $message) {
                $query->where('from_user', Auth::user()->id)
                    ->where('to_user', $request->to_user)
                    ->where('created_at', '<', $message->created_at);
            })
                ->orWhere(function ($query) use ($request, $message) {
                    $query->where('from_user', $request->to_user)
                        ->where('to_user', Auth::user()->id)
                        ->where('created_at', '<', $message->created_at);
                })
                ->orderBy('created_at', 'ASC')->limit(10)->get();

            // if ($lastMessages->count() > 0) {
            // foreach ($lastMessages as $message) {
            //     $return[] = view('chat_layout.message-line')->with('message', $message)->render();
            // }
            // PusherFactory::make()->trigger('chat', 'oldMsgs', ['to_user' => $request->to_user, 'data' => $return]);
            // }
            return response()->json([
                'success' => true,
                'data' => $lastMessages,
                'message' => 'oldMessages',
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'oldMessages',
            ]);
        }
    }




    // forMobileApplication
    public function getMessageHistory()
    {
        $messages = Message::where('from_user', Auth::id())
            ->select('*')->with(['toUser', 'fromUser'])
            ->selectRaw('MAX(created_at) AS last_date')
            ->groupBy(['from_user', 'to_user'])
            ->orderBy('last_date', 'DESC')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $messages,
            'message' => 'Chats',
        ]);
    }
}
