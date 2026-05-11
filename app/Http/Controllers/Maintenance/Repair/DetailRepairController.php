<?php

namespace App\Http\Controllers\Maintenance\Repair;

use App\Enums\Maintenance\PartState;
use App\Http\Controllers\Controller;
use App\Models\DetailRepair;
use App\Models\ExitVoucher;
use App\Models\Part;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DetailRepairController extends Controller
{
    public function store(Request $request, Repair $repair)
    {
        $attributes = $this->validate($request, [
            'part_id' => ['required'],
            'qty' => ['required', 'numeric', 'min:0.01'],
        ],
            [
                'part_id.required' => 'La pièce est obligatoire',
                'qty.required' => 'La quantité est obligatoire',
                'qty.numeric' => 'La quantité doit être un nombre',
                'qty.min' => 'La quantité doit être supérieure à zéro',
            ]
        );

        DetailRepair::create([
            'part_id' => $attributes['part_id'],
            'qty' => $attributes['qty'],
            'repair_id' => $repair->id
        ]);

        flash()->info("La pièce a été ajoutée avec succès à la fiche de réparation");
        return redirect()->back();
    }

    public function delete(DetailRepair $detail)
    {
        $detail->delete();
        return redirect()->back();
    }
}
