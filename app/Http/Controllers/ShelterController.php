<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $shelters = Shelter::with('users')->orderBy('created_at', 'desc')->get();
        $shelters->map(function ($shelter) {
            $shelter->logo_url = $shelter->getFirstMediaUrl('shelterGallery');
            return $shelter;
        });

        return view('shelters.index', compact('shelters', 'users'));
    }

    public function list()
    {
        return Shelter::all();
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

        $shelter = Shelter::updateOrCreate(
            ['id' => $request->id],
            $request->only('user_id', 'name', 'phone', 'facebook', 'tiktok', 'state', 'city', 'colony', 'address', 'postal_code')
        );

        if ($request->hasFile('logo')) {
            $shelter->addMediaFromRequest('logo')->toMediaCollection('shelterGallery');
        }

        return redirect()->route('shelters.index')->with('success', 'Albergue guardado exitosamente');
    }

    public function destroy($id)
    {
        $shelter = Shelter::findOrFail($id);
        if ($shelter) {
            $shelter->clearMediaCollection('shelterGallery');
            $shelter->delete();
        }

        return redirect()->route('shelters.index')->with('success', 'Albergue eliminado exitosamente');
    }

    public function get(Request $request)
    {
        return Shelter::findOrFail($request->id);
    }

    public function edit($id)
    {
        $shelter = Shelter::findOrFail($id);
        $users = User::all();
        return view('shelters.edit', compact('shelter', 'users'));
    }

    public function create()
    {
        $users = User::all();
        return view('shelters.create', compact('users'));
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

        $shelter = Shelter::findOrFail($id);
        $shelter->fill($request->only('user_id', 'name', 'phone', 'facebook', 'tiktok', 'state', 'city', 'colony', 'address', 'postal_code'));

        if ($request->hasFile('logo')) {
            $shelter->clearMediaCollection('shelterGallery');
            $shelter->addMediaFromRequest('logo')->toMediaCollection('shelterGallery');
        }

        $shelter->save();
        return redirect()->route('shelters.index')->with('success', 'Albergue actualizado correctamente');
    }

    public function show(Shelter $shelters)
    {
    }

    public function sheltersView()
    {
        $shelters = Shelter::all();
        return view('sheltersView', compact('shelters'));
    }
}
