<?php

namespace App\Http\Controllers\Maintenance\Repair;

use App\Enums\Maintenance\ExitVoucherState;
use App\Enums\Maintenance\ExitVoucherStatus;
use App\Enums\Maintenance\PartState;
use App\Enums\Maintenance\RepairStatus;
use App\Http\Controllers\Controller;
use App\Models\ExitVoucher;
use App\Models\Motif;
use App\Models\Part;
use App\Models\Repair;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use function flash;
use function redirect;
use function view;

class RepairController extends Controller
{
    public function index()
    {
        return view('maintenance.repair.index', [
            'repairs' => Repair::with('vehicle')
                ->get()
                ->sortByDesc('created_at'),
            'motifs' => Motif::pluck('description', 'id'),
            'vehicles' => Vehicle::pluck('registration', 'id'),
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'date' => 'required',
            'motif_id' => 'required',
            'amount' => 'required',
            'vehicle_id' => ['required'],
            'current_mileage' => ['required'],
            'description' => 'nullable',
        ], [
            'date.required' => 'La date de la réparation est obligatoire',
            'vehicle_id.required' => 'Le véhicule est obligatoire',
            'amount.required' => 'Le coût de la réparation est obligatoire',
            'current_mileage.required' => 'Le kilométrage courant est obligatoire',
            'motif_id.required' => 'Le motif de la réparation est obligatoire'
        ]);
        if (!is_null($attributes['date']))
            Arr::set($attributes, 'date', Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString());

        //dd($attributes);
        $repair = new Repair($attributes);
        $repair->save();

        flash()->info("La reparation à été enregistrée avec succés");
        return redirect()->route('maintenance.repair.detail', $repair->uuid);
    }

    public function detail(Repair $repair)
    {
        $parts = Part::orderBy('name')->get();

        return view('maintenance.repair.details', [
            'repair' => $repair,
            'parts' => $parts
        ]);
    }

    public function closed(Request $request, Repair $repair)
    {
        $attribute = $this->validate($request, [
            'status' => 'required'
        ]);

        throw_if( $repair->status === RepairStatus::Closed,
            ValidationException::withMessages([
                'error' => 'La réparation est déja clôturée'])
        );

        $repair->updateOrFail($attribute);

        foreach ( $repair->parts as $part)
        {
            $exit = ExitVoucher::findOrFail($part->exit_voucher_id);
            if ( $exit->state_voucher == ExitVoucherState::Unused)
            {
                $exit->update([
                    'state_voucher' => ExitVoucherState::Used
                ]);
            }
        }

        flash()->success("La réparation a été clôturer avec succès");
        return redirect()->back();
    }

    public function opened(Request $request, Repair $repair)
    {
        $attributes = $this->validate($request, [
            'status' => 'required'
        ]);

        throw_if( $repair->status == RepairStatus::Pending,
            ValidationException::withMessages([
                'error' => 'La réparation est déja ouverte et en cours.'])
        );

        $repair->updateOrFail($attributes);

        flash()->info("La réparation a été reouvert avec succès");
        return redirect()->back();
    }

    public function print(Repair $repair)
    {
        return view('maintenance.repair.__print', [
            'repair' => $repair,
        ]);
    }

    public function delete(Repair $repair)
    {
        //dd($repair->parts->isNotEmpty());
        throw_if( $repair->status == RepairStatus::Closed,
            ValidationException::withMessages([
                'error' => 'La réparation est déja Clôturer, Vous pouvez plus le supprimer.'])
        );

        if($repair->parts->isNotEmpty())
        {
            foreach ($repair->parts as $detail)
            {
                $detail->delete();
            }
        }

        // on supprime le bon de sortie de stock des pieces utilisé
        if ( !is_null($repair->exit)){
            if ( $repair->exit->parts->isNotEmpty()) {
                foreach ($repair->exit->parts as $part) {
                    $part->delete();
                }
            }
            $repair->exit->delete();
        }

        $repair->delete();

        flash()->info("La réparation a été supprimé avec succés");
        return redirect()->back();
    }

}
