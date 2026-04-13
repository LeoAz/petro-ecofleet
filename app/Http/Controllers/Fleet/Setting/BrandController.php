<?php

namespace App\Http\Controllers\Fleet\Setting;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function flash;
use function redirect;
use function response;
use function view;

class BrandController extends Controller
{
    public function index()
    {
        return view('fleet.setting.brand.index', [
            'brands' => Brand::all()->sortByDesc('created_at')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request,
            [
                'name' => ['required', 'min:4']
            ]
        );
        Arr::set($attributes, 'uuid', Str::uuid()->toString());

        $brand = new Brand($attributes);
        $brand->save();

        flash()->success("La marque a été enregistré avec succès");
        return redirect()->back();
    }

    public function edit(Brand $brand)
    {
        return response()->json($brand);
    }

    public function update(Request $request, Brand $brand)
    {
        $attributes = $this->validate($request, [
            'name' => ['required'],
        ]);
        $brand->update($attributes);

        flash()->success("La marque a été modifié avec succès");
        return redirect()->back();
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        flash()->success("La marque a été suprimée avec succès");
        return redirect()->back();
    }
}
