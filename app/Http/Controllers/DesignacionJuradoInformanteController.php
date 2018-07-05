<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DesignacionJuradoInformante;
use App\DocenteJuradoInformante;
use App\Tesis;

class DesignacionJuradoInformanteController extends Controller
{
    public function registrar(Request $request)
    {

        $designacion = new DesignacionJuradoInformante();
        $designacion->nro_designacion = $request->input('nro_designacion');
        $designacion->fecha_designacion = $request->input('fecha_designacion');
        $designacion->idtesis = $request->input('idtesis');
        $tesis = Tesis::where('idtesis', $request->input('idtesis'))->first();
        $tesis->paso = 3;
        $tesis->update();
        $array = $request->input('docentes');
        foreach($array as $docentes)
        {
            $docente = new DocenteJuradoInformante();
            $docente->idtesis = $request->input('idtesis');
            $docente->iddocente = $docentes;
            $docente->save();
        }
        $designacion->save();
        return response()->json(['designacion' => $designacion], 201);
    }

    public function obtener($id)
    {
        $designacion = DesignacionJuradoInformante::where('id',$id)->first();

        $docentes = DocenteJuradoInformante::select('id')->where('idtesis',$designacion->idtesis)->get();

        $datosDocente = Docente::select('id','nombres','apell_pat','apell_mat')->whereIN('id',$docentes->pluck('id'))->get();
        
        return response()->json(['designacion' => $designacion, 'docentes' => $datosDocente], 201);

    }
}
