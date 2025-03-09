<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Empreinte;
use App\Models\EtatDemande;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $demandeurs = Demande::join('demandeurs', 'demandeurs.id', '=', 'demandes.demandeur_id')
            ->leftJoin('etat_demandes', 'etat_demandes.demande_id', '=', 'demandes.id')
            ->select(
                'demandes.*',
                'demandeurs.*',
                'etat_demandes.*',  // Ajout des colonnes de etat_demandes
                'demandes.id as demande_id',
                'demandeurs.id as demandeur_id'
            )
            ->where('etat_demandes.dg_signer', true)
            ->where('etat_demandes.dsv_signer', true)
            ->get();
        return response()->json($demandeurs);
    }

    // 📌 Enrôlement de l’empreinte
    public function enroler(Request $request)
    {
        $request->validate([
            'demandeur_id' => 'required|exists:demandeurs,id',
            'empreinte' => 'required'
        ]);

        // Hasher l'empreinte avant stockage
        $empreinteHash = hash('sha256', base64_decode($request->empreinte));

        $empreinte = Empreinte::create([
            'demandeur_id' => $request->demandeur_id,
            'empreinte_hash' => $empreinteHash
        ]);

        $etat_demande = EtatDemande::where('demande_id', $request->demande_id)->update(
            [
                'agent_enroler' => true
            ]
        );

        return response()->json(['message' => 'Empreinte enregistrée avec succès', 'empreinte' => $empreinte]);
    }

    // 📌 Vérification de l’empreinte
    public function verifier(Request $request)
    {
        $request->validate([
            'demandeur_id' => 'required|exists:demandeurs,id',
            'empreinte' => 'required'
        ]);

        $empreinteHash = hash('sha256', base64_decode($request->empreinte));
        $empreinteStockee = Empreinte::where('demandeur_id', $request->demandeur_id)->first();

        if ($empreinteStockee && $empreinteStockee->empreinte_hash === $empreinteHash) {
            return response()->json(['message' => 'Authentification réussie']);
        } else {
            return response()->json(['message' => 'Échec d’authentification'], 401);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
