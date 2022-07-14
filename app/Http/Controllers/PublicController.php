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
        $fornitori = Fornitore::all();
        return view('ricambi.lista' , compact('ricambi'))->with(compact('fornitori'));
    }

    public function vistaAggiungiRicambi(){
        $fornitori = Fornitore::all();
        $categorie = Categoria::all();
        return view('ricambi.formAggiunta' , compact('fornitori'))->with(compact('categorie'));
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

    public function vistaModificaRicambio(Ricambio $ricambio){
        $fornitori = Fornitore::all();
        $categorie = Categoria::all();
      
        return view('ricambi.formModifica', compact('ricambio'))->with(compact('fornitori'))->with(compact('categorie'));
    }

    public function modificaRicambio( Ricambio $ricambio ,Request $request){
        
        $ricambio->codice_pezzo = $request->codice_pezzo;
        $ricambio->descrizione = $request->descrizione;
        $ricambio->prezzo = $request->prezzo;
        $ricambio->fornitore_id = $request->fornitore_id;
        $ricambio->categoria_id = $request->categoria_id;
        
        $ricambio->save();
        return redirect(route('vistaRicambi'));
    }

    public function eliminaRicambio(Ricambio $ricambio ){
        
        $ricambio->delete();
        return redirect(route('vistaRicambi'));
    }

    public function vistaCategorie(){
        $categorie = Categoria::all();
        return view('categorie.lista' , compact('categorie'));
    }

    public function vistaAggiungiCategoria(){
        
        return view('categorie.formAggiunta');
    }

    public function aggiungiCategoria(Request $request){
        //dd($request->all());
        $categoria = Categoria::create([
            'descrizione' => $request->input('descrizione'),
        ]);
        return redirect(route('vistaCategorie'));
    }

    public function vistaModificaCategoria(Categoria $categoria){
      
        return view('categorie.formModifica', compact('categoria'));
    }

    public function modificaCategoria( Categoria $categoria ,Request $request){
        
        $categoria->descrizione = $request->descrizione;
        
        $categoria->save();
        return redirect(route('vistaCategorie'));
    }

    public function eliminaCategoria(Categoria $categoria ){
        
        $categoria->delete();
        return redirect(route('vistaCategorie'));
    }
    
    
}