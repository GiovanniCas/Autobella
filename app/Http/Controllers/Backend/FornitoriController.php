<?php

namespace App\Http\Controllers\Backend;

use App\Models\Marca;
use App\Models\Modello;
use App\Models\Immagine;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Http\Request;
use App\Models\ModelloCompatibile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;


class FornitoriController extends Controller
{
    public function listaFornitori(){
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        $fornitori = Fornitore::all(); 
           
        return view('fornitori.lista' , compact('fornitori'));
    }

    public function aggiungiFornitore(){
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        return view('fornitori.formAggiunta' );
    }

    public function aggiungiNuovoFornitore(Request $request){
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

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
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        return view('fornitori.formModifica', compact('fornitore'));
    }

    public function modificaFornitore( Fornitore $fornitore ,Request $request){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

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
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        $fornitore->delete();
        return redirect(route('listaFornitori'));
    }

    public function vistaRicambi(){
        $immagini = Immagine::all();
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
        
        }
        

        $modelli_compatibili = [];
        
        foreach ($ricambi as $ricambio) {
            $modelli = Ricambio::find($ricambio->id)->modelli()->get();
            
            foreach($modelli as $modello) {
                array_push($modelli_compatibili , $modello);
            }
            
        }
        
        
     
        return view('ricambi.lista' , compact('ricambi'))->with(compact('fornitori'))->with(compact('modelli_compatibili'))
                ->with(compact('immagini'));
    }

    public function vistaAggiungiRicambi(){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $fornitori = Fornitore::all();
        $categorie = Categoria::all();
        $modelli = Modello::all();
        
        return view('ricambi.formAggiunta' , compact('fornitori'))->with(compact('categorie'))->with(compact('modelli'));
    }

    public function aggiungiRicambi(Request $request){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

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
        
        
        $immagini = $request->immagini;
        if($immagini){

            foreach($immagini as $immagine){
                
                $img = new Immagine();
                $img->ricambio_id = $ricambio->id;
                $img->save();
                
                
                $nome_img = $img->ricambio_id + $img->id.'.img';
                $img->nome = $nome_img;
                
                $img->save();
                
             
                
                $destinationPath = 'storage/img/';
                
                $immagine->move($destinationPath, $nome_img);
              
            }
            
        }
        return redirect(route('vistaRicambi'));
    }

    public function vistaModificaRicambio(Ricambio $ricambio){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $fornitori = Fornitore::all();
        $categorie = Categoria::all();
      
        return view('ricambi.formModifica', compact('ricambio'))->with(compact('fornitori'))->with(compact('categorie'));
    }

    public function modificaRicambio( Ricambio $ricambio ,Request $request){  

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        
        $ricambio->codice_pezzo = $request->codice_pezzo;
        $ricambio->descrizione = $request->descrizione;
        $ricambio->prezzo = $request->prezzo;
        $ricambio->nome = $request->nome;
        $ricambio->fornitore_id = $request->fornitore_id;
        $ricambio->categoria_id = $request->categoria_id;
        
        $ricambio->save();
        return redirect(route('vistaRicambi'));
    }

    public function eliminaRicambio(Ricambio $ricambio ){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        
        $ricambio->delete();
        return redirect(route('vistaRicambi'));
    }

    public function vistaCategorie(){
        $categorie = Categoria::all();
        return view('categorie.lista' , compact('categorie'));
    }

    public function vistaAggiungiCategoria(){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        return view('categorie.formAggiunta');
    }

    public function aggiungiCategoria(Request $request){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $categoria = Categoria::create([
            'descrizione' => $request->input('descrizione'),
            'img' => $request->file('img')->store('public/img'),
        ]);
        
        return redirect(route('vistaCategorie'));
    }

    public function vistaModificaCategoria(Categoria $categoria){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        return view('categorie.formModifica', compact('categoria'));
    }

    public function modificaCategoria( Categoria $categoria ,Request $request){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $categoria->descrizione = $request->descrizione;
        $categoria->img = $request->file('img')->store('public/img');
    
        $categoria->save();
        return redirect(route('vistaCategorie'));
    }

    public function eliminaCategoria(Categoria $categoria ){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        
        $categoria->delete();
        return redirect(route('vistaCategorie'));
    }
}
