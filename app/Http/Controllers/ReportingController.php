<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfrastructureIntervention;
use App\Models\Hygiene;
class ReportingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function getdata()
    {
        $reporting = InfrastructureIntervention::join('infrastructures','infrastructures.id','infrastructure_interventions.infrastructure_id')
        ->join('localites','infrastructures.localite_id','localites.id')
        ->join('communes','localites.commune_id','communes.id')
        ->join('type_infrastructures','infrastructures.type_id','type_infrastructures.id')
        ->join('latrines','infrastructures.id','latrines.infrastructure_id')
        ->join('interventions','interventions.id','infrastructure_interventions.intervention_id')
        ->join('intervenants','interventions.intervenant_id','intervenants.id')
        ->join('projets','projets.id','interventions.projet_id')
        
        ->select('type_infrastructures.type as type','infrastructures.*','interventions.designation as designationIntervention','interventions.avancement','interventions.code as codeIntervention','interventions.montant','intervenants.nom as nom','intervenants.code as codeIntervenant','projets.designation as projet','projets.code as codeProjet','latrines.*','localites.libele as localite','communes.libele as commune')
        //->groupBy('infrastructures.designation')
        ->get();
        //dd($reporting);
        
        
        $data  = ["data" => $reporting ];
        return $data;
        //return view('reportings.index',['reporting' => $reporting]);
    }
    public function gethygienes()
    {
        $hygienes = Hygiene::join('projets','projets.id','hygienes.projet_id')
        ->join('bayeurs','projets.bayeur_id','bayeurs.id')
        ->join('intervenants','intervenants.id','hygienes.intervenant_id')
        ->select('hygienes.*','projets.designation as projet','projets.date_debut as date_debut','projets.date_fin as date_fin','intervenants.nom as intervenant','bayeurs.nom as bayeur')
        ->get();
        //dd($reporting);
        
        
        $data_hygienes  = ["data" => $hygienes ];
        return $data_hygienes;
        //return view('reportings.index',['reporting' => $reporting]);
    }
}
