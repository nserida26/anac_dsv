<?php

namespace App\Http\Controllers;

use App\Models\ExamenMedical;
use App\Models\Demandeur;
use App\Models\Examinateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminateurController extends Controller
{
    // Liste des examens
    public function index()
    {

        $demandeurs = Demandeur::all();
        $examens = ExamenMedical::with(['demandeur', 'examinateur'])->get();
        return view('examinateur.index', compact('examens', 'demandeurs'));
    }

    // Formulaire de création
    public function create(Demandeur $demandeur)
    {

        $examinateur = Auth::user()->examinateur;
        return view('examinateur.create', compact('demandeur', 'examinateur'));
    }

    // Stocker un nouvel examen
    public function store(Request $request)
    {
        $request->validate([
            'demandeur_id' => 'required|exists:demandeurs,id',
            'examinateur_id' => 'required|exists:examinateurs,id',
            'date_examen' => 'required|date',
            'validite' => 'required|integer',
            'aptitude' => 'required|in:Apte,Inapte',
            'rapport' => 'nullable|string',
            'attestation' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $attestationPath = $request->file('attestation')->store('attestations', 'public');

        ExamenMedical::create([
            'demandeur_id' => $request->demandeur_id,
            'examinateur_id' => $request->examinateur_id,
            'date_examen' => $request->date_examen,
            'validite' => $request->validite,
            'aptitude' => $request->aptitude,
            'rapport' => $request->rapport,
            'attestation' => $attestationPath,
        ]);

        return redirect()->route('examinateur')->with('success', 'Examen médical ajouté avec succès.');
    }

    // Afficher un examen
    public function show(ExamenMedical $examen)
    {
        return view('examinateur.show', compact('examen'));
    }

    // Formulaire d'édition
    public function edit(ExamenMedical $examen)
    {
        return view('examinateur.edit', compact('examen'));
    }

    // Mettre à jour un examen
    public function update(Request $request, ExamenMedical $examen)
    {
        $request->validate([
            'demandeur_id' => 'required|exists:demandeurs,id',
            'examinateur_id' => 'required|exists:examinateurs,id',
            'date_examen' => 'required|date',
            'validite' => 'required|integer',
            'aptitude' => 'required|in:Apte,Inapte',
            'rapport' => 'nullable|string',
            'attestation' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('attestation')) {
            $attestationPath = $request->file('attestation')->store('attestations', 'public');
            $examen->attestation = $attestationPath;
        }

        $examen->update([
            'demandeur_id' => $request->demandeur_id,
            'examinateur_id' => $request->examinateur_id,
            'date_examen' => $request->date_examen,
            'validite' => $request->validite,
            'aptitude' => $request->aptitude,
            'rapport' => $request->rapport,
        ]);

        return redirect()->route('examinateur')->with('success', 'Examen médical mis à jour.');
    }

    // Supprimer un examen
    public function destroy(ExamenMedical $examen)
    {
        $examen->delete();
        return redirect()->route('examinateur')->with('success', 'Examen médical supprimé.');
    }
    public function valider(ExamenMedical $examen)
    {
        $examen->update(
            [
                'valider_examinateur' =>  true
            ]
        );
        return redirect()->route('examinateur')->with('success', 'Examen médical validé.');
    }
}
