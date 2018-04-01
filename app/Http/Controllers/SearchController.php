<?php

namespace Alumni\Http\Controllers;

use Illuminate\Http\Request;
use Alumni\Profile;
use Alumni\User;

class SearchController extends Controller
{
    public function get()
    {
        $profile = Profile::where('uid', $uid)->get();
        return $profile;
    }
}
