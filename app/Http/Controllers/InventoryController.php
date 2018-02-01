<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Inventory;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($profile_id)
    {
        $profile = Profile::find($profile_id);
        $inventories = Inventory::all();

        return view('inventory.index')->with('profile', $profile)->with('inventories', $inventories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($profile_id)
    {
        $profile = Profile::find($profile_id);
        return view('inventory.create')->with('profile', $profile);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $profile_id)
    {
        $profile = Profile::find($profile_id);

        $this->validate($request,[
            'inv_id' => 'required|unique:inventories|max:255',
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'qty' => 'required|integer',
            'vom' => 'required|max:255',
            'date_reorder' => 'required|date|date_format:M-d-Y',
            'value' => 'required|integer'
        ]);

        $inventory = new Inventory;
        $inventory->inv_id = $request->inv_id;
        $inventory->name = $request->name;
        $inventory->price = $request->price;
        $inventory->qty = $request->qty;
        $inventory->vom = $request->vom;
        $inventory->date_reorder = $request->date_reorder;
        $inventory->value = $request->value;
        $inventory->save();

        return redirect()->route('inventory.show', [$profile->id, $inventory->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($profile_id, $id)
    {
        $profile = Profile::find($profile_id);
        $inventory = Inventory::find($id);
        return view('inventory.show', [$profile->id, $inventory->id])->with('inventory', $inventory);
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
