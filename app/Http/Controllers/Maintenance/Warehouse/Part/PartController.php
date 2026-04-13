<?php

namespace App\Http\Controllers\Maintenance\Warehouse\Part;

use App\Enums\Maintenance\PartState;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PartController extends Controller
{
    public function index()
    {
        return view('maintenance.warehouse.part.index', [
            'categories' => Category::pluck('name', 'id'),
            'buyers' => Buyer::pluck('name', 'id'),
            'parts' => Part::with('category')->get()
                ->sortByDesc('created_at')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->rules($request);
        Arr::set($attributes, 'state', PartState::InStock);

        $part = new Part($attributes);
        $part->save();

        flash()->success("La pièce de rechange a été enregistrée avec succès");
        return redirect()->back();
    }

    public function edit(Part $part)
    {
        return view('maintenance.warehouse.part.edit', [
            'part' => $part,
            'categories' => Category::pluck('name', 'id'),
            'buyers' => Buyer::pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, Part $part)
    {
        $attributes = $this->rules($request);
        Arr::set($attributes, 'state', PartState::InStock);

        $part->updateOrFail($attributes);
        $part->save();
        flash()->success("La pièce de rechange a été modifiée avec succès");
        return redirect()->route('maintenance.warehouse.part.index');
    }


    private function rules(Request $request): array
    {
        return $this->validate($request, [
            'name' => ['required'],
            'price' => ['nullable', 'numeric'],
            'qty' => ['required', 'min:1'],
            'category_id' => ['required'],
            'reference' => ['nullable'],
            'buyer_id' => ['nullable']
        ], [
            'name.required' => 'Le nom de la pièce est obligatoire',
            //'price.required' => 'Le prix de la pièce est obligatoire',
            'qty.required' => 'La quantité disponible en stock est obligatoire',
            'qty.min' => 'la quantité minimal doit etre superieur à 1',
            'category_id.required' => 'La catégorie de la pièce disponible en stock est obligatoire',
            'treshold.required' => 'La quantité sueil du stock est obligatoire',
            'treshold.min' => 'la quantité seuil du stock doit etre superieur à 5',
        ]);
    }

}
