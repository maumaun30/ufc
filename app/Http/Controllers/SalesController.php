<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sales;
use App\Inventory;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::find(decrypt($user_id));

        return view('sales.index')->with('user', $user);
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
    public function store(Request $request)
    {
        //
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
    public function edit($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $sale = Sales::find($id);
        return view('sales.edit', [$user->id, $sale->id])->with('sale', $sale)->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($user_id, Request $request, $id)
    {
        $user = User::find(decrypt($user_id));
        $sale = Sales::find($id);

        $this->validate($request, [
            'cx' => 'required|max:255',
            'items' => 'required',
            'price' => 'required|integer',
        ]);

        $sale->cx = $request->cx;
        $sale->items = $request->items;
        $sale->price = $request->price;
        $sale->update();

        return redirect()->route('sales.index', encrypt($user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $sale = Sales::find($id)->delete();

        return redirect()->route('sales.index', encrypt($user->id));
    }
}
