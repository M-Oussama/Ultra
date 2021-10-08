<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CommandMPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $permissions = [
            'list-commandMP',
            'create-commandMP',
            'edit-commandMP',
            'delete-commandMP'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::find(1)->givePermissionTo($permissions);

        $dash_side_menu = Menu::find(1);

        $people_section = new Menu();
        $people_section->menu_id = $dash_side_menu->id;
        $people_section->name = 'CommandsMP';
        $people_section->url = '#';
        $people_section->order = 3;
        $people_section->icon = 'flaticon-layers';
        $people_section->isSection = true;
        $people_section->permissions = 'list-commandMP';
        $people_section->save();

        $product = new Menu();
        $product->menu_id = $dash_side_menu->id;
        $product->name = 'Commands MP';
        $product->url = '#';
        $product->order = 3;
        $product->icon = 'far fa-newspaper';
        $product->isSection = false;
        $product->permissions = 'list-product';
        $product->save();

        $product_index = new Menu();
        $product_index->menu_id = $product->id;
        $product_index->name = 'Commands MP';
        $product_index->url = 'dash/commandsMP';
        $product_index->order = 3;
        $product_index->icon = 'flaticon-layers';
        $product_index->isSection = false;
        $product_index->permissions = 'list-commandMP';
        $product_index->save();

        $product_create = new Menu();
        $product_create->menu_id = $product->id;
        $product_create->name = 'Add Commands MP';
        $product_create->url = 'dash/commandsMP/create';
        $product_create->order = 2;
        $product_create->icon = 'flaticon-layers';
        $product_create->isSection = false;
        $product_create->permissions = 'create-commandMP';
        $product_create->save();

        $product_edit = new Menu();
        $product_edit->menu_id = $product->id;
        $product_edit->name = 'Edit Commands MP';
        $product_edit->url = 'dash/commandsMP/*/edit';
        $product_edit->order = 3;
        $product_edit->icon = 'flaticon-layers';
        $product_edit->isHidden = true;
        $product_edit->permissions = 'edit-commandMP';
        $product_edit->save();

    }

}
