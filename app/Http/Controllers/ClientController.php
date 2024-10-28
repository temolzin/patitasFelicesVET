<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     */
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }

    public function generateClientReport($clientId)
    {
        $clientId = Crypt::decrypt($clientId);
        $client = Client::findOrFail($clientId);
        $pdf = PDF::loadView('clients.client_report', compact('client'));

        return $pdf->download('reporte_cliente_' . $client->id . '.pdf');
    }

    public function selectPets($clientId)
    {
        $client = Client::findOrFail($clientId);
        $pets = Animal::where('client_id', null)->get(); 

        return view('clients.selectPets', compact('client', 'pets'));
    }

    public function updatePets(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);
        $petIds = $request->input('pets');

        foreach ($petIds as $petId) {
            $animal = Animal::find($petId);
            if ($animal) {
                $animal->client_id = $clientId; 
                $animal->save(); 
            }
        }
        return redirect()->route('clients.index')->with('success', 'Mascotas asignadas correctamente.');
    }

    public function create()
    {
        $animals = Animal::all();

        return view('clients.create', compact('animals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'number_pets' => 'required|integer',
            'observations' => 'nullable|string|max:1000',
        ]);

        $cliente = Client::create($data);
        if ($request->animals) {
            Animal::whereIn('id', $request->animals)->update(['client_id' => $cliente->id_client]);
        }
        return redirect()->route('clients.index')->with('success', 'Cliente creado exitosamente y mascotas asignadas.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $animals = Animal::all();

        return view('clients.edit', compact('client', 'animals'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'number_pets' => 'nullable|integer',
            'observations' => 'nullable|string|max:1000',
        ]);
        $client = Client::findOrFail($id);
        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function show($id)
    {
        $client = Client::with('pets')->findOrFail($id);
        return view('clients.show', compact('client'));
    }

    public function report($clientId)
    {
        $client = Client::with('pets')->findOrFail($clientId);
        return view('clients.client_report', compact('client'));
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
