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
            'exit_voucher_id' => ['required'],
        ],
            [
            'exit_voucher_id.required' => 'le bon de sortie est obligatoire',
            ]
        );
        $exit = ExitVoucher::findOrFail($attributes['exit_voucher_id']);

        foreach ( $exit->parts as $part)
        {
            DetailRepair::create([
                'part_id' => $part->part_id,
                'qty' => $part->qty,
                'exit_voucher_id' => $part->exit_id,
                'repair_id' => $repair->id
            ]);
        }

        flash()->info("Les pièces ont été ajouté avec succés à la fiche de reparation");
        return redirect()->back();
    }

    public function delete(DetailRepair $detail)
    {
        $detail->delete();
        return redirect()->back();
    }
}
