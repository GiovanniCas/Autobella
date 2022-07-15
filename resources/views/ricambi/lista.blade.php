<x-layout>
    <h1>Prodotti</h1>
    <div class="container">
        <div class="row">
            @foreach($ricambi as $ricambio)
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card mt-3" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$ricambio->codice_pezzo}}</h5>
                            <h5 class="card-title">{{$ricambio->id}}</h5>
                            <h5 class="card-title">{{$ricambio->descrizione}}</h5>
                            <h5 class="card-title">${{$ricambio->prezzo}}</h5>
                            <h5 class="card-title">{{$ricambio->fornitori->ragione_sociale}}</h5>
                            <h5 class="card-title">{{$ricambio->categorie->descrizione}}</h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$ricambio->id}}">
                                Scopri Compatibilità
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$ricambio->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modelli compatibili</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" name="ricambio_id[{{$ricambio->id}}]">
                                            <ul>Compatibile con:</ul>
                                                @foreach($modelli_compatibili as $modello_compatibile)
                                                    @if($modello_compatibile->pivot->ricambio_id === $ricambio->id) 
                                                        <li>{{$modello_compatibile->nome}}</li>
                                                    @endif
                                                @endforeach   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="d-flex">
                            <form href="{{route('vistaModificaRicambio' , compact('ricambio'))}}" method="get"> 
                                                
                                <a href="{{route('vistaModificaRicambio' , compact('ricambio'))}}" class="btn btn-info">Modifica</a>
                            </form>
                            <form method="post" action="{{route('eliminaRicambio' , compact('ricambio'))}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Elimina</button>
        
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach    
        </div>
        <a href="{{route('vistaAggiungiRicambi')}}" class="btn btn-danger mt-5">Aggiungi Nuovo</a>
    </div>
</x-layout>