<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;
use App\Models\VetAppointment;
use App\Models\Animal;
use App\Models\Sponsorship;
use App\Models\User;
use App\Models\Shelter;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class dashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shelter = $user->shelter;
        $shelterId = $shelter->id ?? null;

        $users = User::all();
        $totalRoles = Role::count();
        $shelters = Shelter::all();

        $totalSponsorship = Sponsorship::whereHas('animal', function ($query) use ($shelterId) {
            $query->where('shelter_id', $shelterId);
        })->count();

        $totalAdoptions = Adoption::whereHas('animal', function ($query) use ($shelterId) {
            $query->where('shelter_id', $shelterId);
        })->count();

        $role = $user->roles->first();
        $status = VetAppointment::APPOINTMENT_STATUS;
        $animals = Animal::where('shelter_id', $shelterId)->get();

        $vetAppointments = VetAppointment::with('animal')
            ->whereHas('animal', function ($query) use ($shelterId) {
                $query->where('shelter_id', $shelterId);
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
            'shelter',
            'role',
            'users',
            'totalRoles',
            'shelters',
            'totalSponsorship',
            'totalAdoptions'
        ));
    }
}
