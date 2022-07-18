<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modello;
use App\Models\Ricambio;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class VettureController extends Controller
{
    public function vistaModelli(){
 
        
        
       $modelli = Modello::all();
       
        $ricambi_compatibili = [];

        foreach ($modelli as $modello) {
            $ricambi = Modello::find($modello->id)->ricambi()->get();
            foreach($ricambi as $ricambio){
                array_push($ricambi_compatibili , $ricambio);
            }           
        }
        
            

        return view('modelli.lista' , compact('modelli'))->with(compact('ricambi_compatibili'));
    }

    public function vistaAggiungiModello(){
        $marche = Marca::all();
        return view('modelli.formAggiunta' , compact('marche'));
    }

    public function aggiungiModello(Request $request){
        //dd($request->all());
        $categoria = Modello::create([
            'marca_id' => $request->input('marca_id'),
            'nome' => $request->input('nome'),
            'anno_produzione' => $request->input('anno_produzione'),
            'anno_ritiro' => $request->input('anno_ritiro'),
            'img' => $request->file('img')->store('public/img'),
        ]);
        return redirect(route('vistaModelli'));
    }

    public function vistaModificaModello(Modello $modello){
        $marche = Marca::all();
        return view('modelli.formModifica', compact('modello'))->with(compact('marche'));
    }

    public function modificaModello( Modello $modello ,Request $request){
        
        $modello->nome = $request->nome;
        $modello->marca_id = $request->marca_id;
        $modello->anno_produzione = $request->anno_produzione;
        $modello->anno_ritiro = $request->anno_ritiro;
        $modello->img = $request->file('img')->store('public/img');
        
        $modello->save();
        return redirect(route('vistaModelli'));
    }

    public function eliminaModello(Modello $modello ){
        
        $modello->delete();
        return redirect(route('vistaModelli'));
    }

    public function vistaMarche(){
        $marche = Marca::all();
        return view('marche.lista' , compact('marche'));
    }

    public function vistaAggiungiMarca(){
        
        return view('marche.formAggiunta');
    }

    public function aggiungiMarca(Request $request){
        //dd($request->file('img'));
        $marca = Marca::create([
            'nome' => $request->input('nome'),
            'img' => $request->file('img')->store('public/img'),
        ]);
        return redirect(route('vistaMarche'));
    }

    public function vistaModificaMarca(Marca $marca){
      
        return view('marche.formModifica', compact('marca'));
    }

    public function modificaMarca( Marca $marca ,Request $request){
        
        $marca->nome = $request->nome;
        $marca->img = $request->file('img')->store('public/img');
        
        $marca->save();
        return redirect(route('vistaMarche'));
    }

    public function eliminaMarca(Marca $marca ){
        
        $marca->delete();
        return redirect(route('vistaMarche'));
    }
}
