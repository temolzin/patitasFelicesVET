<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('servicees.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'description' => 'nullable|string',
            'availability' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
        ]);

        Service::create($request->all());
        return redirect()->route('services.index')->with('success', 'Servicio asignado correctamente.');
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('servicees.show', compact('service'));
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('servicees.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'description' => 'nullable|string',
            'availability' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->all());
        return redirect()->route('services.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Servicio eliminado correctamente.');
    }
}
