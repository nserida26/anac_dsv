<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Demande;

use App\Models\CompetenceDemandeur;

use App\Models\Document;
use App\Models\EmployeurDemandeur;
use App\Models\EtatDemande;
use App\Models\ExperienceDemandeur;
use App\Models\ExperienceMaintenanceDemandeur;
use App\Models\ExprienceMaintenanceDemandeur;
use App\Models\FormationDemandeur;
use App\Models\InterruptionDemandeur;
use App\Models\Licence;
use App\Models\MedicalExamination;
use App\Models\QualificationDemandeur;
use App\Models\TrainingDemandeur;

class AdminController extends Controller
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
        return view('admin.demandes.index', compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function licences()
    {
        $licences = Licence::all();

        return view('admin.licences.index', compact('licences'));

        //
    }

    public function showLicence(Licence $licence)
    {
        //

        return view('admin.licences.show', compact('licence'));
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

        //
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



        return view('admin.demandes.show', compact('demande', 'demandeur', 'employeur_demandeurs', 'experience_maintenance_demandeurs', 'interruption_demandeurs', 'formation_demandeurs', 'documents', 'entrainement_demandeurs', 'competence_demandeurs', 'experience_demandeurs', 'medical_examinations', 'qualification_demandeurs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLicence(Request $request, Licence $licence)
    {

        $licence->update([
            'date_deliverance' => $request->date_deliverance,
            'date_mise_a_jour' => $request->date_mise_a_jour,
            'date_expiration' => $request->date_deliverance,
        ]);

        return redirect()->route('licences')->with('success', 'Licence mis à jour.');

        //
    }

    public function validerLicence(Licence $licence)
    {
        $etat_demande = $licence->update(
            [
                'licence_valide' => true
            ]
        );

        $etat_demande = $licence->demande->etatDemande->update(
            [
                'pel_licence_valider' => true
            ]
        );

        return back()->with('success', 'Licence validée avec succès.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demande $demande)
    {
        //
        $request->validate([
            'description' => 'required|string',
        ]);


        $demande->update([
            'description' => $request->description,
        ]);

        return redirect()->route('demandes')->with('success', 'Demande mis à jour.');
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
    public function annoterDemande($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'pel_annoter' => true
            ]
        );

        return back()->with('success', 'Demande annotée avec succès.');
    }
    public function valider($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'pel_valider' => true
            ]
        );

        return back()->with('success', 'Demande validée avec succès.');
    }
    public function enroller($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'pel_valider_enrol' => true
            ]
        );

        return back()->with('success', 'Demandeur enrolée avec succès.');
    }
}
