<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DesignacionJuradoExaminador;
use App\DocenteJuradoExaminador;
use App\Docente;
use App\Tesis;

class DesignacionJuradoExaminadorController extends Controller
{
    //Agregar tipo de jurado, fecha y hora de sustentación
    public function registrar(Request $request)
    {

        $designacion = new DesignacionJuradoExaminador();
        $designacion->nro_designacion = $request->input('nro_designacion');
        $designacion->fecha_designacion = $request->input('fecha_designacion');
        $designacion->idtesis = $request->input('idtesis');
        $tesis = Tesis::where('idtesis', $request->input('idtesis'))->first();
        $tesis->fecha_sustentacion = $request->input('fecha_sustentacion');
        $tesis->hora_sustentacion = $request->input('hora_sustentacion');
        $tesis->paso = 4;
        $tesis->update();
        $array = $request->input('docentes');
        foreach($array as $docentes)
        {
            $docente = new DocenteJuradoExaminador();
            $docente->idtesis = $request->input('idtesis');
            $docente->iddocente = $docentes;
            $docente->save();
        }
        $designacion->save();
        return response()->json(['designacion' => $designacion], 201);
    }

    public function obtener($id)
    {
        $designacion = DesignacionJuradoExaminador::where('id',$id)->first();

        $docentes = DocenteJuradoExaminador::select('id')->where('idtesis',$designacion->idtesis)->get();

        $datosDocente = Docente::select('id','nombres','apell_pat','apell_mat')->whereIN('id',$docentes->pluck('id'))->get();
        
        return response()->json(['designacion' => $designacion, 'docentes' => $datosDocente], 201);

    }
}
