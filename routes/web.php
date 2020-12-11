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
Route::get('/services', 'HomeController@service')->name('service.home');

/**
 * Route Dossier
 */
Route::get('/dossier/{type}', 'DossierController@listeDossier')->name('dossiers.list');
Route::get('/dossiers', 'DossierController@dossiers')->name('dossiers.all');
Route::get('/dossiers/detail/{id}', 'DossierController@detail')->name('dossier.detail');
Route::get('/dossiers/find', 'DossierController@find')->name('dossiers.find');
Route::post('/Dossier/create', 'DossierController@store')->name('dossier.store');
Route::get('/Dossier/group', 'DossierController@group')->name('dossier.group');
Route::get('/Dossier/group/{id}', 'DossierController@showGroup')->name('dossier.group.show');
Route::get('/dossier/quotation/{id}/{dossier_id}', 'DossierController@quotation')->name('dossier.quotation');
Route::get('/dossier/traiter/{id}', 'DossierController@traiter')->name('dossier.traiter');
Route::get('/dossier/find/result', 'DossierController@findresult')->name('dossier.result');
Route::patch('/dossier/update/{id}', 'DossierController@update')->name('dossier.update');
Route::patch('/dossier/delete/{id}', 'DossierController@delete')->name('dossier.delete');

/**
 * Route Personnel
 */
Route::get('/personnels', 'PersonnelController@index')->name('personnel.index');
Route::post('/personnels', 'PersonnelController@store')->name('personnel.store');
Route::get('/personnels/{id}', 'PersonnelController@edit')->name('personnel.edit');
Route::post('/personnels/{id}', 'PersonnelController@update')->name('personnel.update');
/*
 * poste routes
 */
Route::get('/postes', 'PosteController@index')->name('poste.index');
Route::post('/postes', 'PosteController@store')->name('poste.store');
Route::get('/postes/{id}', 'PosteController@edit')->name('poste.edit');
Route::post('/postes/{id}', 'PosteController@update')->name('poste.update');


/**
 *Route Step
 */
Route::post('/step/create', 'StepController@store')->name('step.store');
Route::get('/step/destroy/{id}', 'StepController@destroy')->name('step.destroy');


/**
 *Route Type de Dossiers
 */
Route::post('/typedossier', 'TypeDossierController@store')->name('typedossier.store')->middleware('auth');
Route::post('/type/create', 'TypeDossierController@store')->name('type.store');
Route::get('/type', 'TypeDossierController@index')->name('type.index');

/**
 *Route de Services
 */
Route::post('/service/create', 'ServiceController@store')->name('service.store');
Route::get('/service', 'ServiceController@index')->name('service.index');
Route::get('/service/listdossier', 'ServiceController@listcoter')->name('service.coter');
Route::get('/service/traite', 'ServiceController@listTraiter')->name('service.traiter');


/**
 *Route d'utilisateurs
 */
Route::post('/user/create', 'HomeController@store')->name('user.store');
Route::get('/users', 'HomeController@index')->name('user.index');
Route::get('/users/edit/{user}', 'HomeController@edit')->name('user.edit');
Route::post('/users', 'HomeController@saveUser')->name('user.store');
Route::patch('/users/update/{id}', 'HomeController@updateUser')->name('user.update');
Route::patch('/users/delete//{id}', 'HomeController@deletetUser')->name('user.delete');

/**
 * Route Categorie
 */
Route::get('/categorie', 'CategorieController@index')->name('categorie.index');
Route::post('/categorie', 'CategorieController@store')->name('categorie.store');
Route::patch('/categorie/{id}', 'CategorieController@update')->name('categorie.update');
Route::delete('/categorie/{id}', 'CategorieController@destroy')->name('categorie.delete');


/**
 * Route District
 */
Route::get('/district', 'DistrictController@index')->name('district.index');
Route::post('/district', 'DistrictController@store')->name('district.store');
Route::patch('/district/{id}', 'DistrictController@update')->name('district.update');
Route::delete('/district/{id}', 'DistrictController@destroy')->name('district.delete');

/**
 * Route Groupe
 */
Route::get('/groupe', 'GroupeController@index')->name('groupe.index');
Route::post('/groupe', 'GroupeController@store')->name('groupe.store');
Route::patch('/groupe/{id}', 'GroupeController@update')->name('groupe.update');
Route::delete('/groupe/{id}', 'GroupeController@destroy')->name('groupe.delete');

/**
 * Route Region
 */
Route::get('/region', 'RegionController@index')->name('region.index');
Route::post('/region', 'RegionController@store')->name('region.store');
Route::patch('/region/{id}', 'RegionController@update')->name('region.update');
Route::delete('/region/{id}', 'RegionController@destroy')->name('region.delete');

/**
 * Route Structure
 */
Route::get('/structure', 'StructureController@index')->name('structure.index');
Route::post('/structure', 'StructureController@store')->name('structure.store');
Route::patch('/structure/{id}', 'StructureController@update')->name('structure.update');
Route::delete('/structure/{id}', 'StructureController@destroy')->name('structure.delete');



Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

/*
 * Route Pour les affectations
 */
Route::get("/affectations","FicheAffectationController@index")->name("affectation.index");
Route::post("/affectations","FicheAffectationController@store")->name("affectation.store");
Route::get("/affectations/{id}","FicheAffectationController@edit")->name("affectation.edit");
Route::post("/affectations/{id}","FicheAffectationController@update")->name("affectation.update");
Route::get("/affectations/{id}/print","FicheAffectationController@print")->name("affectation.print");
Route::get("/affectations/{id}/manage","FicheAffectationController@manage")->name("affectation.manage");
Route::post("/affectations/{id}/manage/add","AffectationController@new")->name("affectation.new");
Route::get("/affectations/{id}/delete","AffectationController@delete")->name("affectation.delete");
Route::get("/personnel/verificate/{mat}/{fiche}","AffectationController@getPersonnelFromMat")->name("personnel.find");
Route::get("/affectation/pdf",function(){
    return view("affectations.pdf");
})->name("affect.pdf");
