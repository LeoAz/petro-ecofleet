<?php

namespace App\Http\Controllers\Maintenance\Provider;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProviderController extends Controller
{
    public function index()
    {
        return view('maintenance.provider.index', [
            'providers' => Provider::with(['orders', 'purchases'])
            ->get()->sortByDesc('created_at')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request,
            [
                'name' => ['required'],
                'contact' => ['nullable'],
                'address' => ['nullable'],
            ],
            [
                'name.required' => 'Le nom du founisseur est obligatoire !'
            ]
        );

        $provider = new Provider($attributes);
        $provider->save();

        flash()->success("Le fournisseur a été enregistré avec succès");
        return redirect()->back();
    }

    public function edit(Provider $provider)
    {
        return response()->json($provider);
    }

    public function update(Request $request, Provider $provider)
    {
        $attributes = $this->validate($request, [
            'name' => ['required'],
            'contact' => ['nullable'],
            'address' => ['nullable'],
        ],
            [
                'name.required' => 'Le nom du client est obligatoire !',
            ]);
        $provider->update($attributes);

        flash()->success("Le fournisseur a été modifié avec succès");
        return redirect()->back();
    }

    public function destroy(Provider $provider)
    {
        throw_if( $provider->orders->isNotEmpty() || $provider->purchases->isNotEmpty(),
            ValidationException::withMessages([
                'error' => 'Ce fournisseur ne peut etre supprimé car, il possede de bon de commande ou des bon d\'achat en son nom'
            ])
        );
        $provider->delete();

        flash()->success("Le fournisseur a été supprimé avec succès");
        return redirect()->back();
    }

}
