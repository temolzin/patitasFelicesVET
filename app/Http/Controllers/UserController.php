<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $roles = Role::all();
        $users = User::where('id', '!=', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('users.index', compact('users', 'roles'));
    }

    public function list()
    {

        $users = User::all();
        return $users;
    }

    public function store(Request $request)
    {
        $validationMessages = [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.unique' => 'Este número de teléfono ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:users,phone',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
       ], $validationMessages);
        if ($request->id == 0) {
            $users = new User();
        } else {
            $users = User::find($request->id);
        }
        $users->name = $request->input('name');
        $users->last_name = $request->input('last_name');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');
        $users->password = bcrypt($request->input('password'));
        if ($request->hasFile('photo')) {
            $users->addMediaFromRequest('photo')->toMediaCollection('photo');
        }
        $users->save();
        $users->roles()->sync($request->roles);

        return redirect()->back()->with('success', 'Usuario guardado exitosamente');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->clearMediaCollection('photo');
            $user->delete();
        }
    
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente');
    }

    public function get(Request $request)
    {
        $users = User::find($request->id);
        return $users;
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.assignRole', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:users,phone,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'email_verified_at' => 'nullable',
        ]);
        $users = User::find($id);
        if ($users) {
            $users->name = $request->input('name');
            $users->last_name = $request->input('last_name');
            $users->phone = $request->input('phone');
            $users->email = $request->input('email');
            $users->email_verified_at = $request->input('email_verified_at') ? $request->input('email_verified_at') : null;
            $users->update($request->except('photo'));
            if ($request->hasFile('photo')) {
                $users->clearMediaCollection('photo');
                $users->addMediaFromRequest('photo')->toMediaCollection('photo');
            }
            $users->save();
            $users->roles()->sync($request->roles);
        }
        return redirect()->back()->with('success', 'Usuario actualizado correctamente');
    }

    public function updateRole(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('users.index')->with('success', 'Roles asignados correctamente');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find($id);

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('users.index')->with('success', 'Contraseña actualizada correctamente');
        }

        return redirect()->route('users.index')->with('error', 'Usuario no encontrado');
    }

    public function show(User $users)
    {
    }
}
