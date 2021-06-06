<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:super-admin']);
    }
    
    public function index()
    {
        $roles = Role::get();

        return view('dashboard.role.index',[
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('dashboard.role.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => ['required', 'string', 'max:255','min:3','regex:/(^[A-Za-z0-9 ]+$)+/'],
        ]);

        $data ['slug'] = Str::slug($request->name);

        Role::create($data);

        return redirect()->route('role.index')->with('success','Thanks, Role has been saved!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return view('dashboard.role.edit',[
            'role' => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $role = Role::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255','min:3','regex:/(^[A-Za-z0-9 ]+$)+/'],
        ]);

        $data ['slug'] = Str::slug($request->name);

        $role->update($data);

        return redirect()->route('role.index')->with('success','Thanks, Role has been updated!');
    }

    public function destroy($id)
    {
        return redirect()->route('role.index')->with('success','Thanks, Data has been deleted!');
    }
}
