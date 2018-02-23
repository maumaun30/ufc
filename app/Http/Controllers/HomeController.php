<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cart;
use App\Order;
use App\Sales;
use App\Feedback;
use App\Rating;
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

        flash('Successfully updated profile!');

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

        flash('Successfully changed logo!');

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

        flash('Successfully changed password!');

        return redirect()->route('profile', encrypt($user->id));
    }

    public function currentOrders($user_id){
        $user = User::find(decrypt($user_id));

        return view('auth.current_orders')->with('user', $user);
    }

    public function finishOrder($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $order = Order::find($id);
        // status 2 = finish
        $order->status = 2;
        $order->update();

        return redirect()->route('current.orders', encrypt($user->id))->with('user', $user);
    }

    public function discardOrder($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $order = Order::find($id);

        $order->status = 0;
        $order->update();

        return redirect()->route('current.orders', encrypt($user->id))->with('user', $user);
    }

    public function finishCart($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $cart = Cart::find($id);

        $cartItems = '';

        // status 2 = finish
        $cart->status = 2;

        foreach($cart->cartItems as $order){
            $cartItems .= $order->item . ' x ' . $order->qty . ' = ' . $order->price .  ',';
            $order->status = 2;
            $order->update();
        }

        $sales = new Sales;
        $sales->user_id = $user->id;
        $sales->cx = $cart->cx;
        $sales->price = $cart->total;
        $sales->items = rtrim($cartItems,', ');
        $sales->save(); 

        $cart->update();

        return redirect()->route('current.orders', encrypt($user->id))->with('user', $user);
    }

    public function discardCart($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $cart = Cart::find($id);

        $cart->status = 0;

        foreach($cart->cartItems as $order){
            $order->status = 0;
            $order->update();
        }

        $cart->update();

        return redirect()->route('current.orders', encrypt($user->id))->with('user', $user);
    }

    public function indexFeedback($user_id)
    {
        $user = User::find(decrypt($user_id));

        return view('auth.feedback')->with('user', $user);
    }

    public function storeFeedback(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $this->validate($request, [
            'feedback' => 'required'
        ]);

        $feedback = new Feedback;
        $feedback->user_id = $user->id;
        $feedback->cx = $request->cx;
        $feedback->feedback = $request->feedback;
        $feedback->save();

        flash('Successfully submitted feedback!');

        return back();
    }

    public function indexRating($user_id)
    {
        $user = User::find(decrypt($user_id));

        return view('auth.rating')->with('user', $user);
    }

    public function storeRating(Request $request, $user_id, $id)
    {
        $user = User::find($user_id);
        $cart = Cart::find(decrypt($id));

        $rating = new Rating;
        $rating->user_id = $user->id;
        $rating->cart_id = $cart->id;
        $rating->cx = $request->cx1;
        $rating->score = $request->score;
        $rating->save();

        flash('Successfully rated!');

        return back();
    }


    public function print($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $cart = Cart::find($id);

        return view('order.print')->with('user', $user)->with('cart', $cart);
    }
}
