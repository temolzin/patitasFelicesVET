<?php

namespace App\Http\Controllers;

use App\Models\AssignedService;
use Illuminate\Http\Request;

class AssignedServiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'service_id' => 'required|exists:services,id', 
            'service_date' => 'required|date'
        ]);

        $assignedService = new AssignedService();
        $assignedService->animal_id = $request->input('animal_id');
        $assignedService->service_id = $request->input('service_id');
        $assignedService->service_date = $request->input('service_date');

        $assignedService->save();

        return redirect()->back()->with('success', 'Servicio asignado exitosamente.');
    }

    public function destroy($id, Request $request)
    {
        $assignedService = AssignedService::find($id);
        $assignedService->delete();
        return redirect()->back()->with('modal_id', $request->input('modal_id'));
    }
}
