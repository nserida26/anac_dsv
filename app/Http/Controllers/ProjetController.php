<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

/**
 * Class ProjetController
 * @package App\Http\Controllers
 */
class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projets = Projet::paginate();

        return view('projet.index', compact('projets'))
            ->with('i', (request()->input('page', 1) - 1) * $projets->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projet = new Projet();
        return view('projet.create', compact('projet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Projet::$rules);

        $projet = Projet::create($request->all());

        return redirect()->route('projets.index')
            ->with('success', 'Projet created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projet = Projet::find($id);

        return view('projet.show', compact('projet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projet = Projet::find($id);

        return view('projet.edit', compact('projet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Projet $projet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projet $projet)
    {
        request()->validate(Projet::$rules);

        $projet->update($request->all());

        return redirect()->route('projets.index')
            ->with('success', 'Projet updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projet = Projet::find($id)->delete();

        return redirect()->route('projets.index')
            ->with('success', 'Projet deleted successfully');
    }
}
