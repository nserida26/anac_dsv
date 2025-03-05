<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wilaya;

class InfrastructureReportController extends Controller
{
    public function index()
    {
        $wilayas = Wilaya::all();
        return view('admin.reports.infrastructures.index',compact('wilayas'));
        
        
    }
    //
}
