<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Menu;
use App\Addon;
use App\Cart;
use App\User;
use App\Category;
use Auth;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function createCartView(){
        return view('order.create_cart');
    }

    public function createCartPost(Request $request){
        $cart = new Cart; 
        $cart->cx = $request->cx;
        $cart->table_number = $request->table_number;
        $cart->user_id = Auth::user()->id;
        $cart->save();

        return redirect()->route('order.index', encrypt($cart->id))->with('cart', $cart);
    }

    public function cartView($cart_id){
        $cart = Cart::find(decrypt($cart_id));

        return view('order.cart')->with('cart', $cart);
    }

    public function placeOrder($cart_id){
        $cart = Cart::find(decrypt($cart_id));

        if ($cart->status == 1) {
            flash('Order is already placed and in process')->primary;

            return redirect()->route('create.cart');
        }

        else if($cart->status == 2) {
            flash('Order is already finished')->warning;

            return redirect()->route('create.cart');
        }

        else {
            // status 1 = in process
            foreach($cart->cartItems as $item){
                $item->status = 1;
                $item->update();
            }

            $cart->status = 1;
            $cart->total = $total;
            $cart->update();
        }

        return redirect()->route('receipt', encrypt($cart->id))->with('cart', $cart);
    }

    public function receipt($cart_id){
        $cart = Cart::find(decrypt($cart_id));

        return view('order.receipt')->with('cart', $cart);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cart_id)
    {
        $cart = Cart::find(decrypt($cart_id));
        $user = User::find(Auth::user()->id);

        return view('order.index')->with('user', $user)->with('cart', $cart);
    }

    public function indexCategory($cart_id, $id)
    {
        $cart = Cart::find(decrypt($cart_id));
        $user = User::find(Auth::user()->id);

        $category = $user->profileCategoryMenus->where('id', $id)->first();

        return view('order.category')->with('user', $user)->with('cart', $cart)->with('category', $category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $cart_id)
    {
        $cart = Cart::find(decrypt($cart_id));

        $order = new Order;
        $order->cart_id = $cart->id;
        $order->cx = $request->cx;
        $order->item = $request->name;
        $order->price = decrypt($request->price) * $request->qty;
        $order->qty = $request->qty;
        $order->image = $request->image;
        $order->status = 0;
        $order->save();

        flash('Successfully added an item into cart!');

        // return redirect()->route('order.index', $cart->id)->with('cart', $cart);
        return back();
    }

    public function storeAddon(Request $request, $cart_id)
    {
        $cart = Cart::find(decrypt($cart_id));
        $count = count($request->name1);
        for ($i=0; $i < $count; $i++) { 
            foreach ($request->name1 as $checkbox) {
                // dd($request->name1);
                $order = new Order;
                $order->cart_id = $cart->id;
                $order->cx = $request->cx1;
                $order->item = $checkbox;
                $order->image = 'img/uploads/default.jpg';
                $order->price = $request->price1[$i] * $request->qty1[$i];
                $order->qty = $request->qty1[$i];
                $order->status = 0;
                $order->save();
            }
        }

        flash('Successfully added an item into cart!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function editQty(Request $request, $cart_id, $id)
    {
        $cart = Cart::find(decrypt($cart_id));

        $this->validate($request, [
            'qty' => 'integer'
        ]);

        $order = Order::find($id);
        $order->qty = $request->qty;
        $order->price = ($request->price / $request->old_qty) * $request->qty;
        $order->update();

        flash('Successfully edited quantity of item');

        return back();

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart_id, $id)
    {
        $cart = Cart::find(decrypt($cart_id));
        $order = Order::find($id)->delete();

        return redirect()->route('view.cart', encrypt($cart->id))->with('cart', $cart);
    }
}
