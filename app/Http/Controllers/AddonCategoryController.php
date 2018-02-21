<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AddonCategory;

class AddonCategoryController extends Controller
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
        $addon_categories = AddonCategory::all();
        return view('addon.addon_category.index')->with('user', $user)->with('addon_categories', $addon_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $user = User::find(decrypt($user_id));
        return view('addon.addon_category.create')->with('user', $user);
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
        ]);

        $addon_category = new AddonCategory;
        $addon_category->name = $request->name;
        $addon_category->user_id = $user->id;

        $addon_category->save();

        flash('Successfully added add-on category!');

        return redirect()->route('addon_category.index', encrypt($user->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

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
        $addon_category = AddonCategory::find($id);
        return view('addon.addon_category.edit', [$user->id, $addon_category->id])->with('addon_category', $addon_category)->with('user', $user);
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
        $addon_category = AddonCategory::find($id);

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $addon_category->name = $request->name;
        $addon_category->update();

        flash('Successfully updated menu category!');

        return redirect()->route('addon_category.index', encrypt($user->id));
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
        $addon_category = AddonCategory::find($id)->delete();

        flash('Successfully deleted menu category!');

        return redirect()->route('addon_category.index', encrypt($user->id));
    }
}
