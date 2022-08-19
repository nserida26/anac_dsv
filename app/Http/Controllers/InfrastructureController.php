<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\InfrasImport;
use App\Imports\HygieneImport;
use Maatwebsite\Excel\Facades\Excel;
class InfrastructureController extends Controller
{

    public function index()
    {
    # code...
    }

    public function importHygiene(Request $request)
    {
        try {
            Excel::import(new HygieneImport, $request->file);
        
            return redirect()->back()->with('success', 'Excel file Imported Successfully');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            //return redirect()->with('error', 'Error!');
        }
        //dd($request->file);

        
    }
    public function importInfrastructure(Request $request)
    {
        //dd($request->file);
        try {
            Excel::import(new InfrasImport, $request->file);
        
            return redirect()->back()->with('success', 'Excel file Imported Successfully');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            //return redirect()->with('error', 'Error!');
        }

        
    }
    
    //
}
