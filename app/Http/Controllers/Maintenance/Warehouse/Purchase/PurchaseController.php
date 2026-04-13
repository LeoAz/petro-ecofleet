<?php

namespace App\Http\Controllers\Maintenance\Warehouse\Purchase;

use App\Enums\Maintenance\PurchaseStatus;
use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\Provider;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('maintenance.warehouse.purchase.index', [
            'purchases' => Purchase::all()->sortByDesc('createad_at'),
            'providers' => Provider::pluck('name', 'id')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'date' => 'required',
            'provider_id' => 'required',
        ], [
            'date.required' => 'La date du bon d\'achat est obligatoire',
            'provider_id.required' => 'Le fournisseur du bon d\' achat est obligatoire',
        ]);

        if (!is_null($attributes['date']))
            Arr::set($attributes, 'date', Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString());

        $purchase = new Purchase($attributes);
        $purchase->save();

        flash()->info("Le bon d'achat à été créer avec succés, Merci de rajouter les pièces de rechange sur le bon de d'achat");
        return redirect()->route('maintenance.warehouse.purchase.detail', $purchase->uuid);
    }

    public function detail(Purchase $purchase)
    {
        //dd($purchase);
        return view('maintenance.warehouse.purchase.detail', [
            'purchase' => $purchase,
            'parts' => Part::pluck('name', 'id')
        ]);
    }

    public function validated(Request $request, Purchase $purchase)
    {
        $attribute = $this->validate($request, [
            'status' => 'required'
        ]);

        throw_if( $purchase->status === PurchaseStatus::Validated,
            ValidationException::withMessages([
                'error' => 'Le bon d\' achat est déja validé'])
        );
        $purchase->updateOrFail($attribute);

        // on crée le bon d'entré en stock des pieces utilisé
        if ( is_null($purchase->enter)){
            $enter = $purchase->enter()->create([
                'date' => now()->toDateString()
            ]);
            //dd($exit->parts);
            // on associe au bon d'entré la liste des pièces utilisés
            if ( $enter->parts->isEmpty()) {
                foreach ($purchase->parts as $detail)
                {
                    $enter->parts()->create([
                        'part_id' => $detail->part_id,
                        'qty' => $detail->qty
                    ]);
                }
            }
        }

        //On met a jour le stock
        foreach ($purchase->parts as $detail)
        {
            $part = Part::findOrFail($detail->part_id);
            $part->qty += $detail->qty;
            $part->save();
        }

        flash()->success("Le bon d'achat a été validé avec succès");
        return redirect()->back();
    }

    public function opened(Request $request, Purchase $purchase)
    {
        $attributes = $this->validate($request, [
            'status' => 'required'
        ]);

        throw_if( $purchase->status == PurchaseStatus::Pending,
            ValidationException::withMessages([
                'error' => 'Le bon d\'achat est déja ouverte et en cours.'])
        );
        $purchase->updateOrFail($attributes);

        // On remet à jour le stock
        foreach ($purchase->parts as $detail)
        {
            $part = Part::findOrFail($detail->part_id);
            $part->qty -= $detail->qty;
            $part->save();
        }

        flash()->info("Le bon d'achat a été reouvert avec succès, la quantités des pieces séléctionnées ont été déduis du stock. Valider pour la mise a jour du stock");
        return redirect()->back();
    }

    public function print(Purchase $purchase)
    {
        return view('maintenance.warehouse.purchase.__print', [
            'purchase' => $purchase,
        ]);
    }

    public function delete(Purchase $purchase)
    {
        throw_if( $purchase->status == PurchaseStatus::Validated,
            ValidationException::withMessages([
                'error' => 'La réparation est déja valider, Vous pouvez plus le supprimer.'])
        );

        if($purchase->parts->isNotEmpty())
        {
            foreach ($purchase->parts as $detail)
            {
                $detail->delete();
            }
        }

        // on supprime le bon de sortie de stock des pieces utilisé
        if ( !is_null($purchase->enter)){
            if ( $purchase->enter->parts->isNotEmpty()) {
                foreach ($purchase->enter->parts as $part) {
                    $part->delete();
                }
            }
            $purchase->enter->delete();
        }

        $purchase->delete();

        flash()->info("Le bon d\'achat a été supprimé avec succés");
        return redirect()->back();
    }
}
