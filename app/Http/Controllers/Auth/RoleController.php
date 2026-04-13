<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('auth.role.index', [
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required',
        ]);

        //dd($request->get('permissions'));

        $role = new Role($attributes);
        $role->guard_name = 'web';

        $role->save();

        if ($request->has('permissions'))
            $role->givePermissionTo($request->get('permissions'));

        flash()->success("Le rôle a été créer avec succés");
        return redirect()->back();
    }

    public function edit(Role $role)
    {
        return response()->json($role);
    }

    public function update(Request $request, Role $role)
    {
        $attributes = $this->validate($request, [
            'name' => 'required',
        ]);

        //dd($request->get('permissions'));
        $role->update($attributes);

        if ($request->has('permissions'))
            $role->syncPermissions($request->get('permissions'));

        flash()->success("Le rôle a été mise à jour avec succés");
        return redirect()->back();
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back();
    }
}
