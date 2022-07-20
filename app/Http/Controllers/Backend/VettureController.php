<?php

namespace App\Http\Controllers\Backend;

use App\Models\Marca;
use App\Models\Modello;
use App\Models\Ricambio;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


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

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $marche = Marca::all();
        return view('modelli.formAggiunta' , compact('marche'));
    }

    public function aggiungiModello(Request $request){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

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

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $marche = Marca::all();
        return view('modelli.formModifica', compact('modello'))->with(compact('marche'));
    }

    public function modificaModello( Modello $modello ,Request $request){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $modello->nome = $request->nome;
        $modello->marca_id = $request->marca_id;
        $modello->anno_produzione = $request->anno_produzione;
        $modello->anno_ritiro = $request->anno_ritiro;
        $modello->img = $request->file('img')->store('public/img');
        
        $modello->save();

        return redirect(route('vistaModelli'));
    }

    public function eliminaModello(Modello $modello ){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        
        $modello->delete();
        return redirect(route('vistaModelli'));
    }

    public function vistaMarche(){
        $marche = Marca::all();
        return view('marche.lista' , compact('marche'));
    }

    public function vistaAggiungiMarca(){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        
        return view('marche.formAggiunta');
    }

    public function aggiungiMarca(Request $request){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $marca = Marca::create([
            'nome' => $request->input('nome'),
            'img' => $request->file('img')->store('public/img'),
        ]);
        return redirect(route('vistaMarche'));
    }

    public function vistaModificaMarca(Marca $marca){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
      
        return view('marche.formModifica', compact('marca'));
    }

    public function modificaMarca( Marca $marca ,Request $request){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        
        $marca->nome = $request->nome;
        $marca->img = $request->file('img')->store('public/img');
        
        $marca->save();
        return redirect(route('vistaMarche'));
    }

    public function eliminaMarca(Marca $marca ){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        
        $marca->delete();
        return redirect(route('vistaMarche'));
    }
}
