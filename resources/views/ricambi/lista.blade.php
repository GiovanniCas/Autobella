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
                            <h5 class="card-title">{{$ricambio->id}}</h5>
                            <h5 class="card-title">{{$ricambio->descrizione}}</h5>
                            <h5 class="card-title">${{$ricambio->prezzo}}</h5>
                            
                            <a href="#" class="btn btn-primary">Dettagli</a>
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
        <a href="{{route('vistaAggiungiRicambi')}}" class="btn btn-danger">Aggiungi Nuovo</a>
    </div>
</x-layout>