<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vet;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $user = User::find($user->id);
            $isAdmin = $user->roles()->where('id', 1)->exists();

            $isVet = Vet::where('user_id', $user->id)->exists();

            if ($isAdmin || $isVet) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }

            Auth::logout();
        }

        return back()->withErrors([
            'email' => 'Las credenciales no son válidas o no tienes permisos suficientes.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
