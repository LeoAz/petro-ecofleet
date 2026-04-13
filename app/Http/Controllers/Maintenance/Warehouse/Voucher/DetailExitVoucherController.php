<?php

namespace App\Http\Controllers\Maintenance\Warehouse\Voucher;

use App\Enums\Maintenance\ExitVoucherStatus;
use App\Http\Controllers\Controller;
use App\Models\DetailExitVoucher;
use App\Models\ExitVoucher;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DetailExitVoucherController extends Controller
{
    public function store(Request $request, ExitVoucher $exit)
    {
        $attributes = $this->validate($request,[
            'part_id' => ['required'],
            'reference' => ['nullable'],
            'qty' => ['required']
        ],
            [
                'part_id.required' => 'Le nom de la pièce est obligatoire',
                'qty.required' => 'La quantité est obligatoire',
            ]
        );
        $exit->parts()->create($attributes);

        flash()->success("La piece à été ajouté avec succés au bon d'achat.");
        return redirect()->back();
    }

    public function delete(DetailExitVoucher $detail)
    {
        throw_if( $detail->exit->status == ExitVoucherStatus::Validated,
            ValidationException::withMessages([
                'error' => 'Le bon de sortie est deja validé, Vous pouvez plus effectuer d\'ajout de pièce'
            ])
        );
        $detail->delete();
        return redirect()->back();
    }
}
