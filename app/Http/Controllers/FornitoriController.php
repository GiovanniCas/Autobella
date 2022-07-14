<?php

namespace App\Http\Controllers;

use App\Models\Fornitore;
use Illuminate\Http\Request;

class FornitoriController extends Controller
{
    public function listaFornitori(){
        $fornitori = Fornitore::all();     
        return view('fornitori.lista' , compact('fornitori'));
    }

    public function aggiungiFornitore(){
             
        return view('fornitori.formAggiunta' );
    }

    public function aggiungiNuovoFornitore(Request $request){
        //dd($request->all());
        $fornitore = Fornitore::create([
            'ragione_sociale' => $request->input('ragione_sociale'),
            'indirizzo' => $request->input('indirizzo'),
            'comune' => $request->input('comune'),
            'cap' => $request->input('cap'),
            'provincia' => $request->input('provincia'),
            'partita_iva' => $request->input('partita_iva'),
        ]);

        $fornitore->save();

        return redirect(route('listaFornitori'));
    }

    public function vistaModificaFornitore(Fornitore $fornitore){
      
        return view('fornitori.formModifica', compact('fornitore'));
    }

    public function modificaFornitore( Fornitore $fornitore ,Request $request){
        
        //dd($fornitore);
        $fornitore->ragione_sociale = $request->ragione_sociale;
        $fornitore->indirizzo = $request->indirizzo;
        $fornitore->comune = $request->comune;
        $fornitore->cap = $request->cap;
        $fornitore->provincia = $request->provincia;
        $fornitore->partita_iva = $request->partita_iva;
        $fornitore->save();
        return redirect(route('listaFornitori'));
    }

    public function eliminaFornitore(Fornitore $fornitore ){
        
        $fornitore->delete();
        return redirect(route('listaFornitori'));
    }
}
