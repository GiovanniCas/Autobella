<x-layout>
    <h1>Carrello</h1>
    <div class="container">
        <form action="{{route('modificaQuantitaDesiderate')}}" method="post" >
        @method('put')
        @csrf   
            <div class="row">
                
                @foreach($ricambi_nel_carrello as $ricambio_nel_carrello)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card mt-3" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$ricambio_nel_carrello->ricambi->nome}}</h5>
                                <h5 class="card-title">{{$ricambio_nel_carrello->quantita}}</h5>
                                <label for="inputQuantity">Quantita :</label>
                                <input type="number" min="0" value="{{$ricambio_nel_carrello->quantita}}" name="quantita[{{$ricambio_nel_carrello->id}}]" >
                            
                            </div>
                        </div>
                    </div>    
                @endforeach    
                <button type="submit" class="btn btn-info mt-5">Procedi con l'ordine</button>
            </div>
        </form>
    </div>
</x-layout>