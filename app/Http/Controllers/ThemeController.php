<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;
use App\Theme;
use Image;

class ThemeController extends Controller
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

        return view('themes.index')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $user = User::find(decrypt($user_id));

        return view('themes.create')->with('user', $user);
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
            'name' => 'required|max:255'
        ]);

        $theme = new Theme;
        $theme->user_id = $user->id;
        $theme->name = $request->name;

        if ($request->hasFile('bg_image')) {
            $fileName = time() . '.' . $request->file('bg_image')->getClientOriginalExtension();
            Image::make($request->file('bg_image'))->save(public_path('img/uploads/' . $fileName));
            $theme->bg_image = 'img/uploads/' . $fileName;
        }

        $theme->bg_color = $request->bg_color;
        $theme->ft_family = $request->ft_family;
        $theme->ft_size = $request->ft_size;
        $theme->ft_color = $request->ft_color;
        $theme->pnl_opacity = $request->pnl_opacity;
        $theme->pnl_color = $request->pnl_color;
        $theme->save();

        flash('Successfully added theme!');

        return redirect()->route('themes.index', encrypt($user->id));
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
        $theme = Theme::find($id);

        return view('themes.edit')->with('user', $user)->with('theme', $theme);
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

        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,jpg,png,gif',
        ]);

        $theme = Theme::find($id);
        $theme->name = $request->name;
        $theme->bg_color = $request->bg_color;
        $theme->ft_family = $request->ft_family;
        $theme->ft_size = $request->ft_size;
        $theme->ft_color = $request->ft_color;
        $theme->pnl_opacity = $request->pnl_opacity;
        $theme->pnl_color = $request->pnl_color;
        $theme->save();

        flash('Successfully updated theme!');

        return redirect()->route('themes.index', encrypt($user->id));
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
        $theme = Theme::find($id)->delete();

        flash('Successfully deleted theme!');

        return redirect()->route('themes.index', encrypt($user->id));
    }

    public function applyTheme($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $theme = Theme::find($id);

        foreach ($user->profileThemes as $themes) {
            $themes->selected = 0;
            $themes->update();
        }

        $theme->selected = 1;
        $theme->update();

        flash('Successfully applied theme!');

        return redirect()->route('themes.index', encrypt($user->id));
    }

    public function updateBgImage(Request $request, $user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $theme = Theme::find($id);

        $this->validate($request, [
            'bg_image' => 'image|mimes:jpeg,jpg,png,gif',
        ]);

        if ($request->hasFile('bg_image')) {
            $fileName = time() . '.' . $request->file('bg_image')->getClientOriginalExtension();
            Image::make($request->file('bg_image'))->save(public_path('img/uploads/' . $fileName));
            $theme->bg_image = 'img/uploads/' . $fileName;
        }

        $theme->update();

        flash('Successfully updated background image!');

        return redirect()->route('themes.index', encrypt($user->id));
    }
}
