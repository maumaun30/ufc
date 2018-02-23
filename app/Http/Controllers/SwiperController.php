<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Swiper;
use App\User;
use Image;

class SwiperController extends Controller
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

        return view('swiper.index')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $user = User::find(decrypt($user_id));

        return view('swiper.create')->with('user', $user);
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
            'title' => 'required|max:255',
            'image' => 'image|mimes:jpeg,jpg,png,gif',
        ]);

        $swiper = new Swiper;
        $swiper->user_id = $user->id;
        $swiper->title = $request->title;
        $swiper->featured = $request->featured;

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->save(public_path('img/uploads/' . $fileName));
            $swiper->image = 'img/uploads/' . $fileName;
        }

        $swiper->save();

        flash('Successfully added swiper!');

        return redirect()->route('swiper.show', [encrypt($user->id), $swiper->id]);
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
        $swiper = Swiper::find($id);

        return view('swiper.show')->with('user', $user)->with('swiper', $swiper);
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

    public function changeFeatured($user_id, $id){
        $user = User::find(decrypt($user_id));
        $swiper = Swiper::find($id);

        if ($swiper->featured == 1) {
            $swiper->featured = 0;
        }
        else {
            $swiper->featured = 1;
        }

        $swiper->update();

        flash('Successfully changed featured swiper!');

        return redirect()->route('swiper.show', [encrypt($user->id), $swiper->id]);
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
        $swiper = Swiper::find($id)->delete();

        flash('Successfully deleted swiper!');

        return redirect()->route('swiper.index', encrypt($user->id));
    }
}
