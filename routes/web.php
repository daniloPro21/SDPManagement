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
Route::get('/admin', 'HomeController@admin')->name('admin.home')->middleware("role:admin");;
Route::get('/secretaire', 'HomeController@secretaire')->name('secretaire.home');
Route::get('/services', 'HomeController@service')->name('service.home');

/**
 * Route Dossier
 */
Route::get('/dossier/{type}', 'DossierController@listeDossier')->name('dossiers.list');
Route::get('/dossiers', 'DossierController@dossiers')->name('dossiers.all');
Route::get('/get/admin-non-coter', 'DossierController@shownoncoter')->name('dossiers.noncoter_admin');
Route::get('/get/admin-traiter_dossier', 'DossierController@showtraiteradmin')->name('dossiers.traiter-admin');
Route::get('/get/admin-cote_dossier', 'DossierController@showcotedossier')->name('dossiers.coter-admin');
Route::get('/dossiers/detail/{id}', 'DossierController@detail')->name('dossier.detail');
Route::get('/dossiers/find', 'DossierController@find')->name('dossiers.find');
Route::post('/Dossier/create', 'DossierController@store')->name('dossier.store');
Route::get('/Dossier/group', 'DossierController@group')->name('dossier.group');
Route::get('/Dossier/group/{id}', 'DossierController@showGroup')->name('dossier.group.show');
Route::get('/dossier/quotation/{id}/{dossier_id}', 'DossierController@quotation')->name('dossier.quotation');
Route::get('/dossier/send/{id_service}/{dossier_id}', 'DossierController@servicequotation')->name('dossier.quotation_service');
Route::get('/dossier/traiter/{id}', 'DossierController@traiter')->name('dossier.traiter');
Route::get('/dossier/getback/{id}', 'DossierController@getbackdossier')->name('dossier.getback');
Route::get('/dossier/rejete/{id}', 'DossierController@rejete')->name('dossier.rejete');
Route::get('/dossier/transmis/{id}', 'DossierController@transmis')->name('dossier.transmis');
Route::get('/dossier/delegue/{id_dossier}/{id_user}', 'DossierController@delegue')->name('dossier.delegue');
Route::get('/dossier/signed/{id}', 'DossierController@signed')->name('dossier.signed');
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
Route::get('/service', 'ServiceController@index')->name('service.index')->middleware('role:service,cardre');
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
 * Route Structure */
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
Route::get("/affectations","FicheAffectationController@index")->name("affectation.index")->middleware("role:admin,superadmin");
Route::get("/affectations/lock/{id}","FicheAffectationController@lock")->name("affectation.lock")->middleware("role:admin,superadmin");
Route::get("/affectations/unlock/{id}","FicheAffectationController@unlock")->name("affectation.unlock")->middleware("role:admin,superadmin");
Route::post("/affectations","FicheAffectationController@store")->name("affectation.store")->middleware("role:admin,superadmin");
Route::get("/affectations/{id}","FicheAffectationController@edit")->name("affectation.edit")->middleware("role:admin,superadmin");

Route::get("/ficheaffectation/delete/{id}","FicheAffectationController@delete")->name("ficheaffectation.delete")->middleware("role:admin,superadmin");

Route::post("/affectations/{id}","FicheAffectationController@update")->name("affectation.update")->middleware("role:admin,superadmin");
Route::get("/affectations/{id}/print","FicheAffectationController@print")->name("affectation.print")->middleware("role:admin,superadmin");
Route::get("/affectations/{id}/manage","FicheAffectationController@manage")->name("affectation.manage")->middleware("role:admin,superadmin");
Route::post("/affectations/{id}/manage/add","AffectationController@new")->name("affectation.new")->middleware("role:admin,superadmin");
Route::get("/affectations/{id}/delete","AffectationController@delete")->name("affectation.delete")->middleware("role:admin,superadmin");
Route::get("/personnel/verificate/{mat}/{fiche}","AffectationController@getPersonnelFromMat")->name("personnel.find")->middleware("role:admin,superadmin");
Route::get("/affectation/pdf",function(){
    $fiche = \App\Models\FicheAffectation::findOrFail(1);
    dd($fiche->affectations->first()->poste);
    return view("affectations.pdf",compact('fiche'));
})->name("affect.pdf")->middleware("role:admin,superadmin");

/*
 * Route Pour les nominations
 */
