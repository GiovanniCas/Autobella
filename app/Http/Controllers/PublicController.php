<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modello;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Http\Request;
use App\Models\ModelloCompatibile;
use App\Http\Controllers\Controller;


class PublicController extends Controller
{
    public function welcome(){
        $marche = Marca::all();
        return view('welcome', compact('marche'));
    }

    public function cercaRicambiCompatibili(Request $request){
        //dd($request);
        $cercaModello = $request->cercaModello;
        $cercaMarca = $request->cercaMarca;
        $cercaRicambio = $request->cercaRicambio;
        $cercaAnnoProduzione = $request->cercaAnnoProduzione;

        session()->put('cercaRicambio' , $cercaRicambio);
        session()->put('cercaAnnoProduzione' , $cercaAnnoProduzione);
        session()->put('cercaModello' , $cercaModello);
        session()->put('cercaMarca' , $cercaMarca);

        return redirect(route('vistaRicambi'));
    }

    
    
    
}