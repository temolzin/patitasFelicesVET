<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\VetMember;
use App\Models\Sponsorship;
use App\Models\Adoption;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;

class VetMemberController extends Controller
{
    public function godfatherIndex(Request $request)
    {
        $user = Auth::user();
        $vetId = $user->vet->id;
        
        $animals = Animal::where('vet_id', $vetId)
        ->whereDoesntHave('sponsorships', function($query) {
            $query->where('finish_date', '>', now());
        })
        ->get();

        $vetMember = VetMember::where('vet_id', $vetId)
            ->where('type_member',VetMember::TYPE_MEMBER_GODFATHER)
            ->get();

        $sponsorships = Sponsorship::whereIn('vet_member_id', $vetMember->pluck('id'))
            ->with('animal')
            ->get()
            ->groupBy('vet_member_id');

        $typeMember = VetMember::TYPE_MEMBER_GODFATHER;

        return view('vetMembers.godfather', compact('vetMember', 'typeMember','animals', 'sponsorships'));
    }

    public function donorIndex(Request $request)
    {
        $user = Auth::user();

        $vetId = $user->vet->id;

        $vetMember = VetMember::where('vet_id', $vetId)
            ->where('type_member',VetMember::TYPE_MEMBER_DONOR)
            ->get();
           
        $vetMember->map(function ($vetMember) {
            $vetMember->photo_url = $vetMember->getFirstMediaUrl('photos');
            return $vetMember;
        });
        
        $donations = Donation::all();
        $type = Donation::DONATION;
        $typeMember = VetMember::TYPE_MEMBER_DONOR;
        return view('vetMembers.donor', compact('vetMember', 'typeMember', 'type', 'donations'));
    }

    public function adopterIndex(Request $request)
    {
        $user = Auth::user();
        $vetId = $user->vet->id;

        $animals = Animal::where('vet_id', $vetId)
            ->whereDoesntHave('adoption')
            ->orderBy('created_at', 'desc')
            ->get();

        $vetMembers = VetMember::where('vet_id', $vetId)
            ->where('type_member', VetMember::TYPE_MEMBER_ADOPTER)
            ->orderBy('created_at', 'desc')
            ->get();

        $adoptions = Adoption::all();

        $typeMember = VetMember::TYPE_MEMBER_ADOPTER;

        return view('vetMembers.adopter', compact('vetMembers', 'typeMember', 'animals', 'adoptions'));
    }

    public function staffIndex(Request $request)
    {
        $user = Auth::user();

        $vetId = $user->vet->id;

        $vetMember = VetMember::where('vet_id', $vetId)
            ->where('type_member', VetMember::TYPE_MEMBER_STAFF)
            ->get();
        $vetMember->map(function ($vetMember) {
            $vetMember->photo_url = $vetMember->getFirstMediaUrl('photos');
            return $vetMember;
        });

        $typeMember = VetMember::TYPE_MEMBER_STAFF;

        return view('vetMembers.staff', compact('vetMember', 'typeMember'));
    }


    public function list()
    {

        $vetMember = VetMember::all();
        return $vetMember;
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'type_member' => 'required|in:' . implode(',', VetMember::TYPE_MEMBER),
        ]);

        $user = Auth::user();

        $vet = $user->vet;

        $vetMember = new VetMember();
        $vetMember->name = $request->input('name');
        $vetMember->last_name = $request->input('last_name');
        $vetMember->phone = $request->input('phone');
        $vetMember->email = $request->input('email');
        $vetMember->state = $request->input('state');
        $vetMember->city = $request->input('city');
        $vetMember->colony = $request->input('colony');
        $vetMember->address = $request->input('address');
        $vetMember->postal_code = $request->input('postal_code');
        $vetMember->type_member = $request->input('type_member');
        $vetMember->vet_id = $vet->id;

        if ($request->hasFile('photo')) {
            $vetMember->addMediaFromRequest('photo')->toMediaCollection('photos');
        }

        $vetMember->save();

        return redirect()->back()->with('success', 'Miembro registrado exitosamente.');
    }

    public function destroy($id)
    {
        $vetMember = Vetmember::find($id);
        if ($vetMember) {
            $vetMember->clearMediaCollection('photos');
            $vetMember->delete();
        }
        return redirect()->back()->with('success', 'Miembro eliminada exitosamente');
    }

    public function get(Request $request)
    {
        $vetMember = VetMember::find($request->id);
        return $vetMember;
    }

    public function edit($id)
    {
        $vetMember = VetMember::find($id);
        return view('vetMembers.info', compact('vetMember'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);
        $vetMember = VetMember::find($id);
        if ($vetMember) {
            $vetMember->update($request->except('photo'));
            if ($request->hasFile('photo')) {
                $vetMember->clearMediaCollection('photos');
                $vetMember->addMediaFromRequest('photo')->toMediaCollection('photos');
            }
            $vetMember->name = $request->input('name');
            $vetMember->last_name = $request->input('last_name');
            $vetMember->phone = $request->input('phone');
            $vetMember->email = $request->input('email');
            $vetMember->state = $request->input('state');
            $vetMember->city = $request->input('city');
            $vetMember->colony = $request->input('colony');
            $vetMember->address = $request->input('address');
            $vetMember->postal_code = $request->input('postal_code');

            $vetMember->save();
        }
        return redirect()->back()->with('success', 'Miembro actualizada correctamente');
    }

    public function show(VetMember $vetMember)
    {
    }
}
