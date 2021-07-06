<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'list-menu',
            'create-menu',
            'edit-menu',
            'delete-menu',
            'list-backup',
            'create-backup',
            'download-backup',
            'delete-backup',
            'list-console',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::find(1)->givePermissionTo($permissions);

        $dash_side_menu = new Menu();
        $dash_side_menu->name = 'dash_side_menu';
        $dash_side_menu->order = -1;
        $dash_side_menu->save();

        $dashboard = new Menu();
        $dashboard->menu_id = $dash_side_menu->id;
        $dashboard->name = 'Dashboard';
        $dashboard->url = 'dash';
        $dashboard->order = 1;
        $dashboard->icon = 'flaticon-layers';
        $dashboard->isSection = false;
        $dashboard->permissions = 'list-dash';
        $dashboard->save();

        $advanced = new Menu();
        $advanced->menu_id = $dash_side_menu->id;
        $advanced->name = 'Advanced';
        $advanced->url = '#';
        $advanced->order = 90;
        $advanced->icon = 'flaticon-layers';
        $advanced->isSection = true;
        $advanced->permissions = 'list-role list-permission list-menu';
        $advanced->save();

        $roles_permissions = new Menu();
        $roles_permissions->menu_id = $dash_side_menu->id;
        $roles_permissions->name = 'Roles and Permissions';
        $roles_permissions->url = '#';
        $roles_permissions->order = 91;
        $roles_permissions->icon = 'flaticon-list';
        $roles_permissions->permissions = '';
        $roles_permissions->save();

        $roles = new Menu();
        $roles->menu_id = $roles_permissions->id;
        $roles->name = 'Roles';
        $roles->url = 'dash/roles';
        $roles->order = 91;
        $roles->icon = 'flaticon-list';
        $roles->isSection = false;
        $roles->permissions = 'list-role';
        $roles->save();

        $permissions = new Menu();
        $permissions->menu_id = $roles_permissions->id;
        $permissions->name = 'Permissions';
        $permissions->url = 'dash/permissions';
        $permissions->order = 92;
        $permissions->icon = 'flaticon-list';
        $permissions->isSection = false;
        $permissions->permissions = 'list-permission';
        $permissions->save();

        /************** Menus menu :: start ****************/

        $menus = new Menu();
        $menus->menu_id = $dash_side_menu->id;
        $menus->name = 'Menus';
        $menus->url = 'dash/menus';
        $menus->order = 93;
        $menus->icon = 'flaticon2-list-1';
        $menus->isSection = false;
        $menus->permissions = 'list-menu';
        $menus->save();

        $menus_create = new Menu();
        $menus_create->menu_id = $menus->id;
        $menus_create->name = 'Menus';
        $menus_create->url = 'dash/menus/create';
        $menus_create->order = 93;
        $menus_create->icon = 'flaticon-questions-circular-button';
        $menus_create->isSection = false;
        $menus_create->isHidden = true;
        $menus_create->permissions = 'list-menu';
        $menus_create->save();

        $menus_edit = new Menu();
        $menus_edit->menu_id = $menus->id;
        $menus_edit->name = 'Menus';
        $menus_edit->url = 'dash/menus/*/edit';
        $menus_edit->order = 93;
        $menus_edit->icon = 'flaticon-questions-circular-button';
        $menus_edit->isSection = false;
        $menus_edit->isHidden = true;
        $menus_edit->permissions = 'list-menu';
        $menus_edit->save();

        $menus_menuItems_create = new Menu();
        $menus_menuItems_create->menu_id = $menus->id;
        $menus_menuItems_create->name = 'menus.menu-items.create';
        $menus_menuItems_create->url = 'dash/menus/menu-items/*/create';
        $menus_menuItems_create->order = 93;
        $menus_menuItems_create->icon = 'flaticon-questions-circular-button';
        $menus_menuItems_create->isSection = false;
        $menus_menuItems_create->isHidden = true;
        $menus_menuItems_create->permissions = 'list-menu';
        $menus_menuItems_create->save();

        $menus_menuItems_edit = new Menu();
        $menus_menuItems_edit->menu_id = $menus->id;
        $menus_menuItems_edit->name = 'menus.menu-items.edit';
        $menus_menuItems_edit->url = 'dash/menus/menu-items/*/edit/*';
        $menus_menuItems_edit->order = 93;
        $menus_menuItems_edit->icon = 'flaticon-questions-circular-button';
        $menus_menuItems_edit->isSection = false;
        $menus_menuItems_edit->isHidden = true;
        $menus_menuItems_edit->permissions = 'list-menu';
        $menus_menuItems_edit->save();

        $backups = new Menu();
        $backups->menu_id = $dash_side_menu->id;
        $backups->name = 'Backups';
        $backups->url = 'dash/backups';
        $backups->order = 94;
        $backups->icon = 'fas fa-database';
        $backups->isSection = false;
        $backups->permissions = 'list-backup';
        $backups->save();

        $console = new Menu();
        $console->menu_id = $dash_side_menu->id;
        $console->name = 'Developer console';
        $console->url = 'dash/console';
        $console->order = 95;
        $console->icon = 'la la-terminal';
        $console->isSection = false;
        $console->permissions = 'list-console';
        $console->save();

        /************** Menus menu :: end ****************/
    }
}
