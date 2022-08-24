<?php

namespace App\Http\Controllers;

use App\Models\Bayeur;
use Illuminate\Http\Request;

/**
 * Class BayeurController
 * @package App\Http\Controllers
 */
class BayeurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bayeurs = Bayeur::paginate();

        return view('bayeur.index', compact('bayeurs'))
            ->with('i', (request()->input('page', 1) - 1) * $bayeurs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bayeur = new Bayeur();
        return view('bayeur.create', compact('bayeur'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Bayeur::$rules);

        $bayeur = Bayeur::create($request->all());

        return redirect()->route('bayeurs.index')
            ->with('success', 'Bayeur created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bayeur = Bayeur::find($id);

        return view('bayeur.show', compact('bayeur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bayeur = Bayeur::find($id);

        return view('bayeur.edit', compact('bayeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Bayeur $bayeur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bayeur $bayeur)
    {
        request()->validate(Bayeur::$rules);

        $bayeur->update($request->all());

        return redirect()->route('bayeurs.index')
            ->with('success', 'Bayeur updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bayeur = Bayeur::find($id)->delete();

        return redirect()->route('bayeurs.index')
            ->with('success', 'Bayeur deleted successfully');
    }
}
