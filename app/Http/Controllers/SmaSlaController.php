<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\CompetenceDemandeur;

use App\Models\LicenceDemandeur;

use App\Models\Document;
use App\Models\EmployeurDemandeur;
use App\Models\EtatDemande;
use App\Models\ExperienceDemandeur;
use App\Models\ExperienceMaintenanceDemandeur;
use App\Models\ExprienceMaintenanceDemandeur;
use App\Models\FormationDemandeur;
use App\Models\InterruptionDemandeur;
use App\Models\MedicalExamination;
use App\Models\QualificationDemandeur;
use App\Models\TrainingDemandeur;
use App\Models\ExamenMedical;

class SmaSlaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $demandes = Demande::with('demandeur')->where('status', '<>', 'En attente')->get();

        return view('sec.index', compact('demandes'));
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
        $demande = Demande::find($id);
        $demandeur = $demande->demandeur;
        $examens = $demande->demandeur->examens;
        $formations = $demande->demandeur->formations;
        //
        $licence_demandeurs = LicenceDemandeur::join('demandes', 'demandes.id', 'licence_demandeurs.demande_id')
            ->where('licence_demandeurs.demande_id', $id)
            ->select('licence_demandeurs.*')
            ->get();
        $formation_demandeurs = FormationDemandeur::join('demandes', 'demandes.id', 'formation_demandeurs.demande_id')
            ->join('centre_formations', 'centre_formations.id', 'formation_demandeurs.centre_formation_id')
            ->where('formation_demandeurs.demande_id', $id)
            ->select('centre_formations.libelle as centre_formation', 'formation_demandeurs.*')
            ->get();
        $qualification_demandeurs = QualificationDemandeur::join('demandes', 'demandes.id', 'qualification_demandeurs.demande_id')
            ->join('qualifications', 'qualifications.id', 'qualification_demandeurs.qualification_id')
            ->join('centre_formations', 'centre_formations.id', 'qualification_demandeurs.centre_formation_id')
            ->where('qualification_demandeurs.demande_id', $id)
            ->select('centre_formations.libelle as centre_formation', 'qualifications.libelle as qualification', 'qualification_demandeurs.*')
            ->get();
        $medical_examinations = MedicalExamination::join('demandes', 'demandes.id', 'medical_examinations.demande_id')
            ->join('centre_medicals', 'centre_medicals.id', 'medical_examinations.centre_medical_id')
            ->where('medical_examinations.demande_id', $id)
            ->select('centre_medicals.libelle as centre_medical', 'medical_examinations.*')
            ->get();
        $experience_demandeurs = ExperienceDemandeur::join('demandes', 'demandes.id', 'experience_demandeurs.demande_id')
            ->where('experience_demandeurs.demande_id', $id)
            ->select('experience_demandeurs.*')
            ->get();


        $competence_demandeurs = CompetenceDemandeur::join('demandes', 'demandes.id', 'competence_demandeurs.demande_id')
            ->join('centre_formations', 'centre_formations.id', 'competence_demandeurs.centre_formation_id')
            ->where('competence_demandeurs.demande_id', $id)
            ->select('centre_formations.libelle as centre_formation', 'competence_demandeurs.*')
            ->get();


        $entrainement_demandeurs = TrainingDemandeur::join('demandes', 'demandes.id', 'training_demandeurs.demande_id')
            ->join('centre_formations', 'centre_formations.id', 'training_demandeurs.centre_formation_id')
            ->where('training_demandeurs.demande_id', $id)
            ->select('centre_formations.libelle as centre_formation', 'training_demandeurs.*')
            ->get();
        $interruption_demandeurs = InterruptionDemandeur::join('demandes', 'demandes.id', 'interruption_demandeurs.demande_id')
            ->where('interruption_demandeurs.demande_id', $id)
            ->select('interruption_demandeurs.*')
            ->get();
        $experience_maintenance_demandeurs = ExperienceMaintenanceDemandeur::join('demandes', 'demandes.id', 'experience_maintenance_demandeurs.demande_id')
            ->where('experience_maintenance_demandeurs.demande_id', $id)
            ->select('experience_maintenance_demandeurs.*')
            ->get();
        $employeur_demandeurs = EmployeurDemandeur::join('demandes', 'demandes.id', 'employeur_demandeurs.demande_id')
            ->where('employeur_demandeurs.demande_id', $id)
            ->select('employeur_demandeurs.*')
            ->get();
        $documents = Document::join('demandes', 'demandes.id', 'documents.demande_id')
            ->where('documents.demande_id', $id)
            ->select('documents.*')
            ->get();



        return view('sec.show', compact('formations', 'licence_demandeurs', 'examens', 'demande', 'demandeur', 'employeur_demandeurs', 'experience_maintenance_demandeurs', 'interruption_demandeurs', 'formation_demandeurs', 'documents', 'entrainement_demandeurs', 'competence_demandeurs', 'experience_demandeurs', 'medical_examinations', 'qualification_demandeurs'));
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
    function validerSla($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [

                'sl_valider' => true,
            ]
        );

        return back()->with('success', 'Demande annotée avec succès.');
    }
    function validerSma($id)
    {


        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'sm_valider' => true,
            ]
        );

        return back()->with('success', 'Demande annotée avec succès.');
    }
    public function valider(ExamenMedical $examen)
    {
        $examen->update(
            [
                'valider_sma' => true
            ]
        );
        return redirect()->route('sma')->with('success', 'Examen médical validé.');
    }
    public function rejeter($table, $id, Demande $demande)
    {
        // Vérifiez si la table existe dans la base de données
        if (!DB::getSchemaBuilder()->hasTable($table)) {
            return redirect()->back()->with('error', 'Table non trouvée.');
        }

        // Vérifiez si la colonne 'valider' existe dans la table
        if (!DB::getSchemaBuilder()->hasColumn($table, 'valider')) {
            return redirect()->back()->with('error', 'Colonne "valider" non trouvée dans la table.');
        }

        // Mettez à jour la valeur du booléen 'valider' à 0
        DB::table($table)->where('id', $id)->update(['valider' => 0]);

        $demande->etatDemande()->update(
            [
                'demandeur_cree_demande' => 0
            ]
        );

        return redirect()->back()->with('success', 'Information rejetée avec succès.');
    }
}
