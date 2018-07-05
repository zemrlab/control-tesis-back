<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;

class AlumnoController extends Controller
{
    public function buscarPorCodigo(Request $request){
        $alumno = Alumno::select('cod_alumno','ape_paterno','ape_materno','nom_alumno')->where('cod_alumno',$request->input('cod_alumno'))->first();
        return response()->json(['alumno' => $alumno], 201);
 
    }

    public function listar()
    {
 
        $alumno = Alumno::select('cod_alumno','ape_paterno','ape_materno','nom_alumno')->get();

        return response()->json(['alumno' => $alumno], 201);
    }
}
