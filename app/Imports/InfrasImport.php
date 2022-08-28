<?php

namespace App\Imports;
use Illuminate\Support\Str;
use DateTime;

use App\Models\Latrine;
use Illuminate\Support\Facades\DB;
use App\Models\Infrastructure;
use App\Models\InfrastructureIntervention;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Localite;
use App\Models\Projet;
use App\Models\Intervenant;
use App\Models\TypeInfrastructure;

use App\Models\Intervention;


class InfrasImport implements ToCollection, WithHeadingRow
{
    private $infrastructures;
    private $localites;
    private $types;
    private $projets;
    private $intervenants;
    private $latrines;
    private $interventions;
    private $infrastructureinterventions;
    
    //public $message;
    public function __construct()
    {
        $this->infrastructures = Infrastructure::select('id','longitude','altitude')->get(); 
        $this->localites = Localite::select('id','libele')->get(); 
        $this->projets = Projet::select('code','id')->get(); 
        $this->intervenants = Intervenant::select('id','code')->get(); 
        $this->types = TypeInfrastructure::select('id','type')->get(); 
        $this->interventions = Intervention::select('id','designation')->get(); 
        $this->latrines = Latrine::select('*')->get(); 
        $this->infrastructureinterventions = InfrastructureIntervention::select('*')->get(); 
        
        # code...
    }
    //HeadingRowFormatter::default('none');
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        foreach ($rows as $row) 
        {
            $localite_id = $this->localites->where('libele',$row['localite'])->first();
            //dd($this->localites);
            $projet_id = $this->projets->where('code',$row['code_projet'])->first();
            $type_id = $this->types->where('type',$row['type'])->first();
            $intervenant_id = $this->intervenants->where('code',$row['code_intervenant'])->first();
            
            $infrastructure_id = $this->infrastructures->where('longitude',$row['longitude'])->where('altitude',$row['altitude'])->first();
            $intervention_id = $this->interventions->where('designation',$row['designation_intervention'])->first();
            
            if (!isset($infrastructure_id)) {
                # code...
                $infra = DB::table('infrastructures')->create([ 
                    'designation' => $row['designation'],
                    //'type' => $row['type'],
                    'date_construction' => $row['annnee_construction'],
                    'effectif' => $row['effectif'],
                    'source_eau' => $row['source_d_eau'],
                    'longitude' => $row['longitude'],
                    'altitude' => $row['altitude'],
                    'localite_id' => $localite_id->id,
                    'type_id' => $type_id->id
                ]);
                $infrastructure_id = $infra;
            }
            if (!isset($intervention_id)) {
                # code...
                $intervention = DB::table('interventions')->create([ 
                    'designation' => $row['designation_intervention'],
                    'code' => Str::random(4),
                    'montant' => $row['montant'],
                    'avancement' => $row['avancement'],
                    'projet_id' => $projet_id->id,
                    'intervenant_id' => $intervenant_id->id
                ]);
                $intervention_id = $intervention;
            }else{
                $intervention = DB::table('interventions')->update([ 
                    'designation' => $row['designation_intervention'],
                    'code' => Str::random(4),
                    'montant' => $row['montant'],
                    'avancement' => $row['avancement'],
                    'projet_id' => $projet_id->id,
                    'intervenant_id' => $intervenant_id->id
                ]);
                $intervention_id = $intervention;
            }
            //dd($intervenant_id->id);
            
            
            
            $dt = new DateTime();
            $date_today  = $dt->format('Y-m-d');
            ///dd();
            //$intervention_id = Intervention::select('id')->where('logitude',$row['logitude'],'altitude',$row['altitude'])->first()->get();
            InfrastructureIntervention::create([
                'infrastructure_id' => $infrastructure_id->id,
                'intervention_id' => $intervention_id,
                'date_intervention' => $date_today
            ]);
            $latrine_id = $this->latrines->where('type_bloc',$row['type_bloc'])->where('nbr_bloc',$row['nbr_bloc'])->where('infrastructure_id',$infrastructure_id->id)->first();
            //dd(isset($latrine_id));
            if (!isset($latrine_id)) {
                # code...
                Latrine::create([
                    'type_bloc' => $row['type_bloc'],
                    'nbr_bloc' => $row['nbr_bloc'],
                    'infrastructure_id' => $infrastructure_id->id
                ]);
            }else{
                dd($latrine_id);
            }

        }
    }

}
