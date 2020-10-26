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

Route::get('/', 'HomeController@admin')->name('admin.home');
Route::get('/secretaire', 'HomeController@secretaire')->name('secretaire.home');
Route::get('/service', 'HomeController@service')->name('service.home');
Auth::routes();