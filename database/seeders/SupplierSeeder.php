<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'list-supplier',
            'create-supplier',
            'edit-supplier',
            'delete-supplier'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::find(1)->givePermissionTo($permissions);


        $people_section = Menu::where('name','People')->where('icon','fas fa-users-cog')->get()->first();



        $supplier = new Menu();
        $supplier->menu_id = $people_section->id;
        $supplier->name = 'Suppliers';
        $supplier->url = '#';
        $supplier->order = 3;
        $supplier->icon = 'far fa-newspaper';
        $supplier->isSection = false;
        $supplier->permissions = 'create-supplier';
        $supplier->save();

        $supplier_index = new Menu();
        $supplier_index->menu_id = $supplier->id;
        $supplier_index->name = 'Suppliers';
        $supplier_index->url = 'dash/suppliers';
        $supplier_index->order = 3;
        $supplier_index->icon = 'flaticon-layers';
        $supplier_index->isSection = false;
        $supplier_index->permissions = 'list-supplier';
        $supplier_index->save();

        $supplier_create = new Menu();
        $supplier_create->menu_id = $supplier->id;
        $supplier_create->name = 'Add Supplier';
        $supplier_create->url = 'dash/suppliers/create';
        $supplier_create->order = 2;
        $supplier_create->icon = 'flaticon-layers';
        $supplier_create->isSection = false;
        $supplier_create->permissions = 'create-supplier';
        $supplier_create->save();

        $supplier_edit = new Menu();
        $supplier_edit->menu_id = $supplier->id;
        $supplier_edit->name = 'Edit Supplier';
        $supplier_edit->url = 'dash/suppliers/*/edit';
        $supplier_edit->order = 3;
        $supplier_edit->icon = 'flaticon-layers';
        $supplier_edit->isHidden = true;
        $supplier_edit->permissions = 'edit-supplier';
        $supplier_edit->save();
    }
}
