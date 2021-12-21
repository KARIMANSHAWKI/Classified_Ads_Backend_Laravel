<?php

use App\Models\User;


function createToken(User $user)
{
    $token = $user->createToken(env('TOKEN_NAME'))->plainTextToken;
    return $token;
}
