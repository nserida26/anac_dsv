<?php

namespace App\Http\Controllers;

use App\Models\EtatDemande;
use Illuminate\Http\Request;
use App\Models\OrdreRecette;
use App\Models\Facture;
use App\Models\Paiement;

class DafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ordres = OrdreRecette::with('demande')->get();
        $factures = Facture::with('demande')->get();
        $paiements = Paiement::with('demande')->get();
        return view('daf.index', compact('ordres', 'factures', 'paiements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(OrdreRecette $ordre)
    {
        return view('daf.create', compact('ordre'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'demande_id' => 'required|exists:demandes,id',
            'montant' => 'required|numeric|min:0',
            'date_facture' => 'required|date',
            'date_limite' => 'required|date'
        ]);

        if ($request->hasFile('facture')) {
            $facturePath = $request->file('facture')->store('paiements', 'public');
        } else {
            $facturePath = null;
        }
        $facture = Facture::create([
            'demande_id' => $request->demande_id,
            'montant' => $request->montant,
            'reference' => 'FA-' . strtoupper(uniqid()), // Génération de référence unique
            'date_facture' => $request->date_facture,
            'date_limite' => $request->date_limite,
            'statut' => 'Facturée',
            'facture' => $facturePath
        ]);
        $paiement = Paiement::create(
            [
                'demande_id' => $request->demande_id,
                'montant' => $request->montant,
                'reference' => 'PA-' . strtoupper(uniqid()), // Génération de référence unique
                'statut' => 'En attente'
            ]
        );
        $etat_demande = EtatDemande::where('demande_id', $request->demande_id)->update(
            [
                'daf_demande_pay' =>  true
            ]
        );

        return redirect()->route('daf')->with('success', 'Facture créé avec succès.');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Paiement $paiement)
    {

        //
        return view('daf.show', compact('paiement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        //
        return view('daf.edit', compact('facture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {
        //
        $request->validate([
            'montant' => 'required|numeric|min:0',
            'date_facture' => 'required|date',
            'date_limite' => 'required|date'
        ]);

        if ($request->hasFile('facture')) {
            $facturePath = $request->file('facture')->store('paiements', 'public');
        } else {
            $facturePath = null;
        }
        $f = $facture->update([
            'montant' => $request->montant,
            'date_facture' => $request->date_facture,
            'date_limite' => $request->date_limite,
            'facture' => $facturePath
        ]);
        $paiement = Paiement::where('demande_id', $facture->demande_id)->update(
            [
                'montant' => $request->montant,
            ]
        );

        return redirect()->route('daf')->with('success', 'Facture mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        $facture->delete();
        return redirect()->route('daf')->with('success', 'Facture supprimée.');
        //
    }

    public function valider(Facture $facture)
    {
        $facture = $facture->update(
            [
                'statut' => 'Confirmée'
            ]
        );
        return redirect()->route('daf')->with('success', 'Facture Confirmée.');
        //
    }
    public function validerPaiement(Paiement $paiement)
    {
        $p = $paiement->update(
            [
                'statut' => 'Payé'
            ]
        );
        $etat_demande = EtatDemande::where('demande_id', $paiement->demande_id)->update(
            [
                'daf_confirme_pay' =>  true
            ]
        );

        return redirect()->route('daf')->with('success', 'Paiement Confirmée.');
        //
    }
}
