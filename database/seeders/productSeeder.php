<?php

namespace Database\Seeders;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'list-product',
            'create-product',
            'edit-product',
            'delete-product'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::find(1)->givePermissionTo($permissions);

        $dash_side_menu = Menu::find(1);

        $people_section = new Menu();
        $people_section->menu_id = $dash_side_menu->id;
        $people_section->name = 'Product';
        $people_section->url = '#';
        $people_section->order = 3;
        $people_section->icon = 'flaticon-layers';
        $people_section->isSection = true;
        $people_section->permissions = 'list-product';
        $people_section->save();

        $product = new Menu();
        $product->menu_id = $dash_side_menu->id;
        $product->name = 'Products';
        $product->url = '#';
        $product->order = 3;
        $product->icon = 'far fa-newspaper';
        $product->isSection = false;
        $product->permissions = 'list-product';
        $product->save();

        $product_index = new Menu();
        $product_index->menu_id = $product->id;
        $product_index->name = 'Products';
        $product_index->url = 'dash/products';
        $product_index->order = 3;
        $product_index->icon = 'flaticon-layers';
        $product_index->isSection = false;
        $product_index->permissions = 'list-product';
        $product_index->save();

        $product_create = new Menu();
        $product_create->menu_id = $product->id;
        $product_create->name = 'Add Product';
        $product_create->url = 'dash/products/create';
        $product_create->order = 2;
        $product_create->icon = 'flaticon-layers';
        $product_create->isSection = false;
        $product_create->permissions = 'create-product';
        $product_create->save();

        $product_edit = new Menu();
        $product_edit->menu_id = $product->id;
        $product_edit->name = 'Edit product';
        $product_edit->url = 'dash/products/*/edit';
        $product_edit->order = 3;
        $product_edit->icon = 'flaticon-layers';
        $product_edit->isHidden = true;
        $product_edit->permissions = 'edit-product';
        $product_edit->save();

    }
}
