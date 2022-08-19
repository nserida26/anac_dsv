<?php

namespace App\Http\Controllers;

use App\Models\Menage;
use Illuminate\Http\Request;

/**
 * Class MenageController
 * @package App\Http\Controllers
 */
class MenageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menages = Menage::paginate();

        return view('menage.index', compact('menages'))
            ->with('i', (request()->input('page', 1) - 1) * $menages->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menage = new Menage();
        return view('menage.create', compact('menage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Menage::$rules);

        $menage = Menage::create($request->all());

        return redirect()->route('menages.index')
            ->with('success', 'Menage created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menage = Menage::find($id);

        return view('menage.show', compact('menage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menage = Menage::find($id);

        return view('menage.edit', compact('menage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Menage $menage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menage $menage)
    {
        request()->validate(Menage::$rules);

        $menage->update($request->all());

        return redirect()->route('menages.index')
            ->with('success', 'Menage updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $menage = Menage::find($id)->delete();

        return redirect()->route('menages.index')
            ->with('success', 'Menage deleted successfully');
    }
}
