<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\FornitoriController;


Route::get('/' , [PublicController::class , 'welcome'])->name('welcome');

//rotte per ricambi
Route::get('/ricambi' , [PublicController::class , 'vistaRicambi'])->name('vistaRicambi');
Route::get('/aggiungi/ricambio' , [PublicController::class , 'vistaAggiungiRicambi'])->name('vistaAggiungiRicambi');
Route::post('/aggiungi/nuovo/ricambio' , [PublicController::class , 'aggiungiRicambi'])->name('aggiungiRicambi');


//rotte per fornitori
Route::get('/fornitori' , [FornitoriController::class , 'listaFornitori'])->name('listaFornitori');
Route::get('/aggiungi/fornitore' , [FornitoriController::class , 'aggiungiFornitore'])->name('aggiungiFornitore');
Route::post('/aggiungi/fornitore/invio/dati' , [FornitoriController::class , 'aggiungiNuovoFornitore'])->name('aggiungiNuovoFornitore');


//rotte per categorie
Route::get('/categorie' , [PublicController::class , 'vistaCategorie'])->name('vistaCategorie');
Route::get('/aggiungi/categoria' , [PublicController::class , 'vistaAggiungiCategoria'])->name('vistaAggiungiCategoria');
Route::post('/aggiungi/categoria/invio/dati' , [PublicController::class , 'aggiungiCategoria'])->name('aggiungiCategoria');



Auth::routes();


