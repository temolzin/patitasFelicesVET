<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VaccineController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->vet) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta página.');
        }

        $vetId = $user->vet->id;

        $vaccines = Vaccine::where('vet_id', $vetId)
            ->where(function ($query) use ($request) {
                $text = trim($request->get('text'));
                $query->where('vaccine_id', 'LIKE', '%' . $text . '%')
                    ->orWhere('name', 'LIKE', '%' . $text . '%');
            })
            ->orderBy('name', 'desc')
            ->paginate(10);

        return view('vaccines.index', compact('vaccines'));
    }

    public function list()
    {

        $vaccines = Vaccine::all();
        return $vaccines;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
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

        if ($request->vaccine_id == 0) {
            $vaccines = new Vaccine();
        } else {
            $vaccines = Vaccine::find($request->vaccine_id);
            if (!$vaccines) {
                return redirect()->back()->with('error', 'La vacuna no fue encontrada.');
            }
        }

        $vaccines->name = $request->input('name');
        $vaccines->type = $request->input('type');
        $vaccines->description = $request->description;
        $vaccines->vet_id = $vet->id;

        $vaccines->save();

        return redirect()->back()->with('success', 'Vacuna guardada exitosamente.');

    }

    public function destroy($vaccine_id)
    {
        $vaccines = Vaccine::find($vaccine_id);
        $vaccines->delete();
        return redirect()->back()->with('success', 'Vacuna eliminada exitosamente');
    }

    public function get(Request $request)
    {
        $vaccines = Vaccine::find($request->vaccine_id);
        return $vaccines;
    }

    public function edit($vaccine_id)
    {

    }

    public function update(Request $request, $vaccine_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable',
        ]);
        $vaccines = Vaccine::find($vaccine_id);
        if ($vaccines) {
            $vaccines->name = $request->input('name');
            $vaccines->type = $request->input('type');
            $vaccines->description = $request->description;
            $vaccines->save();
        }
        return redirect()->back()->with('success', 'Vacuna actualizada correctamente');
    }

    public function show(Vaccine $vaccines)
    {

    }
}
