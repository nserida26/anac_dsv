<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use App\Models\ExamenMedical;
use App\Models\MedicalExamination;
use Illuminate\Support\Facades\DB;

class EvaluateurController extends Controller
{
    //

    // Liste des examens
    public function index()
    {

        $medical_examinations = MedicalExamination::join('demandes', 'demandes.id', 'medical_examinations.demande_id')
            ->join('centre_medicals', 'centre_medicals.id', 'medical_examinations.centre_medical_id')

            ->select('centre_medicals.libelle as centre_medical', 'medical_examinations.*')
            ->get();
        $examens = ExamenMedical::with(['demandeur', 'examinateur'])->get();
        return view('evaluateur.index', compact('examens', 'medical_examinations'));
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



    public function valider($table, $id)
    {
        // Vérifiez si la table existe dans la base de données
        if (!DB::getSchemaBuilder()->hasTable($table)) {
            return redirect()->back()->with('error', 'Table non trouvée.');
        }

        // Vérifiez si la colonne 'valider_evaluateur' existe dans la table
        if (!DB::getSchemaBuilder()->hasColumn($table, 'valider_evaluateur')) {
            return redirect()->back()->with('error', 'Colonne "valider_evaluateur" non trouvée dans la table.');
        }

        // Mettez à jour la valeur du booléen 'valider_evaluateur' à 1
        DB::table($table)->where('id', $id)->update(['valider_evaluateur' => 1]);



        return redirect()->back()->with('success', 'Information validée avec succès.');
    }
}
