<?php

namespace App\Http\Middleware;

use Closure;

class Cors
 {
     /**
       * Handle an incoming request.
        *
       * @param  \Illuminate\Http\Request  $request
    -     * @param  \Closure  $next
    -     * @return mixed
    -     */
  public function handle($request, Closure $next)
  {
    $response = $next($request);  
    $response->headers->set('Access-Control-Allow-Origin', '*'); 
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS'); 
    $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, x-xsrf-token, x_csrftoken, Authorization,Access-Control-Allow-Origin, Origin, Accept, X-Requested-With, FASE, OBJETIVO-ID,MONTH-ID ,INDICADOR-ID, START-UP-ID, VISION-ID, RETO-ID, EVALUACION-ID, USER-ID,FASE-ID,API-TOKEN,URL,Access-Control-Request-Method, Access-Control-Request-Headers, Access-Control-Allow-Headers', 'URL');  
    return $response; 

    /*return $next($request)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, x-xsrf-token, x_csrftoken, Authorization,Access-Control-Allow-Origin, Origin, Accept, X-Requested-With, OBJETIVO-ID,MONTH-ID ,INDICADOR-ID, START-UP-ID, VISION-ID, RETO-ID, EVALUACION-ID, USER-ID,FASE-ID,API-TOKEN,Access-Control-Request-Method, Access-Control-Request-Headers, Access-Control-Allow-Headers');
  */
      }
}