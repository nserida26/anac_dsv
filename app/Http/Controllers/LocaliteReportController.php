<?php

namespace App\Http\Controllers;

use App\Models\LocaliteReport;
use App\Models\Operation;
use Illuminate\Http\Request;
use App\Models\Wilaya;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    //
    public function index()
    {
        $wilayas = Wilaya::all();
        $operations = Operation::all();

        return view('admin.reports.index',compact('wilayas','operations'));

    }
    public function fechWilayaLocaliteReport(Request $request){
        $wilaya_id =$request->wilaya_id;

        $localite_reports = LocaliteReport
            ::join('localites','localite_operations.localite_id','localites.id')
            ->join('communes','localite_operations.commune_id','communes.id')
            ->join('moughatas','localite_operations.moughata_id','moughatas.id')
            ->join('wilayas','localite_operations.wilaya_id','wilayas.id')
            ->join('operateurs','localite_operations.operateur_id','operateurs.id')
            ->join('operations','localite_operations.operation_id','operations.id')
            ->join('users','localite_operations.user_id','users.id')
            ->select('localites.intitule as localite','localites.code_ansade as code_ansade','localites.nb_pop_ansade as nb_pop_ansade','communes.intitule as commune','moughatas.intitule as moughata','wilayas.intitule as wilaya','operations.intitule as operation','operateurs.intitule as operateur','localite_operations.date_op')
            ->where('localite_operations.wilaya_id',$wilaya_id)
            ->get();
        return response()->json($localite_reports);
    }
    public function fechOperationLocaliteReport(Request $request){
        $operation_id =$request->operation_id;

        $localite_reports = LocaliteReport
            ::join('localites','localite_operations.localite_id','localites.id')
            ->join('communes','localite_operations.commune_id','communes.id')
            ->join('moughatas','localite_operations.moughata_id','moughatas.id')
            ->join('wilayas','localite_operations.wilaya_id','wilayas.id')
            ->join('operateurs','localite_operations.operateur_id','operateurs.id')
            ->join('operations','localite_operations.operation_id','operations.id')
            ->join('users','localite_operations.user_id','users.id')
            ->select('localites.intitule as localite','localites.code_ansade as code_ansade','localites.nb_pop_ansade as nb_pop_ansade','communes.intitule as commune','moughatas.intitule as moughata','wilayas.intitule as wilaya','operations.intitule as operation','operateurs.intitule as operateur','localite_operations.date_op')
            ->where('localite_operations.operation_id',$operation_id)
            ->get();
        return response()->json($localite_reports);
    }
    public function fechMoughataLocaliteReport(Request $request){
        $moughata_id =$request->moughata_id;
        $wilaya_id =$request->wilaya_id;
        $localite_reports = LocaliteReport
            ::join('localites','localite_operations.localite_id','localites.id')
            ->join('communes','localite_operations.commune_id','communes.id')
            ->join('moughatas','localite_operations.moughata_id','moughatas.id')
            ->join('wilayas','localite_operations.wilaya_id','wilayas.id')
            ->join('operateurs','localite_operations.operateur_id','operateurs.id')
            ->join('operations','localite_operations.operation_id','operations.id')
            ->join('users','localite_operations.user_id','users.id')
            ->select('localites.intitule as localite','localites.code_ansade as code_ansade','localites.nb_pop_ansade as nb_pop_ansade','communes.intitule as commune','moughatas.intitule as moughata','wilayas.intitule as wilaya','operations.intitule as operation','operateurs.intitule as operateur','localite_operations.date_op')
            ->where('localite_operations.wilaya_id',$wilaya_id)
            ->where('localite_operations.moughata_id',$moughata_id)
            ->get();
        return response()->json($localite_reports);
    }
    public function fechCommuneLocaliteReport(Request $request){
        $moughata_id =$request->moughata_id;
        $wilaya_id =$request->wilaya_id;
        $commune_id =$request->commune_id;
        $localite_reports = LocaliteReport
            ::join('localites','localite_operations.localite_id','localites.id')
            ->join('communes','localite_operations.commune_id','communes.id')
            ->join('moughatas','localite_operations.moughata_id','moughatas.id')
            ->join('wilayas','localite_operations.wilaya_id','wilayas.id')
            ->join('operateurs','localite_operations.operateur_id','operateurs.id')
            ->join('operations','localite_operations.operation_id','operations.id')
            ->join('users','localite_operations.user_id','users.id')
            ->select('localites.intitule as localite','localites.code_ansade as code_ansade','localites.nb_pop_ansade as nb_pop_ansade','communes.intitule as commune','moughatas.intitule as moughata','wilayas.intitule as wilaya','operations.intitule as operation','operateurs.intitule as operateur','localite_operations.date_op')
            ->where('localite_operations.wilaya_id',$wilaya_id)
            ->where('localite_operations.moughata_id',$moughata_id)
            ->where('localite_operations.commune_id',$commune_id)
            ->get();
        return response()->json($localite_reports);
    }

}
