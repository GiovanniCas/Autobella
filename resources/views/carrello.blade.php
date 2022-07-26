@php
    use App\Models\Ricambio;
@endphp
<x-layout>
<div class="container">
        <h1>Carrello</h1>
        <div class="product-header">
                <h5 class="product-title">Nome</h5>
                <h5 class="price">Prezzo</h5>
                <h5 class="quantity">Quantità</h5>
                <h5 class="totalprice">Totale</h5>
            </div>
        <form action="{{route('modificaQuantitaDesiderate')}}" method="post" >
        @method('put')
        @csrf   
            <div class="row">
                
                @foreach($ricambi_nel_carrello as $ricambio_nel_carrello)
                
                    @php 
                        $ricambio = Ricambio::find($ricambio_nel_carrello->ricambio_id) 
                    @endphp
                    <div class="col-12 d-flex">
                        <div class="card mt-3" style="width: 18rem; display:contents;">
                            <div style="height: 150px; width: 200px;">
                                @if($ricambio->trovaImmagine())
                                    <img src="/storage/img/{{$ricambio->trovaImmagine()->nome}}" class="d-block w-100" alt="...">
                                @endif 
                            </div>
                            <div class="card-body d-flex justify-content-between">
                                <h5 class="card-title">{{$ricambio_nel_carrello->ricambi->nome}}</h5>
                                <h5 class="card-title">{{$ricambio_nel_carrello->ricambi->descrizione}}</h5>
                                <h5 class="card-prezzo">${{$ricambio_nel_carrello->ricambi->prezzo}}
                                </h5>
                                <div>

                                    <label for="inputQuantity"></label>
                                    <input id="{{ $ricambio_nel_carrello->id }}-input" class="card-quantita" type="number" min="0" value="{{$ricambio_nel_carrello->quantita}}" name="quantita[{{$ricambio_nel_carrello->id}}]" style="width : 25%;">
                                </div>
                            
                                <h4> $
                                    <span id="{{ $ricambio_nel_carrello->id }}-price" class="costo-attuale">
                                        {{ $ricambio_nel_carrello->prezzo_unitario * $ricambio_nel_carrello->quantita }}
                                    </span>
                                </h4>  
                            </div>
                        </div>
                    </div>  
                @endforeach    
                <h3><span class="total"> </span></h3>
                <!-- <h2><span id="total">Totale : ${{$totale}}</span></h2> -->
                <button type="submit" class="btn btn-info mt-5">Procedi con l'ordine</button>
            </div>
        </form>
    </div>
    <script>
        
        let ricambi = @json($ricambi_nel_carrello);
        let totale = 0;
        for (let ricambio of ricambi) {

            document.getElementById(`${ricambio.id}-input`).addEventListener('input', function(e) {
                document.getElementById(`${ricambio.id}-price`).textContent = ricambio.prezzo_unitario * e.target.value

                aggiornaTotale()
            })

            
        }

        function aggiornaTotale(){
            
            let prezzi_ricambio = document.getElementsByClassName('costo-attuale')
            for (let i = 0; i < prezzi_ricambio.length; i++) {
                let prezzo_ricambio = prezzi_ricambio[i];

                let prezzo = parseFloat(prezzo_ricambio.innerText.replace('$' , ''));
                
                totale = totale + prezzo ;
                console.log(totale);
            }
            document.getElementsByClassName('total')[0].innerText = 'Totale : $' + totale;

            totale = 0;

        }
        
        aggiornaTotale()

    </script>
</x-layout>