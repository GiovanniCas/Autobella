<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modello;
use App\Models\Testata;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Http\Request;
use App\Models\RicambioOrdinato;
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

    public function carrello(){
        $ricambi_nel_carrello = RicambioOrdinato::where('testata_id' , session('testata_id'))->get();
        return view('carrello')->with(compact('ricambi_nel_carrello'));
    }

    public function aggiungiAlCarrello(Request $request){
       
        $quantita_selezionate = $request->input(['quantita']);

        if(!session('testata_id')){
            $testata = Testata::create();
            $testata_id = $testata->id;
            session()->put('testata_id' ,  $testata_id );
        }

        foreach($quantita_selezionate as $id_ricambio => $quantita_selezionata){

            if($quantita_selezionata > 0 && $quantita_selezionata != null){
                $ricambi = RicambioOrdinato::where('ricambio_id', $id_ricambio)->where('testata_id' , session('testata_id'))->exists();
                
                if($ricambi){
                    $quantita_selezionata = RicambioOrdinato::where('ricambio_id', $id_ricambio)->increment('quantita' , $quantita_selezionata);
                    
                }else{
                    $prezzo= Ricambio::where('id' , $id_ricambio)->value('prezzo');
                    
                    $ricambio = RicambioOrdinato::create([
                        'ricambio_id' => $id_ricambio,
                        'testata_id' => session('testata_id'),
                        'quantita' => $quantita_selezionata ,
                        'prezzo_unitario' => $prezzo,
                    ]);
                    
                    $ricambio->save();
                }
                
                
            }
        }
        
        return redirect(route('carrello'));
    }


    public function modificaQuantitaDesiderate(Request $request){

        $quantita_selezionate = $request->input(['quantita']);
       // dd($quantita_selezionate);

        foreach( $quantita_selezionate as $id_ricambio_selezionato => $nuova_quantita){
            $ricambio_selezionato = RicambioOrdinato::where('id' , $id_ricambio_selezionato)->where('testata_id' , session('testata_id'))->update(['quantita' => $nuova_quantita]);
        }
        $ricambi_nel_carrello = RicambioOrdinato::all()->where('testata_id', session('testata_id'));
        
        foreach( $ricambi_nel_carrello as  $ricambio_nel_carrello) {
            if( $ricambio_nel_carrello->quantita === 0){
                
                 $ricambio_nel_carrello->delete();
            }
        }

        $ricambi_nel_carrello = RicambioOrdinato::all()->where('testata_id', session('testata_id'));//->where('quantity', 0);

        if(count($ricambi_nel_carrello) > 0) {
            return redirect(route('ordine'));
        } else {
            return redirect(route('welcome'));
        };
           
    }

    public function ordine(){
        return view('ordine');
    }
        
    public function confermaOrdine(Request $request){
        $ricambi = RicambioOrdinato::all()->where('testata_id' , session('testata_id'));
            
        $totale = 0;
        foreach($ricambi as $ricambio){
            $tot = $ricambio->quantita * $ricambio->prezzo_unitario;
            $totale += $tot;
        }
        
        
        $ordine = Testata::where('id' , session('testata_id'))->update([
            'name' => $request->input('nome'),
            'cognome' =>$request->input('cognome'),
            'citta' => $request->input('citta'),
            'indirizzo' => $request->input('indirizzo'),
            'cap' => $request->input('cap'),
            'email' => $request->input('email'),
            'totale' => $totale,
        ]);  
        
        session()->flush();
        
        
        return redirect(route('welcome'));
    }
       

    
    
}