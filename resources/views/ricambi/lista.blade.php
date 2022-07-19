<x-layout>
<h1>Prodotti</h1>
    <div class=" container mt-3">
        <div class="row">
            <h3>Filtra per</h3>
            <form method="post" action="{{route('cercaRicambiCompatibili')}}" class="d-flex">
                @csrf
                <div class="col-md-3">
                    <h5>Marca :</h5>
                    @if(session('searchOrder'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaMarca')}}" aria-label="Search" name="cercaMarca">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci Marca" aria-label="Search" style="height: 40px; width: 100%;" name="cercaMarca">
                    @endif 
                </div>
            
                <div class="col-md-3">
                    <h5>Modello :</h5>
                    @if(session('cercaModello'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaModello')}}" aria-label="Search" name="cercaModello">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci Modello" aria-label="Search" style="height: 40px; width: 100%;" name="cercaModello">
                    @endif 
                </div>
                <div class="col-md-3">
                    <h5>Nome Ricambio :</h5>
                    @if(session('cercaRicambio'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaRicambio')}}" aria-label="Search" name="cercaRicambio">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci Nome Ricambio" aria-label="Search" style="height: 40px; width: 100%;" name="cercaRicambio">
                    @endif 
                </div>
                <div class="col-md-3">
                    <h5>Anno di Produzione :</h5>
                    @if(session('cercaAnnoProduzione'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaAnnoProduzione')}}" aria-label="Search" name="cercaAnnoProduzione">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci AnnoProduzione" aria-label="Search" style="height: 40px; width: 100%;" name="cercaAnnoProduzione">
                    @endif 
                </div>
                
                <button class="btn btn-outline-dark my-btn" style="height: 40px;" type="submit"><i class="fa-solid fa-magnifying-glass text-dark"></i></button>
            </form>
        </div>    
    </div>
    @guest
        <div class="container">
            <form action="{{route('aggiungiAlCarrello')}}" method="post" >
            @csrf   
            <div class="row">
                @foreach($ricambi as $ricambio)
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
                                <a class="btn btn-primary" href="{{route('vistaDettaglio' , compact('ricambio'))}}">
                                    Vai al Dettaglio
                                </a>
                                
                            </div>
                            <label for="inputQuantity">Quantita :</label>
                                <input type="number" min="0" name="quantita[{{$ricambio->id}}]" >
                            </div>
                        </div>
                    @endforeach    
                    <button type="submit" class="btn btn-info mt-5">Aggiungi al carrello</button>
                </div>
            </form>
        </div>
    @endguest

    @if(Auth::user())
        <div class="container-fluid">
            
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome Pezzo</th>
                        <th scope="col">Fornitore</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Codice</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ricambi as $ricambio)
                        <tr>
                            <th scope="row">{{$ricambio->nome}}</th>
                            <td>{{$ricambio->fornitori->ragione_sociale}}</td>
                            <td>{{$ricambio->categorie->descrizione}}</td>
                            <td>{{$ricambio->codice_pezzo}}</td>
                            <td>{{$ricambio->prezzo}}</td>
                            <td>{{$ricambio->descrizione}}</td>
                            <td>
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
                            </td>
                        </tr>    
                    @endforeach    
                </tbody>
            </table>
        </div>
        <a href="{{route('vistaAggiungiRicambi')}}" class="btn btn-danger mt-5">Aggiungi Nuovo</a>
    @endif

</x-layout>