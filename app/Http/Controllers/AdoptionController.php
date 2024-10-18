<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Adoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;


class AdoptionController extends Controller
{
    public function pdfAdoption($id)
    {
        $id = Crypt::decrypt($id);
        $vet = Auth::user()->vet;

        $adoption = Adoption::where('id', $id)
            ->with(['animal.specie', 'vetMember'])
            ->firstOrFail();

        $pdf = PDF::loadView('adoptions.pdfAdoption', compact('adoption', 'vet'));
        return $pdf->stream();
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'vet_member_id' => 'required|exists:vet_member,id',
            'adoption_date' => 'required|date',
            'observation' => 'nullable|string',
        ]);

        $adoption = new Adoption();

        $adoption->animal_id = $request->animal_id;
        $adoption->vet_member_id = $request->vet_member_id;
        $adoption->adoption_date = $request->adoption_date;
        $adoption->observation = $request->observation;

        $adoption->save();

        return redirect()->route('vetMembers.adopter')->with('success', 'Adopción creada exitosamente.');
    }
    
    public function destroy($id, Request $request)
    {
        $adoption = Adoption::findOrFail($id);
        $adoption->delete();
    
        return redirect()->back()->with('success', 'Adopción eliminada exitosamente')->with('modal_id', $request->input('modal_id'));
    }
}
