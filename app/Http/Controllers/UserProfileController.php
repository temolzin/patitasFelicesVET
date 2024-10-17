<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    
    public function show()
    {
        $user = auth()->user();
        $shelter = $user->shelter;
        
        return view('profiles.users', compact('user', 'shelter'));
    }

    public function update(Request $request)
    {
        $user = auth()->user(); 

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
        ]);

        $user->update($request->all());
        return redirect()->route('user.profile')->with('success', 'Perfil actualizado con éxito.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'Las contraseñas no coinciden.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password))
        {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('password_success', '¡Contraseña actualizada correctamente!');
    }

    public function updatePicture(Request $request)
    {
        $userId = $request->input('user_id'); 
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::with('media')->findOrFail($userId); 
        $user->clearMediaCollection('userGallery');
        $user->addMedia($request->file('photo'))->toMediaCollection('userGallery');

        session(['user' => $user->refresh()]); 

        return redirect()->route('user.profile')->with('success', 'Imagen de perfil actualizada con éxito.')->with('image_updated', true);
    }

    public function updatePictureShelter(Request $request)
    {
        $shelterId = $request->input('shelter_id'); 
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shelter = User::with('media')->findOrFail($shelterId); 
        $shelter->clearMediaCollection('shelterGallery');
        $shelter->addMedia($request->file('photo'))->toMediaCollection('shelterGallery');

        session(['user' => $shelter->refresh()]); 

        return redirect()->route('user.profile')->with('success', 'Imagen de perfil actualizada con éxito.')->with('image_updated', true);
    }
}
