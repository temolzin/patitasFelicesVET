<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use App\Models\Vet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SpecieController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->vet) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta página.');
        }

        $vetId = $user->vet->id;

        $species = Specie::orderBy('created_at', 'desc')->get();

        return view('species.index', compact('species'));
    }

    public function list()
    {

        $species = Specie::all();
        return $species;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        $vet = $user->vet;
        if (!$vet) {
            return redirect()->back()->with('error', 'No se encontró el refugio asociado al usuario.');
        }

        if ($request->id == 0) {
            $species = new Specie();
        } else {
            $species = Specie::find($request->id);
            if (!$species) {
                return redirect()->back()->with('error', 'La especie no fue encontrada.');
            }
        }

        $species->name = $request->input('name');
        $species->description = $request->description;
        $species->vet_id = $vet->id;

        $species->save();

        return redirect()->back()->with('success', 'Especie guardada exitosamente.');
    }


    public function destroy($id)
    {
        $species = Specie::find($id);
        $species->delete();
        return redirect()->back()->with('success', 'Especie eliminada exitosamente');
    }

    public function get(Request $request)
    {
        $species = Specie::find($request->id);
        return $species;
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable',
        ]);
        $species = Specie::find($id);
        if ($species) {
            $species->name = $request->input('name');
            $species->description = $request->description;
            $species->save();
        }
        return redirect()->back()->with('success', 'Especie actualizada correctamente');
    }

    public function show(Specie $species)
    {
    }
}
