<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Route Home By UserRole
 */
Route::get('/admin', 'HomeController@admin')->name('admin.home');
Route::get('/secretaire', 'HomeController@secretaire')->name('secretaire.home');
Route::get('/service', 'HomeController@service')->name('service.home');

/**
 * Route Dossier
 */
Route::get('/dossier/{type}', 'DossierController@listeDossier')->name('dossiers.list');
Route::get('/dossiers', 'DossierController@dossiers')->name('dossiers.all');
Route::get('/dossiers/detail/{id}', 'DossierController@detail')->name('dossier.detail');
Route::get('/dossiers/find', 'DossierController@find')->name('dossiers.find');
Route::post('/Dossier/create', 'DossierController@store')->name('dossier.store');
Route::get('/dossier/quotation/{id}/{dossier_id}', 'DossierController@quotation')->name('dossier.quotation');

/**
 * Route Personne
 */
Route::get('/personne/create', 'PersonneController@create')->name('personne.create');
Route::post('/personne/create', 'PersonneController@store')->name('personne.store');
Route::get('/personne/dossier/{idpersonne}', 'PersonneController@aboutDossier')->name('personne.dossier');


/**
 *Route Step
 */
Route::post('/step/create', 'StepController@store')->name('step.store');
Route::get('/step/destroy/{id}', 'StepController@destroy')->name('step.destroy');









Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
