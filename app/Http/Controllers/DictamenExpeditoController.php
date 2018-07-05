<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DictamenExpedito;
use App\Tesis;

class DictamenExpeditoController extends Controller
{
    public function registrar(Request $request)
    {
            $dictamen = new DictamenExpedito();

            $dictamen->nro_dictamen = $request->input('nro_dictamen');
            $dictamen->fecha_dictamen = $request->input('fecha_dictamen');
            $dictamen->idtesis = $request->input('idtesis');

            $tesis = Tesis::where('idtesis',$request->input('idtesis'))->first();
            $tesis->paso = 2;
            $tesis->update();

            $dictamen->save();

            return response()->json(['dictamen' => $dictamen], 201);
    }

    public function actualizarRegistro($id)
    {
        $dictamen = DictamenExpedito::where('iddictamen',$id)->first();
        $dictamen->nro_dictamen = $request->input('nro_dictamen');
        $dictamen->fecha_dictamen = $request->input('fecha_dictamen');

        $dictamen->update();

        return response()->json(['dictamen' => $dictamen], 201);
    } 
}
