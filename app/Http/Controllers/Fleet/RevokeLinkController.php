<?php

namespace App\Http\Controllers\Fleet;

use App\Enums\Fleet\LinkStatus;
use App\Enums\Fleet\TrailerStatus;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RevokeLinkController extends Controller
{

    public function __invoke(Request $request, Vehicle $vehicle): RedirectResponse
    {
        if( $vehicle->is_linked == false ){
            throw ValidationException::withMessages([
                'error' => 'Le véhicule n\'est lié à aucune remorque, Nous ne pouvons pas désaffecter ce vehicule'
            ]);
        }

        if( !is_null($vehicle->activeTrailer)){
            $vehicle->activeTrailer->trailer->update([
                'is_linked' => false,
                'status' => TrailerStatus::Available
            ]);

            $vehicle->activeTrailer->update([
                'unlink_date' => Carbon::now()->toDateString(),
                'status' => LinkStatus::Revoked
            ]);
        }

        $vehicle->update([
            'is_linked' => false
        ]);

        flash()->success("La desaffectation a été affectuée avec succès. Vous pouvez desormais lié ce véhicule à une autre remorque");

        return redirect()->back();
    }
}
