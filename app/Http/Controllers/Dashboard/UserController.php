<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;
use App\Permission;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:super-admin']);
    }
    
    public function index()
    {
        $users = User::with(['roles','permissions'])->get();

        return view('dashboard.user.index',[
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::get();

        return view('dashboard.user.create',[
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->roles()->attach($request->roles);
        $user->permissions()->attach($request->permissions);

        return redirect()->route('user.index')->with('success','Thanks, Post has been saved!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        $permissions = Permission::get();

        return view('dashboard.user.edit',[
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);

        $user->update($data);

        $user->roles()->sync($request->roles);
        $user->permissions()->sync($request->permissions);

        return redirect()->route('user.index')->with('success','Thanks, Data has been updated!');
    }

    public function destroy($id)
    {
        return redirect()->route('user.index')->with('success','Thanks, Data has been deleted!');
    }
}
