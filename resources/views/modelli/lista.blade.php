
<x-layout>
    @guest
    <div class="container" style="margin-top:160px">
        <h1 class="color-brown">Modelli</h1>
        <div class="row">
                @foreach($modelli as $modello)
                    <div class="col-12 col-sm-6 col-md-3 mt-5">
                        <div class="card" style="width: 18rem;">
                            <div style="height: 180px;">
                                <img src="{{Storage::url($modello->img)}}" class="card-img-top" style="height: 180px;" alt="...">
                            </div>
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
                                                            <li>
                                                                Nome Ricambio :{{$ricambio_compatibile->nome}} <br>
                                                                Codice : {{$ricambio_compatibile->codice_pezzo}}  <br>
                                                                Descrizione : {{$ricambio_compatibile->descrizione}}
                                                            </li>
                                                        @endif
                                                    @endforeach   
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            
                        </div>
                    </div>
                @endforeach    
            </div>
            
        </div>
    @endguest
    @if(Auth::user())
        <h1 class="color-brown">Modelli</h1>
        <div class="container-fluid">
            
            <table class="table">
                <thead>
                    <tr class="color-brown">
                        <th scope="col">Nome </th>
                        <th scope="col">Marca</th>
                        <th scope="col">Anno di Produzione</th>
                        <th scope="col">Anno di Ritiro</th>                        
                        <th scope="col">Immagini</th>                        
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modelli as $modello)
                        <tr>
                            <th scope="row">{{$modello->nome}}</th>
                            <td>{{$modello->marche->nome}}</td>
                            <td>{{$modello->anno_produzione}}</td>
                            <td>{{$modello->anno_ritiro}}</td>
                            <td>
                                @if($modello->img)
                                    Si
                                @else 
                                    No
                                @endif        
                            </td>
                            <td>
                                <div class="d-flex">
                                    <form href="{{route('vistaModificaModello' , compact('modello'))}}" method="get"> 
                                        <a href="{{route('vistaModificaModello' , compact('modello'))}}" class="btn btn-info">Modifica</a>
                                    </form>
                                    <form method="post" action="{{route('eliminaModello' , compact('modello'))}}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger">Elimina</button>
                                    </form>
                                </div>
                            </td>
                        </tr>    
                    @endforeach    
                </tbody>
            </table>
            <a href="{{route('vistaAggiungiModello')}}" class="btn btn-danger mt-5">Aggiungi Modello</a>
        </div>
    @endif
    
</x-layout>