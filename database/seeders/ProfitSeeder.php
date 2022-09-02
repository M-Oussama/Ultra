<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProfitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'list-profit',
            'create-profit',
            'edit-profit',
            'delete-profit'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::find(1)->givePermissionTo($permissions);


        $dash_side_menu = Menu::find(1);



        $item = new Menu();
        $item->menu_id = $dash_side_menu->id;
        $item->name = 'Profit';
        $item->url = '#';
        $item->order = 4;
        $item->icon = 'far fa-newspaper';
        $item->isSection = true;
        $item->permissions = 'create-profit';
        $item->save();

        $item_ = new Menu();
        $item_->menu_id = $dash_side_menu->id;
        $item_->name = 'Profit';
        $item_->url = '#';
        $item_->order = 4;
        $item_->icon = 'far fa-newspaper';
        $item_->isSection = false;
        $item_->permissions = 'list-product';
        $item_->save();

        $item_index = new Menu();
        $item_index->menu_id = $item_->id;
        $item_index->name = 'Profit';
        $item_index->url = 'dash/profit';
        $item_index->order = 4;
        $item_index->icon = 'flaticon-layers';
        $item_index->isSection = false;
        $item_index->permissions = 'list-profit';
        $item_index->save();

        $item_create = new Menu();
        $item_create->menu_id = $item_->id;
        $item_create->name = 'Add Monthly Profit';
        $item_create->url = 'dash/profit/create';
        $item_create->order = 4;
        $item_create->icon = 'flaticon-layers';
        $item_create->isSection = false;
        $item_create->permissions = 'create-profit';
        $item_create->save();

        $item_create = new Menu();
        $item_create->menu_id = $item_->id;
        $item_create->name = 'Add Client Monthly Profit';
        $item_create->url = 'dash/profit/client/create';
        $item_create->order = 4;
        $item_create->icon = 'flaticon-layers';
        $item_create->isSection = false;
        $item_create->permissions = 'create-profit';
        $item_create->save();

        $item_edit = new Menu();
        $item_edit->menu_id = $item_->id;
        $item_edit->name = 'Edit Profit';
        $item_edit->url = 'dash/profit/*/edit';
        $item_edit->order = 4;
        $item_edit->icon = 'flaticon-layers';
        $item_edit->isHidden = true;
        $item_edit->permissions = 'edit-profit';
        $item_edit->save();
    }
}
