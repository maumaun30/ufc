<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\User;

class InventoryController extends Controller
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
        $inventories = Inventory::all();

        return view('inventory.index')->with('user', $user)->with('inventories', $inventories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $user = User::find(decrypt($user_id));
        return view('inventory.create')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $user = User::find(decrypt($user_id));

        $this->validate($request,[
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'qty' => 'required|integer',
            'vom' => 'required|max:255',
            'date_reorder' => 'required|date|date_format:M-d-Y',
        ]);

        $inventory = new Inventory;
        $inventory->user_id = $user->id;
        $inventory->name = $request->name;
        $inventory->price = $request->price;
        $inventory->qty = $request->qty;
        $inventory->vom = $request->vom;
        $inventory->date_reorder = $request->date_reorder;
        $inventory->value = $request->qty * $request->price;
        $inventory->save();

        flash('Successfully added inventory!');

        return redirect()->route('inventory.show', [encrypt($user->id), $inventory->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $inventory = Inventory::find($id);
        return view('inventory.show', [encrypt($user->id), $inventory->id])->with('inventory', $inventory)->with('user', $user);
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
        $inventory = Inventory::find($id);
        return view('inventory.edit', [encrypt($user->id), $inventory->id])->with('inventory', $inventory)->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $inventory = Inventory::find($id);

        $this->validate($request,[
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'qty' => 'required|integer',
            'vom' => 'required|max:255',
            'date_reorder' => 'required|date|date_format:M-d-Y',
        ]);

        $inventory->name = $request->name;
        $inventory->price = $request->price;
        $inventory->qty = $request->qty;
        $inventory->vom = $request->vom;
        $inventory->date_reorder = $request->date_reorder;
        $inventory->value = $request->qty * $request->price;
        $inventory->update();

        flash('Successfully updated inventory!');

        return redirect()->route('inventory.show', [encrypt($user->id), $inventory->id]);
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
        $inventory = Inventory::find($id)->delete();

        flash('Successfully deleted inventory!');

        return redirect()->route('inventory.show', encrypt($user->id));
    }
}
