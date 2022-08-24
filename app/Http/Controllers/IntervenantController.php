<?php

namespace App\Http\Controllers;

use App\Models\Intervenant;
use Illuminate\Http\Request;

/**
 * Class IntervenantController
 * @package App\Http\Controllers
 */
class IntervenantController extends Controller
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
        $intervenants = Intervenant::paginate();

        return view('intervenant.index', compact('intervenants'))
            ->with('i', (request()->input('page', 1) - 1) * $intervenants->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $intervenant = new Intervenant();
        return view('intervenant.create', compact('intervenant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Intervenant::$rules);

        $intervenant = Intervenant::create($request->all());

        return redirect()->route('intervenants.index')
            ->with('success', 'Intervenant created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $intervenant = Intervenant::find($id);

        return view('intervenant.show', compact('intervenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $intervenant = Intervenant::find($id);

        return view('intervenant.edit', compact('intervenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Intervenant $intervenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Intervenant $intervenant)
    {
        request()->validate(Intervenant::$rules);

        $intervenant->update($request->all());

        return redirect()->route('intervenants.index')
            ->with('success', 'Intervenant updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $intervenant = Intervenant::find($id)->delete();

        return redirect()->route('intervenants.index')
            ->with('success', 'Intervenant deleted successfully');
    }
}
