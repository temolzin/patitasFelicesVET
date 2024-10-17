<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use App\Models\Specie;
use App\Models\VaccinatedAnimal;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;

class AnimalController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $shelter = $user->shelter;
        $shelterId = $shelter->id;

        $origins = Animal::ORIGINS;
        $behaviors = Animal::BEHAVIORS;
        $sexes = Animal::SEXES;
        $animals = Animal::where('shelter_id', $shelterId)->get();
        $species = Specie::where('shelter_id', $shelterId)->get();
        $vaccines = Vaccine::where('shelter_id', $shelterId)->get();
        $vaccinatedAnimals = VaccinatedAnimal::whereIn('animal_id', $animals->pluck('id'))
        ->with('vaccines') 
        ->get()
        ->groupBy('animal_id');

        return view('animals.index', compact('animals', 'species','origins', 'behaviors','sexes','vaccines','vaccinatedAnimals'));
    }

    public function create()
    {
        $species = Specie::all();
        return view('animals.create', compact('species'));
    }

    public function petProfile($animalId)
    {
        $animalId = Crypt::decrypt($animalId);

        $user = Auth::user();
        $shelter = $user->shelter;
        $shelterId = $shelter->id;

        $animal = Animal::where('shelter_id', $shelterId)->where('id', $animalId)->firstOrFail();

        $pdf = PDF::loadView('animals.petProfile', compact('animal'));
        return $pdf->stream();
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|string|max:255',
            'specie_id' => 'required|exists:species,id',
            'breed' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'sex' => 'required|in:' . implode(',', Animal::SEXES),
            'color' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'is_sterilized' => 'nullable|boolean',
            'entry_date' => 'required|date',
            'origin' => 'required|in:' . implode(',', Animal::ORIGINS),
            'behavior' => 'required|in:' . implode(',', Animal::BEHAVIORS),
            'history' => 'required',
        ]);

        $user = Auth::user();
        $shelter = $user->shelter;

        $animal = new Animal();
        $animal->specie_id = $request->specie_id;
        $animal->shelter_id = $shelter->id;
        $animal->name = $request->name;
        $animal->breed = $request->breed;
        $animal->birth_date = $request->birth_date;
        $animal->sex = $request->sex;
        $animal->color = $request->color;
        $animal->weight = $request->weight;
        $animal->is_sterilized = $request->is_sterilized;
        $animal->entry_date = $request->entry_date;
        $animal->origin = $request->origin;
        $animal->behavior = $request->behavior;
        $animal->history = $request->history;

        $animal->save();

        if ($request->hasFile('photo')) {
            $animal->addMediaFromRequest('photo')->toMediaCollection('animalGallery');
        }

        return redirect()->route('animals.index')->with('success', 'Mascota agregada correctamente.');
    }

    public function show($id)
    {
        $animal = Animal::with('vaccinatedAnimals')->find($id); 
    }

    public function edit($id)
    {
    }

    public function update(Request $request, Animal $animal)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|string|max:255',
            'specie_id' => 'required|exists:species,id',
            'breed' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'sex' => 'required|in:' . implode(',', Animal::SEXES),
            'color' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'is_sterilized' => 'nullable|boolean',
            'entry_date' => 'required|date',
            'origin' => 'required|in:' . implode(',', Animal::ORIGINS),
            'behavior' => 'required|in:' . implode(',', Animal::BEHAVIORS),
            'history' => 'required',
        ]);

        $animal->update($request->except('photo'));

        if ($request->hasFile('photo')) {
            $animal->clearMediaCollection('animalGallery');
            $animal->addMediaFromRequest('photo')->toMediaCollection('animalGallery');
        }

        return redirect()->route('animals.index')->with('success', 'Mascota actualizada correctamente.');
    }

    public function destroy($id)
    {
        $animal = Animal::find($id);
        $animal->delete();
        return redirect()->back()->with('success', 'Mascota eliminada exitosamente');
    }
}
