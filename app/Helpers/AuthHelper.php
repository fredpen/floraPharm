<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    public static function isAdmin()
    {
        if (Auth::id() && Auth::user() && Auth::user()->type == 1) {
            return true;
        }
        return false;
    }
}
