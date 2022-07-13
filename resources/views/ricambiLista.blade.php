<x-layout>
    <h1>Prodotti</h1>
    <div class="container">
        <div class="row">
            @foreach($ricambi as $ricambio)
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$ricambio->codice_pezzo}}</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            @endforeach    
        </div>
        <a href="{{route('vistaAggiungiRicambi')}}" class="btn btn-danger">Aggiungi Nuovo</a>
    </div>
</x-layout>