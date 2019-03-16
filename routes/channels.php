<?php
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($id) {

    return true;
    // return (int) $user->id === (int) $id;
});

Broadcast::channel('channel-test', function() {
    return true;
});

Broadcast::channel('new-vendor-created', function($user) {
    return true;
});

Broadcast::channel('courier-location.{sjId}', function($sjId) {
    return true;
});
