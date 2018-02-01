<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;

class MenuController extends Controller
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
        $user = User::find($user_id);
        $menus = Menu::all();
        return view('menu.index')->with('user', $user)->with('menus', $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $user = User::find($user_id);
        return view('menu.create')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $this->validate($request, [
            'code' => 'required|max:10',
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'description' => 'required|max:10000'
        ]);

        $menu = new Menu;
        $menu->user_id = $user->id;
        $menu->code = $request->code;
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->description = $request->description;
        $menu->save();

        return redirect()->route('menu.show', [$user->id, $menu->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $id)
    {
        $user = User::find($user_id);
        $menu = Menu::find($id);
        return view('menu.show', [$user->id, $menu->id])->with('menu', $menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, $id)
    {
        $user = User::find($user_id);
        $menu = Menu::find($id);
        return view('menu.edit', [$user->id, $menu->id])->with('menu', $menu)->with('user', $user);
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
        $user = User::find($user_id);
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

        return redirect()->route('menu.show', [$user->id, $menu->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $id)
    {
        $user = User::find($user_id);
        $menu = Menu::find($id)->delete();

        return redirect()->route('menu.index', $user->id);
    }
}
