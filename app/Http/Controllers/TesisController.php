<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tesis;
use App\DictamenExpedito;
use App\Alumno;
use App\Docente;
use App\DesignacionJuradoExaminador;
use App\DesignacionJuradoInformante;
use App\DocenteJuradoExaminador;
use App\DocenteJuradoInformante;
use App\Exports\TesisExport;
use Maatwebsite\Excel\Facades\Excel;

class TesisController extends Controller
{
    public function listar()
    {

        $tesis = Tesis::select('idtesis','idalumno','titulo')->get();
        $i = 0;
        foreach ($tesis->pluck('idalumno') as $idalumno) {
            $tesis[$i]['alumno'] = Alumno::select('ape_paterno','ape_materno','nom_alumno')->where('cod_alumno',$idalumno)->first();
            $i++;
        };
        return response()->json(['tesis' => $tesis], 201);
    }

    public function inscripcion(Request $request)
    {

        $tesis = new Tesis();
        $tesis->nro_inscripcion = $request->input('nro_inscripcion');
        $tesis->fecha_inscripcion = $request->input('fecha_inscripcion');
        $tesis->titulo = $request->input('titulo');
        $tesis->iddocente = $request->input('iddocente');
        $tesis->idalumno = $request->input('idalumno');
        $tesis->paso = 1;
        $tesis->save();
        return response()->json(['tesis' => $tesis], 201);
    }

    public function actualizarInscripcion(Request $request, $id)
    {

        $tesis = Tesis::where('idtesis',$id)->first();
        $tesis->nro_inscripcion = $request->input('nro_inscripcion');
        $tesis->fecha_inscripcion = $request->input('fecha_inscripcion');
        $tesis->titulo = $request->input('titulo');
        $tesis->iddocente = $request->input('iddocente');
        $tesis->idalumno = $request->input('idalumno');
        $tesis->update();

        return response()->json(['tesis' => $tesis], 201);
    }

    public function obtener($id) //pendiente
    {
        //$tesis = Tesis::select('idtesis','fecha_inscripcion','titulo','nro_inscripcion','iddocente','paso')->where('idalumno',$id)->first();
        $tesis = Tesis::where('idalumno',$id)->first();
        if ($tesis != null)
        {
            $alumno = Alumno::select('cod_alumno','ape_paterno','ape_materno','nom_alumno')->where('cod_alumno',$id)->first();

            $asesor = Docente::select('id','nombres','apell_pat','apell_mat')->where('id',$tesis->iddocente)->first();

            $dictamen = DictamenExpedito::where('idtesis',$tesis->idtesis)->first();
    
            $designacionExaminador = DesignacionJuradoExaminador::where('idtesis',$tesis->idtesis)->first();
            
            if ($designacionExaminador != null) 
            {
                $i = 0;
                $juradoExaminador = DocenteJuradoExaminador::where('idtesis',$tesis->idtesis)->get();
                $examinador = Docente::select('id','nombres','apell_pat','apell_mat')->whereIn('id',$juradoExaminador->pluck('iddocente'))->get();

                foreach ($juradoExaminador->pluck('tipo') as $tipo) {
                    $examinador[$i]["tipo"] = $tipo;
                    $i++;
                }
            } 
            else
            {
                $examinador = [];
            }

            $designacionInformante = DesignacionJuradoInformante::where('idtesis',$tesis->idtesis)->first();

            if ($designacionInformante != null) 
            {
                $juradoInformante = DocenteJuradoInformante::where('idtesis',$tesis->idtesis)->get();
                $informante = Docente::select('id','nombres','apell_pat','apell_mat')->whereIn('id',$juradoInformante->pluck('iddocente'))->get();
            } 
            else
            {
                $informante = [];
            }

            return response()->json([   'tesis' => $tesis,
                                        'alumno' => $alumno,
                                        'asesor' => $asesor,
                                        'dictamen_expedito' => $dictamen,
                                        'designacion_jurado_examinador' => $designacionExaminador,
                                        'examinador' => $examinador,
                                        'designacion_jurado_informante' => $designacionInformante,
                                        'informante' => $informante,
                                    
                                    ], 201);
        } else {
            return response()->json([   'tesis' => null,
                                        'alumno' => null,
                                        'asesor' => null,
                                        'dictamen_expedito' => null,
                                        'designacion_jurado_examinador' => null,
                                        'examinador' => null,
                                        'designacion_jurado_informante' => null,
                                        'informante' => null,
                                    
                                    ], 201);
        }     
    }

    public function calificar(Request $request, $id)
    {
        $tesis = Tesis::where('idtesis',$id)->first();
        $tesis->calificacion = $request->input('calificacion');
    }

    public function exportar()
    {
        return Excel::download(new TesisExport, 'tesis.xlsx');
    }

}
