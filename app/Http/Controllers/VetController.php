<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vet;
use Illuminate\Http\Request;

class VetController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $vets = Vet::with('users')->orderBy('created_at', 'desc')->get();
        $vets->map(function ($vet) {
            $vet->logo_url = $vet->getFirstMediaUrl('vetGallery');
            return $vet;
        });

        return view('vets.index', compact('vets', 'users'));
    }

    public function list()
    {
        return Vet::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $vet = Vet::updateOrCreate(
            ['id' => $request->id],
            $request->only('user_id', 'name', 'phone', 'facebook', 'tiktok', 'state', 'city', 'colony', 'address', 'postal_code')
        );

        if ($request->hasFile('logo')) {
            $vet->addMediaFromRequest('logo')->toMediaCollection('vetGallery');
        }

        return redirect()->route('vets.index')->with('success', 'Albergue guardado exitosamente');
    }

    public function destroy($id)
    {
        $vet = Vet::findOrFail($id);
        if ($vet) {
            $vet->clearMediaCollection('vetGallery');
            $vet->delete();
        }

        return redirect()->route('vets.index')->with('success', 'Albergue eliminado exitosamente');
    }

    public function get(Request $request)
    {
        return Vet::findOrFail($request->id);
    }

    public function edit($id)
    {
        $vet = Vet::findOrFail($id);
        $users = User::all();
        return view('vets.edit', compact('vet', 'users'));
    }

    public function create()
    {
        $users = User::all();
        return view('vets.create', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vet = Vet::findOrFail($id);
        $vet->fill($request->only('user_id', 'name', 'phone', 'facebook', 'tiktok', 'state', 'city', 'colony', 'address', 'postal_code'));

        if ($request->hasFile('logo')) {
            $vet->clearMediaCollection('vetGallery');
            $vet->addMediaFromRequest('logo')->toMediaCollection('vetGallery');
        }

        $vet->save();
        return redirect()->route('vets.index')->with('success', 'Albergue actualizado correctamente');
    }

    public function show(Vet $vets)
    {
    }

    public function vetsView()
    {
        $vets = Vet::all();
        return view('vetsView', compact('vets'));
    }
}
