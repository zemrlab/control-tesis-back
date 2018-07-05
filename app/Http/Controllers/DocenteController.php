<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Docente;

class DocenteController extends Controller
{
    public function listar()
    {

        $docente = Docente::select('id','nombres','apell_pat','apell_mat')->limit(5)->get();
        return response()->json(['docente' => $docente], 201);
    }

    public function busqueda(Request $request)
    {

        //$docente = Docente::select('id','nombres','apell_pat','apell_mat')->where(DB::raw("CONCAT(nombres,' ', apell_pat,' ',apell_mat)"), 'LIKE', '%'.$request->input('docente').'%')->get();
        //$docente = Docente::select('id','nombres','apell_pat','apell_mat')->where('ciclo_tesis',1)->get();
        $docente = Docente::select('id','nombres','apell_pat','apell_mat')->where('nombres','LIKE',$request->input('docente'))->get();
        return response()->json(['docente' => $docente], 201);
    }
}
