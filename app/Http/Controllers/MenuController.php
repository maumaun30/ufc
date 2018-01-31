<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Profile;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($profile_id)
    {
        $profile = Profile::find($profile_id);
        $menus = Menu::all();
        return view('menu.index')->with('profile', $profile)->with('menus', $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($profile_id)
    {
        $profile = Profile::find($profile_id);
        return view('menu.create')->with('profile', $profile);
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

        $this->validate($request, [
            'code' => 'required|max:10',
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'description' => 'required|max:10000'
        ]);

        $menu = new Menu;
        $menu->code = $request->code;
        $menu->name = $request->name;
        $menu->profile_id = $profile->id;
        $menu->price = $request->price;
        $menu->description = $request->description;
        $menu->save();

        return redirect()->route('menu.show', [$profile->id, $menu->id]);
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
        $menu = Menu::find($id);
        return view('menu.show', [$profile->id, $menu->id])->with('menu', $menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($profile_id, $id)
    {
        $profile = Profile::find($profile_id);
        $menu = Menu::find($id);
        return view('menu.edit', [$profile->id, $menu->id])->with('menu', $menu)->with('profile', $profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $profile_id, $id)
    {
        $profile = Profile::find($profile_id);
        $menu = Menu::find($id);

        $this->validate($request, [
            'code' => 'required|max:10',
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'description' => 'required|max:10000'
        ]);

        $menu->code = $request->code;
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->description = $request->description;
        $menu->update();

        return redirect()->route('menu.show', [$profile->id, $menu->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($profile_id, $id)
    {
        $profile = Profile::find($profile_id);
        $menu = Menu::find($id)->delete();

        return redirect()->route('profile.show', $profile->id);
    }
}
