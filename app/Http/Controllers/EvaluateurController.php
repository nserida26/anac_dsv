<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use App\Models\ExamenMedical;



class EvaluateurController extends Controller
{
    //

    // Liste des examens
    public function index()
    {

        $demandes = Demande::with('demandeur')->where('status', '<>', 'En attente')->get();

        $examens = ExamenMedical::with(['demandeur', 'examinateur'])->get();
        return view('evaluateur.index', compact('examens', 'demandes'));
    }

    // Afficher un examen
    public function show(ExamenMedical $examen)
    {
        return view('evaluateur.show', compact('examen'));
    }

    // Formulaire d'édition
    public function edit(ExamenMedical $examen)
    {
        return view('evaluateur.edit', compact('examen'));
    }

    // Mettre à jour un examen
    public function update(Request $request, ExamenMedical $examen)
    {
        $request->validate([
            'rapport_evaluateur' => 'nullable|string',
            'validite_evaluateur' => 'integer'
        ]);


        $examen->update([
            'validite_evaluateur' => $request->validite_evaluateur,
            'rapport_evaluateur' => $request->rapport_evaluateur,
        ]);

        return redirect()->route('evaluateur')->with('success', 'Examen médical mis à jour.');
    }


    public function valider(ExamenMedical $examen)
    {
        $examen->update(
            [
                'valider_evaluateur' => true
            ]
        );
        return redirect()->route('evaluateur')->with('success', 'Examen médical validé.');
    }
}
