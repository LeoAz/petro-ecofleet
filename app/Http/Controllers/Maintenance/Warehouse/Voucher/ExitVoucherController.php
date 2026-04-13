<?php

namespace App\Http\Controllers\Maintenance\Warehouse\Voucher;

use App\Enums\Maintenance\ExitVoucherStatus;
use App\Http\Controllers\Controller;
use App\Models\ExitVoucher;
use App\Models\Part;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class ExitVoucherController extends Controller
{
    public function index()
    {
        return view('maintenance.warehouse.voucher.exitVoucher.index', [
            'exits' => ExitVoucher::all()->sortByDesc('created_at'),
            'vehicles' => Vehicle::pluck('registration', 'id')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'date' => 'required',
            'vehicle_id' => 'required',
            'observation' => 'nullable',
        ], [
            'date.required' => 'La date du bon de sortie est obligatoire',
            'vehicle_id.required' => 'Le vehicle du bon de sortie est obligatoire',
        ]);

        if (!is_null($attributes['date']))
            Arr::set($attributes, 'date', Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString());

        $exit = new ExitVoucher($attributes);
        $exit->save();

        flash()->info("Un bon de sortie vierge à été créer avec succés, Merci de rajouter les pièces de rechange sur le bon");
        return redirect()->route('maintenance.warehouse.exit.detail', $exit->uuid);
    }

    public function detail(ExitVoucher $exit)
    {
        //dd($purchase);
        return view('maintenance.warehouse.voucher.exitVoucher.details', [
            'exit' => $exit,
            'parts' => Part::all()
        ]);
    }

    public function validated(Request $request, ExitVoucher $exit)
    {
        $attribute = $this->validate($request, [
            'status_exit' => 'required'
        ]);

        throw_if( $exit->status_exit === ExitVoucherStatus::Validated,
            ValidationException::withMessages([
                'error' => 'Le bon de sortie est déja validé'])
        );
        $exit->updateOrFail($attribute);

        //On met a jour le stock
        foreach ($exit->parts as $detail)
        {
            $part = Part::findOrFail($detail->part_id);
            $part->qty -= $detail->qty;
            $part->save();
        }

        flash()->success("Le bon de sortie a été validé avec succès");
        return redirect()->back();
    }

    public function opened(Request $request, ExitVoucher $exit)
    {
        $attributes = $this->validate($request, [
            'status_exit' => 'required'
        ]);

        throw_if( $exit->status_exit == ExitVoucherStatus::Opened,
            ValidationException::withMessages([
                'error' => 'Le bon de sortie est déja ouverte et en cours.'])
        );
        $exit->updateOrFail($attributes);

        // On remet à jour le stock
        foreach ($exit->parts as $detail)
        {
            $part = Part::findOrFail($detail->part_id);
            $part->qty += $detail->qty;
            $part->save();
        }

        flash()->info("Le bon de sorite a été reouvert avec succès, les quantités des pieces séléctionnées ont été rajouté du stock. Valider le à nouveau pour la mise a jour du stock");
        return redirect()->back();
    }

    public function print(ExitVoucher $exit)
    {
        return view('maintenance.warehouse.voucher.exitVoucher.__printExit', [
            'exit' => $exit
        ]);
    }
}
