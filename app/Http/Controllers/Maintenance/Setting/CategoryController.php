<?php

namespace App\Http\Controllers\Maintenance\Setting;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function index()
    {
        return view('maintenance.setting.category.index', [
            'categories' => Category::all()->sortByDesc('created_at')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request,
            [
                'name' => ['required', 'min:4']
            ]
        );

        $category = new Category($attributes);
        $category->save();

        flash()->success("La categorie a été enregistré avec succès");
        return redirect()->back();
    }

    public function edit(Category $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $attributes = $this->validate($request, [
            'name' => ['required'],
        ]);
        $category->update($attributes);

        flash()->success("La categorie a été modifiée avec succès");
        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        throw_if( $category->parts->isNotEmpty(),
            ValidationException::withMessages([
                'error' => 'Cette catégorie ne peut etre supprimé car, elle possede des pièces de rechange enregistré en son nom'
            ])
        );
        $category->delete();

        flash()->success("La catégorie a été suprimée avec succès");
        return redirect()->back();
    }
}
