<?php

namespace App\Http\Controllers;

use App\Models\TypeInfrastructure;
use Illuminate\Http\Request;

/**
 * Class TypeInfrastructureController
 * @package App\Http\Controllers
 */
class TypeInfrastructureController extends Controller
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
        $typeInfrastructures = TypeInfrastructure::paginate();

        return view('type-infrastructure.index', compact('typeInfrastructures'))
            ->with('i', (request()->input('page', 1) - 1) * $typeInfrastructures->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeInfrastructure = new TypeInfrastructure();
        return view('type-infrastructure.create', compact('typeInfrastructure'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TypeInfrastructure::$rules);

        $typeInfrastructure = TypeInfrastructure::create($request->all());

        return redirect()->route('type-infrastructures.index')
            ->with('success', 'TypeInfrastructure created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typeInfrastructure = TypeInfrastructure::find($id);

        return view('type-infrastructure.show', compact('typeInfrastructure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typeInfrastructure = TypeInfrastructure::find($id);

        return view('type-infrastructure.edit', compact('typeInfrastructure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TypeInfrastructure $typeInfrastructure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeInfrastructure $typeInfrastructure)
    {
        request()->validate(TypeInfrastructure::$rules);

        $typeInfrastructure->update($request->all());

        return redirect()->route('type-infrastructures.index')
            ->with('success', 'TypeInfrastructure updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $typeInfrastructure = TypeInfrastructure::find($id)->delete();

        return redirect()->route('type-infrastructures.index')
            ->with('success', 'TypeInfrastructure deleted successfully');
    }
}
