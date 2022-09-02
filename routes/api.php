<?php

use App\Http\Controllers\Admin\AdherentController;
use App\Http\Controllers\Admin\CotisationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('infos-souscripteur',[AdherentController::class, 'getInfos'])->name('apiGetInfosSouscripteur');
Route::post('infos-cotisation',[CotisationController::class, 'getInfos'])->name('apiGetInfosCotisation');
