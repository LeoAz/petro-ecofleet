<?php

namespace App\Http\Controllers\Fleet;

use App\Enums\Fleet\LinkStatus;
use App\Enums\Fleet\TrailerStatus;
use App\Enums\Fleet\VehicleStatus;
use App\Enums\Fleet\VehicleType;
use App\Http\Controllers\Controller;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LinkController extends Controller
{
    public function index()
    {
        return view('fleet.link.index', [
            'links' => Link::with([
                'trailer',
                'vehicle'
            ])->get()
        ]);
    }
    public function store(Request $request)
    {
        //dd('here');
        $attributes = $this->validate($request, [
            'uuid' => ['nullable'],
            'vehicle_id' => ['required'],
            'trailer_id' => ['required'],
            'link_date' => ['nullable'],
            'unlink_date' => ['nullable'],
            'status' => ['nullable'],
        ]);

        if (!is_null($attributes['link_date']))
            Arr::set($attributes, 'link_date', Carbon::createFromFormat('d/m/Y', $attributes['link_date'])->toDateString());

        Arr::set($attributes,'uuid', Str::uuid()->toString());
        Arr::set($attributes, 'status', LinkStatus::Active);

        $link = new Link($attributes);

        if($link->vehicle->status == VehicleStatus::Garage){
            throw ValidationException::withMessages([
                'error' => 'Le véhicule sur lequel vous voulez affécter la remorque est au garage. Nous ne pouvons pas affecter pour le moment la remorque'
            ]);
        }

        if($link->vehicle->status == VehicleStatus::Reform){
            throw ValidationException::withMessages([
                'error' => 'Le véhicule sur lequel vous voulez affécter la remorque est en reforme. Nous ne pouvons pas affecter pour le moment la remorque'
            ]);
        }

        if($link->vehicle->type != VehicleType::Tracteur){
            throw ValidationException::withMessages([
                'error' => 'Le véhicule sur lequel vous voulez affécter la remorque n\' est pas un tracteur. Seul les tracteurs peuvent etre lié aux remorques'
            ]);
        }

        if($link->vehicle->is_linked == true){
            throw ValidationException::withMessages([
                'error' => 'Le véhicule sur lequel vous voulez affécter la remorque est déja attélé à une remorque. Pour lié une nouvelle remorque merci de désaffecter l\' ancienne remorque'
            ]);
        }

        $link->vehicle->update([
            'is_linked' => true
        ]);

        $link->trailer->update([
            'is_linked' => true,
            'Status' => TrailerStatus::Linked
        ]);

        $link->save();

        flash()->success("L'affectation a été effectuée avec succès");
        return redirect()->back();
    }

    public function edit(Link $link)
    {
        return response()->json($link);
    }

    public function delete(Link $link)
    {
        $link->vehicle->update([
            'is_linked' => false
        ]);

        $link->trailer->update([
            'status' => TrailerStatus::Available,
            'is_linked' => false
        ]);

        $link->delete();

        flash()->success("L'affectation a été supprimée avec succés");
        return redirect()->back();
    }
}
