<?php

namespace App\Http\Controllers;

use App\Models\Cachet;
use App\Models\Demande;
use App\Models\EtatDemande;
use App\Models\OrdreRecette;
use Illuminate\Http\Request;


use App\Models\CompetenceDemandeur;

use App\Models\Document;
use App\Models\EmployeurDemandeur;

use App\Models\ExperienceDemandeur;
use App\Models\ExperienceMaintenanceDemandeur;
use App\Models\ExprienceMaintenanceDemandeur;
use App\Models\FormationDemandeur;
use App\Models\InterruptionDemandeur;
use App\Models\Licence;
use App\Models\MedicalExamination;
use App\Models\QualificationDemandeur;
use App\Models\Signature;
use App\Models\TrainingDemandeur;
use Illuminate\Support\Facades\Auth;

class DgDsvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        $demandes = Demande::with('demandeur')->with('paiement')->where('status', '<>', 'En attente')->get();
        $ordres = OrdreRecette::with('demande')->get();

        return view('dir.index', compact('demandes', 'ordres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $demande = Demande::find($id);

        return view('dir.create', compact('demande'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Stocker un nouvel ordre de recette
    public function store(Request $request)
    {
        $request->validate([
            'demande_id' => 'required|exists:demandes,id',
            'montant' => 'required|numeric|min:0',
            'date_ordre' => 'required|date'
        ]);

        if ($request->hasFile('ordre')) {
            $ordrePath = $request->file('ordre')->store('paiements', 'public');
        } else {
            $ordrePath = null;
        }
        $ordre = OrdreRecette::create([
            'demande_id' => $request->demande_id,
            'montant' => $request->montant,
            'reference' => 'OR-' . strtoupper(uniqid()), // Génération de référence unique
            'date_ordre' => $request->date_ordre,
            'statut' => 'Généré',
            'ordre' => $ordrePath
        ]);
        $etat_demande = EtatDemande::where('demande_id', $request->demande_id)->update(
            [
                'dsv_recette' =>  true
            ]
        );

        return redirect()->route('dsv')->with('success', 'Ordre de recette créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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



        return view('dir.show', compact('demande', 'demandeur', 'employeur_demandeurs', 'experience_maintenance_demandeurs', 'interruption_demandeurs', 'formation_demandeurs', 'documents', 'entrainement_demandeurs', 'competence_demandeurs', 'experience_demandeurs', 'medical_examinations', 'qualification_demandeurs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdreRecette $ordre)
    {
        //
        return view('dir.edit', compact('ordre'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdreRecette $ordre)
    {
        //
        $request->validate([
            'montant' => 'required|numeric|min:0',
            'date_ordre' => 'required|date',
            'ordre'  =>  'required|file'
        ]);

        if ($request->hasFile('ordre')) {
            $ordrePath = $request->file('ordre')->store('paiements', 'public');
        } else {
            $ordrePath = null;
        }
        $or = $ordre->update([
            'montant' => $request->montant,
            'date_ordre' => $request->date_ordre,
            'ordre' => $ordrePath
        ]);

        return redirect()->route('dsv')->with('success', 'Ordre de recette mis à jour avec succès.');
    }

    function sc()
    {
        $signature  =  Auth::user()->signature;
        $cachet  =  Auth::user()->cachet;
        return view('dir.signature', compact('signature', 'cachet'));
    }
    public function store_sc(Request $request)
    {
        //
        $request->validate([
            'cachet' => 'required|file',
            'signature'  =>  'required|file'
        ]);
        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('sc', 'public');
        } else {
            $signaturePath = null;
        }
        if ($request->hasFile('cachet')) {
            $cachetPath = $request->file('cachet')->store('sc', 'public');
        } else {
            $cachetPath = null;
        }
        $c = Cachet::create([
            'user_id' => auth()->user()->id,
            'cachet' => $cachetPath
        ]);
        $s = Signature::create([
            'user_id' => auth()->user()->id,
            'signature' => $signaturePath
        ]);

        return redirect()->route('dsv')->with('success', 'Signature et Cache cree avec succès.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdreRecette $ordre)
    {

        $ordre->delete();
        return redirect()->route('dsv')->with('success', 'Ordre de  recette supprimé.');
        //
    }

    function valider(OrdreRecette $ordre)
    {

        $ordre = $ordre->update(
            [
                'statut' => 'Validé'
            ]
        );

        return back()->with('success', 'Ordre de  recette validée avec succès.');
    }


    function validerDsv($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'dsv_valider' => true
            ]
        );

        return back()->with('success', 'Demande validée avec succès.');
    }

    function annoterDemandeDSVtoPEL($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'dsv_annoter' => true
            ]
        );

        return back()->with('success', 'Demande annotée avec succès.');
    }

    function rejeterDSV($id)
    {


        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'dsv_rejeter' => true
            ]
        );

        return back()->with('success', 'Demande rejetée avec succès.');
    }



    function validerDg($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'dg_valider' => true
            ]
        );

        return back()->with('success', 'Demande validée avec succès.');
    }
    function annoterDemandeDGtoDSV($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'dg_annoter' => true
            ]
        );

        return back()->with('success', 'Demande annotée avec succès.');
    }
    function rejeter($id)
    {


        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'dg_rejeter' => true
            ]
        );

        return back()->with('success', 'Demande rejetée avec succès.');
    }

    function signerDsv($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'dsv_signer' => true
            ]
        );

        return back()->with('success', 'Demande signée avec succès.');
    }
    function signerDg($id)
    {

        $etat_demande = EtatDemande::where('demande_id', $id)->update(
            [
                'dg_signer' => true
            ]
        );

        $demande = Demande::findOrFail($id);
        $demandeur = $demande->demandeur;
        $categorie_licence = $this->getCategorieLicence($demande->type_licence);
        $first_part_code = strtoupper(substr($demande->type_licence, 0, 1)) . '' . strtoupper(substr($demande->specialite, 0, 1));
        $latestLicense = Licence::latest('id')->first();
        $second_part_code = '';
        if ($latestLicense) {
            # code...
            $hyphenPosition = strpos($latestLicense->numero_licence, '-');
            if ($hyphenPosition !== false) {
                $second_part_code = substr($latestLicense->numero_licence, $hyphenPosition + 1);
            }
        } else {

            $second_part_code = '001';
            # code...
        }
        //$qualifications = $demande->qualifications->where('');
        if ($demande->objet_licence === 'Delivrance') {
            $licence = Licence::create(
                [
                    'demande_id' => $demande->id,
                    'categorie_licence' => $categorie_licence,
                    'machine_licence' => strtoupper(substr($demande->specialite, 0, 1)),
                    'type_licence' => $demande->type_licence,
                    'numero_licence' => $first_part_code . '-' . $second_part_code,
                    'np' => $demandeur->np,
                    'date_naissance' => $demandeur->date_naissance,
                    'adresse' => $demandeur->adresse,
                    'nationalite' => $demandeur->nationalite,
                    'photo' => $demandeur->photo,
                    'signature' =>  $demandeur->signature
                ]
            );
            # code...
        }




        return back()->with('success', 'Demande signée et Licence cree avec succès.');
    }
    function getCategorieLicence($type_licence)
    {
        // Convert to uppercase to handle case insensitivity
        $type_licence = strtoupper($type_licence);

        switch ($type_licence) {
            case 'ATPL':
            case 'CPL':
            case 'PPL':
            case 'ULM':
                return 'Flight Crew Licence';
            case 'RPA':
                return 'UA Pilot Licence';
            case 'ATC':
                return 'ATC Licence';
            case 'ATE':
                return 'Dispatcher Licence';
            case 'AMT':
                return 'Aircraft Maintenance Licence';
            case 'MEC':
                return 'Cabin Crew Licence';
            default:
                return 'Unknown Licence';
        }
    }
}
