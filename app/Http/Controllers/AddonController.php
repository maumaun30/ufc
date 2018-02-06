<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Addon;

class AddonController extends Controller
{
    public function __construct(){
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
        $addons = Addon::latest();
        return view('addon.index')->with('user', $user)->with('addons', $addons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $user = User::find(decrypt($user_id));
        return view('addon.create')->with('user', $user);
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

        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|integer',
        ]);

        $addon = new addon;
        $addon->user_id = $user->id;
        $addon->name = $request->name;
        $addon->price = $request->price;
        $addon->featured = $request->featured;

        $addon->save();

        return redirect()->route('addon.show', [encrypt($user->id), $addon->id]);
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
        $addon = Addon::find($id);
        return view('addon.show', [$user->id, $addon->id])->with('user', $user)->with('addon', $addon);
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
        $addon = Addon::find($id);
        return view('addon.edit', [$user->id, $addon->id])->with('addon', $addon)->with('user', $user);
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
        $addon = Addon::find($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|integer',
        ]);

        $addon->name = $request->name;
        $addon->price = $request->price;
        $addon->update();

        return redirect()->route('addon.show', [encrypt($user->id), $addon->id]);
    }

    public function changeFeatured($user_id, $id){
        $user = User::find(decrypt($user_id));
        $addon = Addon::find($id);

        if ($addon->featured == 1) {
            $addon->featured = 0;
        }
        else {
            $addon->featured = 1;
        }

        $addon->update();

        return redirect()->route('addon.show', [encrypt($user->id), $addon->id]);
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
        $addon = Addon::find($id)->delete();

        return redirect()->route('addon.index', encrypt($user->id));
    }
}
