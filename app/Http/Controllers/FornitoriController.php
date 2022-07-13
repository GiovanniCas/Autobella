<?php

namespace App\Http\Controllers;

use App\Models\Fornitore;
use Illuminate\Http\Request;

class FornitoriController extends Controller
{
    public function listaFornitori(){
        $fornitori = Fornitore::all();     
        return view('fornitoriLista' , compact('fornitori'));
    }

    public function aggiungiFornitore(){
             
        return view('fornitoriForm' );
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
}
