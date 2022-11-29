<?php

use App\Http\Controllers\Admin\AdherentController;
use App\Http\Controllers\Admin\CotisationController;
use App\Http\Controllers\MessageController;
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

Route::post('montant-du-souscripteur',[AdherentController::class, 'getMontantDu'])->name('apiGetMontantDuSouscripteur');
Route::post('souscripteurs-a-avertir',[AdherentController::class, 'getSouscripteurAvertir'])->name('apiGetSouscripteurAvertir');

Route::post('cotisations-dues',[AdherentController::class, 'getCotisationsDues'])->name('apiGetCotisationsDues');
Route::post('personnal-message',[AdherentController::class, 'getPersonnalMessage'])->name('apiGetPersonnalMessage');
Route::post('send-messages',[MessageController::class, 'postSendMessages'])->name('apiPostSendMessages');
