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
        $shelter = Auth::user()->shelter;
        
        $donation = Donation::where('id', $id)
            ->with(['shelterMember'])
            ->firstOrFail();
        
        $shelterMember = $donation->shelterMember;
        
        $pdf = PDF::loadView('donations.pdfDonation', compact('donation', 'shelterMember', 'shelter'));
        return $pdf->stream();
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'shelter_member_id' => 'required|exists:shelter_member,id',
            'donation_date' => 'required|date',
            'type' => 'required|in:' .implode(',',Donation::DONATION),
            'amount' => 'required|numeric',
            'observation' => 'required|string|max:255'
        ]);

        $donation = new Donation();
        $donation->shelter_member_id = $request->input('shelter_member_id');
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
