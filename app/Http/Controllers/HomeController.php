<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.dashboard');
    }

    public function profile($user_id){
        $user = User::find($user_id);

        return view('auth.profile')->with('user', $user);
    }

    public function settings($user_id){
        $user = User::find($user_id);

        return view('auth.settings')->with('user', $user);
    }

    public function currentOrders($user_id){
        $user = User::find($user_id);

        return view('auth.current_orders')->with('user', $user);
    }
}
