<x-layout>
<h1>Fornitori:</h1>
    <div class="container-fluid">
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ragione Sociale</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col">Comune</th>
                    <th scope="col">C.A.P.</th>
                    <th scope="col">Provincia</th>
                    <th scope="col">Partita IVA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fornitori as $fornitore)
                    <tr>
                    <th scope="row">{{$fornitore->ragione_sociale}}</th>
                    <td>{{$fornitore->indirizzo}}</td>
                    <td>{{$fornitore->comune}}</td>
                    <td>{{$fornitore->cap}}</td>
                    <td>{{$fornitore->provincia}}</td>
                    <td>{{$fornitore->partita_iva}}</td>
                    </tr>    
                @endforeach    
            </tbody>
        </table>
        <a href="{{route('aggiungiFornitore')}}" class="btn btn-danger">Aggiungi Fornitore</a>
    </div>
</x-layout>