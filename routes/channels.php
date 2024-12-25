<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Auth::login(new User());


Broadcast::channel('checkboxes', function (User $user) {
    return true;
});
