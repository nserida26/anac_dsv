<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use Illuminate\Support\Facades\DB;
use App\Models\Demandeur;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Page des statistiques
    public function index()
    {
        return view('admin.dashboard');
    }

    // Retourner les statistiques sous format JSON
    public function getData()
    {
        // Nombre total de demandeurs
        $nombreDemandeurs = Demandeur::count();

        // Récupérer les demandes traitées et non traitées par jour
        $demandesParJour = Demande::join('etat_demandes', 'demandes.id', 'etat_demandes.demande_id')->select(
            DB::raw('DATE(demandes.created_at) as date'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN etat_demandes.demandeur_cree_demande = 1 THEN 1 ELSE 0 END) as traitees'),
            DB::raw('SUM(CASE WHEN etat_demandes.demandeur_cree_demande = 0 THEN 1 ELSE 0 END) as non_traitees')
        )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Récupérer les demandes traitées et non traitées par mois
        $demandesParMois = Demande::join('etat_demandes', 'demandes.id', 'etat_demandes.demande_id')->select(
            DB::raw('DATE_FORMAT(demandes.created_at, "%Y-%m") as mois'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN etat_demandes.demandeur_cree_demande = 1 THEN 1 ELSE 0 END) as traitees'),
            DB::raw('SUM(CASE WHEN etat_demandes.demandeur_cree_demande = 0 THEN 1 ELSE 0 END) as non_traitees')
        )
            ->groupBy('mois')
            ->orderBy('mois', 'ASC')
            ->get();

        // Récupérer les demandes traitées et non traitées par année
        $demandesParAnnee = Demande::join('etat_demandes', 'demandes.id', 'etat_demandes.demande_id')->select(
            DB::raw('YEAR(demandes.created_at) as annee'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN etat_demandes.demandeur_cree_demande = 1 THEN 1 ELSE 0 END) as traitees'),
            DB::raw('SUM(CASE WHEN etat_demandes.demandeur_cree_demande = 0 THEN 1 ELSE 0 END) as non_traitees')
        )
            ->groupBy('annee')
            ->orderBy('annee', 'ASC')
            ->get();

        return response()->json([
            'nombreDemandeurs' => $nombreDemandeurs,
            'demandesParJour' => $demandesParJour,
            'demandesParMois' => $demandesParMois,
            'demandesParAnnee' => $demandesParAnnee,
        ]);
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
