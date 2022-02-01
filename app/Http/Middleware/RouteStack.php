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
        $array = session('routeStack');
        if(Route::currentRouteName() == 'admin.index'){
            session(['routeStack' => []]);
        } else {
            if(count($array) == 0 || $array[array_unshift($array)-1] != Route::currentRouteName()){
                array_push($array, Route::currentRouteName());
                session(['routeStack' => $array]);
            }
        }
        return $next($request);
    }
}
