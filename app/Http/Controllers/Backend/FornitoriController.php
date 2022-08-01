<?php

namespace App\Http\Controllers\Backend;

use Storage;
use App\Models\Marca;
use App\Models\Modello;
use App\Models\Immagine;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Http\Request;
use App\Models\RicambioOrdinato;
use App\Models\ModelloCompatibile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
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
        $ricambi = Ricambio::all()->where('stato' , Ricambio::STATO_ABILITATO);
        $fornitori = Fornitore::all();
        $ricambi_disabilitati = Ricambio::where('stato', Ricambio::STATO_DISABILITATO)->get();
        
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
                //    dd('ciao');
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
        
        if($ricambi->isEmpty()){
            Session::flash('message' , 'Ops , non ci sono prodotti corrispondenti alla ricerca!');
            
            
        }
        
        return view('ricambi.lista' , compact('ricambi'))->with(compact('fornitori'))->with(compact('modelli_compatibili'))
                ->with(compact('immagini'))->with(compact('ricambi_disabilitati'));
    }

    public function ricambiDisabilitati(){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        $ricambi_disabilitati = Ricambio::where('stato', Ricambio::STATO_DISABILITATO)->get();

        $modelli_compatibili = [];
        
        foreach ($ricambi_disabilitati as $ricambio_disabilitato) {
            $modelli = Ricambio::find($ricambio_disabilitato->id)->modelli()->get();
            
            foreach($modelli as $modello) {
                array_push($modelli_compatibili , $modello);
            }
            
        }

        return view('ricambi.ricambiDisabilitati' , compact('ricambi_disabilitati'))->with(compact('modelli_compatibili'));
    }

    public function riabilitaRicambio(Ricambio $ricambio_disabilitato){

        $ricambio_disabilitato->stato = Ricambio::STATO_ABILITATO ;
        $ricambio_disabilitato->save();

        return redirect(route('ricambiDisabilitati'));

    }

    public function vistaAggiungiRicambi(){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $fornitori = Fornitore::all();
        $categorie = Categoria::all();
        $modelli = Modello::all()->sortBy('nome');
        
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
        $modelli = Modello::all()->sortBy('nome');
        $modelli_compatibili = Ricambio::find($ricambio->id)->modelli()->orderBy('nome')->get();
        $immagini = Immagine::where('ricambio_id' , $ricambio->id)->get();
        //dd($modelli_compatibili);
        
      
        return view('ricambi.formModifica', compact('ricambio'))->with(compact('fornitori'))->with(compact('categorie'))->with(compact('immagini'))->with(compact('modelli'))->with(compact('modelli_compatibili'));
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
        
        $modelli_id = $request->modelli_id;
        //dd($request->modelli_id);
        foreach($modelli_id as $modello_id){
            $modello_compatibile = new ModelloCompatibile();
            $modello_compatibile->ricambio_id = $ricambio->id;
            $modello_compatibile->modello_id = $modello_id;
            $modello_compatibile->save();
        }
        return redirect(route('vistaRicambi'));
    }

    public function eliminaImmagine(Immagine $immagine){
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
       
        $immagine->delete();
        return redirect()->back();

    }

    public function eliminaModelloCompatibile(ModelloCompatibile $modello_compatibile){
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        
        $modello_compatibile->delete();

        return redirect()->back();

    }

    public function disabilitaRicambio(Ricambio $ricambio){
        if (Gate::denies('Gestore')) {
            abort(403);            
        }
        $ricambio->stato = Ricambio::STATO_DISABILITATO;
        $ricambio->save();
        

        return redirect(route('vistaRicambi'));
    }

    public function eliminaRicambio(Ricambio $ricambio){

        $ricambi_ordinati = RicambioOrdinato::where('ricambio_id' , $ricambio->id)->get();
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        if(!$ricambi_ordinati->isEmpty()){
            
            
            session()->put('ricambio' , $ricambio);
            Session::flash('error', 'Non è possibile eliminare il ricambio perchè legato a uno o più ordini. Vuoi toglierlo lo stesso dalla vendita?');
            return redirect(route('vistaRicambi'));
        }
        
        
        $ricambio->delete();
        return redirect()->back();
            
        
        
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
        
        if($request->file('img')->store('public/img')){
            $categoria->img = $request->file('img')->store('public/img');
        }
        $categoria->save();
        
        return redirect(route('vistaCategorie'));
    }

    public function eliminaImmagineCategoria(Categoria $categoria){
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        if(\Storage::exists($categoria->img)){
            \Storage::delete($categoria->img);
            
        }
        
        return redirect()->back();

    }

    public function eliminaCategoria(Categoria $categoria ){
        
        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
        
        $categoria->delete();
        return redirect(route('vistaCategorie'));
    }
}
