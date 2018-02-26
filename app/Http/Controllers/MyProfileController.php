<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MyProfileController extends Controller
{
    // My Profile

    public function myProfile($id, $company){
        $user = User::find($id);
        return view('my_profile.index')->with('user', $user);
    }
}
