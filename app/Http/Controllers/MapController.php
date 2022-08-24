<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infrastructure;
use App\Models\InfrastructureIntervention;
class MapController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $infrastructures = Infrastructure::select('*')->get();
        return view('maps.index',['infrastructures' => $infrastructures]);
    # code...
    }

    public function getinf(Request $request){
        //json_encode();
        $interventions = InfrastructureIntervention::join('infrastructures','infrastructures.id','infrastructure_interventions.infrastructure_id')->join('type_infrastructures','type_infrastructures.id','infrastructures.type_id')
                                                    ->join('interventions','interventions.id','infrastructure_interventions.intervention_id')
                                                    ->join('intervenants','interventions.intervenant_id','intervenants.id')
                                                    ->join('projets','projets.id','interventions.projet_id')->join('bayeurs','projets.bayeur_id','bayeurs.id')->select('type_infrastructures.type as type','infrastructures.designation as infrastructure','interventions.*','intervenants.nom as intervenant','projets.designation as projet','bayeurs.nom as bayeur')->where('longitude',$request->longitude)->where('altitude',$request->altitude)->get();
        //$infra  = Infrastructure::select('*')->where('longitude',$request->longitude)->where('altitude',$request->altitude)->get();
        //$interventions = InfrastructureIntervention::join('infrastructures','infrastructures.id','infrastructure_interventions.infrastructure_id')->join('interventions','interventions.id','infrastructure_interventions.intervention_id')->select('interventions.*','infrastructures.*')->where('longitude',$request->longitude)->where('altitude',$request->altitude)->get();
        
        return $interventions;
    }
}