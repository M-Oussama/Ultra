<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'list-client',
            'create-client',
            'edit-client',
            'delete-client'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::find(1)->givePermissionTo($permissions);

        $dash_side_menu = Menu::find(1);

        $people_section = Menu::where('name','People')->where('icon','fas fa-users-cog')->get()->first();



        $client = new Menu();
        $client->menu_id = $people_section->id;
        $client->name = 'Clients';
        $client->url = '#';
        $client->order = 3;
        $client->icon = 'far fa-newspaper';
        $client->isSection = false;
        $client->permissions = 'create-client';
        $client->save();

        $client_index = new Menu();
        $client_index->menu_id = $client->id;
        $client_index->name = 'Clients';
        $client_index->url = 'dash/clients';
        $client_index->order = 3;
        $client_index->icon = 'flaticon-layers';
        $client_index->isSection = false;
        $client_index->permissions = 'list-client';
        $client_index->save();

        $client_create = new Menu();
        $client_create->menu_id = $client->id;
        $client_create->name = 'Add Clients';
        $client_create->url = 'dash/clients/create';
        $client_create->order = 2;
        $client_create->icon = 'flaticon-layers';
        $client_create->isSection = false;
        $client_create->permissions = 'create-client';
        $client_create->save();

        $client_edit = new Menu();
        $client_edit->menu_id = $client->id;
        $client_edit->name = 'Edit Clients';
        $client_edit->url = 'dash/clients/*/edit';
        $client_edit->order = 3;
        $client_edit->icon = 'flaticon-layers';
        $client_edit->isHidden = true;
        $client_edit->permissions = 'edit-client';
        $client_edit->save();
    }
}
