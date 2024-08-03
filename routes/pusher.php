<?php

use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

Route::post('/auth', function () {
    $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'useTLS' => true
    ]);
    $socketId = request()->input('socket_id');
    $channelName = request()->input('channel_name');
    $auth = $pusher->socket_auth($channelName, $socketId);
    return $auth;
});
