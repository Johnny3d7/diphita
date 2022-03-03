<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class RouteStack
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $home = 'admin.index';
        $to_ignore = [
            'admin.adhesion.valider',
            'admin.adhesion.rejeter',
            'admin.beneficiaire.remove',
            'admin.ayantdroit.remove',
            'admin.adherent.bloquer',
            'admin.adherent.debloquer',
            'admin.depense.destroy',
            'admin.assistance.valider',
            'admin.assistance.rejeter',
            'admin.assistance.assister',
            'admin.assistance.destroy',
            'admin.assistance.publier',
            'admin.assistance.publier',
            'admin.demande.valider',
            'admin.demande.refuser',
        ];

        if($request->method() == "GET" && !in_array(Route::currentRouteName(), $to_ignore)){
            $array = session('routeStack');
            if(Route::currentRouteName() == $home){
                session(['routeStack' => []]);
            } else {
                if(count($array) == 0 || $array[array_unshift($array)-1]["name"] != Route::currentRouteName()){
                    array_push($array, [
                        'name' => Route::currentRouteName(),
                        'params' => Route::getCurrentRoute()->parameters()
                    ]);
                    session(['routeStack' => $array]);
                }
            }
        }
        return $next($request);
    }
}
