<?php

namespace App\Http\Controllers\Docs;

use App\Enums\Fleet\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class VehDocsController extends Controller
{
    public function index()
    {
        return view('docs.vehs.index', [
            'vehicles' => Vehicle::with('documents', 'pattern')
                ->whereHas('documents')
                ->get(),
            'vehs' => Vehicle::pluck('registration', 'id')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->getAttributes($request);

        $doc = new Document($attributes);
        $doc->uuid = Str::uuid()->toString();
        $doc->status = DocumentStatus::Active;
        $doc->save();

        flash()->success("Le document a été créer avec succès");
        return redirect()->route('docs.vehs.document', $doc->vehicle->uuid);
    }

    public function document(Vehicle $vehicle)
    {
        return view('docs.vehs.docs',[
            'vehicle' => $vehicle
        ]);
    }

    public function delete(Document $document)
    {
        $document->delete();
        flash()->success("Le document a été créer avec succès");
        return redirect()->back();
    }

    private function getAttributes(Request $request): array
    {
        $attributes = $this->validate($request, [
            'label' => ['required'],
            'type' => ['required'],
            'provider' => ['required'],
            'delivery_date' => ['required'],
            'exp_date' => ['required'],
            'vehicle_id' => ['required'],
            'amount' => ['required', 'numeric']
        ], [
            'delivery_date.required' => 'La date de delivrance du document est obligatoire',
            'exp_date.required' => 'La date d\'expiration du document est obligatoire',
            'type.required' => 'Le type du document est obligatoire',
            'provider.required' => 'Le fournisseur du document est obligatoire',
            'amount.required' => 'Le montant du document est obligatoire',
            'label.required' => 'Le nom du document est obligatoire',
            'vehicle_id.required' => 'L\immatriculation du véhicule est obligatoire',
            'amount.numeric' => 'Le montant doit être en chiffre',
            //'exp_date.after' => 'Le date d\'expiration doit être date posterieur à la date de delivrance',
        ]);

        if (!is_null($attributes['delivery_date']))
            Arr::set($attributes, 'delivery_date', Carbon::createFromFormat('d/m/Y', $attributes['delivery_date'])->toDateString());

        if (!is_null($attributes['exp_date']))
            Arr::set($attributes, 'exp_date', Carbon::createFromFormat('d/m/Y', $attributes['exp_date'])->toDateString());

        return $attributes;
    }
}
