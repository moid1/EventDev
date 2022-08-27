<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    public function getUserNotifications()
    {
        $notifications = Notifications::where('user_id', Auth::id())->with('user')->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'success' => true,
            'data' => $notifications,
            'Message' => 'Your Notifications',
        ]);
    }

    public function sendSingleNotification(Request $request)
    {
        // $token, $title, $body, $data


        $SERVER_API_KEY = 'AAAAV0DCJ4I:APA91bGCijvnYnQgphS7rUTDtpfXtVqGcJxWXM8O-nAOZSp3rE9DOUDJav8-B3oaZpZgjI3Engzj_Y3wkxJ26c0X16hv8HOrceP3NVolYel8rE55IHUvVZzD8s-fqQsXasijSUVxJLHn';
        $data = [
            'registration_ids' => array($request->token),
            "notification" => [
                'title' => $request->title,
                "body" => $request->body,
                'data' => $request->data,
            ]
        ];

        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return $response;
    }
}
