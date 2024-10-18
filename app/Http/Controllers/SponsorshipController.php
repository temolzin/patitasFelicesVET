<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    public function pdfSponsorship($id)
    {
        $id = Crypt::decrypt($id);
        $vet = Auth::user()->vet;

        $sponsorship = Sponsorship::where('id', $id)
            ->with(['animal.specie', 'vetMember'])
            ->firstOrFail();

        $vetMember = $sponsorship->vetMember;

        $pdf = PDF::loadView('sponsorship.pdfSponsorship', compact('sponsorship', 'vetMember', 'vet'));
        return $pdf->stream();
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'start_date' => 'required|date',
            'finish_date' => 'required|date',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'observation' => 'required|string|max:255',
            'vet_member_id' => 'required|exists:vet_member,id',
        ]);

        $sponsorship = new Sponsorship();
        $sponsorship->animal_id = $request->input('animal_id');
        $sponsorship->vet_member_id = $request->input('vet_member_id');
        $sponsorship->start_date = $request->input('start_date');
        $sponsorship->finish_date = $request->input('finish_date');
        $sponsorship->payment_date = $request->input('payment_date');
        $sponsorship->amount = $request->input('amount');
        $sponsorship->observation = $request->input('observation');

        $sponsorship->save();

        $sponsorships = Sponsorship::store('created_at', 'desc')->get();

        return view('sponsorships.index', compact('sponsorships'))->with('success', 'Apadrinamiento registrado exitosamente.');
    }

    public function destroy($id, Request $request)
    {
        $sponsorship = Sponsorship::find($id);
        $sponsorship->delete();
        return redirect()->back()->with('success', 'Apadrinamiento eliminada exitosamente')->with('modal_id', $request->input('modal_id'));
    }
}
