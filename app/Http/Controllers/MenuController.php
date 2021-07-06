<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menus = Menu::whereNull('menu_id')->get();
        return view('dashboard.settings.menus.index')
            ->with('menus',$menus);
    }

    public function create()
    {
        return view('dashboard.settings.menus.create');
    }

    public function store(Request $request)
    {
        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->url = $request->input('url');
        $menu->order = -1;
        $menu->icon = $request->input('icon');
        $menu->isSection = $request->input('isSection');
        $menu->isHidden = $request->input('isHidden');
        $menu->save();

        session()->flash('type', 'success');
        session()->flash('message', 'menu created successfully.');

        return redirect('dash/menus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     */
    public function edit(Menu $menu)
    {
        return view('dashboard.settings.menus.edit')
            ->with('menu',$menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    public function destroy(Menu $menu)
    {
        $this->delete_menu_recursive($menu);

        session()->flash('type', 'success');
        session()->flash('message', 'menu deleted successfully.');

        return redirect('dash/menus/');
    }

    // delete the menu and its children
    public function delete_menu_recursive(Menu $menu)
    {
        if ($menu->childrenAll()->count() == 0){
            $menu->delete();
        } else {
            foreach ($menu->childrenAll() as $child){
                $this->delete_menu_recursive($child);
            }
            $menu->delete();
        }
    }
}
