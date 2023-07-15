<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'list-sale',
            'list-pos',
            'create-sale',
            'edit-sale',
            'delete-sale',
            'list-stock',

        ];

        foreach ($permissions as $permission) {
            if(!Permission::where('name',$permission)->exists())
                    Permission::create(['name' => $permission]);
        }
        Role::find(1)->givePermissionTo($permissions);

        $dash_side_menu = Menu::find(1);

        $people_section = new Menu();
        $people_section->menu_id = $dash_side_menu->id;
        $people_section->name = 'POS SYSTEM';
        $people_section->url = '#';
        $people_section->order = 2;
        $people_section->icon = 'flaticon-layers';
        $people_section->isSection = true;
        $people_section->permissions = 'list-pos';
        $people_section->save();

        $people_menu = new Menu();
        $people_menu->menu_id = $dash_side_menu->id;
        $people_menu->name = 'POS SYSTEM';
        $people_menu->url = '#';
        $people_menu->order = 2;
        $people_menu->icon = 'fas fa-cash-register';
        $people_menu->isSection = false;
        $people_menu->permissions = 'list-pos';
        $people_menu->save();

        $users = new Menu();
        $users->menu_id = $people_menu->id;
        $users->name = 'Sales';
        $users->url = '#';
        $users->order = 2;
        $users->icon = 'flaticon-layers';
        $users->isSection = false;
        $users->permissions = 'list-sale';
        $users->save();

        $users_index = new Menu();
        $users_index->menu_id = $users->id;
        $users_index->name = 'Sales';
        $users_index->url = 'dash/sales';
        $users_index->order = 2;
        $users_index->icon = 'flaticon-layers';
        $users_index->isSection = false;
        $users_index->permissions = 'list-sale';
        $users_index->save();

        $users_create = new Menu();
        $users_create->menu_id = $users->id;
        $users_create->name = 'Add Sale';
        $users_create->url = 'dash/sales/create';
        $users_create->order = 2;
        $users_create->icon = 'flaticon-layers';
        $users_create->isSection = false;
        $users_create->permissions = 'create-sale';
        $users_create->save();






    }
}
