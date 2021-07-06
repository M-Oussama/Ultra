<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = Role::all();
        //$roles->first()->revokePermissionTo(1);
        //$roles->first()->givePermissionTo(9);
        return view('dashboard.settings.roles.index')->with('roles',$roles);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.settings.roles.create')
            ->with('permissions',$permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = Role::where('name',$request->input('name'))->get();
        if(count($roles) > 0) {
            session()->flash('type', "warning");
            session()->flash('message', "A role with the same name already exists");
        }else {
            $role = new Role();
            $role->name = $request->input('name');
            $permissions = $request->input('rolePermissions');
            $role->save();
            $role->givePermissionTo($permissions);
            session()->flash('type', 'success');
            session()->flash('message', 'Role created successfully.');
        }
        return redirect('dash/roles');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions()->pluck("id");
        return view('dashboard.settings.roles.edit')
            ->with("role", $role)
            ->with("permissions", $permissions)
            ->with("rolePermissions", $rolePermissions);
    }

    public function update(Request $request,Role $role)
    {
        $roles = Role::where('name',$request->input('name'))->get();

        if(count($roles) > 0 && $role->name != $request->input('name')) {
            session()->flash('type', "warning");
            session()->flash('message', "A role with the same name already exists");

            return redirect('dash/roles');
        }else {
            $role->name = $request->input('name');
            $permissions = $request->input('rolePermissions');
            $role->save();
            $role->syncPermissions($permissions);
            session()->flash('type', 'success');
            session()->flash('message', 'Role updated successfully.');

            return redirect('dash/roles');
        }

    }

    public function destroy($id)
    {
        Role::find($id)->delete();
        session()->flash('type', 'success');
        session()->flash('message', 'Role deleted successfully.');
        return redirect()->back();
    }

    public function deleteMulti(Request $request){
        $ids = $request->input('ids');
        foreach ($ids as $id){
            Role::find($id)->delete();
        }
        session()->flash('type', 'success');
        session()->flash('message', 'Roles deleted successfully.');
        return redirect()->back();
    }

}
