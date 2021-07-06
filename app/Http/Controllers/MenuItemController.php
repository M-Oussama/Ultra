<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuItemController extends Controller
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

    // show the create form
    public function create(Menu $menu)
    {
        return view('dashboard.settings.menus.menu-items.create')
            ->with('menu',$menu);
    }

    // create and store the menu-item
    public function store(Request $request,Menu $menu)
    {
        $menu_item = new Menu();
        $menu_item->menu_id = $menu->id;
        $menu_item->name = $request->input('name');
        $menu_item->url = $request->input('url');
        $menu_item->order = $request->input('order');
        $menu_item->icon = $request->input('icon');
        $menu_item->isSection = $request->input('isSection');
        $menu_item->isHidden = $request->input('isHidden');
        $menu_item->permissions = $request->input('permissions');
        $menu_item->save();

        session()->flash('type', 'success');
        session()->flash('message', 'menu created successfully.');

        return redirect('dash/menus/'.$menu->id.'/edit');
    }

    // update the menu's menu-items
    public function update_menu(Request $request,Menu $menu)
    {
        foreach ($request->input("menu_items") as $menu_item) {
            $current_menu_item = Menu::find($menu_item['id']);
            $current_menu_item->order = $menu_item['order'];
            if (!empty($menu_item['parentId'])){
                $current_menu_item->menu_id = $menu_item['parentId'];
            } else {
                $current_menu_item->menu_id = $menu->id;
            }
            $current_menu_item->save();
        }

        session()->flash('type', 'success');
        session()->flash('message', 'Menu saved successfully.');

        return response()->json([
            "type"=>"success",
            "message"=>"menu created successfully"
        ]);
    }

    // show the edit form
    public function edit(Menu $menu, Menu $menu_item)
    {
        return view('dashboard.settings.menus.menu-items.edit')
            ->with('menu',$menu)
            ->with('menu_item',$menu_item);
    }

    // update the menu's menu-items
    public function update_menuItem(Request $request, Menu $menu, Menu $menu_item)
    {
        $menu_item->menu_id = $menu->id;
        $menu_item->name = $request->input('name');
        $menu_item->url = $request->input('url');
        $menu_item->order = $request->input('order');
        $menu_item->icon = $request->input('icon');
        $menu_item->isSection = $request->input('isSection');
        $menu_item->isHidden = $request->input('isHidden');
        $menu_item->permissions = $request->input('permissions');
        $menu_item->save();

        session()->flash('type', 'success');
        session()->flash('message', 'Menu updated successfully.');

        return redirect('dash/menus/'.$menu->id.'/edit');
    }

    // delete the menu's menu-items
    public function delete_menuItem(Menu $menu, Menu $menu_item)
    {
        $this->delete_menuItem_recursive($menu_item);

        session()->flash('type', 'success');
        session()->flash('message', 'Menu deleted successfully.');

        return redirect('dash/menus/'.$menu->id.'/edit');
    }

    // delete the menu's menu-items and their children
    public function delete_menuItem_recursive(Menu $menu)
    {
        if ($menu->childrenAll()->count() == 0){
            $menu->delete();
        } else {
            foreach ($menu->childrenAll() as $child){
                $this->delete_menuItem_recursive($child);
            }
            $menu->delete();
        }
    }

}
