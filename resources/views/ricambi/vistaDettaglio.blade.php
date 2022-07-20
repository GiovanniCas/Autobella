@php
    use App\Models\Ricambio;
@endphp

<x-layout>

    <div class="container">
        <h1 class="card-title">{{$ricambio->nome}}</h1>
        <form action="{{route('aggiungiAlCarrello')}}" method="post" >
            @csrf   
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="swiper mySwiper" style="height: 100%, width: 100%;">
                        <div class="swiper-wrapper">
                            @foreach($immagini as $immagine)
                                @if($immagine->ricambio_id === $ricambio->id)
                              
                                    <div class="swiper-slide"><img src="/storage/img/{{$immagine->nome}}" class="d-block w-100" alt="..."></div>
                                @endif
                            @endforeach   
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <h3 class="card-title">Descrizione: {{$ricambio->descrizione}}</h3>
                    <h3 class="card-title">Prezzo: ${{$ricambio->prezzo}}</h3>
                    <h3 class="card-title">Fornitore: {{$ricambio->fornitori->ragione_sociale}}</h3>
                    <h3 class="card-title">Categoria: {{$ricambio->categorie->descrizione}}</h3>
                    <br>
                    <h3>Compatibile con:</h3>
                    @foreach($modelli_compatibili as $modello_compatibile)
                        @if($modello_compatibile->pivot->ricambio_id === $ricambio->id) 
                            <p>{{$modello_compatibile->nome}}</p>
                        @endif
                    @endforeach  
                    <label for="inputQuantity">Quantita :</label>
                    <input type="number" min="0" name="quantita[{{$ricambio->id}}]" > <br>
                    <button type="submit" class="btn btn-info mt-5">Aggiungi al carrello</button>
                </div>
            </div>
        </form>
    </div>
   
    @if(count(session('visti_di_recente')))

        <div class="container mt-5">
            <h3>Visti di recente:</h3>
            <div class="row">
          
                @foreach($visti_di_recente as $visto_di_recente)
                @if($visto_di_recente !== $ricambio->id)
                    @php 
                        $ricambio = Ricambio::find($visto_di_recente) 
                    @endphp
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card mt-3" style="width: 18rem;">
                            @if($ricambio->trovaImmagine())
                                <img src="/storage/img/{{$ricambio->trovaImmagine()->nome}}" class="d-block w-100" alt="...">
                            @endif                                
                            <div class="card-body">
                                <h5 class="card-title">{{$ricambio->nome}}</h5>
                                <h5 class="card-title">{{$ricambio->descrizione}}</h5>
                                <h5 class="card-title">${{$ricambio->prezzo}}</h5>
                                <h5 class="card-title">{{$ricambio->fornitori->ragione_sociale}}</h5>
                                <h5 class="card-title">{{$ricambio->categorie->descrizione}}</h5>
                                <a class="btn btn-primary" href="{{route('vistaDettaglio' , compact('ricambio'))}}">Vai al Dettaglio</a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                
            </div>
        </div>
    @endif
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</x-layout>