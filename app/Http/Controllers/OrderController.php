<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Menu;
use App\Cart;
use Auth;

class OrderController extends Controller
{
    public function createCartView(){
        return view('order.create_cart');
    }

    public function createCartPost(Request $request){
        $cart = new Cart; 
        $cart->cx = $request->cx;
        $cart->user_id = Auth::user()->id;
        $cart->save();

        return redirect()->route('order.index', $cart->id)->with('cart', $cart);
    }

    public function cartView($cart_id){
        $cart = Cart::find($cart_id);

        $total = $cart->cartItems->sum('price');

        return view('order.cart')->with('cart', $cart)->with('total', $total);
    }

    public function placeOrder($cart_id){
        $cart = Cart::find($cart_id);

        // status 1 = in process
        foreach($cart->cartItems as $item){
            $item->status = 1;
            $item->update();
        }

        $total = $cart->cartItems->sum('price');

        $cart->status = 1;
        $cart->total = $total;
        $cart->update();

        return redirect()->route('receipt', $cart->id)->with('cart', $cart);
    }

    public function receipt($cart_id){
        $cart = Cart::find($cart_id);
        $total = $cart->cartItems->sum('price');

        return view('order.receipt')->with('cart', $cart)->with('total', $total);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cart_id)
    {
        $cart = Cart::find($cart_id);
        $menus = Menu::all();

        return view('order.index')->with('menus', $menus)->with('cart', $cart);
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
        $cart = Cart::find($cart_id);

        $order = new Order;
        $order->cart_id = $cart->id;
        $order->cx = $request->cx;
        $order->item = $request->name;
        $order->price = $request->price * $request->qty;
        $order->qty = $request->qty;
        $order->image = $request->image;
        $order->status = 0;
        $order->save();

        return redirect()->route('order.index', $cart->id)->with('cart', $cart);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
