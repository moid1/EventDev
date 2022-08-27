<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SocialShareButtonsController extends Controller
{

    public function ShareWidget($id)
    {
        $url =   URL::to('/') . '/eventDetails/' . $id;
        $shareComponent = \Share::page(
            $url,
            'Your share text comes here',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

        return view('posts', compact('shareComponent'));
    }
}
