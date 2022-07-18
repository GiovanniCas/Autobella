<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\VettureController;
use App\Http\Controllers\FornitoriController;

//parte pubblica
Route::get('/' , [PublicController::class , 'welcome'])->name('welcome');
Route::post('/cerca/ricambi/per/vettura' , [PublicController::class , 'cercaRicambiCompatibili'])->name('cercaRicambiCompatibili');
Route::get('/carrello' , [PublicController::class , 'carrello'])->name('carrello');
Route::post('/aggiungi/al/carrello' , [PublicController::class , "aggiungiAlCarrello"])->name("aggiungiAlCarrello");
Route::put('/modifica/quantita/carrello' , [PublicController::class , "modificaQuantitaDesiderate"])->name("modificaQuantitaDesiderate");
Route::get('/ordine' , [PublicController::class , "ordine"])->name("ordine");
Route::post('/conferma/ordine' , [PublicController::class , "confermaOrdine"])->name("confermaOrdine");




//rotte per ricambi
Route::get('/ricambi' , [FornitoriController::class , 'vistaRicambi'])->name('vistaRicambi');
Route::get('/aggiungi/ricambio' , [FornitoriController::class , 'vistaAggiungiRicambi'])->name('vistaAggiungiRicambi');
Route::post('/aggiungi/nuovo/ricambio' , [FornitoriController::class , 'aggiungiRicambi'])->name('aggiungiRicambi');
Route::get('/modifica/ricambio/{ricambio}' , [FornitoriController::class , 'vistaModificaRicambio'])->name('vistaModificaRicambio');
Route::put('/modifica/ricambio/invio/dati/{ricambio}' , [FornitoriController::class , 'modificaRicambio'])->name('modificaRicambio');
Route::delete('/elimina/ricambio/{ricambio}' , [FornitoriController::class , 'eliminaRicambio'])->name('eliminaRicambio');


//rotte per fornitori
Route::get('/fornitori' , [FornitoriController::class , 'listaFornitori'])->name('listaFornitori');
Route::get('/aggiungi/fornitore' , [FornitoriController::class , 'aggiungiFornitore'])->name('aggiungiFornitore');
Route::post('/aggiungi/fornitore/invio/dati' , [FornitoriController::class , 'aggiungiNuovoFornitore'])->name('aggiungiNuovoFornitore');
Route::get('/modifica/fornitore/{fornitore}' , [FornitoriController::class , 'vistaModificaFornitore'])->name('vistaModificaFornitore');
Route::put('/modifica/fornitore/invio/dati/{fornitore}' , [FornitoriController::class , 'modificaFornitore'])->name('modificaFornitore');
Route::delete('/elimina/fornitore/{fornitore}' , [FornitoriController::class , 'eliminaFornitore'])->name('eliminaFornitore');


//rotte per categorie
Route::get('/categorie' , [FornitoriController::class , 'vistaCategorie'])->name('vistaCategorie');
Route::get('/aggiungi/categoria' , [FornitoriController::class , 'vistaAggiungiCategoria'])->name('vistaAggiungiCategoria');
Route::post('/aggiungi/categoria/invio/dati' , [FornitoriController::class , 'aggiungiCategoria'])->name('aggiungiCategoria');
Route::get('/modifica/categoria/{categoria}' , [FornitoriController::class , 'vistaModificaCategoria'])->name('vistaModificaCategoria');
Route::put('/modifica/categoria/invio/dati/{categoria}' , [FornitoriController::class , 'modificaCategoria'])->name('modificaCategoria');
Route::delete('/elimina/categoria/{categoria}' , [FornitoriController::class , 'eliminaCategoria'])->name('eliminaCategoria');


//rotte per modelli
Route::get('/modelli' , [VettureController::class , 'vistaModelli'])->name('vistaModelli');
Route::get('/aggiungi/modello' , [VettureController::class , 'vistaAggiungiModello'])->name('vistaAggiungiModello');
Route::post('/aggiungi/modello/invio/dati' , [VettureController::class , 'aggiungiModello'])->name('aggiungiModello');
Route::get('/modifica/modello/{modello}' , [VettureController::class , 'vistaModificaModello'])->name('vistaModificaModello');
Route::put('/modifica/modello/invio/dati/{modello}' , [VettureController::class , 'modificaModello'])->name('modificaModello');
Route::delete('/elimina/modello/{modello}' , [VettureController::class , 'eliminaModello'])->name('eliminaModello');


//rotte per marche
Route::get('/marche' , [VettureController::class , 'vistaMarche'])->name('vistaMarche');
Route::get('/aggiungi/marca' , [VettureController::class , 'vistaAggiungiMarca'])->name('vistaAggiungiMarca');
Route::post('/aggiungi/marca/invio/dati' , [VettureController::class , 'aggiungiMarca'])->name('aggiungiMarca');
Route::get('/modifica/marca/{marca}' , [VettureController::class , 'vistaModificaMarca'])->name('vistaModificaMarca');
Route::put('/modifica/marca/invio/dati/{marca}' , [VettureController::class , 'modificaMarca'])->name('modificaMarca');
Route::delete('/elimina/marca/{marca}' , [VettureController::class , 'eliminaMarca'])->name('eliminaMarca');


Auth::routes();


