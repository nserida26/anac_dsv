<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;

/**
 * Class CommuneController
 * @package App\Http\Controllers
 */
class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communes = Commune::paginate();

        return view('commune.index', compact('communes'))
            ->with('i', (request()->input('page', 1) - 1) * $communes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commune = new Commune();
        return view('commune.create', compact('commune'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Commune::$rules);

        $commune = Commune::create($request->all());

        return redirect()->route('communes.index')
            ->with('success', 'Commune created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commune = Commune::find($id);

        return view('commune.show', compact('commune'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commune = Commune::find($id);

        return view('commune.edit', compact('commune'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Commune $commune
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commune $commune)
    {
        request()->validate(Commune::$rules);

        $commune->update($request->all());

        return redirect()->route('communes.index')
            ->with('success', 'Commune updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $commune = Commune::find($id)->delete();

        return redirect()->route('communes.index')
            ->with('success', 'Commune deleted successfully');
    }
}