Route::get("/nominations","FicheNominationController@index")->name("nomination.index")->middleware("role:admin,superadmin");
Route::get("/nominations/lock/{id}","FicheNominationController@lock")->name("nomination.lock")->middleware("role:admin,superadmin");;
Route::get("/nominations/unlock/{id}","FicheNominationController@unlock")->name("nomination.unlock")->middleware("role:admin,superadmin");
Route::post("/nominations","FicheNominationController@store")->name("nomination.store")->middleware("role:admin,superadmin");
Route::get("/nominations/{id}","FicheNominationController@edit")->name("nomination.edit")->middleware("role:admin,superadmin");;

Route::get("/fichenominations/delete/{id}","FicheNominationController@delete")->name("fichenominations.delete")->middleware("role:admin,superadmin");;

Route::post("/nominations/{id}","FicheNominationController@update")->name("nomination.update")->middleware("role:admin,superadmin");;
Route::get("/nominations/{id}/print","FicheNominationController@print")->name("nomination.print")->middleware("role:admin,superadmin");;
Route::get("/nominations/{id}/manage","FicheNominationController@manage")->name("nomination.manage")->middleware("role:admin,superadmin");;
Route::post("/nominations/{id}/manage/add","AffectationController@new")->name("nomination.new")->middleware("role:admin,superadmin");;
Route::get("/nominations/{id}/delete","FicheNominationController@delete")->name("nomination.delete")->middleware("role:admin,superadmin");
Route::get("/nominations/pdf",function(){
    $fiche = \App\Models\FicheAffectation::findOrFail(1);
    dd($fiche->affectations->first()->poste);
    return view("nominations.pdf",compact('fiche'));
})->name("affect.pdf");
/**
 * Nomination Route
 */
//Route::get('nomination', 'NominationController@index')->name('nomination.index');
Route::get('cds', 'NominationController@cds')->name('nomination.cds');
Route::get('eco', 'NominationController@eco')->name('nomination.eco');

/**
 * Route Supper admin
 */

Route::get('superadmin/home', 'SuperAdminController@index')->name('super.home')->middleware("role:superadmin,secdrh");
Route::get('secdrh/home', 'SuperAdminController@index')->name('secdrh.home')->middleware("role:secdrh");


/**
 * Trace Route
 */
Route::post("/trace/add","TraceController@store")->name("trace.add");
Route::patch("/trace/update","TraceController@update")->name("trace.update");

/**
 * Route Transmission
 */
Route::get('transmission', 'TransmissionController@index')->name('transmission.index');
Route::get('transmission/{id}', 'TransmissionController@show')->name('transmission.show');
Route::post('transmission/store', 'TransmissionController@store')->name('transmission.store');
Route::get('transmission/lock/{id}', 'TransmissionController@lock')->name('transmission.lock');
Route::get('transmission/unlock/{id}', 'TransmissionController@unlock')->name('transmission.unlock');
Route::post('transmission/new/{id}', 'TransmissionController@newossier')->name('transmission.new');
Route::get('transmission/delete/{id}', 'TransmissionController@removedossier')->name('transmission.removedossier');
Route::get('transmission/deleted/{id}', 'TransmissionController@delete')->name('transmission.delete');
Route::get('transmission/print/{id}', 'TransmissionController@print')->name('transmission.print');


/**
 * Non Authorize
 */
Route::get('/non-authrize', function (Request $request) {
    return view("error");
})->name("error");


/**
 * Route bordreau
 */
Route::get('bordereau', 'BorderauController@index')->name('bordreau.index');
Route::get('bordereau/{id}', 'BorderauController@show')->name('bordreau.show');
Route::post('bordereau/store', 'BorderauController@store')->name('bordreau.store');
Route::get('bordereau/lock/{id}', 'BorderauController@lock')->name('bordreau.lock');
Route::get('bordereau/unlock/{id}', 'BorderauController@unlock')->name('bordreau.unlock');
Route::post('bordereau/new/{id}', 'BorderauController@newossier')->name('bordreau.new');
Route::get('bordereau/delete/{id}', 'BorderauController@removedossier')->name('bordreau.removedossier');
Route::get('bordereau/print/{id}', 'BorderauController@print')->name('bordreau.print');
Route::get('bordereau/deleted/{id}', 'BorderauController@delete')->name('bordreau.delete');

/**
 * General services
 */
Route::post('/servicegeneral/create', 'ServiceGeneralController@store')->name('servicegeneral.store');
Route::get('/servicegeneral', 'ServiceGeneralController@index')->name('servicegeneral.index');
