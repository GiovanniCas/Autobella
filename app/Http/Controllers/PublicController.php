<?php

namespace App\Http\Controllers;

use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function vistaRicambi(){
        $ricambi = Ricambio::all();
        return view('ricambiLista' , compact('ricambi'));
    }

    public function vistaAggiungiRicambi(){
        $fornitori = Fornitore::all();
        $categorie = Categoria::all();
        return view('ricambiForm' , compact('fornitori'))->with(compact('categorie'));
    }

    public function aggiungiRicambi(Request $request){
        $ricambio = Ricambio::create([
            'fornitore_id' => $request->input('fornitore_id'),
            'categoria_id' => $request->input('categoria_id'),
            'codice_pezzo' => $request->input('codice_pezzo'),
            'descrizione' => $request->input('descrizione'),
            'prezzo' => $request->input('prezzo'),
        ]);
        return redirect(route('vistaRicambi'));
    }

    public function vistaCategorie(){
        $categorie = Categoria::all();
        return view('categorie.lista' , compact('categorie'));
    }

    public function vistaAggiungiCategoria(){
        
        return view('categorie.form');
    }

    public function aggiungiCategoria(Request $request){
        //dd($request->all());
        $categoria = Categoria::create([
            'descrizione' => $request->input('descrizione'),
        ]);
        return redirect(route('vistaCategorie'));
    }
    
    
}