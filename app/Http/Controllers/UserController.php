<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use PDF;

class UserController extends Controller
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

    public function index()
    {
        $users = User::with(['roles','address'])->get();
        return view('dashboard.people.users.index')->with('users',$users);
    }

    public function create()
    {
        $roles = Role::where('name','!=','Admin')->get();

        return view('dashboard.people.users.create')->with('roles',$roles);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password2' => function ($attribute, $value, $fail) use ($request) {
                if ($value != $request->input('password')) {
                    $fail('The repeated password does not match the first password.');
                }
            },
        ]);

        if ($validator->fails()) {
            session()->flash('type', "error");
            session()->flash('message', "Please verify your form");
            return redirect('dash/users/create')
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::find($request->param);
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->birthdate = $request->birthdate;
        $user->email = $request->email;
        $user->syncRoles($role);
        $user->password = Hash::make($request->password);
        $user->save();

        if (!empty($request->avatar)) {
            $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatars');
        }

        session()->flash('type', 'success');
        session()->flash('message', 'User created successfully.');

        return redirect('dash/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::where('name','!=','Admin')->get();

        return view('dashboard.people.users.edit')
            ->with('user',$user)
            ->with('roles',$roles);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password2' => function ($attribute, $value, $fail) use ($request) {
                if ($value != $request->input('password')) {
                    $fail('The repeated password does not match the first password.');
                }
            },
        ]);

        if ($validator->fails()) {
            session()->flash('type', "error");
            session()->flash('message', "Please verify your form");
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $users = User::where('email', $request->input('email'))->get();

        if (count($users) > 0 && $user->email != $request->email) {
            session()->flash('type', "warning");
            session()->flash('message', "A user with the same email already exists");

            return redirect('dash/users');
        } else {
            $role = Role::find($request->param);
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->birthdate = $request->birthdate;
            $user->syncRoles($role);
            $user->password = Hash::make($request->password);
            $user->save();

            if (!empty($request->avatar)) {
                if (!empty($user->getFirstMedia('avatars'))) {
                    $user->getFirstMedia('avatars')->delete();
                }
                $user->addMediaFromRequest('avatar')
                    ->toMediaCollection('avatars');
            }

            if (!empty($request->avatar_remove)){
                $user->getFirstMedia('avatars')->delete();
            }

            session()->flash('type', 'success');
            session()->flash('message', 'User updated successfully.');

            return redirect('dash/users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('type', 'success');
        session()->flash('message', 'User deleted successfully.');
        return redirect()->back();
    }

    public function deleteMulti(Request $request){
        $ids = $request->input('ids');
        foreach ($ids as $id){
            User::find($id)->delete();
        }
        session()->flash('type', 'success');
        session()->flash('message', 'Users deleted successfully.');
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users-'.Carbon::now()->toDateString().'.xlsx');
    }

    public function generatePdf(User $user){
        $data = [
            'user' => $user,
        ];
        $pdf = PDF::loadView('dashboard.people.users.pdf.pdf', $data);
        return $pdf->download($user->name.' '.$user->surname.' file.pdf');
    }

    public function getChangePassword(){
        return view('dashboard.people.users.change_password');
    }
    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password'          => 'required',
            'password'              => 'required',
            'password2' =>  function ($attribute, $value, $fail) use ($request) {
                if ($value != $request->input('password')) {
                    $fail('The repeated password does not match the first password.');
                }
            }
        ]);

        if ($validator->fails()) {
            session()->flash('type', "error");
            session()->flash('message', "Please verify your form");
            return redirect('dash/change_password')
                ->withErrors($validator)
                ->withInput();
        }
        $user = Auth::user();
        if (Hash::check($request->old_password,$user->password )) {
            //add logic here
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('type', 'success');
            session()->flash('message', 'Password updated successfully.');
            return redirect()->back();
        }else{
            session()->flash('type', "error");
            session()->flash('message',"The Old Password is Wrong");
            return redirect('dash/change_password')
                ->withErrors($validator)
                ->withInput();
        }


    }
}
