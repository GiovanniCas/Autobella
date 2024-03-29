<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Marca;
use App\Models\Modello;
use App\Models\Testata;
use App\Models\Immagine;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Http\Request;
use App\Models\RicambioOrdinato;
use App\Models\ModelloCompatibile;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PublicController extends Controller
{
    public function welcome(){
       
    
        $marche = Marca::all();
        if(Auth::user()) {

            App::setlocale(Auth::user()->lingua);
            return view('welcome', compact('marche'));

        }else{
            if(session('locale')){
                App::setLocale(session()->get('locale'));
            }else{
                App::setlocale('it');
            }
        }


        return view('welcome', compact('marche'));
    }


    public function cercaRicambiCompatibili(Request $request){
        //dd($request->all());
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
        $totale = 0;
        foreach($ricambi_nel_carrello as $ricambio_nel_carrello){
            $tot = $ricambio_nel_carrello->quantita * $ricambio_nel_carrello->prezzo_unitario;
            $totale += $tot;
        }
        return view('carrello')->with(compact('ricambi_nel_carrello'))->with(compact('totale'));
    }

    public function aggiungiAlCarrello(Ricambio $ricambio ,Request $request){
        
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
                    $nome= Ricambio::where('id' , $id_ricambio)->value('nome');
                    $codice= Ricambio::where('id' , $id_ricambio)->value('codice_pezzo');
                    
                    $ricambio = RicambioOrdinato::create([
                        'ricambio_id' => $id_ricambio,
                        'testata_id' => session('testata_id'),
                        'nome_ricambio' => $nome,
                        'codice_ricambio' => $codice,
                        'quantita' => $quantita_selezionata ,
                        'prezzo_unitario' => $prezzo,
                    ]);
                    
                    $ricambio->save();
                }
                
                
            }
        }
        
        return redirect(route('vistaRicambi'));
    }


    public function modificaQuantitaDesiderate(Request $request){

        $quantita_selezionate = $request->input(['quantita']);
        if($quantita_selezionate === null){
            return redirect(route('welcome'));
        };

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
        $ricambi = RicambioOrdinato::where('testata_id' , session('testata_id'))->get();
        $totale = 0;
        foreach($ricambi as $ricambio){
            $tot = $ricambio->quantita * $ricambio->prezzo_unitario;
            $totale += $tot;
        }
        
        return view('ordine' , compact('ricambi'))->with(compact('totale'));
    }
        
    public function confermaOrdine(Request $request){
        $ricambi = RicambioOrdinato::all()->where('testata_id' , session('testata_id'));
        
        $totale = 0;
        foreach($ricambi as $ricambio){
            $tot = $ricambio->quantita * $ricambio->prezzo_unitario;
            $totale += $tot;
        }
        
        $ordine = Testata::where('id' , session('testata_id'))->update([
            //optional: se il valore dentro le parentesi esiste allora mi prende di quel valore l'id;
            //altrimenti mi ritorna null
            'user_id' => optional(Auth::user())->id,
            // null coalescing operator
            // 'user_id' => Auth::user()?Auth::user()->id:null,
            'name' => $request->input('nome'),
            'cognome' =>$request->input('cognome'),
            'citta' => $request->input('citta'),
            'indirizzo' => $request->input('indirizzo'),
            'cap' => $request->input('cap'),
            'email' => $request->input('email'),
            'totale' => $totale,
            'stato' => 1,
            'data' => date("Y-m-d"),
        ]);  
        session()->forget('testata_id');
       
        // session()->flush();
        
        
        return redirect(route('welcome'))->with("message" , "Grazie per averci scelto, il suo ordine è stato preso in carico!");
    }
       

    public function vistaDettaglio(Ricambio $ricambio){
       
        $visti_di_recente = [];
        array_push($visti_di_recente , $ricambio->id);
        
        if(empty(session('visti_di_recente'))){
           
            session()->put('visti_di_recente' , $visti_di_recente);
            
        }else{
           
            $visti_di_recente = array_slice(session('visti_di_recente') , -4 );
            if(!in_array($ricambio->id ,  session('visti_di_recente'))){
                session()->push('visti_di_recente' , $ricambio->id);
                
            }
        }
       
        $immagini = Immagine::where('ricambio_id' , $ricambio->id)->get();
        
        $modelli_compatibili = [];
        
        $modelli = Ricambio::find($ricambio->id)->modelli()->get();
        foreach($modelli as $modello) {
            array_push($modelli_compatibili , $modello);
        }
        
        return view('ricambi.vistaDettaglio' , compact('ricambio'))->with(compact('immagini'))
                ->with(compact('visti_di_recente'))
                ->with(compact('modelli_compatibili'));
    }

    //scelta lingua
    public function locale($locale)
    {
        
        session()->put('locale', $locale);
        App::setLocale(session()->get('locale'));
       
        return redirect()->back();
    }


    
    
}