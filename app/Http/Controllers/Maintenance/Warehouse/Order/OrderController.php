<?php

namespace App\Http\Controllers\Maintenance\Warehouse\Order;

use App\Enums\Maintenance\OrderStatus;
use App\Enums\Maintenance\PurchaseStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Part;
use App\Models\Provider;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index()
    {
        return view('maintenance.warehouse.order.index', [
            'orders' => Order::all()->sortByDesc('created_at'),
            'providers' => Provider::pluck('name', 'id'),
            'vehicles' => Vehicle::pluck('registration', 'id'),
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'date' => 'required',
            'provider_id' => 'required',
            'vehicle_id' => 'required',
            'description' => 'nullable',
        ], [
            'date.required' => 'La date du bon de commande est obligatoire',
            'provider_id.required' => 'Le fournisseur du bon de commande est obligatoire',
            'vehicle_id.required' => 'Le numéro du véhicule est obligatoire',
        ]);

        if (!is_null($attributes['date']))
            Arr::set($attributes, 'date', Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString());

        $order = new Order($attributes);
        $order->save();

        flash()->info("Le bon de commande à été créer avec succés, Merci de rajouter les pièces de rechange sur le bon");
        return redirect()->route('maintenance.warehouse.order.detail', $order->uuid);
    }

    public function detail(Order $order)
    {
        return view('maintenance.warehouse.order.detail', [
            'order' => $order,
            'parts' => Part::all()
        ]);
    }

    public function print(Order $order)
    {
        return view('maintenance.warehouse.order.__print', [
            'order' => $order,
        ]);
    }

    public function validated(Request $request, Order $order)
    {
        $attribute = $this->validate($request, [
            'status' => 'required'
        ]);

        throw_if( $order->status === OrderStatus::Validated,
            ValidationException::withMessages([
                'error' => 'Le bon de commande est déja validé'])
        );

        throw_if( $order->status === OrderStatus::Received,
            ValidationException::withMessages([
                'error' => 'Le bon de commande est déja receptioné'])
        );
        $order->updateOrFail($attribute);

        // on crée le bon d'achat associé
        $purchase = $order->purchase()->create([
            'date' => $order->date->toDateString(),
            'provider_id' => $order->provider_id,
        ]);
        $purchase->save();

        // On associé les pieces sur le bon d'achat
        foreach ($order->parts as $detail) {
            $purchase->parts()->create([
                'part_id' => $detail->part_id,
                'qty' => $detail->qty,
            ]);
        }

        flash()->success("Le bon de commande a été validé avec succès");
        return redirect()->back();
    }

    public function canceled(Request $request, Order $order)
    {
        $attributes = $this->validate($request, [
            'status' => 'required'
        ]);

        throw_if( $order->status == OrderStatus::Validated,
            ValidationException::withMessages([
                'error' => 'Le bon de commande est déja validé.'])
        );

        throw_if( $order->status == OrderStatus::Created,
            ValidationException::withMessages([
                'error' => 'Le bon de commande est déja ouverte et en cours.'])
        );
        $order->updateOrFail($attributes);

        flash()->info("Le bon de commande à été annulé avec succés");
        return redirect()->back();
    }

    public function received(Request $request, Order $order)
    {
        $attribute = $this->validate($request, [
            'status' => 'required'
        ]);

        throw_if( $order->status == OrderStatus::Received,
            ValidationException::withMessages([
                'error' => 'Le bon de commande est déja receptioné.'])
        );

        throw_if( $order->status == OrderStatus::Canceled,
            ValidationException::withMessages([
                'error' => 'Le bon de commande est annulé. il ne peut etre receptioné'
            ])
        );

        throw_if( $order->status == OrderStatus::Created,
            ValidationException::withMessages([
               "error"=> 'Le bon de commande n\'est pas validé. Merci de le valider avant reception'])
        );

        $order->updateOrFail($attribute);

        //on cree le bon d'entre en stock
        if ( is_null($order->enter)){
            $enter = $order->enter()->create([
                'date' => now()->toDateString(),
                'purchase_id' => $order->purchase->id
            ]);
            //dd($exit->parts);
            // on associe au bon d'entré la liste des pièces utilisés
            if ( $enter->parts->isEmpty()) {
                foreach ($order->parts as $detail)
                {
                    $enter->parts()->create([
                        'part_id' => $detail->part_id,
                        'qty' => $detail->qty
                    ]);
                }
            }
        }

        // on met la quantité de stock à jour
        foreach ($order->parts as $detail)
        {
            $part = Part::findOrFail($detail->part_id);
            $part->qty += $detail->qty;
            $part->save();
        }

        $order->purchase()->update([
            'status' => PurchaseStatus::Validated
        ]);

        flash()->info("Le bon de commande à été réceptionné avec succés, Le bon d'entré en stock à été créer automatiquement");
        return redirect()->back();
    }
}
