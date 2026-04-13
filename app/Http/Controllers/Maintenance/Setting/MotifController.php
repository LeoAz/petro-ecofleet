<?php

namespace App\Http\Controllers\Maintenance\Setting;

use App\Http\Controllers\Controller;
use App\Models\Motif;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MotifController extends Controller
{
    public function index()
    {
        return view('maintenance.setting.motif.index', [
            'motifs' => Motif::all()->sortByDesc('created_at')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request,
            [
                'description' => ['required', 'min:4']
            ]
        );

        $motif= new Motif($attributes);
        $motif->save();

        flash()->success("Le motif a été enregistré avec succès");
        return redirect()->back();
    }

    public function edit(Motif $motif)
    {
        return response()->json($motif);
    }

    public function update(Request $request, Motif $motif)
    {
        $attributes = $this->validate($request, [
            'description' => ['required'],
        ]);
        $motif->update($attributes);

        flash()->success("Le motif a été modifiée avec succès");
        return redirect()->back();
    }

    public function destroy(Motif $motif)
    {
        throw_if( $motif->repairs->isNotEmpty(),
            ValidationException::withMessages([
                'error' => 'Ce motif ne peut etre supprimé car, elle possède des reparations enregistrées en son nom'
            ])
        );

        $motif->delete();
        flash()->success("Le motif a été suprimée avec succès");
        return redirect()->back();
    }
}
