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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('admin.login');
});



//Route::get('/home', 'App\Http\Controllers\Admin\HomeController@index')->name('admin.index');

Route::middleware(['guest'])->group(function(){
    Route::post('checkuser', 'App\Http\Controllers\UserController@checkuser')->name('checkuser');
    Route::post('/adhesion-store', 'App\Http\Controllers\Client\AdherentController@store')->name('adhesion.store');
    Route::get('/adhesion', 'App\Http\Controllers\Client\AdherentController@adhesion')->name('client.adhesion');
});

/*Route::group(['middleware' => 'prevent-back-history'],function(){
  Auth::routes();
  Route::get('/home', 'HomeController@index');
});*/

Route::get('/adhesion-liste', 'App\Http\Controllers\Client\AdherentController@index')->name('client.adhesion.liste')->middleware('auth');

//Route::get('/index', 'HomeController@index')->name('index');
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->name('admin.')->middleware(['auth','route-stack'])->group( function(){

    //Dashboard
    Route::get('/home', 'HomeController@index')->name('index');

    //Adhesion

    //Formulaire d'importation de données
    Route::get('/adhesions/importation', 'AdherentController@importation')->name('adhesion.importation');
    Route::post('/adhesions/importation', 'AdherentController@importationPost')->name('adhesion.importationPost');

    //Formulaire d'ajout d'un adhérent
    Route::get('/adhesions/create', 'AdherentController@create')->name('adhesion.create');

    //Formulaire d'ajout d'un adhérent
    Route::post('/adhesions/store', 'AdherentController@store')->name('adhesion.store');
    
    //Adhesion deja valider
    Route::get('/adhesions-valider-liste', 'AdherentController@adhesion_valider_liste')->name('adhesion.valider.liste');

    //Adhesion deja rejeter
    Route::get('/adhesions-rejeter-liste', 'AdherentController@adhesion_rejeter_liste')->name('adhesion.rejeter.liste');    
    

    //show
    Route::get('/adherent/show/{id}', 'AdherentController@show')->name('adhesion.show');

    //Validation
    Route::get('/adhesion-valider/{id}', 'AdherentController@valider')->name('adhesion.valider');

    //Rejet
    Route::get('/adhesion-rejeter/{id}', 'AdherentController@rejeter')->name('adhesion.rejeter');


    //Adhérents routes
    Route::get('/adherents', 'AdherentController@index')->name('adherent.index');
    Route::get('/beneficiaires', 'AdherentController@beneficiaires')->name('beneficiaires.index');

    //Bloquer ou débloquer le compte
    Route::get('/adherent-bloquer/{id}', 'AdherentController@bloquer')->name('adherent.bloquer');
    Route::get('/adherent-debloquer/{id}', 'AdherentController@debloquer')->name('adherent.debloquer');

    //Adhérent formulaire print
    Route::get('/adherent-formulaire-print/{id}', 'AdherentController@formulaire_print')->name('adherent.formulaire-print');

    //Contrats 
    Route::get('/contrats', 'ContratController@index')->name('contrat.index');
    Route::get('/contrats/expire', 'ContratController@expire')->name('contrat.expire');
    Route::get('/contrat/create', 'ContratController@create')->name('contrat.create');
    Route::post('/contrat/store', 'ContratController@store')->name('contrat.store');

    //Dépenses
    Route::get('/depenses', 'DepenseController@index')->name('depense.index');
    Route::get('/depense/create', 'DepenseController@create')->name('depense.create');
    Route::post('/depense/store', 'DepenseController@store')->name('depense.store');
    Route::get('/depense/edit/{id}', 'DepenseController@edit')->name('depense.edit');
    Route::any('/depense/update/{id}', 'DepenseController@update')->name('depense.update');
    Route::get('/depense/destroy/{id}', 'DepenseController@destroy')->name('depense.destroy');

    /* Cotisations */
    // Cotisations Exceptionnelles
    Route::prefix('/cotisations')->name('cotisations.')->group( function() {
        Route::resource('exceptionnelles', CotisationExceptController::class);
        
        // Cotisations Annuelles
        Route::resource('annuelles', CotisationAnnuController::class);
    });
    //Cas assisté
    Route::get('/assistances', 'AssistanceController@index')->name('assistance.index');
    Route::get('/assistances/{id}', 'AssistanceController@assistance_sous')->name('assistance.souscripteur.index');
    Route::get('/assistance/{id}/create', 'AssistanceController@create')->name('assistance.create');
    Route::get('/assistance/{id}/edit', 'AssistanceController@edit')->name('assistance.edit');
    Route::get('/assistance/{id}/show', 'AssistanceController@show')->name('assistance.show');
    Route::post('/assistance/store', 'AssistanceController@store')->name('assistance.store');
    Route::get('/assistance/{id}/valider', 'AssistanceController@valider')->name('assistance.valider');
    Route::get('/assistance/{id}/rejeter', 'AssistanceController@rejeter')->name('assistance.rejeter');
    Route::get('/assistance/{id}/assister', 'AssistanceController@assister')->name('assistance.assister');
    Route::get('/assistance/{id}/destroy', 'AssistanceController@destroy')->name('assistance.destroy');
    

    Route::get('/assistance/importation', 'AssistanceController@importation')->name('assistance.importation');
    Route::post('/assistance/importation', 'AssistanceController@importationPost')->name('assistance.importationPost');


    //Demande adhésion en ligne
    Route::get('/demandes-a-traiter', 'DemandeController@index')->name('demande.index');
    Route::get('/demandes/valider', 'DemandeController@valider')->name('demande.valider');
    Route::get('/demandes/refuser', 'DemandeController@refuser')->name('demande.refuser');

    //Versement
    Route::post('/versement/store', 'VersementController@store')->name('versement.store');


    //Configuration
    
    //Droit d'inscription
    Route::get('/montant-droit-inscription', 'ConfigurationController@droitInscription')->name('droit-inscription.index');
    Route::post('/montant-droit-inscription/store', 'ConfigurationController@droitInscriptionStore')->name('droit-inscription.store');

    //Cotisations annuelles
    Route::get('/montant-cotisation-annuelle', 'ConfigurationController@cotisationAnnuelle')->name('montant-cotisation-annuelle.index');
    Route::post('/montant-cotisation-annuelle/store', 'ConfigurationController@cotisationAnnuelleStore')->name('montant-cotisation-annuelle.store');

    //Cotisations exceptionnelles
    Route::get('/montant-cotisation-exceptionnelle', 'ConfigurationController@cotisationExcept')->name('montant-cotisation-exceptionnelle.index');
    Route::post('/montant-cotisation-exceptionnelle/store', 'ConfigurationController@cotisationExceptionnelleStore')->name('montant-cotisation-exceptionnelle.store');

    //Kit d'inscription
    Route::get('/montant-kit', 'ConfigurationController@traitementKit')->name('montant-kit.index');
    Route::post('/montant-kit/store', 'ConfigurationController@traitementKitStore')->name('montant-kit.store');

    //Mois de carence
    Route::get('/duree-fin-de-carence', 'ConfigurationController@dureeFincarence')->name('duree-carence.index');
    Route::post('/duree-fin-de-carence/store', 'ConfigurationController@dureeFincarenceStore')->name('duree-carence.store');

    //Ajax
    
    //Afficher les informations d'un bénéficiaire à partir de son numéro d'adhesion
    Route::get('get-benef-info/{num_adhesion}', 'AjaxController@getBenefNomPnom')->name('get-benef-info.search');

});

// Formulaire demande d'adhésion en ligne
Route::get('/demande/create', 'App\Http\Controllers\Admin\DemandeController@create')->name('demande.create');
Route::post('/demande/store', 'App\Http\Controllers\Admin\DemandeController@store')->name('demande.store');


Route::get('back', function () {
    $array = $tab = session('routeStack');
    $routeName = array_pop($array);
    $routeName = array_pop($array);
    session(['routeStack' => $array]);
    return redirect()->route($routeName == "" ? 'admin.index' : $routeName);
})->name('backStack');


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
