<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Animal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $animals = Animal::all(); 

        return view('clients.index', compact('clients', 'animals'));
    }

    public function generateClientReport($clientId)
    {
        $clientId = Crypt::decrypt($clientId);
        $client = Client::findOrFail($clientId);
        $pdf = PDF::loadView('clients.client_report', compact('client'));

        return $pdf->download('reporte_cliente_' . $client->id . '.pdf');
    }

    public function create()
    {
        $animals = Animal::all(); 
        return view('clients.create', compact('animals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'animal_id' => 'required|exists:animals,id',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'number_pets' => 'nullable|integer|min:0',
            'observations' => 'nullable|string',
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Cliente creado exitosamente.');
    }

    public function show(Client $client)
    {
        $client->load('animal');
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $animals = Animal::all();
        return view('clients.edit', compact('client', 'animals'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'animal_id' => 'required|exists:animals,id',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'number_pets' => 'nullable|integer|min:0',
            'observations' => 'nullable|string',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function showClientReport($id)
    {
        $client = Client::with('animals')->find($id);
        return view('clients.client_report', compact('client'));
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
