<?php

namespace App\Http\Controllers;

use App\Models\Localite;
use App\Models\Commune;
use Illuminate\Http\Request;

/**
 * Class LocaliteController
 * @package App\Http\Controllers
 */
class LocaliteController extends Controller
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
        $localites = Localite::join('communes','communes.id','localites.commune_id')->select('localites.*','communes.libele as commune')->paginate();

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
        $communes = Commune::all();
        return view('localite.create', compact('localite','communes'));
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
        $localite = Localite::join('communes','communes.id','localites.commune_id')->select('localites.*','communes.libele as commune')->where('localites.id',$id)->first();

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
        $communes = Commune::all();
        return view('localite.edit', compact('localite','communes'));
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
