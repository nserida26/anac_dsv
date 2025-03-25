<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demandeur;
use App\Models\EtatDemande;
use App\Models\ExamenMedical;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;

class CompagnieController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $demandeurs = $user->compagnie->demandeurs;
        $compagnie = $user->compagnie;
        return view('compagnie.index', compact('demandeurs', 'compagnie'));
    }
    public function pay($id)
    {
        $paiement = Paiement::find($id);
        return view('compagnie.pay', compact('paiement'));
    }
    public function update(Request $request, Paiement $paiement)
    {
        //
        $request->validate([
            'quittance' => 'required|file',
            'date_paiement' => 'required|date'
        ]);

        if ($request->hasFile('quittance')) {
            $quittancePath = $request->file('quittance')->store('paiements', 'public');
        } else {
            $quittancePath = null;
        }

        $user = Auth::user();
        $compagnie = $user->compagnie;
        $compagnie->update(
            [
                'panier' => $compagnie->panier + doubleval($paiement->montant)
            ]
        );

        $p = $paiement->update(
            [
                'quittance' => $quittancePath,
                'date_paiement' => $request->date_paiement,
                'statut' => 'Réglée'
            ]
        );

        $etat_demande = EtatDemande::where('demande_id', $paiement->demande_id)->update(
            [
                'compagnie_payer' => true
            ]
        );
        return redirect()->route('compagnie')->with('success', 'Paiement mis à jour avec succès.');
    }

    function valider(Demandeur $demandeur)
    {

        $valider_compagnie = $demandeur->update(
            [

                'valider_compagnie' => true,
            ]
        );

        return back()->with('success', 'Demandeur validee avec succès.');
    }
}
