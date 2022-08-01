@php
    use App\Models\Immagine;
    use App\Models\ModelloCompatibile;
@endphp
<x-layout>
    <h1 class="color-brown">Ricambi tolti dalla vendita:</h1>
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
            @foreach($ricambi_disabilitati as $ricambio_disabilitato)
                <tr>
                    <th scope="row">{{$ricambio_disabilitato->nome}}</th>
                    <td>{{$ricambio_disabilitato->fornitori->ragione_sociale}}</td>
                    <td>{{$ricambio_disabilitato->categorie->descrizione}}</td>
                    <td>{{$ricambio_disabilitato->codice_pezzo}}</td>
                    <td>{{$ricambio_disabilitato->prezzo}}</td>
                    <td>{{$ricambio_disabilitato->descrizione}}</td>
                    <td>{{count(ModelloCompatibile::where('ricambio_id' , $ricambio_disabilitato->id)->get())}}</td>
                    <td>{{count(Immagine::where('ricambio_id' , $ricambio_disabilitato->id)->get())}}</td>
                    <td>
                        <div class="d-flex">
                            <form action="{{route('riabilitaRicambio' , compact('ricambio_disabilitato'))}}" method="post"> 
                                @csrf 
                                @method('put')
                                <button type="submit" class="btn btn-info">Riabilita</button>
                            </form>
                        </div>
                    </td>
                </tr>    
            @endforeach    
        </tbody>
    </table>
        
    
</x-layout>