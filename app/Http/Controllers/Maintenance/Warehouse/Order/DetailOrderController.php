<?php

namespace App\Http\Controllers\Maintenance\Warehouse\Order;

use App\Enums\Maintenance\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DetailOrderController extends Controller
{
    public function store(Request $request, Order $order)
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
        $order->parts()->create($attributes);

        flash()->success("La piece à été ajouté avec succés au bon d'achat.");
        return redirect()->back();
    }

    public function delete(DetailOrder $detail)
    {
        throw_if( $detail->order->status == OrderStatus::Validated,
            ValidationException::withMessages([
                'error' => 'Le bon de commande est deja validé, Vous pouvez plus effectuer d\'ajout de pièce'
            ])
        );
        throw_if( $detail->order->status == OrderStatus::Received,
            ValidationException::withMessages([
                'error' => 'Le bon de commande est deja receptioné, Vous pouvez plus effectuer d\'ajout de pièce'
            ])
        );
        $detail->delete();
        return redirect()->back();
    }
}
