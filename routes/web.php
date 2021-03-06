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
Route::get('/serviceHome', 'HomeController@service')->name('services.home');
/**
 * Route Dossier
 */
Route::get('/dossier/{type}', 'DossierController@listeDossier')->name('dossiers.list');
Route::get('/dossiers', 'DossierController@dossiers')->name('dossiers.all');
Route::get('/dossiers/detail/{id}', 'DossierController@detail')->name('dossier.detail');
Route::get('/dossiers/find', 'DossierController@find')->name('dossiers.find');
Route::post('/Dossier/create', 'DossierController@store')->name('dossier.store');
Route::get('/dossier/quotation/{id}/{dossier_id}', 'DossierController@quotation')->name('dossier.quotation');
Route::get('/dossier/find/result', 'DossierController@findresult')->name('dossier.result');

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

/**
*Route Type Dossier
*/

Route::post('/typedossier', 'TypeDossierController@store')->name('typedossier.store')->middleware('auth');
/**
 * Route Type de Dossiers
 */
Route::post('/type/create', 'TypeDossierController@store')->name('type.store');
Route::get('/type', 'TypeDossierController@index')->name('type.index');

/**
 *Route de Services
 */
Route::post('/service/create', 'ServiceController@store')->name('service.store');
Route::get('/service', 'ServiceController@index')->name('service.index');
Route::get('/dossier/serive', 'DossierController@dossierService')->name('dossierServie');
/**
 *Route d'utilisateurs
 */
Route::post('/user/create', 'HomeController@store')->name('user.store');
Route::get('/users', 'HomeController@index')->name('user.index');
/**
 * Route Region
 */
Route::get('region/index', 'RegionController@index')->name('region.index');
Route::patch('region/upadte/{id}', 'RegionController@update')->name('region.update');
Route::get('region/edit/{id}', 'RegionController@edit')->name('region.edit');
Route::post('region/create', 'RegionController@store')->name('region.store');

/**
 * Route Categorie
 */
Route::get('categorie/index', 'CategorieController@index')->name('categorie.index');
Route::patch('categorie/upadte/{id}', 'CategorieController@update')->name('categorie.update');
Route::get('categorie/edit/{id}', 'CategorieController@edit')->name('categorie.edit');
Route::post('categorie/create', 'CategorieController@store')->name('categorie.store');

/**
 * Route District
 */
Route::get('district/index', 'DistrictController@index')->name('district.index');
Route::patch('district/upadte/{id}', 'DistrictController@update')->name('district.update');
Route::get('district/edit/{id}', 'DistrictController@edit')->name('district.edit');
Route::post('district/create', 'DistrictController@store')->name('district.store');


/**
 *  Route Groupe
*/
Route::get('groupe/index', 'GroupeController@index')->name('groupe.index');
Route::patch('groupe/upadte/{id}', 'GroupeController@update')->name('groupe.update');
Route::get('groupe/edit/{id}', 'GroupeController@edit')->name('groupe.edit');
Route::post('groupe/create', 'GroupeController@store')->name('groupe.store');


/**
 *  Route Structure
*/
Route::get('structure/index', 'StructureController@index')->name('structure.index');
Route::patch('structure/upadte/{id}', 'StructureController@update')->name('structure.update');
Route::get('structure/edit/{id}', 'StructureController@edit')->name('structure.edit');
Route::post('structure/create', 'StructureController@store')->name('structure.store');



Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
