<x-layout>

    <h1>Modelli</h1>
        <div class="container">
        <div class="row">
                @foreach($modelli as $modello)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$modello->anno_produzione}}</h5>
                                <h5 class="card-title">{{$modello->anno_ritiro}}</h5>
                                <h5 class="card-title">{{$modello->nome}}</h5>
                                <h5 class="card-title">{{$modello->marche->nome}}</h5>
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$modello->id}}">
                                Scopri Compatibilità
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$modello->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modelli compatibili</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>Compatibile con:</ul>
                                                @foreach($ricambi_compatibili as $ricambio_compatibile)
                                                   
                                                    @if($ricambio_compatibile->pivot->modello_id === $modello->id) 
                                                        <li>Codice : {{$ricambio_compatibile->codice_pezzo}} , <br>
                                                          Descrizione : {{$ricambio_compatibile->descrizione}}</li>
                                                    @endif
                                                @endforeach   
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            </div>
                            <form href="{{route('vistaModificaModello' , compact('modello'))}}" method="get"> 
                                            
                                <a href="{{route('vistaModificaModello' , compact('modello'))}}" class="btn btn-info">Modifica</a>
                            </form>
                            <form method="post" action="{{route('eliminaModello' , compact('modello'))}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Elimina</button>
        
                            </form>
                        </div>
                    </div>
                @endforeach    
            </div>
            <a href="{{route('vistaAggiungiModello')}}" class="btn btn-danger">Aggiungi Modello</a>
        </div>
        
</x-layout>