<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PeopleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'list-user',
            'create-user',
            'edit-user',
            'delete-user'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::find(1)->givePermissionTo($permissions);

        $dash_side_menu = Menu::find(1);

        $people_section = new Menu();
        $people_section->menu_id = $dash_side_menu->id;
        $people_section->name = 'People';
        $people_section->url = '#';
        $people_section->order = 2;
        $people_section->icon = 'flaticon-layers';
        $people_section->isSection = true;
        $people_section->permissions = 'list-user';
        $people_section->save();

        $people_menu = new Menu();
        $people_menu->menu_id = $dash_side_menu->id;
        $people_menu->name = 'People';
        $people_menu->url = '#';
        $people_menu->order = 2;
        $people_menu->icon = 'fas fa-users-cog';
        $people_menu->isSection = false;
        $people_menu->permissions = 'list-user';
        $people_menu->save();

        $users = new Menu();
        $users->menu_id = $people_menu->id;
        $users->name = 'Users';
        $users->url = '#';
        $users->order = 2;
        $users->icon = 'flaticon-layers';
        $users->isSection = false;
        $users->permissions = 'list-user';
        $users->save();

        $users_index = new Menu();
        $users_index->menu_id = $users->id;
        $users_index->name = 'Users';
        $users_index->url = 'dash/users';
        $users_index->order = 2;
        $users_index->icon = 'flaticon-layers';
        $users_index->isSection = false;
        $users_index->permissions = 'list-user';
        $users_index->save();

        $users_create = new Menu();
        $users_create->menu_id = $users->id;
        $users_create->name = 'Add user';
        $users_create->url = 'dash/users/create';
        $users_create->order = 2;
        $users_create->icon = 'flaticon-layers';
        $users_create->isSection = false;
        $users_create->permissions = 'create-user';
        $users_create->save();

        $users_edit = new Menu();
        $users_edit->menu_id = $users_index->id;
        $users_edit->name = 'Edit user';
        $users_edit->url = 'dash/users/*/edit';
        $users_edit->order = 2;
        $users_edit->icon = 'flaticon-layers';
        $users_edit->isHidden = true;
        $users_edit->permissions = 'edit-user';
        $users_edit->save();
    }
}
