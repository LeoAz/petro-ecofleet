<?php

namespace App\Http\Controllers\Maintenance\Warehouse\Purchase;

use App\Enums\Maintenance\PurchaseStatus;
use App\Http\Controllers\Controller;
use App\Models\DetailPurchase;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DetailPurchaseController extends Controller
{
    public function store(Request $request, Purchase $purchase)
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
        $purchase->parts()->create($attributes);

        flash()->success("La piece à été ajouté avec succés au bon d'achat.");
        return redirect()->back();
    }

    public function delete(DetailPurchase $detail)
    {
        throw_if( $detail->purchase->status == PurchaseStatus::Validated,
            ValidationException::withMessages([
                'error' => 'Le bon d\'achat est deja validé, Vous pouvez plus effectuer d\'ajout de pièce'
            ])
        );
        $detail->delete();
        return redirect()->back();
    }
}
