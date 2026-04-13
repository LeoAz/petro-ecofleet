<?php

namespace App\Http\Controllers\Docs;

use App\Enums\Fleet\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DriverDocsController extends Controller
{
    public function index()
    {
        return view('docs.driver.index', [
            'drivers' => Driver::with('documents')
                ->whereHas('documents')
                ->get(),
            'drivs' => Driver::pluck('name', 'id')
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
        return redirect()->route('docs.driver.document', $doc->driver->uuid);
    }

    public function document(Driver $driver)
    {
        //dd($driver);
        return view('docs.driver.docs',[
            'driver' => $driver
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
            'driver_id' => ['required'],
            'amount' => ['required', 'numeric']
        ], [
            'delivery_date.required' => 'La date de delivrance du document est obligatoire',
            'exp_date.required' => 'La date d\'expiration du document est obligatoire',
            'type.required' => 'Le type du document est obligatoire',
            'provider.required' => 'Le fournisseur du document est obligatoire',
            'amount.required' => 'Le montant du document est obligatoire',
            'label.required' => 'Le nom du document est obligatoire',
            'driver_id.required' => 'Le nom du chauffeur est obligatoire',
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
