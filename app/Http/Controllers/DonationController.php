<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;

class DonationController extends Controller
{
    public function pdfDonation($id)
    {
        $id = Crypt::decrypt($id);
        $vet = Auth::user()->vet;
        
        $donation = Donation::where('id', $id)
            ->with(['vetMember'])
            ->firstOrFail();
        
        $vetMember = $donation->vetMember;
        
        $pdf = PDF::loadView('donations.pdfDonation', compact('donation', 'vetMember', 'vet'));
        return $pdf->stream();
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'vet_member_id' => 'required|exists:vet_member,id',
            'donation_date' => 'required|date',
            'type' => 'required|in:' .implode(',',Donation::DONATION),
            'amount' => 'required|numeric',
            'observation' => 'required|string|max:255'
        ]);

        $donation = new Donation();
        $donation->vet_member_id = $request->input('vet_member_id');
        $donation->donation_date = $request->input('donation_date');
        $donation->type = $request->input('type');
        $donation->amount = $request->input('amount');
        $donation->observation = $request->input('observation');
        $donation->save();

        return redirect()->back()->with('success', 'Donación registrada exitosamente');
    }

    public function destroy($id, Request $request)
    {
        $donation = Donation::find($id);
        $donation->delete();

        return redirect()->back()->with('success', 'Donacion eliminada exitosamente')->with('modal_id', $request->input('modal_id'));
    }
}
