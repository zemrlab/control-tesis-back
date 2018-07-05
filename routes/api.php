<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//ALUMNOS
Route::post('/alumno/buscarPorCodigo',[
    'uses'  => 'AlumnoController@buscarPorCodigo'
]);

Route::get('/alumno/listar',[
    'uses'  => 'AlumnoController@listar'
]);

//Tesis
Route::get('/tesis/listar',[
    'uses'  => 'TesisController@listar'
]);

Route::get('/tesis/exportar',[
    'uses'  => 'TesisController@exportar'
]);

Route::post('/tesis/inscripcion',[
    'uses'  => 'TesisController@inscripcion'
]);

Route::post('/tesis/actualizar/{id}',[
    'uses'  => 'TesisController@actualizarInscripcion'
]);

Route::get('/tesis/obtener/{id}',[
    'uses'  => 'TesisController@obtener'
]);

//Docente
Route::get('/docente/listar',[
    'uses'  => 'DocenteController@listar'
]);

Route::get('/docente/busqueda',[
    'uses'  => 'DocenteController@busqueda'
]);


//Expedito
Route::post('/dictamenExpedito/registrar',[
    'uses'  => 'DictamenExpeditoController@registrar'
]);

Route::post('/dictamenExpedito/actualizar/{id}',[
    'uses'  => 'DictamenExpeditoController@actualizarRegistro'
]);

//DesignacionJuradoExaminador
Route::post('/designacionJuradoExaminador/registrar',[
    'uses'  => 'DesignacionJuradoExaminadorController@registrar'
]);

Route::get('/designacionJuradoExaminador/obtener/{id}',[
    'uses'  => 'DesignacionJuradoExaminadorController@obtener'
]);

//DesignacionJuradoInformante
Route::post('/designacionJuradoInformante/registrar',[
    'uses'  => 'DesignacionJuradoInformanteController@registrar'
]);

Route::get('/designacionJuradoInformante/obtener/{id}',[
    'uses'  => 'DesignacionJuradoInformanteController@obtener'
]);