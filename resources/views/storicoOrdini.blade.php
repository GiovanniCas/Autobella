@php
    use App\Models\Ricambio;
    use App\Models\Testata;
@endphp
<x-layout>
    <div class="container">
        <h1  class="color-brown"> I Miei Ordini </h1>
        <div class="product-header color-brown" style="">
            <h5 class="product-title" style="width: 20%; padding-left:33px;">Nome</h5>
            <h5 class="price d-flex justify-content-end" style="width: 20%; margin-right: 222px">Prezzo</h5>
            <h5 class="quantity d-flex justify-content-end" style="width: 20%; margin-right: 114px">Stato Ordine</h5>
        </div>
        
        <div class="row">
                
            @foreach($ricambi_ordinati as $ricambio_ordinato)
                
                @php 
                    $ricambio = Ricambio::find($ricambio_ordinato->ricambio_id) 
                @endphp
                <div class="col-12 d-flex">
                    <div class="card mt-3" style="width: 18rem; display:contents;">
                        <div style="height: 150px; width: 200px;">
                            @if($ricambio->trovaImmagine())
                                <img src="/storage/img/{{$ricambio->trovaImmagine()->nome}}" class="d-block w-100" alt="...">
                            @endif 
                        </div>
                        <div class="card-body d-flex justify-content-between">
                            <h5 class="card-title" style="width: 20%;">{{$ricambio_ordinato->ricambi->nome}}</h5>
                            <h5 class="card-prezzo" style="width: 20%;">${{$ricambio_ordinato->ricambi->prezzo}}</h5>
                            @if($ricambio_ordinato->testate->stato == Testata::ORDINE_IN_PREPARAZIONE)
                                <h5 class="card-prezzo" style="width: 20%;">In lavorazione</h5>
                            @elseif($ricambio_ordinato->testate->stato == Testata::ORDINE_SPEDITO)
                                <h5 class="card-prezzo" style="width: 20%;">Spedito</h5>
                            @endif
                        </div>
                    </div>
                </div>  
            @endforeach   

                    
            
                
        </div>
       
    </div>
</x-layout>