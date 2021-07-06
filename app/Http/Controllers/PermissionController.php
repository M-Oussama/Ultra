<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
        $permissions = Permission::all();
        return view('dashboard.settings.permissions.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $base = $request->input('basePermission');
        if ($base == 'true') {
            $permission_name = $request->input('name');
            $base_perm = ['list-','create-','edit-','delete-'];
            session()->flash('type', "warning");
            session()->flash('message', "A permission with the same name already exists");

           foreach ($base_perm as $perm){
               $this->store_permissions($perm,$permission_name);
           }

        } else {
            $permissions = Permission::where('name',$request->input('name'))->get();
            if(count($permissions) > 0) {
                session()->flash('type', "warning");
                session()->flash('message', "A permission with the same name already exists");
            }else {
                $permission = new Permission();
                $permission->name = $request->input('name');
                $permission->save();
                session()->flash('type', 'success');
                session()->flash('message', 'Permission created successfully.');
            }
        }
        return redirect()->back();
    }

    /**** Avoid code repetition *****/

   public function store_permissions($string,$permission_name){
       $permissions = Permission::where('name',$string.$permission_name)->get();
       if(!count($permissions) > 0) {
           $permission = new Permission();
           $permission->name = $string.$permission_name;
           $permission->save();
           session()->flash('type', 'success');
           session()->flash('message', 'Permissions created successfully.');
       }
   }



    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request,Permission $permission)
    {
        $permissions = Permission::where('name',$request->input('name'))->get();


        if ($permission->name == $request->input('name')) {
            session()->flash('type', "warning");
            session()->flash('message', "You haven't changed the name");
        } else if (count($permissions) > 0) {
            session()->flash('type', "warning");
            session()->flash('message', "A permission with the same name already exists");
        } else {
            $permission->name = $request->input('name');
            $permission->save();
            session()->flash('type', 'success');
            session()->flash('message', 'Permission updated successfully.');
        }

        return redirect()->back();
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('type', 'success');
        session()->flash('message', 'Permission deleted successfully.');
        return redirect()->back();
    }

    public function deleteMulti(Request $request){

        $ids = $request->input('ids');
        foreach ($ids as $id){
            Permission::find($id)->delete();
        }
        session()->flash('type', 'success');
        session()->flash('message', 'Permissions deleted successfully.');
        return redirect()->back();
    }
}
