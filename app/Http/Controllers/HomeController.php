<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cart;
use Auth;
use Image;

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

    public function welcome(){
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();

        return view('auth.dashboard')->with('user', $user);
    }

    // Profile
    public function profile($user_id){
        $user = User::find(decrypt($user_id));

        return view('auth.profile')->with('user', $user);
    }

    public function profileEdit($user_id){
        $user = User::find(decrypt($user_id));

        return view('auth.profile_edit')->with('user', $user);
    }

    public function profileUpdate(Request $request, $user_id){
        $user = User::find(decrypt($user_id));

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,' . $user->id,
            'company' => 'required|max:255',
            'address' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->company = $request->company;
        $user->address = $request->address;
        $user->update();

        return redirect()->route('profile', encrypt($user->id));
    }

    public function profileLogo(Request $request, $user_id){
        $user = User::find(decrypt($user_id));

        $this->validate($request, [
            'logo' => 'image|mimes:jpeg,jpg,png,gif',
        ]);

        if ($request->hasFile('logo')) {
            $fileName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            Image::make($request->file('logo'))->save(public_path('img/uploads/logo/' . $fileName));
            $user->logo = 'img/uploads/logo/' . $fileName;
        }

        $user->update();

        return redirect()->route('profile', encrypt($user->id));
    }

    public function changePassword($user_id){
        $user = User::find(decrypt($user_id));

        return view('auth.change_password')->with('user', $user);
    }

    public function changePasswordUpdate(Request $request, $user_id){
        $user = User::find(decrypt($user_id));

        $this->validate($request, [
        'password' => 'required|string|min:6|confirmed',
        ]);

        $user->password = bcrypt($request->password);
        $user->update();

        return redirect()->route('profile', encrypt($user->id));
    }

    public function settings($user_id){
        $user = User::find(decrypt($user_id));

        return view('auth.settings')->with('user', $user);
    }

    public function currentOrders($user_id){
        $user = User::find(decrypt($user_id));

        return view('auth.current_orders')->with('user', $user);
    }
}
