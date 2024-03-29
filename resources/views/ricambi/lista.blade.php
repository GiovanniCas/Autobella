@php
    use App\Models\Immagine;
    use App\Models\ModelloCompatibile;
@endphp

<x-layout>
    <div class=" container mt-3">
        <h1 class="color-brown" >Prodotti</h1>
        <div class="row d-flex">
            <div >
                <h3 class="color-brown">Filtra per</h3>
            </div>
            <form method="post" action="{{route('cercaRicambiCompatibili')}}" class="d-flex" >
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
                <button class="btn btn-outline-dark my-btn" style="height: 40px; margin-top: auto;" type="submit"><i class="fa-solid fa-magnifying-glass text-dark"></i></button>
                
            </form>
        </div>    
    </div>
    @guest
        <div class="container  mt-5">
            @if (session('message'))
                <div class="alert alert-success d-flex" id="box-avviso" role="alert">
                        {{ session('message') }}
                </div>
            @endif
            <div class="row ">
                @foreach($ricambi as $ricambio)
                <div class="col-12 col-sm-6 col-md-3">
                    <form action="{{route('aggiungiAlCarrello')}}" method="post" >
                        @csrf
                        <div class="card mt-3" style="width: 90%; height: 412px;">
                            <div style="height: 180px;">
                                @if($ricambio->trovaImmagine())
                                    <img src="/storage/img/{{$ricambio->trovaImmagine()->nome}}" class="d-block w-100" style="height: 180px;"  alt="...">
                                @endif                                
                            </div>                         
                            <div class="card-body">
                                <h5 class="card-title">{{$ricambio->nome}}</h5>
                                <p class="card-title">{{$ricambio->descrizione}}</p>
                                <p class="card-title">${{$ricambio->prezzo}}</p>
                                <p class="card-title">{{$ricambio->fornitori->ragione_sociale}}</p>
                                <p class="card-title">{{$ricambio->categorie->descrizione}}</p>
                                <a class="btn btn-primary" href="{{route('vistaDettaglio' , compact('ricambio'))}}">
                                    Vai al Dettaglio
                                </a>
                            </div>
                            <!-- <a class="aggiungi-al-carrello cart" type="submit" >Aggiungi al Carrello</a> -->
                            <!-- <div class="d-flex justify-content-between">
                                <div style="width: 80%;">
                                    <label for="inputQuantity">Quantita :</label>
                                    <input type="number" min="0" name="quantita[{{$ricambio->id}}]" >
                                </div>
                                <div style="width: 80%;" class="d-flex justify-content-end add-cart">
                                    <button type="submit" class="btn btn-info" style="margin-top: 21px; height: 34px;"><i class="fa-solid fa-cart-shopping"></i></button>
                                </div>
                            </div> -->
                        </div>
                    </form>
                    
                </div>
                @endforeach    
            </div>
        </div>
    @endguest    
    @can('Utente')
        <div class="container mt-5">
            @if (session('message'))
                <div class="alert alert-success d-flex" id="box-avviso" role="alert">
                        {{ session('message') }}
                </div>
            @endif
            <div class="row">
                @foreach($ricambi as $ricambio)
                <div class="col-12 col-sm-6 col-md-3">
                    <form action="{{route('aggiungiAlCarrello')}}" method="post" >
                        @csrf
                        <div class="card mt-3" style="width: 90%; height: 412px;">
                            <div style="height: 180px;">
                                @if($ricambio->trovaImmagine())
                                    <img src="/storage/img/{{$ricambio->trovaImmagine()->nome}}" class="d-block w-100" style="height: 180px;"  alt="...">
                                @endif                                
                            </div>                         
                            <div class="card-body">
                                <h5 class="card-title">{{$ricambio->nome}}</h5>
                                <p class="card-title">{{$ricambio->descrizione}}</p>
                                <p class="card-title">${{$ricambio->prezzo}}</p>
                                <p class="card-title">{{$ricambio->fornitori->ragione_sociale}}</p>
                                <p class="card-title">{{$ricambio->categorie->descrizione}}</p>
                                <a class="btn btn-primary" href="{{route('vistaDettaglio' , compact('ricambio'))}}">
                                    Vai al Dettaglio
                                </a>
                            </div>
                        </div>
                    </form>
                    
                </div>
                @endforeach    
            </div>
        </div>
    @endcan   

    @can('Gestore')
        <div class="container-fluid mt-5">
            @if(count($ricambi_disabilitati))
                <h4><a href="{{route('ricambiDisabilitati')}}"> Ricambi tolti dalla vendita = {{count($ricambi_disabilitati)}}</a></h4>
            @endif
            @if (session('message'))
                <div class="alert alert-success d-flex" id="box-avviso" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                @php 
                    $ricambio = session('ricambio')
                @endphp    
                <div class="alert alert-success d-flex" id="box-avviso" role="alert">
                    {{ session('error') }}
                    <div>
                        <form action="{{route('disabilitaRicambio' , compact('ricambio'))}}" method="post">
                        @method('put')
                        @csrf
                        <button type="submit" style="border: none; color: green; background: bottom;"><i class="fa-solid fa-check"  style="margin-left:100px"></i></button>
                        </form>
                    </div>
                    <div>
                        <button onclick="myFunction()" style="border: none; color: red; background: bottom;"><i class="fa-solid fa-xmark text-danger" style="margin-left:50px"></i></button>
                    </div>
                </div>
            @endif
            @csrf   
            <table class="table">
                <thead>
                    <tr class="color-brown">
                        <th scope="col">Nome Pezzo</th>
                        <th scope="col">Fornitore</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Codice</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Modelli Compatibili</th>
                        <th scope="col">Num Immagini</th>
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
                            <td>{{count(ModelloCompatibile::where('ricambio_id' , $ricambio->id)->get())}}</td>
                            <td>{{count(Immagine::where('ricambio_id' , $ricambio->id)->get())}}</td>
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
    @endcan

    <script>
        let box = document.getElementById('box-avviso');
        function myFunction(){
            box.classList.add("d-none");

        }
     
    </script>
</x-layout>