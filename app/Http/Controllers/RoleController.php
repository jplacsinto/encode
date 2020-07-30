<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->get('search', null);

        $col = $request->get('col', 'id');

        $sort = $request->get('sort', 'desc');

        $rows = $request->get('rows', 10);

        $roles = new Role;

        if(!is_null($search)){
            $roles = $roles->where("name", "LIKE", "%{$search}%");
        }

        $roles = $roles->orderBy($col, $sort)->paginate($rows);

        return view('modules.roles.index')->with('roles', $roles);
    }

    public function create()
    {
        return view('modules.roles.create');
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());

        return redirect()->route('roles.index')->with('message', 'New role created');
    }

    public function edit(Role $role)
    {

        return view('modules.roles.edit')->with('role', $role);

        return response()->json($role);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());

        return redirect()->back()->with('success', true);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->back()->with('message', 'Role successfully deleted');
    }
}