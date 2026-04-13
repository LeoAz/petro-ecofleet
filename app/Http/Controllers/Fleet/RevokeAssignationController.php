<?php

namespace App\Http\Controllers\Fleet;

use App\Enums\Fleet\AssignationStatus;
use App\Enums\Fleet\DriverStatus;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RevokeAssignationController extends Controller
{

    public function __invoke(Request $request, Driver $driver)
    {
        if($driver->status == DriverStatus::Unassign){
            throw ValidationException::withMessages([
                'error' => 'Le Chauffeur n\'est lié à aucun véhicule, Nous ne pouvons pas désaffecter ce chauffeur'
            ]);
        }
        //dd($driver);

        if(!is_null($driver->activeVehicle)){
            $driver->activeVehicle->vehicle->update([
                'has_driver' => false
            ]);

            $driver->activeVehicle->update([
                'cancel_date' => Carbon::now()->toDateString(),
                'status' => AssignationStatus::Revoked
            ]);
        }

        $driver->update([
            'status' => DriverStatus::Unassign
        ]);

        flash()->success("La desaffectation a été affectuée avec succès. Vous pouvez desormais lié ce chauffeur à un autre véhicule");

        return redirect()->back();

    }
}
