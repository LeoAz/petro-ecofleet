<?php

namespace App\Http\Controllers\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserUpdatePasswordController extends Controller
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
        $attributes = $this->validate($request, [
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);
        Arr::set($attributes, 'password', bcrypt($attributes['password']));
        $user->update($attributes);
        return redirect()->back();
    }
}
