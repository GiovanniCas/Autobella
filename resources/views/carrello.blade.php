@php
    use App\Models\Ricambio;
@endphp
<x-layout>
    <div class="container">
        <h1>Carrello</h1>
        <form action="{{route('modificaQuantitaDesiderate')}}" method="post" >
        @method('put')
        @csrf   
            <div class="row">
                
                @foreach($ricambi_nel_carrello as $ricambio_nel_carrello)
                
                    @php 
                        $ricambio = Ricambio::find($ricambio_nel_carrello->ricambio_id) 
                    @endphp
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card mt-3" style="width: 18rem;">
                            @if($ricambio->trovaImmagine())
                                <img src="/storage/img/{{$ricambio->trovaImmagine()->nome}}" class="d-block w-100" alt="...">
                            @endif 
                            
                            <div class="card-body">
                                <h5 class="card-title">Nome: {{$ricambio_nel_carrello->ricambi->nome}}</h5>
                                <h5 class="card-title">Descrizione: {{$ricambio_nel_carrello->ricambi->descrizione}}</h5>
                                <h5 class="card-title">Prezzo: ${{$ricambio_nel_carrello->ricambi->prezzo}}</h5>
                                <label for="inputQuantity">Quantita :</label>
                                <input type="number" min="0" value="{{$ricambio_nel_carrello->quantita}}" name="quantita[{{$ricambio_nel_carrello->id}}]" >
                            
                            </div>
                        </div>
                    </div>  
                    <h2>TOT :</h2>  
                @endforeach    
                <button type="submit" class="btn btn-info mt-5">Procedi con l'ordine</button>
            </div>
        </form>
    </div>
</x-layout>