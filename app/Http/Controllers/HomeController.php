<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Intervention;
use App\Models\Intervenant;
use App\Models\Bayeur;
use App\Models\Hygiene;
use App\Models\Projet;
use App\Models\Menage;
use App\Models\InfrastructureIntervention;
use App\Models\TypeInfrastructure;
use App\Models\Infrastructure;
use App\Models\Localite;
use App\Models\Commune;


use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd(Hash::make("1234"));
        $total_interventions = Intervention::count();
        $total_bayeurs = Bayeur::count();
        $total_intervenants = Intervenant::count();

        $total_projets = Projet::count();

        $total_hygienes = Hygiene::count();
        $total_menages = Menage::count();
        $projet_types = InfrastructureIntervention::join('infrastructures','infrastructures.id','infrastructure_interventions.infrastructure_id')->join('type_infrastructures','type_infrastructures.id','infrastructures.type_id')->join('interventions','interventions.id','infrastructure_interventions.intervention_id')->join('projets','projets.id','interventions.projet_id')->select(DB::raw('COUNT(projets.id) as projets'),'type_infrastructures.type')->groupBy('type_infrastructures.type')->get();

        $projet_localites = InfrastructureIntervention::join('infrastructures','infrastructures.id','infrastructure_interventions.infrastructure_id')->join('localites','localites.id','infrastructures.localite_id')->join('interventions','interventions.id','infrastructure_interventions.intervention_id')->join('projets','projets.id','interventions.projet_id')->select(DB::raw('COUNT(projets.id) as projets'),'localites.libele')->groupBy('localites.libele')->get();

        $types = TypeInfrastructure::select('type')->get();
        $localites = Localite::select('libele')->get();
        $communes = Commune::select('libele')->get();
        $projets_chart  = array();
        foreach ($types as $type) {
            # code...
            $projets_chart[$type->type] = 0;
            foreach ($projet_types as $projet_type) {
                # code...
                if ($projet_type->type == $type->type ) {
                    $projets_chart[$type->type] = $projet_type->projets;
                    # code...
                }
            }
        }

        $projets_zone_chart  = array();
        foreach ($localites as $localite) {
            # code...
            $projets_zone_chart[$localite->libele] = 0;
            foreach ($projet_localites as $projet_localite) {
                # code...
                if ($projet_localite->libele == $localite->libele ) {
                    $projets_zone_chart[$localite->libele] = $projet_localite->projets;
                    # code...
                }
            }
        }
        //dd($projets_zone_chart);

        $beneficiare_types = Infrastructure::join('type_infrastructures','infrastructures.type_id','type_infrastructures.id')->select(DB::raw('SUM(infrastructures.effectif) as effectif'),'type_infrastructures.type')->groupBy('type_infrastructures.type')->get();
        $beneficiare_chart = array();
        
        foreach ($types as $type) {
            # code...
            $beneficiare_chart[$type->type] = 0;
            foreach ($beneficiare_types as $beneficiare_type) {
                # code...
                if ($beneficiare_type->type == $type->type ) {
                    $beneficiare_chart[$type->type] = $beneficiare_type->effectif;
                    # code...
                }
            }
        }

        $infrastructure_types = Infrastructure::join('type_infrastructures','infrastructures.type_id','type_infrastructures.id')->select(DB::raw('COUNT(infrastructures.id) as c'),'type_infrastructures.type')->groupBy('type_infrastructures.type')->get();
        $infrastructure_chart = array();
        
        foreach ($types as $type) {
            # code...
            $infrastructure_chart[$type->type] = 0;
            foreach ($infrastructure_types as $infrastructure_type) {
                # code...
                if ($infrastructure_type->type == $type->type ) {
                    $infrastructure_chart[$type->type] = $infrastructure_type->c;
                    # code...
                }
            }
        }
        
        $intervention_types = InfrastructureIntervention::join('infrastructures','infrastructures.id','infrastructure_interventions.infrastructure_id')->join('type_infrastructures','type_infrastructures.id','infrastructures.type_id')->join('interventions','interventions.id','infrastructure_interventions.intervention_id')->select(DB::raw('COUNT(interventions.id) as interventions'),'type_infrastructures.type')->groupBy('type_infrastructures.type')->get();
        $intervention_chart = array();
        
        foreach ($types as $type) {
            # code...
            $intervention_chart[$type->type] = 0;
            foreach ($intervention_types as $intervention_type) {
                # code...
                if ($intervention_type->type == $type->type ) {
                    $intervention_chart[$type->type] = $intervention_type->interventions;
                    # code...
                }
            }
        }
        
        
        //dd($intervention_types);
        return view('home',['intervention_chart' => $intervention_chart,'infrastructure_chart' => $infrastructure_chart,'beneficiare_chart' => $beneficiare_chart,'projets_zone_chart' => $projets_zone_chart,'projets_chart' => $projets_chart,'total_interventions' => $total_interventions,'total_bayeurs' => $total_bayeurs,'total_intervenants' => $total_intervenants,'total_projets' => $total_projets,'total_hygienes' => $total_hygienes]);
    }
}
