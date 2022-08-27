<?php
namespace App\Lib;
use Pusher\Pusher;
class PusherFactory
{
    public static function make()
    {
    //    dd(env("PUSHER_APP_CLUSTER"));
        return new Pusher(
            env("PUSHER_APP_KEY"), // public key
            env("PUSHER_APP_SECRET"), // Secret
            env("PUSHER_APP_ID"), // App_id
            array(
                'cluster' => env("PUSHER_APP_CLUSTER"), // Cluster
                'encrypted' => true,
            )
        );
    }
}