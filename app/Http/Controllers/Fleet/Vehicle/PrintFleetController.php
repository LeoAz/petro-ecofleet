<?php

namespace App\Http\Controllers\Fleet\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class PrintFleetController extends Controller
{
    public function __invoke()
    {
        return view('fleet.vehicle.printable', [
            'vehicles' => Vehicle::with([
                'brand',
                'pattern',
                'activeTrailer',
                //'trailers',
                'documents',
                'drivers',
                'activeDriver'
            ])->where('is_tier', false)
                ->get()
        ]);
    }
}
