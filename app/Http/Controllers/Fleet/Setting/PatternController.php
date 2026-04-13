<?php

namespace App\Http\Controllers\Fleet\Setting;

use App\Http\Controllers\Controller;
use App\Models\Pattern;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function flash;
use function redirect;
use function response;
use function view;

class PatternController extends Controller
{
    public function index()
    {
        return view('fleet.setting.pattern.index', [
            'patterns' => Pattern::all()->sortByDesc('created_at')
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

        $pattern = new Pattern($attributes);
        $pattern->save();

        flash()->success("Le model a été enregistré avec succès");
        return redirect()->back();
    }

    public function edit(Pattern $pattern)
    {
        return response()->json($pattern);
    }

    public function update(Request $request, Pattern $pattern)
    {
        $attributes = $this->validate($request, [
            'name' => ['required'],
        ]);

        $pattern->update($attributes);

        flash()->success("Le model a été modifié avec succès");
        return redirect()->back();
    }

    public function destroy(Pattern $pattern)
    {
        $pattern->delete();

        flash()->success("Le model a été suprimé avec succès");
        return redirect()->back();
    }
}
