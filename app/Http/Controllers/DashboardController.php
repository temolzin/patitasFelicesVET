<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;
use App\Models\VetAppointment;
use App\Models\Animal;
use App\Models\Sponsorship;
use App\Models\User;
use App\Models\Vet;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class dashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $vet = $user->vet;
        $vetId = $vet->id ?? null;

        $users = User::all();
        $totalRoles = Role::count();
        $vets = Vet::all();

        $totalSponsorship = Sponsorship::whereHas('animal', function ($query) use ($vetId) {
            $query->where('vet_id', $vetId);
        })->count();

        $totalAdoptions = Adoption::whereHas('animal', function ($query) use ($vetId) {
            $query->where('vet_id', $vetId);
        })->count();

        $role = $user->roles->first();
        $status = VetAppointment::APPOINTMENT_STATUS;
        $animals = Animal::where('vet_id', $vetId)->get();

        $vetAppointments = VetAppointment::with('animal')
            ->whereHas('animal', function ($query) use ($vetId) {
                $query->where('vet_id', $vetId);
            })
            ->get();

        $appointments = [];
        foreach ($vetAppointments as $appointment) {
            $appointments[] = [
                'title' => $appointment->animal->name . ': ' . $appointment->reason,
                'start' => $appointment->schedule_date,
                'description' => $appointment->observation
            ];
        }

        return view('dashboard', compact(
            'appointments',
            'animals',
            'status',
            'vetAppointments',
            'user',
            'vet',
            'role',
            'users',
            'totalRoles',
            'vets',
            'totalSponsorship',
            'totalAdoptions'
        ));
    }
}
