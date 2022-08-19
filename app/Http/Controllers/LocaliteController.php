<?php

namespace App\Http\Controllers;

use App\Models\Localite;
use Illuminate\Http\Request;

/**
 * Class LocaliteController
 * @package App\Http\Controllers
 */
class LocaliteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localites = Localite::paginate();

        return view('localite.index', compact('localites'))
            ->with('i', (request()->input('page', 1) - 1) * $localites->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $localite = new Localite();
        return view('localite.create', compact('localite'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Localite::$rules);

        $localite = Localite::create($request->all());

        return redirect()->route('localites.index')
            ->with('success', 'Localite created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $localite = Localite::find($id);

        return view('localite.show', compact('localite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $localite = Localite::find($id);

        return view('localite.edit', compact('localite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Localite $localite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localite $localite)
    {
        request()->validate(Localite::$rules);

        $localite->update($request->all());

        return redirect()->route('localites.index')
            ->with('success', 'Localite updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $localite = Localite::find($id)->delete();

        return redirect()->route('localites.index')
            ->with('success', 'Localite deleted successfully');
    }
}
