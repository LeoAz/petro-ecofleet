<?php

namespace App\Http\Controllers\Maintenance\Setting;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BuyerController extends Controller
{
    public function index()
    {
        return view('maintenance.setting.buyer.index', [
            'buyers' => Buyer::all()->sortByDesc('created_at')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request,
            [
                'name' => ['required', 'min:4']
            ]
        );

        $buyer = new Buyer($attributes);
        $buyer->save();

        flash()->success("L'appartenant a été enregistré avec succès");
        return redirect()->back();
    }

    public function edit(Buyer $buyer)
    {
        return response()->json($buyer);
    }

    public function update(Request $request, Buyer $buyer)
    {
        $attributes = $this->validate($request, [
            'name' => ['required'],
        ]);
        $buyer->update($attributes);

        flash()->success("L'appartenant a été modifiée avec succès");
        return redirect()->back();
    }

    public function destroy(Buyer $buyer)
    {
        throw_if( $buyer->parts->isNotEmpty(),
            ValidationException::withMessages([
                'error' => 'Cet appartenant ne peut etre supprimé car, elle possede des pièces de rechange enregistré en son nom'
            ])
        );
        $buyer->delete();

        flash()->success("L'appartenant a été suprimée avec succès");
        return redirect()->back();
    }
}
