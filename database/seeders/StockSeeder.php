<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $permissions = [
            'list-stock',
            'export-stock',
            'filter-stock'

        ];

        foreach ($permissions as $permission) {
            if(!Permission::where('name',$permission)->exists())
                Permission::create(['name' => $permission]);
        }
        Role::find(1)->givePermissionTo($permissions);

        $menu = Menu::where('name','POS SYSTEM')->where('icon','fas fa-cash-register')->get()->first();

        $stock = new Menu();
        $stock->menu_id = $menu->id;
        $stock->name = 'Stock';
        $stock->url = '#';
        $stock->order = 4;
        $stock->icon = 'flaticon-layers';
        $stock->isSection = false;
        $stock->permissions = 'list-stock';
        $stock->save();

        $stock_index = new Menu();
        $stock_index->menu_id = $stock->id;
        $stock_index->name = 'Stock';
        $stock_index->url = 'dash/stock';
        $stock_index->order = 4;
        $stock_index->icon = 'flaticon-layers';
        $stock_index->isSection = false;
        $stock_index->permissions = 'list-sale';
        $stock_index->save();

//        $stock_create = new Menu();
//        $stock_create->menu_id = $users->id;
//        $stock_create->name = 'Add Sale';
//        $stock_create->url = 'dash/sales/create';
//        $stock_create->order = 2;
//        $stock_create->icon = 'flaticon-layers';
//        $stock_create->isSection = false;
//        $stock_create->permissions = 'create-sale';
//        $stock_create->save();
    }
}
