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

Route::get('/', 'viewController@home')->name('home');
Route::get('/contact', 'viewController@contact')->name('contact');

Route::get('/profil', 'profilController@viewProfil')->name('profil');
Route::post('/schimbareavatar', 'profilController@avatarpost')->name('sadp');

Route::get('/cursuri', 'cursuriController@viewCursuri')->name('cursuri');
Route::get('/curs/{id}', 'cursuriController@vizualizarecurs')->name('curs');
Route::post('/inscrierecurs/{id}', 'cursuriController@inscriere')->name('inscrierecurs');
Route::get('/lectie/{id_curs}/{id_capitol}/{id_lectie}', 'cursuriController@vizualizarelectie')->name('lectie');
Route::get('/quiz/{id_curs}/{id_capitol}/{id_quiz}', 'cursuriController@quiz')->name('quiz');
Route::post('/rquiz/{id_curs}/{id_capitol}/{id_quiz}', 'cursuriController@verificarequiz')->name('rquiz');

Route::get('/cursurilemele', 'profilController@cursurilemele')->name('cursurilemele');
Route::get('/cm/{id}', 'profilController@cursget')->name('cm');

Route::post('/rezultat/{id}', 'compilerController@compileAPI')->name('compileAPI');

Route::get('/probleme', 'compilerController@vizualizareprobleme')->name('probleme');
Route::get('/problema/{id}', 'compilerController@vw')->name('problema');

Route::get('/solutiiuser/{id}', 'solutieController@vwuser')->name('solutii');
Route::get('/rezultat/{id}', 'compilerController@vizualizare')->name('solutie');

Auth::routes(['verify' => true]);
