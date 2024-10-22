<?php

namespace App\Http\Controllers;

use App\Models\VetAppointment;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VetAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $vet = $user->vet;
        $vetId = $vet->id;
        $status = VetAppointment::APPOINTMENT_STATUS;

        $animals = Animal::where('vet_id', $vetId)->get();
        $vets = VetAppointment::whereHas('animal', function($query) use ($vetId) {
            $query->where('vet_id', $vetId);
        })->get();

        return view('vetAppointments.index', compact('animals', 'vets', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'schedule_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'status' => 'required|in:' .implode(',',VetAppointment::APPOINTMENT_STATUS),
            'observation' => 'nullable|string|max:255',

        ]);

        $vet = new VetAppointment();
        $vet->animal_id = $request->input('animal_id');
        $vet->schedule_date = $request->input('schedule_date');
        $vet->reason = $request->input('reason');
        $vet->status = $request->input('status');
        $vet->observation = $request->input('observation');

        $vet->save();

        return redirect()->back()->with('success', 'Cita veterinaria guardada exitosamente');
    }

    public function destroy($id)
    {
        $vet = VetAppointment::find($id);
        if ($vet && $vet->animal->vet_id == Auth::user()->vet->id) {
            $vet->delete();
        }
        return redirect()->back()->with('success', 'Cita veterinaria eliminada exitosamente');
    }

    public function edit($id)
    {
        $vet = VetAppointment::find($id);
        if ($vet && $vet->animal->vet_id == Auth::user()->vet->id) {
            $user = Auth::user();
            $vetId = $user->vet->id;
            $animals = Animal::where('vet_id', $vetId)->get();
    
            return view('vetAppointments.edit', compact('vet', 'animals'));
        }
    }

    public function create()
    {
        $status = VetAppointment::APPOINTMENT_STATUS;
        $vet = new VetAppointment();

        return view('vetAppointments.create', compact('vet', 'status'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'schedule_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'status' => 'required|in:' .implode(',',VetAppointment::APPOINTMENT_STATUS),
            'observation' => 'nullable|string|max:255',
        ]);

        $vet = VetAppointment::find($id);
        if ($vet && $vet->animal->vet_id == Auth::user()->vet->id) 
            $vet->update($request->all());
            return redirect()->back()->with('success', 'Cita veterinaria actualizada correctamente');
        }

    public function show($id)
    {
        $vet = VetAppointment::find($id);
        if ($vet && $vet->animal->vet_id == Auth::user()->vet->id) 
            return view('vetAppointments.show', compact('vet'));
        }
    }
