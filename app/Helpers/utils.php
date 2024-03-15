<?php

use App\Models\User;

function getUserDP($userID = 0)
{
    $user = User::find(($userID) ? $userID : auth()->user()->id);
    if ($user->dp == "/images/user.png") {
        return "/images/user2.png";
    }
    return "/storage/" . $user->dp;
}
