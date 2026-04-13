<?php

namespace App\Http\Controllers\Maintenance\Inventory;

use App\Enums\Maintenance\InventoryStatus;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InventoryController extends Controller
{
    public function index()
    {
        return view('maintenance.inventory.index', [
            'inventories' => Inventory::all()->sortByDesc('created_at')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'date_inventory' => ['required'],
            'description' => ['required'],
        ]);

        $inventory = new Inventory($attributes);
        $inventory->save();
        flash()->info('Inventaire a bien été initailisé, Merci de saisir les détails');
        return redirect()->route('maintenance.inventory.detail', $inventory->uuid);
    }

    public function detail(Inventory $inventory)
    {
        return view('maintenance.inventory.detail', [
            'inventory' => $inventory,
            'parts' => Part::all()
        ]);
    }

    public function closed(Inventory $inventory)
    {
        throw_if( $inventory->status === InventoryStatus::Closed,
            ValidationException::withMessages([
                'error' => "l'inventaire est déja clôturer"])
        );

        foreach ($inventory->details as $detail){
            $part = Part::whereId($detail->part_id)->first();
            $part->updateOrFail([
                'qty' => $detail->real_qty
            ]);
        }

        $inventory->update([
            'status' => InventoryStatus::Closed
        ]);
        flash()->success("l'inventaire a été clôturer avec succés");
        return redirect()->route('maintenance.inventory.index');
    }

    public function delete(Inventory $inventory)
    {
        throw_if( $inventory->status === InventoryStatus::Closed,
            ValidationException::withMessages([
                'error' => "l'inventaire est déja clôturer"])
        );

        throw_if( $inventory->details->isNotEmpty(),
            ValidationException::withMessages([
                'error' => "l'inventaire contient des détails, merci de supprimer ces détails avant suppression de l'inventaire"])
        );

        $inventory->delete();
        flash()->success("l'inventaire a été supprimer avec succés");
        return redirect()->back();

    }
}
