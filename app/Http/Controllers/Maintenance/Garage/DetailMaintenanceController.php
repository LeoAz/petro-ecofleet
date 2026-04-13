<?php

namespace App\Http\Controllers\Maintenance\Garage;

use App\Enums\Maintenance\PartState;
use App\Http\Controllers\Controller;
use App\Models\DetailMaintenance;
use App\Models\ExitVoucher;
use App\Models\Maintenance;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DetailMaintenanceController extends Controller
{
    public function store(Request $request, Maintenance $maintenance)
    {
        $attributes = $this->validate($request,[
            'part_id' => ['required'],
            'qty' => ['required']
        ],
            [
                'part_id.required' => 'Le nom de la pièce est obligatoire',
                'qty.required' => 'La quantité est obligatoire',
            ]
        );
        $maintenance->parts()->create($attributes);

        flash()->success("La piece à été ajouté avec succés au bon d'achat.");
        return redirect()->back();
    }

    public function delete(DetailMaintenance $detail)
    {
        $detail->delete();
        return redirect()->back();
    }
}
