<?php

namespace Database\Seeders;

use App\Models\AccountType;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'list-type',
            'create-type',
            'edit-type',
            'delete-type'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::find(1)->givePermissionTo($permissions);

        $dash_side_menu = Menu::find(1);

        $people_section = new Menu();
        $people_section->menu_id = $dash_side_menu->id;
        $people_section->name = 'Types';
        $people_section->url = '#';
        $people_section->order = 3;
        $people_section->icon = 'flaticon-layers';
        $people_section->isSection = true;
        $people_section->permissions = 'list-type';
        $people_section->save();

        $product = new Menu();
        $product->menu_id = $dash_side_menu->id;
        $product->name = 'Types';
        $product->url = '#';
        $product->order = 3;
        $product->icon = 'far fa-newspaper';
        $product->isSection = false;
        $product->permissions = 'create-type';
        $product->save();

        $product_index = new Menu();
        $product_index->menu_id = $product->id;
        $product_index->name = 'Types';
        $product_index->url = 'dash/types';
        $product_index->order = 3;
        $product_index->icon = 'flaticon-layers';
        $product_index->isSection = false;
        $product_index->permissions = 'list-type';
        $product_index->save();

        $product_create = new Menu();
        $product_create->menu_id = $product->id;
        $product_create->name = 'Add Types';
        $product_create->url = 'dash/types/create';
        $product_create->order = 2;
        $product_create->icon = 'flaticon-layers';
        $product_create->isSection = false;
        $product_create->permissions = 'create-type';
        $product_create->save();

        $product_edit = new Menu();
        $product_edit->menu_id = $product->id;
        $product_edit->name = 'Edit Types';
        $product_edit->url = 'dash/types/*/edit';
        $product_edit->order = 3;
        $product_edit->icon = 'flaticon-layers';
        $product_edit->isHidden = true;
        $product_edit->permissions = 'edit-type';
        $product_edit->save();
        //
        $types[3] = ["matiére premiere","Production","Emballage"];
        $types_codes[3] = ["MP","PR","EM"];


            $account_type = new AccountType();
            $account_type->name = "matiére premiere";
            $account_type->code = "MP";
            $account_type->save();

            $account_type = new AccountType();
            $account_type->name = "Production";
            $account_type->code = "PR";
            $account_type->save();

            $account_type = new AccountType();
            $account_type->name = "Emballage";
            $account_type->code = "EM";
            $account_type->save();


    }
}
