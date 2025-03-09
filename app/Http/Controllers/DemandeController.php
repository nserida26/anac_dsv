<?php

namespace App\Http\Controllers;

use App\Models\Autorite;
use App\Models\CentreFormation;
use App\Models\CentreMedical;
use App\Models\CompetenceDemandeur;
use App\Models\Demande;
use App\Models\Demandeur;
use App\Models\TypeAvion;
use App\Models\Document;
use App\Models\EmployeurDemandeur;
use App\Models\EtatDemande;
use App\Models\ExperienceDemandeur;
use App\Models\ExperienceMaintenanceDemandeur;
use App\Models\ExprienceMaintenanceDemandeur;
use App\Models\FormationDemandeur;
use App\Models\InterruptionDemandeur;
use App\Models\MedicalExamination;
use App\Models\Qualification;
use App\Models\QualificationDemandeur;
use App\Models\Simulateur;
use App\Models\TrainingDemandeur;
use App\Models\Facture;
use App\Models\LicenceDemandeur;
use App\Models\Paiement;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    //

    public function index()
    {
        // Joining with users
        $demandes = Demande::join('demandeurs', 'demandeurs.id', '=', 'demandes.demandeur_id')
            ->leftJoin('etat_demandes', 'etat_demandes.demande_id', '=', 'demandes.id')
            ->leftJoin('paiements', 'paiements.demande_id', '=', 'demandes.id')
            ->select(
                'demandes.*',
                'demandeurs.*',
                'etat_demandes.*',  // Ajout des colonnes de etat_demandes
                'paiements.*',
                'paiements.id as paiement_id',
                'demandes.id as demande_id',
                'demandeurs.id as demandeur_id'
            )
            ->where('demandeurs.user_id', auth()->id())
            ->get();


        return view('user.index', compact('demandes'));
    }
    public function create()
    {
        $demandeur = Demandeur::all();
        return view('user.create', compact('demandeur'));
    }

    public function pay($id)
    {
        $paiement = Paiement::find($id);
        return view('user.pay', compact('paiement'));
    }
    public function store(Request $request)
    {
        $code = rand(1000, 9999);

        $demandeur = Demandeur::where('user_id', auth()->id())->first();
        $request->validate([
            'objet_licence' => 'required|string',
            'type_licence' => 'required|string',
            'specialite' => 'nullable|string',
        ]);


        // Créer l demande
        $demande = Demande::create(array_merge($request->all(), ['status' => 'En attente'], ['date' => date('Y-m-d')], ['code' => $code], ['demandeur_id' => $demandeur->id]));
        $etat_demande = EtatDemande::create([
            'demande_id' => $demande->id,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('user')->with('success', 'Demande créée avec succès.');
    }

    public function edit($id)
    {
        $demande = Demande::find($id);
        $qualifications = Qualification::all();
        $centre_formations = CentreFormation::all();
        $simulateurs = Simulateur::all();
        $centre_medicals = CentreMedical::all();
        $autorites = Autorite::all();

        $type_avions = TypeAvion::all();

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
            //->join('demandes', 'demandes.demande_id', 'demandeurs.id')
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



        return view('user.edit', compact('type_avions', 'licence_demandeurs', 'autorites', 'id', 'employeur_demandeurs', 'experience_maintenance_demandeurs', 'interruption_demandeurs', 'formation_demandeurs', 'documents', 'entrainement_demandeurs', 'competence_demandeurs', 'experience_demandeurs', 'medical_examinations', 'qualification_demandeurs', 'demande', 'centre_formations', 'qualifications', 'simulateurs', 'centre_medicals'));
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

        $p = $paiement->update(
            [
                'quittance' => $quittancePath,
                'date_paiement' => $request->date_paiement,
                'statut' => 'Réglée'
            ]
        );

        $etat_demande = EtatDemande::where('demande_id', $paiement->demande_id)->update(
            [
                'demandeur_payer' => true
            ]
        );
        return redirect()->route('user')->with('success', 'Paiement mis à jour avec succès.');
    }

    public function validateDemande($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->status = 'En cours de traitement';
        $demande->save();
        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'demandeur_cree_demande' => true
            ]
        );

        return back()->with('success', 'Demande validée avec succès.');
    }

    public function destroy($id)
    {
        $demande = Demande::findOrFail($id);

        $demande->delete();
        return redirect()->back()->with('success', 'Demande supprimée avec succès.');
    }

    public function storeLicences(Request $request)
    {
        $request->validate([
            'date_licence' => 'required|date',
            'lieu_delivrance' => 'required',
            'autorite_id' => 'required',
            'num_licence' => 'required'
        ]);
        // Créer l Licence demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }

        $licence_demandeur = LicenceDemandeur::create(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Licence créée avec succès.');
    }
    public function updateLicences(Request $request, LicenceDemandeur $licence_demandeur)
    {
        $request->validate([
            'date_licence' => 'required|date',
            'lieu_delivrance' => 'required',
            'autorite_id' => 'required',
            'num_licence' => 'required'
        ]);
        // Créer l Licence demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }

        $licence_demandeur = $licence_demandeur->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Licence mis a jour avec succès.');
    }

    public function destroyLicences(LicenceDemandeur $licence_demandeur)
    {
        // Supprimer l'enregistrement
        $licence_demandeur->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Licence supprimée avec succès.');
    }

    public function storeFormations(Request $request)
    {

        $request->validate([
            'date_formation' => 'required|date',
            'lieu' => 'required',
            'centre_formation_id' => 'required',
            'document' => 'required|file|mimes:pdf'
        ]);
        if ($request->hasFile('document')) {

            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }


        $formation_demandeur = FormationDemandeur::create(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Formation créée avec succès.');
    }
    public function updateFormations(Request $request, FormationDemandeur $formation)
    {
        $request->validate([
            'date_formation' => 'required|date',
            'lieu' => 'required',
            'centre_formation_id' => 'required',
        ]);

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }

        $formation_demandeur = $formation->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Formation mis a jour avec succès.');
    }
    public function destroyFormations(FormationDemandeur $formation)
    {
        // Supprimer l'enregistrement
        $formation->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Formation supprimée avec succès.');
    }


    public function storeQualifications(Request $request)
    {

        $request->validate([
            'qualification_id' => 'required',
            //'type_avion_id' => 'required',
            'date_examen' => 'required|date',
            'lieu' => 'required',
            'centre_formation_id' => 'required',
        ]);
        // Créer l Qualifications demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $qualification_demandeur = QualificationDemandeur::create(array_merge($request->all(), ['document' => $documentPath]));

        return redirect()->back()->with('success', 'Qualification créée avec succès.');
    }

    public function updateQualifications(Request $request, QualificationDemandeur $qualification_demandeur)
    {
        $request->validate([
            'qualification_id' => 'required',
            //'type_avion_id' => 'required',
            'date_examen' => 'required|date',
            'lieu' => 'required',
            'centre_formation_id' => 'required',
        ]);
        // Créer l Qualifications demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $qd = $qualification_demandeur->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Qualification mis a jour avec succès.');
    }
    public function destroyQualifications(QualificationDemandeur $qualification_demandeur)
    {
        // Supprimer l'enregistrement
        $qualification_demandeur->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Qualification supprimée avec succès.');
    }


    public function storeAptitudes(Request $request)
    {


        $request->validate([
            'date_examen' => 'required|date',
            'validite' => 'required',
            'centre_medical_id' => 'required',
        ]);
        // Créer l Aptitude demande


        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }

        $medical_examination = MedicalExamination::create(array_merge($request->all(), ['document' => $documentPath]));

        return redirect()->back()->with('success', 'Aptitude créée avec succès.');
    }
    public function updateAptitudes(Request $request, MedicalExamination $medical_examination)
    {

        $request->validate([
            'date_examen' => 'required|date',
            'validite' => 'required',
            'centre_medical_id' => 'required',
        ]);
        // Créer l Aptitude demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $md = $medical_examination->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Aptitude mis a jour avec succès.');
    }
    public function destroyAptitudes(MedicalExamination $medical_examination)
    {
        // Supprimer l'enregistrement
        $medical_examination->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Aptitude supprimée avec succès.');
    }


    public function storeExpriences(Request $request)
    {

        $request->validate([
            'nature' => 'required',
            'total' => 'required',
            'six_mois' => 'required',
            'trois_mois' => 'required',
        ]);
        // Créer l Experience demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $experience_demandeur = ExperienceDemandeur::create(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Experience créée avec succès.');
    }
    public function updateExpriences(Request $request, ExperienceDemandeur $experience_demandeur)
    {

        $request->validate([
            'nature' => 'required',
            'total' => 'required',
            'six_mois' => 'required',
            'trois_mois' => 'required',
        ]);

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $ed = $experience_demandeur->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Experience mis a jour avec succès.');
    }
    public function destroyExpriences(ExperienceDemandeur $experience_demandeur)
    {
        // Supprimer l'enregistrement
        $experience_demandeur->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Experience supprimée avec succès.');
    }


    public function storeCompetences(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'date' => 'required',
            'validite' => 'required',
            'centre_formation_id' => 'required',
        ]);
        // Créer l Aptitude demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $competence_demandeur = CompetenceDemandeur::create(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Competence créée avec succès.');
    }

    public function updateCompetences(Request $request, CompetenceDemandeur $competence_demandeur)
    {

        $request->validate([
            'type' => 'required',
            'niveau' => 'nullable|required',
            'date' => 'required',
            'validite' => 'required',
            'centre_formation_id' => 'required',
        ]);
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $cd = $competence_demandeur->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Competence mis a jour avec succès.');
    }

    public function destroyCompetences(CompetenceDemandeur $competence_demandeur)
    {
        // Supprimer l'enregistrement
        $competence_demandeur->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Competence supprimée avec succès.');
    }

    public function storeEntrainements(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'date' => 'required',
            'validite' => 'required',
            'centre_formation_id' => 'required',
        ]);
        // Créer l Aptitude demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $training_demandeur = TrainingDemandeur::create(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Entrainement créée avec succès.');
    }

    public function updateEntrainements(Request $request, TrainingDemandeur $training_demandeur)
    {
        $request->validate([
            'type' => 'required',
            'date' => 'required',
            'validite' => 'required',
            'centre_formation_id' => 'required',
        ]);
        // Créer l Aptitude demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $training_demandeur = $training_demandeur->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Entrainement mis a jour avec succès.');
    }

    public function destroyEntrainements(TrainingDemandeur $training_demandeur)
    {
        // Supprimer l'enregistrement
        $training_demandeur->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Entrainement supprimée avec succès.');
    }

    public function storeDocuments(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'piece' => 'required|mimes:pdf',
            'demande_id' => 'required',
        ]);


        if ($request->hasFile('piece')) {
            $documentPath = $request->file('piece')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $document = Document::create(array_merge(['demande_id' => $request->demande_id], ['url' => $documentPath], ['libelle' => $request->libelle]));
        return response()->json([
            'success' => 'Document ajouté avec succès',
            'document' => $document
        ]);
    }

    public function updateDocuments(Request $request, Document $document)
    {
        $request->validate([
            'libelle' => 'required',
            'piece' => 'required|mimes:pdf',
        ]);
        // Créer l Aptitude demande

        if ($request->hasFile('piece')) {
            $documentPath = $request->file('piece')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $doc = $document->update(array_merge(['url' => $documentPath], ['libelle' => $request->libelle]));
        $updatedDocument = Document::find($document->id);
        return response()->json([
            'success' => 'Document mis à jour avec succès',
            'document' => $updatedDocument
        ]);
    }

    public function destroyDocuments(Document $document)
    {

        // Supprimer l'enregistrement
        $document->delete();

        // Redirection avec un message de succès
        return response()->json(['success' => 'Document supprimé avec succès']);
    }


    public function storeInterruptions(Request $request)
    {


        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'raison' => 'required',
            'demande_id' => 'required',
        ]);

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }

        $interruptionDemandeur = InterruptionDemandeur::create(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Interruption créée avec succès.');
    }
    public function updateInterruptions(Request $request, InterruptionDemandeur $interruptionDemandeur)
    {


        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'raison' => 'required'
        ]);

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }

        $interruptionDemandeur = $interruptionDemandeur->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Interruption créée avec succès.');
    }
    public function destroyInterruptions(InterruptionDemandeur $interruptionDemandeur)
    {
        // Supprimer l'enregistrement
        $interruptionDemandeur->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Interruption supprimée avec succès.');
    }


    public function storeMaintenances(Request $request)
    {
        $request->validate([
            'date_debut' => 'required',
            'date_fin' => 'required|date',
            'description_maintenance' => 'required',
        ]);
        // Créer l Maintenance demande

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $experience_maintenance_demandeur = ExperienceMaintenanceDemandeur::create(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Experience Maintenance créée avec succès.');
    }
    public function updateMaintenances(Request $request, ExperienceMaintenanceDemandeur $experience_maintenance_demandeur)
    {
        $request->validate([
            'date_debut' => 'required',
            'date_fin' => 'required|date',
            'description_maintenance' => 'required',
        ]);
        // Créer l Maintenance demande

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $experience_maintenance_demandeur = $experience_maintenance_demandeur->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Experience Maintenance créée avec succès.');
    }
    public function destroyMaintenances(ExperienceMaintenanceDemandeur $experience_maintenance_demandeur)
    {
        // Supprimer l'enregistrement
        $experience_maintenance_demandeur->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Experience Maintenance supprimée avec succès.');
    }


    public function storeEmployeurs(Request $request)
    {
        $request->validate([
            'periode_du' => 'required|date',
            'periode_au' => 'required|date',
            'fonction' => 'required',
            'employeur' => 'required',
        ]);
        // Créer l Employeur demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $employeurDemandeur = EmployeurDemandeur::create(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Employeur créée avec succès.');
    }
    public function updateEmployeurs(Request $request, EmployeurDemandeur $employeur_demandeur)
    {
        $request->validate([
            'periode_du' => 'required|date',
            'periode_au' => 'required|date',
            'fonction' => 'required',
            'employeur' => 'required',
        ]);
        // Créer l Employeur demande
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        } else {
            $documentPath = null;
        }
        $employeurDemandeur = $employeur_demandeur->update(array_merge($request->all(), ['document' => $documentPath]));
        return redirect()->back()->with('success', 'Employeur créée avec succès.');
    }
    public function destroyEmployeurs(EmployeurDemandeur $employeurDemandeur)
    {
        // Supprimer l'enregistrement
        $employeurDemandeur->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Employeur supprimée avec succès.');
    }
}
