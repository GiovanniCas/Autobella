<x-layout>

<div class="container">
            <form action="{{route('aggiungiAlCarrello')}}" method="post" >
            @csrf   
            <div class="row">
               
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card mt-3" style="width: 18rem;">
                            @foreach($immagini as $immagine)
                                @if($immagine->ricambio_id === $ricambio->id)
                                    <img src="/storage/img/{{$immagine->nome}}" class="d-block w-100" alt="...">
                                @endif
                            @endforeach  
                            
                            <div class="card-body">
                                <h5 class="card-title">{{$ricambio->nome}}</h5>
                                <h5 class="card-title">{{$ricambio->descrizione}}</h5>
                                <h5 class="card-title">${{$ricambio->prezzo}}</h5>
                                <h5 class="card-title">{{$ricambio->fornitori->ragione_sociale}}</h5>
                                <h5 class="card-title">{{$ricambio->categorie->descrizione}}</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$ricambio->id}}">
                                    Modelli Compatibili
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
                            <label for="inputQuantity">Quantita :</label>
                                <input type="number" min="0" name="quantita[{{$ricambio->id}}]" >
                            </div>
                        </div>
                     
                    <button type="submit" class="btn btn-info mt-5">Aggiungi al carrello</button>
                </div>
            </form>
        </div>
</x-layout>