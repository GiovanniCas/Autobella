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
 
        
        //
       $modelli = Modello::all();
        // if(empty(session('cercaMarca')) && empty(session('cercaModello')) && empty(session('cercaRicambio')) && empty(session('cercaAnnoProduzione'))){
            

        // }else{
        //     $cercaRicambio = session('cercaRicambio');

        //     if(session('cercaRicambio')){
        //         $ricambi = Ricambio::where('nome' , 'LIKE','%'.$cercaRicambio.'%')->get();
        //         foreach($ricambi as $ricambio){
        //             $ricambi = Ricambio::where('nome' , 'LIKE','%'.$cercaRicambio.'%')->get();
        //         }
                
                
        //     }
        //     $q = Ricambio::query();
        //     $cercaMarca = session('cercaMarca');
        //     $cercaModello = session('cercaModello');
        //     $cercaRicambio = session('cercaRicambio');
        //     $cercaAnnoProduzione = session('cercaAnnoProduzione');

        //     $marche = Marca::where('nome' , 'LIKE','%'.$cercaMarca.'%')->get();
        //     foreach($marche as $marca){
        //         $id = $marca->id;
        //     }

        //     $modelli = Modello::where('nome' ,  'LIKE','%'.$cercaModello.'%')->get();
        //     foreach ($modelli as $modello) {
        //             $nome = $modello->nome;
        //             $anno = $modello->anno_produzione;
        //     }
                
        //     $modelli = Modello::where('nome' ,  'LIKE','%'.$nome.'%')
        //             ->where('marca_id' , $id)       
        //             ->where('anno_produzione' , $anno)->get();       

        //     foreach($modelli as $modello ){
        //         //dd($modello->id);
        //     } 
        //     // $q = $q->where('nome' , 'LIKE','%'.$cercaRicambio.'%')

        // }
        
       
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
        //dd($request->all());
        $marca = Marca::create([
            'nome' => $request->input('nome'),
        ]);
        return redirect(route('vistaMarche'));
    }

    public function vistaModificaMarca(Marca $marca){
      
        return view('marche.formModifica', compact('marca'));
    }

    public function modificaMarca( Marca $marca ,Request $request){
        
        $marca->nome = $request->nome;
        
        $marca->save();
        return redirect(route('vistaMarche'));
    }

    public function eliminaMarca(Marca $marca ){
        
        $marca->delete();
        return redirect(route('vistaMarche'));
    }
}
