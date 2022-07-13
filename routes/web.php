<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\FornitoriController;

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

Route::get('/' , [PublicController::class , 'welcome'])->name('welcome');
Route::get('/ricambi' , [PublicController::class , 'vistaRicambi'])->name('vistaRicambi');



Route::get('/fornitori' , [FornitoriController::class , 'listaFornitori'])->name('listaFornitori');
Route::get('/aggiungi/fornitore' , [FornitoriController::class , 'aggiungiFornitore'])->name('aggiungiFornitore');
Route::post('/aggiungi/fornitore/invio/dati' , [FornitoriController::class , 'aggiungiNuovoFornitore'])->name('aggiungiNuovoFornitore');

Auth::routes();


