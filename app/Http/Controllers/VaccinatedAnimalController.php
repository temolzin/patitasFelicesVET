<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaccinatedAnimal;

class VaccinatedAnimalController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'vaccine_id' => 'required|exists:vaccines,vaccine_id',
            'application_date' => 'required|date'
        ]);

        $vaccinatedAnimal = new VaccinatedAnimal();
        $vaccinatedAnimal->animal_id = $request->input('animal_id');
        $vaccinatedAnimal->vaccine_id = $request->input('vaccine_id');
        $vaccinatedAnimal->application_date = $request->input('application_date');

        $vaccinatedAnimal->save();

        return redirect()->back()->with('success', 'Vacuna de el amimal registrado exitosamente.');
    }

    public function destroy($id, Request $request)
    {
        $vaccinatedAnimal = VaccinatedAnimal::find($id);
        $vaccinatedAnimal->delete();
        return redirect()->back()->with('modal_id', $request->input('modal_id'));
    }
}
