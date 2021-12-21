<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('admin.login');
});

Route::get('/adhesion', 'App\Http\Controllers\Client\AdherentController@adhesion')->name('client.adhesion');

Route::get('/', 'App\Http\Controllers\Admin\HomeController@index')->name('admin.index');



Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->name('admin.')->group( function(){
    //Route::get('/index', 'HomeController@index')->name('index');


    //Adhérents routes
    Route::get('/adherents', 'AdherentController@index')->name('adherent.index');
    Route::get('/souscripteurs', 'AdherentController@souscripteurs')->name('souscripteur.index');

    //Contrats 
    Route::get('/contrats', 'ContratController@index')->name('contrat.index');
    Route::get('/contrats/expire', 'ContratController@expire')->name('contrat.expire');
    Route::get('/contrat/create', 'ContratController@create')->name('contrat.create');
    Route::post('/contrat/store', 'ContratController@store')->name('contrat.store');

    //Dépenses
    Route::get('/depenses', 'DepenseController@index')->name('depense.index');
    Route::get('/depense/create', 'DepenseController@create')->name('depense.create');
    Route::post('/depense/store', 'DepenseController@store')->name('depense.store');

    //Cas assisté
    Route::get('/assistances', 'AssistanceController@index')->name('assistance.index');
    Route::get('/assistance/create', 'AssistanceController@create')->name('assistance.create');
    Route::post('/assistance/store', 'AssistanceController@store')->name('assistance.store');

    //Demande adhésion en ligne
    Route::get('/demandes-a-traiter', 'DemandeController@index')->name('demande.index');
    Route::get('/demandes/valider', 'DemandeController@valider')->name('demande.valider');
    Route::get('/demandes/refuser', 'DemandeController@refuser')->name('demande.refuser');


    //Configuration
    
    //Droit d'inscription
    Route::get('/prix-droit-inscription', 'ConfigurationController@droitInscription')->name('droit-inscription.index');
    Route::post('/prix-droit-inscription/store', 'ConfigurationController@droitInscriptionStore')->name('droit-inscription.store');

    //Cotisations annuelles
    Route::get('/prix-cotisation-annuelle', 'ConfigurationController@prixCotisationAnnuelle')->name('prix-cotisation-annuelle.index');
    Route::post('/prix-cotisation-annuelle/store', 'ConfigurationController@prixCotisationAnnuelleStore')->name('prix-cotisation-annuelle.store');

    //Cotisations exceptionnelles
    Route::get('/prix-cotisation-exceptionnelle', 'ConfigurationController@prixCotisationExceptionnelle')->name('prix-cotisation-exceptionnelle.index');
    Route::post('/prix-cotisation-exceptionnelle/store', 'ConfigurationController@prixCotisationExceptionnelleStore')->name('prix-cotisation-exceptionnelle.store');

    //Kit d'inscription
    Route::get('/prix-kit', 'ConfigurationController@prixKit')->name('prix-kit.index');
    Route::post('/prix-kit/store', 'ConfigurationController@prixKitStore')->name('prix-kit.store');

});

// Formulaire demande d'adhésion en ligne
Route::get('/demande/create', 'App\Http\Controllers\Admin\DemandeController@create')->name('demande.create');
Route::post('/demande/store', 'App\Http\Controllers\Admin\DemandeController@store')->name('demande.store');




