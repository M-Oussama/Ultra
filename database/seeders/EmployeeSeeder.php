<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'list-employee',
            'list-attendance',
            'create-employee',
            'edit-employee',
            'delete-employee',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::find(1)->givePermissionTo($permissions);

        $dash_side_menu = Menu::find(1);

        $people_section = Menu::where('name','People')->where('icon','fas fa-users-cog')->get()->first();



        $employee = new Menu();
        $employee->menu_id = $people_section->id;
        $employee->name = 'Employees';
        $employee->url = '#';
        $employee->order = 3;
        $employee->icon = 'far fa-newspaper';
        $employee->isSection = false;
        $employee->permissions = 'create-employee';
        $employee->save();

        $employee_index = new Menu();
        $employee_index->menu_id = $employee->id;
        $employee_index->name = 'Employees';
        $employee_index->url = 'dash/employees';
        $employee_index->order = 3;
        $employee_index->icon = 'flaticon-layers';
        $employee_index->isSection = false;
        $employee_index->permissions = 'list-employee';
        $employee_index->save();

        $employee_index1 = new Menu();
        $employee_index1->menu_id = $employee->id;
        $employee_index1->name = 'Attendance';
        $employee_index1->url = 'dash/attendances';
        $employee_index1->order = 2;
        $employee_index1->icon = 'flaticon-layers';
        $employee_index1->isSection = false;
        $employee_index1->permissions = 'list-attendance';
        $employee_index1->save();

        $employee_create = new Menu();
        $employee_create->menu_id = $employee->id;
        $employee_create->name = 'Add Employees';
        $employee_create->url = 'dash/employees/create';
        $employee_create->order = 3;
        $employee_create->icon = 'flaticon-layers';
        $employee_create->isSection = false;
        $employee_create->permissions = 'create-employee';
        $employee_create->save();

        $employee_edit = new Menu();
        $employee_edit->menu_id = $employee->id;
        $employee_edit->name = 'Edit Employees';
        $employee_edit->url = 'dash/employees/*/edit';
        $employee_edit->order = 3;
        $employee_edit->icon = 'flaticon-layers';
        $employee_edit->isHidden = true;
        $employee_edit->permissions = 'edit-employee';
        $employee_edit->save();
    }
}
