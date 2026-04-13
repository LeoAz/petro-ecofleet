<?php

namespace App\Http\Controllers\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StatusUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, User $user)
    {
        $user->update($this->validate($request, [
            'status' => 'required',
        ]));
        return redirect()->back();
    }
}
