<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        if(auth()->user()->hasRole('admin')){
            return redirect()->route('admin.user.index');
        } else{
            return redirect()->route('fleet.vehicle.index');
        }
    }

}
