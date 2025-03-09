<?php

namespace App\Http\Controllers;

use App\Models\TypeFormation;
use Illuminate\Http\Request;
use App\Models\Demandeur;
use App\Models\Formation;
use Illuminate\Support\Facades\Auth;
class CentreFormationController extends Controller
{
    //
    public function index()
    {

        $demandeurs = Demandeur::all();
        $centreFormation = auth()->user()->centreFormation;
        $type_formations = TypeFormation::all();
        $formations = Formation::with(['demandeur', 'centreFormation', 'typeFormation'])->where('centre_formation_id', $centreFormation->id)->get();

        return view('centre.index', compact('type_formations', 'formations', 'demandeurs'));
    }
    public function create(Demandeur $demandeur)
    {

        $centre = Auth::user()->centreFormation;
        $type_formations = TypeFormation::all();
        return view('centre.create', compact('type_formations', 'demandeur', 'centre'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'demandeur_id' => 'required|exists:demandeurs,id',
            'centre_formation_id' => 'required|exists:centre_formations,id',
            'type_formation_id' => 'required|exists:type_formations,id',
            'date_formation' => 'required|date',
            'attestation' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $attestationPath = $request->file('attestation')->store('attestations', 'public');

        Formation::create([
            'demandeur_id' => $request->demandeur_id,
            'centre_formation_id' => $request->centre_formation_id,
            'type_formation_id' => $request->type_formation_id,
            'date_formation' => $request->date_formation,
            'lieu' => $request->lieu,
            'attestation' => $attestationPath,
        ]);

        return redirect()->route('centre')->with('success', 'Formation ajouté avec succès.');
    }

    public function update(Request $request, Formation $formation)
    {
        $request->validate([
            'type_formation_id' => 'required|exists:type_formations,id',
            'date_formation' => 'required|date',
            'attestation' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('attestation')) {
            $attestationPath = $request->file('attestation')->store('attestations', 'public');
            $formation->attestation = $attestationPath;
        }

        $formation->update([
            'type_formation_id' => $request->type_formation_id,
            'date_formation' => $request->date_formation,
            'lieu' => $request->lieu,
            'attestation' => $attestationPath,
        ]);

        return redirect()->route('centre')->with('success', 'Formation mis à jour.');
    }

    public function destroy(Formation $formation)
    {
        $formation->delete();
        return redirect()->route('centre')->with('success', 'Formation supprimé.');
    }


}
