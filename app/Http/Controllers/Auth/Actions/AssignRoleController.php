<?php

namespace App\Http\Controllers\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AssignRoleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, User $user)
    {
        //dd($request->get('roles'));
        $user->assignRole($request->get('roles'));
        return redirect()->back();
    }
}
