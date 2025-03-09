<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Demandeur;
use App\Models\Compagnie;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeurController extends Controller
{
    //
    public function index()
    {
        $demandeur = Auth::user()->demandeur;
        $compagnies = Compagnie::all();
        
        return view('user.profile', compact('compagnies','demandeur'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'np' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'compagnie_id' => 'nullable|string|max:255',
            //'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);



        // Handle file upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = null;
        }
        /*if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('photos', 'public');
        } else {
            $signaturePath = null;
        }
        */


        // Create Demandeur

        Demandeur::create(array_merge($request->all(),['photo' => $photoPath],['user_id' => auth()->id()]));
        
        return redirect()->route('user.profile')->with('success', 'Demandeur created successfully.');
    }
}
