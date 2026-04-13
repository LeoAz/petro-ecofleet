<?php

namespace App\Http\Controllers\Maintenance\Inventory\Detail;

use App\Enums\Maintenance\InventoryStatus;
use App\Http\Controllers\Controller;
use App\Models\DetailInventory;
use App\Models\Inventory;
use Illuminate\Validation\ValidationException;

class DeleteDetailInventoryController extends Controller
{
    public function __invoke(Inventory $inventory, DetailInventory $detail)
    {
        throw_if( $inventory->status === InventoryStatus::Closed,
            ValidationException::withMessages([
                'error' => "l'inventaire est déja clôturer"])
        );

        $detail->delete();
        return redirect()->back();
    }
}
