<?php

namespace App\Http\Controllers\Maintenance\Inventory;

use App\Enums\Maintenance\InventoryStatus;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class CreateDetailInventoryController extends Controller
{
    public function __invoke(Request $request, Inventory $inventory)
    {
        throw_if( $inventory->status === InventoryStatus::Closed,
            ValidationException::withMessages([
                'error' => "l'inventaire est déja clôturer"])
        );

        $attributes = $this->validate($request, [
            'part_id' => ['required'],
            'real_qty' => ['required', 'integer'],
            'observation' => ['nullable'],
        ]);
        $part = Part::whereId($attributes['part_id'])->first();
        throw_if( $part === null,
            ValidationException::withMessages([
                'error' => "La pièce saisie n'existe pas dans la base de donnée"])
        );
       Arr::set($attributes,'theoriq_qty', $part->qty);
        $inventory->details()->create($attributes);

        return redirect()->back();
    }

}
