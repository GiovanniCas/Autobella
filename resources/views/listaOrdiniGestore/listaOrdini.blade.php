@php
    use App\Models\Testata;
@endphp
<x-layout>
    <h1 class="color-brown">Lista Ordini:</h1>
    <div class="container-fluid">
            
            <table class="table">
                <thead>
                    <tr class="color-brown">
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Città</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">C.A.P.</th>
                        <th scope="col">email</th>
                        <th scope="col">Totale</th>
                        <th scope="col">Data</th>
                        <th scope="col">Stato</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordini as $ordine)
                        <tr>
                            <th>{{$ordine->name}}</th>
                            <td>{{$ordine->cognome}}</td>
                            <td>{{$ordine->citta}}</td>
                            <td>{{$ordine->indirizzo}}</td>
                            <td>{{$ordine->cap}}</td>
                            <td>{{$ordine->email}}</td>
                            <td>{{$ordine->totale}}</td>
                            <td>{{$ordine->data}}</td>
                            <td>
                                @if($ordine->stato == Testata::ORDINE_IN_PREPARAZIONE)
                                <form action="{{route('ordineSpedito' , compact('ordine'))}}" method="post">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-success">Spedito</button>
                                </form>
                                @endif
                                @if($ordine->stato == Testata::ORDINE_SPEDITO)
                                    <p>Spedito!</p>
                                @endif
                            </td>
                           
                        </tr>    
                    @endforeach    
                </tbody>
            </table>    
        </div>
</x-layout>