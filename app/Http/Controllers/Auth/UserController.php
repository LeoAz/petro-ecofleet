<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Compagny;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.user.index', [
            'users' => User::with('roles', 'permissions')->get()->sortByDesc('created_at'),
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request,
            [
                'name'           => 'required|min:4',
                'pseudo'         => 'required|min:4',
                'email'          => 'required|unique:users,email',
                'jobtitle' => 'nullable',
                'password'       => 'required|min:5',
            ]
        );
        Arr::set($attributes, 'password', bcrypt($attributes['password']));
        $user = new User($attributes);
        $user->save();

        if ($request->has('roles') and !empty($request->get('roles')))
        {
            $user->assignRole($request->get('roles'));
            $user->save();
        }
        flash()->success("L'utiisateur a été créer avec succés");
        return redirect()->back();
    }


    public function setting(User $user)
    {
        return view('auth.user.setting', [
            'user' => $user,
            'roles' => Role::all(),
            'status' => UserStatus::asSelectArray()
        ]);
    }

    public function show(User $user)
    {
        return view('auth.user.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('auth.user.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $attributes = $this->validate($request,
            [
                'name'      => 'required|min:4',
                'pseudo'    => 'nullable',
                'jobtitle'    => 'nullable',
                'email'     => 'nullable',
                'password'  => 'nullable|min:5',
            ]
        );

        // do not update empty password
        if(empty($attributes['password']))
            Arr::forget($attributes, 'password');

        if ($request->has('roles') and !empty($request->get('roles')))
            $user->syncRoles($request->get('roles'));

        $user->update($attributes);

        flash()->success("L'utiisateur a été mise jour créer avec succés");
        return redirect()->route('admin.user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
