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
use Illuminate\Database\Eloquent\Builder;


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

    public function vistaRicambi(){
        $ricambi = Ricambio::all();
        $fornitori = Fornitore::all();
        //$modelli_compatibili = Ricambio::find(6)->modelli()->get();
        $cercaRicambio = session('cercaRicambio');
        if(session('cercaRicambio') || session('cercaModello') || session('cercaMarca') || session('cercaAnnoProduzione')){
            
            $cercaModello = session('cercaModello');
            
            $cercaMarca = session('cercaMarca');
            $cercaAnnoProduzione = session('cercaAnnoProduzione');
            
            $query_ricambio = Ricambio::query(); 
            if($cercaRicambio){
                $query_ricambio->where('nome' , 'LIKE','%'.$cercaRicambio.'%');
                
            }
            if($cercaModello){
               $query_ricambio->whereHas('modelli', function (Builder $query) use($cercaModello )  {
                   $query->where('nome', 'LIKE','%'.$cercaModello.'%');
                });
                
            }
            if($cercaAnnoProduzione){
                $query_ricambio->whereHas('modelli', function (Builder $query) use( $cercaAnnoProduzione)  {
                    $query->where('anno_produzione', 'LIKE','%'.$cercaAnnoProduzione.'%');
                    
                });
            }
            if($cercaMarca){
                $query_ricambio->whereHas('modelli', function (Builder $query) use( $cercaMarca){
                    $query->whereHas('marche', function (Builder $query) use( $cercaMarca) {
                        $query->where('nome', 'LIKE','%'.$cercaMarca.'%');
                        
                });
            });
            }

            $ricambi = $query_ricambio->get();
            // $ricambi = Ricambio::where('nome' , 'LIKE','%'.$cercaRicambio.'%')
            //         ->whereHas('modelli', function (Builder $query) use($cercaModello , $cercaAnnoProduzione)  {
            //             $query->where('nome', 'LIKE','%'.$cercaModello.'%')->where('anno_produzione' , $cercaAnnoProduzione);
            //         })
            //         ->with('modelli')->dd();
            //     dd($ricambi);            
       
        }

            
        
        $modelli_compatibili = [];
        
        foreach ($ricambi as $ricambio) {
            $modelli = Ricambio::find($ricambio->id)->modelli()->get();
            //dd($modelli);
            foreach($modelli as $modello) {
                array_push($modelli_compatibili , $modello);
            }
           
            
            // $modelli = ModelloCompatibile::where('ricambio_id' , $ricambio->id)->get();
            // array_push($pippo , $modelli);
            
        }
        
        
     
        return view('ricambi.lista' , compact('ricambi'))->with(compact('fornitori'))->with(compact('modelli_compatibili'));
    }

    public function vistaAggiungiRicambi(){
        
        $fornitori = Fornitore::all();
        $categorie = Categoria::all();
        $modelli = Modello::all();
        
        return view('ricambi.formAggiunta' , compact('fornitori'))->with(compact('categorie'))->with(compact('modelli'));
    }

    public function aggiungiRicambi(Request $request){
        
        $ricambio = Ricambio::create([
            'fornitore_id' => $request->input('fornitore_id'),
            'categoria_id' => $request->input('categoria_id'),
            'codice_pezzo' => $request->input('codice_pezzo'),
            'descrizione' => $request->input('descrizione'),
            'prezzo' => $request->input('prezzo'),
            'nome' => $request->input('nome'),
        ]);
        $ricambio->save();

        $modelli_id = $request->modelli_id;
        
        foreach($modelli_id as $modello_id){
            $modello_compatibile = new ModelloCompatibile();
            $modello_compatibile->ricambio_id = $ricambio->id;
            $modello_compatibile->modello_id = $modello_id;
            $modello_compatibile->save();
        }
        
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
        $ricambio->nome = $request->nome;
        $ricambio->fornitore_id = $request->fornitore_id;
        $ricambio->categoria_id = $request->categoria_id;
        //dd($request);
        
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
